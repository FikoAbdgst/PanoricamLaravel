<div class="w-full h-full relative bg-white overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
        <img src="{{ asset('hindia/bg-hindia.png') }}" 
         class="w-[190px] h-[500px] opacity-80 z-10" />

    <div class="absolute z-[30] top-[-17px] left-[65px] pointer-events-none">
        <img src="{{ asset('hindia/hindia1.png') }}" alt="Logo" class="h-[60px] w-auto">
    </div>
    <div class="absolute z-[30] top-[80px] left-[-3px] pointer-events-none">
        <img src="{{ asset('hindia/hindia2.png') }}" alt="Logo" class="h-[110px] w-auto">
    </div>
    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="0" data-has-photo="false">⟲</button>
        </div>
    </div>

    <div class="absolute z-[30] top-[215px] right-[-8px] pointer-events-none">
        <img src="{{ asset('hindia/hindia3.png') }}" alt="Logo" class="h-[120px] w-auto">
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

    <div class="absolute z-[30] bottom-[98px] left-[-20px] pointer-events-none">
        <img src="{{ asset('hindia/hindia4.png') }}" alt="Logo" class="h-[85px] w-auto  ">
    </div>


    <div class=" z-[50] relative bottom-[140px] left-[0px] ">
        <img src="{{ asset('hindia/hindia5.png') }}" alt="Logo" class="h-[170px] w-auto mx-auto ">
    </div>

</div>
