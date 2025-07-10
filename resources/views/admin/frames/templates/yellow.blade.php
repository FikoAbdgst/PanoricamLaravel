<div class="w-full h-full relative bg-white overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
     <img src="{{ asset('yellow/bg-yellow.png') }}" 
         class="w-[190px] h-[500px] opacity-80 z-10" />
    
    <div class="absolute z-[30] top-[40px] left-[-17px] pointer-events-none">
        <img src="{{ asset('yellow/yellow1.png') }}" alt="Logo" class="h-[40px] w-auto">
    </div>
    <div class="absolute z-[30] top-[7px] right-[-3px] pointer-events-none">
        <img src="{{ asset('yellow/yellow3.png') }}" alt="Logo" class="h-[30px] w-auto">
    </div>
    <div class="absolute z-[30] top-[80px] right-[-17px] pointer-events-none">
        <img src="{{ asset('yellow/yellow1.png') }}" alt="Logo" class="h-[40px] w-auto scale-x-[-1] ">
    </div>
    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="0" data-has-photo="false">⟲</button>
        </div>
    </div>

    <div class="absolute z-[30] top-[145px] left-[2px] pointer-events-none">
        <img src="{{ asset('yellow/yellow3.png') }}" alt="Logo" class="h-[30px] w-auto scale-x-[-1] ">
    </div>
    <div class="absolute z-[30] top-[175px] right-[2px] pointer-events-none">
        <img src="{{ asset('yellow/yellow2.png') }}" alt="Logo" class="h-[40px] w-auto scale-x-[-1]">
    </div>
    <div class="absolute z-[30] top-[235px] left-[2px] pointer-events-none">
        <img src="{{ asset('yellow/yellow1.png') }}" alt="Logo" class="h-[30px] w-auto scale-x-[-1] ">
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

    <div class="absolute z-[30] bottom-[180px] right-[-15px] pointer-events-none">
        <img src="{{ asset('yellow/yellow1.png') }}" alt="Logo" class="h-[40px] w-auto ">
    </div>
    <div class="absolute z-[30] bottom-[180px] left-[3px] pointer-events-none">
        <img src="{{ asset('yellow/yellow2.png') }}" alt="Logo" class="h-[30px] w-auto ">
    </div>
    <div class="absolute z-[30] bottom-[80px] left-[-15px] pointer-events-none">
        <img src="{{ asset('yellow/yellow1.png') }}" alt="Logo" class="h-[40px] w-auto scale-x-[-1]">
    </div>
    <div class="absolute z-[30] bottom-[90px] right-[5px] pointer-events-none">
        <img src="{{ asset('yellow/yellow3.png') }}" alt="Logo" class="h-[30px] w-auto ">
    </div>

    <div class=" z-[20] relative bottom-[35px] left-[-5px] ">
        <img src="{{ asset('panoricam2.png') }}" alt="Logo" class="h-[15px] w-auto mx-auto ">
    </div>

</div>
