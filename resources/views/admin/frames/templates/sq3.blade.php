<div class="w-full h-full relative bg-white overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
     <img src="{{ asset('images/sqwarna/sq3.png') }}" 
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


<div class="absolute z-[30] bottom-[-30px] left-2 w-full text-center pointer-events-none">
    <img src="{{ asset('images/sqwarna/lagusq.png') }}" alt="Nj7"
     class="w-[170px] mx-auto drop-shadow-[0_0px_0px_rgba(255,105,180,0.5)] transition-transform duration-300 hover:scale-105"
     style="transform: translateX(-10px);">

    <div class=" z-[20] relative bottom-[45px] left-[-5px] ">
        <img src="{{ asset('panoricam2.png') }}" alt="Logo" class="h-[13px] w-auto mx-auto ">
    </div>

</div>
