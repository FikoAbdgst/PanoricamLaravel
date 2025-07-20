<div class="w-full h-full relative bg-black overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <img src="{{ asset('sunwoo/bg-sunwoo.png') }}" class="w-[190px] h-[500px] opacity-80 z-10" />

    <div class="absolute z-[30] top-[53px] left-[-25px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo1.png') }}" alt="Logo" class="h-[100px] w-auto">
    </div>
    <div class="absolute z-[30] top-[30px] left-[-25px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo3.png') }}" alt="Logo" class="h-[50px] w-auto">
    </div>
    <div class="absolute z-[30] top-[15px] right-[3px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo4.png') }}" alt="Logo" class="h-[40px] w-auto">
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

    <div class="absolute z-[30] top-[143px] left-[4px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo6.png') }}" alt="Logo" class="h-[135px] w-auto">
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

    <div class="absolute z-[30] bottom-[187px] left-[3px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo4.png') }}" alt="Logo" class="h-[40px] w-auto ">
    </div>
    <div class="absolute z-[30] bottom-[170px] right-[-15px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo3.png') }}" alt="Logo" class="h-[50px] w-auto scale-x-[-1]">
    </div>
    <div class="absolute z-[30] bottom-[95px] right-[-40px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo2.png') }}" alt="Logo" class="h-[100px] w-auto ">
    </div>
    <div class="absolute z-[30] bottom-[45px] left-[-10px] pointer-events-none">
        <img src="{{ asset('sunwoo/sunwoo5.png') }}" alt="Logo" class="h-[55px] w-auto ">
    </div>

    <div class=" z-[20] relative bottom-[35px] left-[-5px] ">
        <img src="{{ asset('panoricam2.png') }}" alt="Logo" class="h-[15px] w-auto mx-auto ">
    </div>

</div>
