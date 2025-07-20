<div class="w-full h-full relative bg-blue-900 overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot relative w-full h-full">
            <img id="photo1" src="" class="w-full h-full object-cover bg-gray-100">
            <!-- Centered button container -->
            <div class="absolute inset-0 flex items-center justify-center gap-5 mr-5">
                <button
                    class="retake-button bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full w-8 h-8 flex items-center justify-center text-lg shadow-md transition-all"
                    data-index="0" data-has-photo="false" title="Retake Photo">⟲</button>
                <button
                    class="recrop-button bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full w-8 h-8 flex items-center justify-center shadow-md transition-all"
                    data-index="0" data-has-photo="false" title="Recrop Photo">✂</button>
            </div>
        </div>
    </div>

    <!-- Second Photo Slot -->
    <div class="absolute top-[150px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="1">
        <div class="photo-slot relative w-full h-full">
            <img id="photo2" src="" class="w-full h-full object-cover bg-gray-100">
            <!-- Centered button container -->
            <div class="absolute inset-0 flex items-center justify-center gap-5 mr-5">
                <button
                    class="retake-button bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full w-8 h-8 flex items-center justify-center text-lg shadow-md transition-all"
                    data-index="1" data-has-photo="false" title="Retake Photo">⟲</button>
                <button
                    class="recrop-button bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full w-8 h-8 flex items-center justify-center shadow-md transition-all"
                    data-index="1" data-has-photo="false" title="Recrop Photo">✂</button>
            </div>
        </div>
    </div>
    <!-- Third Photo Slot -->
    <div class="absolute top-[280px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="2">
        <div class="photo-slot relative w-full h-full">
            <img id="photo3" src="" class="w-full h-full object-cover bg-gray-100">
            <!-- Centered button container -->
            <div class="absolute inset-0 flex items-center justify-center gap-5 mr-5">
                <button
                    class="retake-button bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full w-8 h-8 flex items-center justify-center text-lg shadow-md transition-all"
                    data-index="2" data-has-photo="false" title="Retake Photo">⟲</button>
                <button
                    class="recrop-button bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full w-8 h-8 flex items-center justify-center shadow-md transition-all"
                    data-index="2" data-has-photo="false" title="Recrop Photo">✂</button>
            </div>
        </div>
    </div>

    <div class="absolute z-[30] bottom-[200px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('images/nj/nj1.png') }}" alt="Nj1" style="transform: translateX(-20px);"
            class="h-[80px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[320px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('images/nj/nj2.png') }}" alt="Nj2" style="transform: translateX(100px);"
            class="h-[102px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[0px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('images/nj/nj4.png') }}" alt="Nj4" style="transform: translateX(90px);"
            class="h-[102px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[450px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('images/nj/nj5.png') }}" alt="Nj5" style="transform: translateX(140px);"
            class="h-[80px] w-auto">
    </div>


    <div class="absolute z-[30] bottom-[420px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('images/nj/nj6.png') }}" alt="Nj6" style="transform: translateX(0px);"
            class="h-[80px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[30px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('images/nj/nj3.png') }}" alt="Nj3" style="transform: translateX(-15px);"
            class="h-[110px] w-auto">
    </div>
    <div class=" z-[20] relative bottom-[30px] left-[-5px] ">
        <img src="{{ asset('panoricam2.png') }}" alt="Logo" class="h-[13px] w-auto mx-auto ">
    </div>




    <!-- Frame Footer -->

    <div class="absolute z-[30] bottom-[50px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('images/nj/nj7.png') }}" alt="Nj7"
            class="w-[120px] mx-auto drop-shadow-[0_0px_0px_rgba(255,105,180,0.5)] transition-transform duration-300 hover:scale-105"
            style="transform: translateX(40px);">

        <div class="absolute z-[30] bottom-[-200px] left-2 w-full text-center pointer-events-none">
            <img src="{{ asset('images/nj/nj8.png') }}" alt="Nj8"
                class="w-[250px] mx-auto drop-shadow-[0_0px_00px_rgba(255,105,180,0.5)] transition-transform duration-300 hover:scale-105"
                style="transform: translateX(-16px);">

        </div>

    </div>
