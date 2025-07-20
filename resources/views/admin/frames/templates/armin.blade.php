<div class="w-full h-full relative bg- overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
     <img src="{{ asset('AoT/bg-aot.png') }}" 
         class="w-[190px] h-[500px]" />
    
    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="0" data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]"
                data-index="0" data-has-photo="false" title="Recrop Photo">✂️</button>
        </div>
    </div>

    <!-- Second Photo Slot -->
    <div class="absolute top-[150px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="1">
        <div class="photo-slot">
            <img id="photo2" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="1"
                data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]"
                data-index="1" data-has-photo="false" title="Recrop Photo">✂️</button>
        </div>
    </div>

    <!-- Third Photo Slot -->
    <div class="absolute top-[280px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="2">
        <div class="photo-slot">
            <img id="photo3" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="2"
                data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]"
                data-index="2" data-has-photo="false" title="Recrop Photo">✂️</button>
        </div>
    </div>

    <div class="absolute z-[30] bottom-[190px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('AoT/armin4.png') }}" alt="Nj1" style="transform: translateX(-50px);" class="h-[110px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[90px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('AoT/armin1.png') }}" alt="Nj2" style="transform: translateX(110px);" class="h-[100px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[320px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('AoT/armin2.png') }}" alt="Nj2" style="transform: translateX(120px);" class="h-[90px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[425px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('AoT/armin3.png') }}" alt="Nj3" style="transform: translateX(-30px);" class="h-[90px] w-auto">
    </div>

        <div class="absolute z-[30] bottom-[455px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('AoT/pengintai.png') }}" alt="Nj3" style="transform: translateX(155px);" class="h-[30px] w-auto">
    </div>


<div class="absolute z-[30] bottom-[-30px] left-2 w-full text-center pointer-events-none">
    <img src="{{ asset('AoT/logoaot.png') }}" alt="Nj7"
     class="w-[250px] mx-auto transition-transform duration-300 hover:scale-105"
     style="transform: translateX(-8px);">

    <div class=" z-[20] relative bottom-[20px] left-[-7px] ">
        <img src="{{ asset('panoricam.png') }}" alt="Logo" class="h-[70px] w-auto mx-auto ">
    </div>

</div>
