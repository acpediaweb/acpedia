<!-- Services Icons -->
    <div class="bg-white py-5 border-b">
        <div class="container mx-auto px-4">
            <!-- Mobile Dropdown -->
            <div class="md:hidden">
                <button id="servicesToggle" class="w-full flex items-center justify-between px-4 py-3 bg-white border border-gray-300 rounded-lg hover:border-[#41B8EA] transition-colors">
                    <span class="font-semibold text-[#373E51]">Layanan Kami</span>
                    <i data-lucide="chevron-down" id="servicesChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
                </button>
                <div id="servicesContent" class="dropdown-content mt-3 space-y-2">
                    <!-- PK Calculator -->
                    <button class="pkCalculatorServiceBtn service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#3EB48A] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#3EB48A] flex items-center justify-center relative">
                            <img src="\src\assets\pkcal.png" alt="PK Calculator" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">PK Calculator</span>
                    </button>

                    <!-- Proyek HVAC -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#41B8EA] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#41B8EA] flex items-center justify-center">
                            <img src="\src\assets\hvac.png" alt="Proyek HVAC" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Proyek HVAC</span>
                    </button>

                    <!-- Pasang unit -->
                    <button onclick="window.location.replace('/layanan/pemasangan')" class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#F99C1C] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#F99C1C] flex items-center justify-center">
                            <img src="\src\assets\pasang.png" alt="Pasang Unit" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Pasang unit</span>
                    </button>

                    <!-- Perawatan -->
                    <button onclick="window.location.replace('/layanan/perawatan')" class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#ED2024] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#ED2024] flex items-center justify-center">
                            <img src="\src\assets\perawatan2.png" alt="Perawatan" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Perawatan</span>
                    </button>

                    <!-- Perbaikan -->
                    <button onclick="window.location.replace('/layanan/perbaikan')" class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#373E51] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#373E51] flex items-center justify-center">
                            <img src="\src\assets\perbaikan2.png" alt="Perbaikan" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Perbaikan</span>
                    </button>
                </div>
            </div>

            <!-- Desktop Services - Centered -->
            <div class="hidden md:flex justify-center items-center gap-4">
                <button class="pkCalculatorServiceBtn service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#3EB48A]">
                    <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center">
                        <img src="\src\assets\pkcal.png" alt="PK Calculator" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">PK Calculator</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#41B8EA]">
                    <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center">
                        <img src="\src\assets\hvac.png" alt="Proyek HVAC" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Proyek HVAC</span>
                </button>
                <button onclick="window.location.replace('/layanan/pemasangan')" class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#F99C1C]">
                    <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center">
                        <img src="\src\assets\pasang.png" alt="Pasang Unit" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Pasang unit</span>
                </button>
                <button onclick="window.location.replace('/layanan/perawatan')" class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#ED2024]">
                    <div class="w-10 h-10 rounded-full bg-[#ED2024] flex items-center justify-center">
                        <img src="\src\assets\perawatan2.png" alt="Perawatan" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Perawatan</span>
                </button>
                <button onclick="window.location.replace('/layanan/perbaikan')" class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#373E51]">
                    <div class="w-10 h-10 rounded-full bg-[#373E51] flex items-center justify-center">
                        <img src="\src\assets\perbaikan2.png" alt="Perbaikan" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Perbaikan</span>
                </button>
            </div>
        </div>
    </div>