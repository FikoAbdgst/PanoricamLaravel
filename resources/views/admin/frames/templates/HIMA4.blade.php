<div class="w-full h-full relative bg-[#720400] overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <div class="absolute z-[20]  top-[-17px] left-[-13px]">
        <img src="{{ asset('pitap.png') }}" alt="Logo" class="h-[40px] w-auto scale-x-[-1]">
    </div>
    <div class="z-[30] relative top-[-30px] pointer-events-none">
        <img src="{{ asset('himamaroon.png') }}" alt="Logo" class="h-[85px] w-auto mx-auto">
    </div>
    <div class="absolute z-[30] top-3 right-0 pointer-events-none">
        <img src="{{ asset('pitap.png') }}" alt="Logo" class="h-[40px] w-auto ">
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


    <div class="absolute z-[30] top-[137px] left-[-5px] pointer-events-none">
        <img src="{{ asset('pitap.png') }}" alt="Logo" class="h-[40px] w-auto scale-x-[-1]">
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
    <div class="absolute z-[30] top-[260px] right-[-5px] pointer-events-none">
        <img src="{{ asset('pitap.png') }}" alt="Logo" class="h-[40px] w-auto">
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
    <!-- Frame Footer -->
    <div class="absolute bottom-[-3px] left-0 w-full text-center z-[30]">
        <img src="{{ asset('hima3.png') }}" alt="Logo" class="h-[160px] w-auto mx-auto">
    </div>

    <div class="z-[20] relative bottom-[-365px]">
        <img src="{{ asset('panoricam.png') }}" alt="Logo" class="h-[70px] w-auto mx-auto">
    </div>

</div>
