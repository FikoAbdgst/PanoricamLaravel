<div class="w-full h-full relative bg-blue-0 overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <img src="{{ asset('oasis/oasis.jpeg') }}" class="w-[190px] h-[500px] opacity-80 z-10" />

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

    <div class="absolute z-[30] bottom-[430px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/tag.png') }}" alt="Nj1" style="transform: translateX(35px);"
            class="h-[100px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[405px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/oasis4.png') }}" alt="Nj2" style="transform: translateX(-30px) rotate(-20deg);"
            class="h-[140px] w-auto">
    </div>

    <div class="absolute z-[30] bottom-[310px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/oasis7.png') }}" alt="Nj2" style="transform: translateX(120px) rotate(-20deg);"
            class="h-[90px] w-auto">
    </div>


    <div class="absolute z-[40] bottom-[200px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/oasis5.png') }}" alt="Nj1" style="transform: translateX(-20px) rotate(0deg);"
            class="h-[30px] w-auto">
    </div>
    <div class="absolute z-[30] bottom-[200px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/oasis6.png') }}" alt="Nj1" style="transform: translateX(-30px) rotate(30deg);"
            class="h-[90px] w-auto">
    </div>


    <div class="absolute z-[30] bottom-[-20px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/oasis1.png') }}" alt="Nj3" style="transform: translateX(-50px);"
            class="h-[180px]">
    </div>
    <div class="absolute z-[30] bottom-[82px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/oasis3.png') }}" alt="Nj7" class="w-[120px]"
            style="transform: translateX(110px) rotate(-20deg);">

    </div>
    <div class="absolute z-[20] bottom-[-25px] left-2 w-full text-center pointer-events-none">
        <img src="{{ asset('oasis/oasis2.jpeg') }}" alt="Nj7" class="w-[100px]"
            style="transform: translateX(90px) rotate(-10deg);">

    </div>
    <div class="absolute z-[50] bottom-[35px] left-[65px] pointer-events-none">
        <img src="{{ asset('panoricam2.png') }}" alt="Logo" class="h-[10px] w-auto">
    </div>


</div>
