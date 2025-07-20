<div class="w-full h-full relative bg-white overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <!-- First Photo Slot -->
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="0" data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]" data-index="0" data-has-photo="false"
                title="Recrop Photo">✂</button>
        </div>
    </div>

    <!-- Second Photo Slot -->
    <div class="absolute top-[150px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="1">
        <div class="photo-slot">
            <img id="photo2" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="1"
                data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]" data-index="1" data-has-photo="false"
                title="Recrop Photo">✂</button>
        </div>
    </div>

    <!-- Third Photo Slot -->
    <div class="absolute top-[280px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="2">
        <div class="photo-slot">
            <img id="photo3" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="2"
                data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]" data-index="2" data-has-photo="false"
                title="Recrop Photo">✂</button>
        </div>
    </div>

    <!-- Frame Footer -->
    <div class="absolute bottom-[10px] left-0 w-full text-center">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-[70px] w-auto mx-auto">
    </div>
</div>
