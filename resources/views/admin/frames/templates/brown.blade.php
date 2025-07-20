<div class="w-full h-full relative bg-[#462d1b] overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">

    <div class="absolute z-[30] top-[-25px] left-[2px] pointer-events-none">
        <img src="{{ asset('brown/brown1.png') }}" alt="Logo" class="h-[205px] w-auto">
    </div>

    <div class="absolute z-[30] top-[11px] left-[5px] pointer-events-none">
        <img src="{{ asset('brown/brown2.png') }}" alt="Logo" class="h-[40px] w-auto">
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

    <div class="absolute z-[30] top-[115px] left-[2px] pointer-events-none">
        <img src="{{ asset('brown/brown1.png') }}" alt="Logo" class="h-[205px] w-auto">
    </div>
    <div class="absolute z-[30] top-[140px] right-[-2px] pointer-events-none">
        <img src="{{ asset('brown/brown3.png') }}" alt="Logo" class="h-[65px] w-auto ">
    </div>
    <div class="absolute z-[30] top-[230px] left-[-20px] pointer-events-none">
        <img src="{{ asset('brown/brown3.png') }}" alt="Logo" class="h-[65px] w-auto ">
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

    <div class="absolute z-[30] bottom-[55px] left-[2px] pointer-events-none">
        <img src="{{ asset('brown/brown1.png') }}" alt="Logo" class="h-[205px] w-auto">
    </div>
    <div class="absolute z-[30] bottom-[95px] right-[-5px] pointer-events-none">
        <img src="{{ asset('brown/brown2.png') }}" alt="Logo" class="h-[40px] w-auto scale-x-[-1] ">
    </div>

    <div class=" absolute z-[30] bottom-[-5px] left-[50px] ">
        <img src="{{ asset('panoricam.png') }}" alt="Logo" class="h-[80px] w-auto mx-auto ">
    </div>

</div>
