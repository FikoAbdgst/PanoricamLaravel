<!-- resources/views/components/sidebar.blade.php -->
<!-- Overlay untuk mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

<!-- Sidebar dengan posisi fixed dan responsif -->
<div id="sidebar"
    class="fixed left-0 top-0 w-64 bg-gray-800 text-white flex flex-col justify-between h-screen z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="overflow-y-auto">
        <!-- Header dengan close button untuk mobile -->
        <div class="p-4 border-b border-gray-700 lg:border-b-0">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Photobooth Admin</h2>
                    <p class="text-sm text-gray-400 mt-1">Selamat datang, {{ session('admin_name') }}</p>
                </div>
                <!-- Close button untuk mobile -->
                <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 flex flex-col space-y-2 px-4">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14-4l-3 3.5L13 6m6 5l-3-3.5L13 11"></path>
                </svg>
                <span>Kelola Kategori</span>
            </a>
            <a href="{{ route('admin.frames.index') }}"
                class="flex items-center py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.frames.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span>Kelola Frame</span>
            </a>
            <a href="{{ route('admin.testimoni.index') }}"
                class="flex items-center py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.testimoni.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
                <span>Kelola Testimoni</span>
            </a>
            <a href="{{ route('admin.transactions.index') }}"
                class="flex items-center py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.transactions.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Kelola Transaksi</span>
            </a>
        </nav>
    </div>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-700">
        <a href="{{ route('admin.logout') }}"
            class="flex items-center justify-center bg-red-700 py-3 px-4 rounded-lg text-white hover:bg-red-800 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                </path>
            </svg>
            <span>Logout</span>
        </a>
    </div>
</div>

<!-- Toggle Button untuk Mobile -->
<button id="toggle-sidebar"
    class="fixed top-4 left-4 z-50 lg:hidden bg-gray-800 text-white p-2 rounded-lg shadow-lg hover:bg-gray-700 transition-all duration-300 ease-in-out">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('toggle-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        // Function untuk hide/show toggle button
        function hideToggleButton() {
            toggleButton.classList.add('opacity-0', 'pointer-events-none', 'scale-75');
        }

        function showToggleButton() {
            toggleButton.classList.remove('opacity-0', 'pointer-events-none', 'scale-75');
        }

        // Toggle sidebar
        toggleButton.addEventListener('click', function() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            hideToggleButton();
        });

        // Close sidebar
        closeSidebar.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            showToggleButton();
        });

        // Close sidebar ketika overlay diklik
        overlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            showToggleButton();
        });

        // Close sidebar ketika window diresize ke desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                showToggleButton(); // Reset button state
            } else {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    // Jika sidebar terbuka di mobile setelah resize
                    hideToggleButton();
                } else {
                    // Jika sidebar tertutup di mobile setelah resize
                    showToggleButton();
                }
            }
        });

        // Close sidebar dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && window.innerWidth < 1024) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    showToggleButton();
                }
            }
        });
    });
</script>
