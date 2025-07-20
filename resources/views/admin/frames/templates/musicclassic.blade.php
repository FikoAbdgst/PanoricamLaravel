<div class="w-full h-full relative bg-black-1000 overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
     <img src="{{ asset('music/mus2.png') }}" 
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

    <div class="absolute z-[30] bottom-[-90px] left-2 w-full text-center pointer-events-none">
    <img src="{{ asset('music/mus.png') }}" alt="Nj7"
     class="w-[170px] mx-auto drop-shadow-[0_0px_0px_rgba(255,105,180,0.5)] transition-transform duration-300 hover:scale-105"
     style="transform: translateX(-8px);">

    <div class=" z-[20] relative bottom-[70px] left-[-7px] ">
        <img src="{{ asset('panoricam.png') }}" alt="Logo" class="h-[70px] w-auto mx-auto ">
    </div>

</div>
