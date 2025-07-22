 <div class="w-full h-full relative bg- overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.3)]">
     <img src="{{ asset('bg/47.png') }}" class="w-[190px] h-[500px] opacity-80 z-10" />

     <!-- First Photo Slot -->
     <div class="absolute top-[20px] left-[10px] w-[calc(100%-20px)] h-[120px]" data-photo-index="0">
         <div class="photo-slot">
             <img id="photo1" src="" class="w-full h-full object-cover">
             <button class="retake-button absolute top-1 right-1 text-lg z-[50]" data-index="0"
                 data-has-photo="false">⟲</button>
         </div>
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

     <div class="absolute z-[30] bottom-[360px] left-2 w-full text-center pointer-events-none">
         <img src="{{ asset('demonslayer/tulisan-ds.png') }}" alt="Nj1" style="transform: translateX(-30px);"
             class="h-[120px] w-auto">
     </div>

     <div class="absolute z-[30] bottom-[350px] left-2 w-full text-center pointer-events-none">
         <img src="{{ asset('demonslayer/reng1.png') }}" alt="Nj2" style="transform: translateX(122px);"
             class="h-[75px] w-auto">
     </div>

     <div class="absolute z-[30] bottom-[70px] left-2 w-full text-center pointer-events-none">
         <img src="{{ asset('demonslayer/reng2.png') }}" alt="Nj2" style="transform: translateX(118px);"
             class="h-[110px] w-auto">
     </div>

     <div class="absolute z-[30] bottom-[180px] left-2 w-full text-center pointer-events-none">
         <img src="{{ asset('demonslayer/reng3.png') }}" alt="Nj3" style="transform: translateX(-20px);"
             class="h-[90px] w-auto">
     </div>

     <div class="absolute z-[30] bottom-[455px] left-2 w-full text-center pointer-events-none">
         <img src="{{ asset('demonslayer/logo-ds.png') }}" alt="Nj3" style="transform: translateX(145px);"
             class="h-[30px] w-auto">
     </div>


     <div class="absolute z-[30] bottom-[-35px] left-2 w-full text-center pointer-events-none">
         <img src="{{ asset('demonslayer/logo-ds.png') }}" alt="Nj7"
             class="w-[100px] mx-auto transition-transform duration-300 hover:scale-105"
             style="transform: translateX(-8px);">

         <div class=" z-[20] relative bottom-[20px] left-[-7px] ">
             <img src="{{ asset('panoricam.png') }}" alt="Logo" class="h-[70px] w-auto mx-auto ">
         </div>

     </div>
