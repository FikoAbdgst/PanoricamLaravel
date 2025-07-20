<div class="w-full h-full relative overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
    <img src="{{ asset('tape.png') }}" class="absolute top-0 left-0 opacity-80 z-0 pointer-events-none" />
    <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px] z-10" data-photo-index="0">
        <div class="photo-slot">
            <img id="photo1" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="0" data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]" data-index="0" data-has-photo="false"
                title="Recrop Photo">✂</button>
        </div>
    </div>

    <div class="absolute top-[150px] left-[10px] w-[calc(100%-20px)] h-[120px] z-10" data-photo-index="1">
        <div class="photo-slot">
            <img id="photo2" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="1"
                data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]" data-index="1" data-has-photo="false"
                title="Recrop Photo">✂</button>
        </div>
    </div>

    <div class="absolute top-[280px] left-[10px] w-[calc(100%-20px)] h-[120px] z-10" data-photo-index="2">
        <div class="photo-slot">
            <img id="photo3" src="" class="w-full h-full object-cover">
            <button class="retake-button absolute top-1 right-1 text-lg" data-index="2"
                data-has-photo="false">⟲</button>
            <button class="recrop-button absolute top-1 right-1 z-[60]" data-index="2" data-has-photo="false"
                title="Recrop Photo">✂</button>
        </div>
    </div>
</div>
