<div class="w-full h-full relative bg-black overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <img src="{{ asset('wanpis/bg-wanpis.png') }}" 
         class="w-[190px] h-[500px] opacity-80 z-10" />

    <div class="absolute z-[30] top-[2px] right-[-40px] pointer-events-none">
        <img src="{{ asset('wanpis/wanpis1.png') }}" alt="Logo" class="h-[100px] w-auto">
    </div>
    <div class="absolute z-[30] top-[75px] left-[-40px] pointer-events-none">
        <img src="{{ asset('wanpis/wanpis2.png') }}" alt="Logo" class="h-[100px] w-auto">
    </div>
    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="0" data-has-photo="false">⟲</button>
        </div>
    </div>

    <div class="absolute z-[30] top-[160px] right-[-40px] pointer-events-none">
        <img src="{{ asset('wanpis/wanpis3.png') }}" alt="Logo" class="h-[100px] w-auto">
    </div>

    <!-- Second Photo Slot -->
    <div class="absolute top-[150px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="1">
        <div class="photo-slot">
            <img id="photo2" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="1"
                data-has-photo="false">⟲</button>
        </div>
    </div>

    <!-- Third Photo Slot -->
    <div class="absolute top-[280px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="2">
        <div class="photo-slot">
            <img id="photo3" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="2"
                data-has-photo="false">⟲</button>
        </div>
    </div>

    <div class="absolute z-[30] bottom-[110px] left-[-20px] pointer-events-none">
        <img src="{{ asset('wanpis/wanpis4.png') }}" alt="Logo" class="h-[90px] w-auto ">
    </div>
    <div class="absolute z-[30] bottom-[85px] right-[-25px] pointer-events-none">
        <img src="{{ asset('wanpis/wanpis5.png') }}" alt="Logo" class="h-[115px] w-auto ">
    </div>
        <div class=" z-[10] relative bottom-[120px] left-[-3px] ">
        <img src="{{ asset('wanpis/wanpis6.png') }}" alt="Logo" class="h-[120px] w-auto mx-auto ">
    </div>
</div>
