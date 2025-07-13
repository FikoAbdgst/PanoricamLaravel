<div class="w-full h-full relative bg-white overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
     <img src="{{ asset('bgoliver.png') }}" 
         class="w-[190px] h-[500px] opacity-80 z-10" />
    
    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="0" data-has-photo="false">⟲</button>
        </div>
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

        <div class="absolute z-[30] bottom-[320px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('Oliver.png') }}" alt="Nj1" style="transform: translateX(-2px);" class="h-[180px] w-auto">
    </div>
        <div class="absolute z-[30] bottom-[190px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('Oliver.png') }}" alt="Nj1" style="transform: translateX(-2px);" class="h-[180px] w-auto">
    </div>
        <div class="absolute z-[30] bottom-[60px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('Oliver.png') }}" alt="Nj1" style="transform: translateX(-2px);" class="h-[180px] w-auto">
    </div>

    <div class=" z-[20] relative bottom-[45px] left-[0px] ">
        <img src="{{ asset('panoricam2.png') }}" alt="Logo" class="h-[13px] w-auto mx-auto ">
    </div>

</div>
