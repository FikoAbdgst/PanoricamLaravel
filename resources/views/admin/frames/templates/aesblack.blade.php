<div class="w-full h-full relative bg-blue-0 overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <img src="{{ asset('ae/blpk.png') }}" class="w-[190px] h-[500px] opacity-80 z-10" />

    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="0" data-has-photo="false">⟲</button>
            <button class="recrop-button" data-index="0" data-has-photo="false" title="Recrop Photo">✂️</button>
        </div>
    </div>

    <!-- Second Photo Slot -->
    <div class="absolute top-[150px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="1">
        <div class="photo-slot">
            <img id="photo2" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="1"
                data-has-photo="false">⟲</button>
            <button class="recrop-button" data-index="1" data-has-photo="false" title="Recrop Photo">✂️</button>
        </div>
    </div>

    <!-- Third Photo Slot -->
    <div class="absolute top-[280px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="2">
        <div class="photo-slot">
            <img id="photo3" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="2"
                data-has-photo="false">⟲</button>
            <button class="recrop-button" data-index="2" data-has-photo="false" title="Recrop Photo">✂️</button>
        </div>
    </div>

    <div class="absolute z-[30] bottom-[430px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('ae/ae1.png') }}" alt="Nj1" style="transform: translateX(-20px);"
            class="h-[80px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[200px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('/ae/ae2.png') }}" alt="Nj2" style="transform: translateX(140px);"
            class="h-[50px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[330px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('/ae/ae5.png') }}" alt="Nj2" style="transform: translateX(135px);"
            class="h-[50px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[450px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('/ae/ae2.png') }}" alt="Nj2" style="transform: translateX(130px);"
            class="h-[90px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[320px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('/ae/ae6.png') }}" alt="Nj2" style="transform: translateX(-40px);"
            class="h-[80px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[170px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('ae/ae1.png') }}" alt="Nj1" style="transform: translateX(-20px);"
            class="h-[80px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[70px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('ae/ae5.png') }}" alt="Nj3" style="transform: translateX(-15px);"
            class="h-[70px] w-auto">
    </div>
    <div class="absolute z-[50] bottom-[5px] left-[55px] pointer-events-none">
        <img src="{{ asset('panoricam.png') }}" alt="Logo" class="h-[80px] w-auto">
    </div>




    <!-- Frame Footer -->

    <div class="absolute z-[30] bottom-[70px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('ae/ae3.png') }}" alt="Nj7"
            class="w-[70px] mx-auto drop-shadow-[0_0px_0px_rgba(255,105,180,0.5)] transition-transform duration-300 hover:scale-105"
            style="transform: translateX(65px);">

    </div>

</div>
