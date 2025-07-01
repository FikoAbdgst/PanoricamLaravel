<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource with filtering and search
     */
    public function index(Request $request)
    {
        $query = Testimoni::query();

        // Filter by rating if provided
        if ($request->has('rating') && $request->rating != '') {
            $query->where('rating', $request->rating);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('message', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Order by latest first
        $testimonis = $query->latest()->get();

        // If it's an AJAX request (for live search), return JSON
        if ($request->ajax()) {
            return response()->json([
                'testimonis' => $testimonis,
                'count' => $testimonis->count()
            ]);
        }

        return view('admin.testimoni.index', compact('testimonis'));
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy($id)
    {
        try {
            $testimoni = Testimoni::findOrFail($id);
            $customerName = $testimoni->name;
            $testimoni->delete();

            return redirect()->route('admin.testimoni.index')
                ->with('success', "Testimoni dari {$customerName} berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('admin.testimoni.index')
                ->with('error', 'Terjadi kesalahan saat menghapus testimoni.');
        }
    }

    /**
     * Get testimoni statistics for dashboard
     */
    public function getStats()
    {
        $stats = [
            'total' => Testimoni::count(),
            'by_rating' => [
                5 => Testimoni::where('rating', 5)->count(),
                4 => Testimoni::where('rating', 4)->count(),
                3 => Testimoni::where('rating', 3)->count(),
                2 => Testimoni::where('rating', 2)->count(),
                1 => Testimoni::where('rating', 1)->count(),
            ],
            'average_rating' => Testimoni::avg('rating'),
            'recent' => Testimoni::latest()->take(5)->get()
        ];

        return response()->json($stats);
    }

    /**
     * Bulk delete testimoni
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:testimonis,id'
        ]);

        try {
            $count = Testimoni::whereIn('id', $request->ids)->count();
            Testimoni::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => "{$count} testimoni berhasil dihapus."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus testimoni.'
            ], 500);
        }
    }

    /**
     * Export testimoni to CSV
     */
    public function export(Request $request)
    {
        $query = Testimoni::query();

        // Apply same filters as index
        if ($request->has('rating') && $request->rating != '') {
            $query->where('rating', $request->rating);
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('message', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $testimonis = $query->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="testimoni_' . date('Y-m-d_H-i-s') . '.csv"',
        ];

        $callback = function () use ($testimonis) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM for Excel compatibility
            fwrite($file, "\xEF\xBB\xBF");

            // CSV headers
            fputcsv($file, ['Nama', 'Rating', 'Pesan', 'Tanggal']);

            // CSV data
            foreach ($testimonis as $testimoni) {
                fputcsv($file, [
                    $testimoni->name,
                    $testimoni->rating,
                    $testimoni->message,
                    $testimoni->created_at ? $testimoni->created_at->format('d/m/Y H:i:s') : 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
