<div class="bg-white rounded-lg p-4 shadow mb-6" id="pkCalculatorBlock">
    <h3 class="font-bold mb-4 text-[#373E51]">PK Calculator</h3>
    <div class="space-y-3">
        <div>
            <select id="roomCondition" class="w-full border rounded p-2 text-sm">
                <option value="">Pilih Kondisi Ruangan</option>
                <option value="terkena-matahari">Ruangan: Terkena Sinar Matahari</option>
                <option value="tidak-terkena-matahari">Ruangan: Tidak Terkena Sinar Matahari</option>
            </select>
        </div>
        <div class="bg-gray-100 rounded-lg p-3 text-center">
            <div class="text-3xl font-bold text-[#41B8EA]"><span id="m2Display">0</span> m²</div>
        </div>
        
        <div class="relative w-full h-[50px] mt-0 mb-3">
            <div class="absolute bg-[#f3f3f3] h-[11px] left-0 rounded-full top-[5px] w-full"></div>
            <div id="sliderHandle" class="absolute w-[20px] h-[20px] top-0 transition-all duration-150" style="left: 0px;">
                <div class="absolute inset-[-35%]">
                     <svg class="block w-full h-full" fill="none" viewBox="0 0 34 34">
                        <circle cx="17" cy="17" fill="#41B8EA" r="10" />
                        <circle cx="17" cy="17" r="11.5" stroke="white" stroke-width="3" />
                    </svg>
                </div>
            </div>
            
            <p class="absolute font-normal left-0 text-[13px] text-black whitespace-nowrap top-[28px]">0 m²</p>
            <p class="absolute font-normal right-0 text-[13px] text-black whitespace-nowrap top-[28px]">250 m²</p>
            
            <input type="range" id="m2Slider" min="0" max="250" value="0" class="w-full h-[20px] opacity-0 cursor-pointer absolute top-0 left-0 z-10">
        </div>
        
        <div class="text-xs text-gray-600 leading-relaxed">Geser kiri atau kanan slider dibawah ini sesuai ukuran ruangan anda dan klik tombol "Mulai Hitung" dibawah ini</div>
        
        <button id="calculateBtn" class="w-full bg-[#F99C1C] hover:bg-[#F99C1C]/90 text-white py-2 rounded-lg font-semibold transition-colors">
            Mulai Hitung
        </button>
    </div>
</div>

<div id="calculationResult" class="hidden mb-6">
    <div class="bg-[#f3f3f3] rounded-lg p-5 relative">
        <div class="mb-4">
            <p class="font-semibold text-sm mb-3">Hasil PK Calculator</p>
            <p class="text-base leading-relaxed mb-1">
                <span class="font-semibold text-[#222]">Daya:</span>
                <span class="font-semibold text-[#41B8EA]" id="btuResult">-</span>
                <span class="text-[#222]">Btu/h</span>
            </p>
            <p class="text-base leading-relaxed">
                <span class="font-semibold text-[#222]">Kebutuhan:</span>
                <span class="font-semibold text-[#41B8EA]" id="pkResult">-</span>
                <span class="text-[#222]">PK</span>
            </p>
        </div>
        <button id="recommendationBtn" class="w-full bg-[#3EB48A] hover:bg-[#3EB48A]/90 text-white py-2 rounded-lg font-semibold transition-colors mt-3 text-sm">
            Lihat Rekomendasi
        </button>
    </div>
</div>