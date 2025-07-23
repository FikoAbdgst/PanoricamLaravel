<div class="w-full h-full relative bg-[#fff16a] overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <img src="{{ asset('retro/bg-retro.png') }}" class="w-[190px] h-auto opacity-100 z-10" />
    
    <div class="absolute z-[30] top-[-5px] left-[5px] pointer-events-none">
        <img src="{{ asset('retro/retro1.png') }}" alt="Logo" class="h-[180px] w-auto">
    </div>

    <div class="absolute z-[30] top-[105px] left-[-30px] pointer-events-none">
        <img src="{{ asset('retro/retro2.png') }}" alt="Logo" class="h-[75px] w-auto">
    </div>
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

    <div class="absolute z-[20] top-[125px] left-[5px] pointer-events-none">
        <img src="{{ asset('retro/retro1.png') }}" alt="Logo" class="h-[180px] w-auto">
    </div>
    <div class="absolute z-[30] top-[195px] right-[-30px] pointer-events-none">
        <img src="{{ asset('retro/retro3.png') }}" alt="Logo" class="h-[100px] w-auto ">
    </div>
    <div class="absolute z-[40] top-[295px] left-[1px] pointer-events-none">
        <img src="{{ asset('retro/retro4.png') }}" alt="Logo" class="h-[190px] w-auto ">
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

    <div class="absolute z-[20] bottom-[65px] left-[5px] pointer-events-none">
        <img src="{{ asset('retro/retro1.png') }}" alt="Logo" class="h-[180px] w-auto">
    </div>


    <div class=" z-[20] relative bottom-[-405px] left-[1px] ">
        <img src="{{ asset('retro/bg-retro.png') }}" alt="Logo" class="w-[200px] h-auto mx-auto ">
    </div>
    <div class=" z-[50] relative bottom-[-355px] left-[-5px] ">
        <img src="{{ asset('panoricam2.png') }}" alt="Logo" class="h-[15px] w-auto mx-auto ">
    </div>


</div>
