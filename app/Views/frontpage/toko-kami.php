<?php echo $this->extend('template-shop'); ?>
<?php echo $this->section('content'); ?>

<!-- Tagline -->
    <div class="bg-white py-4">
        <div class="container mx-auto px-4 text-center">
            <img 
                src="assets\quote.png" 
                alt="every AC holds a journey, we ensure it lasts!"
                class="mx-auto h-20 md:h-24 lg:h-32"
            />
        </div>
    </div>

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
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#3EB48A] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#3EB48A] flex items-center justify-center relative">
                            <img src="assets\pkcal.png" alt="PK Calculator" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">PK Calculator</span>
                    </button>

                    <!-- Proyek HVAC -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#41B8EA] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#41B8EA] flex items-center justify-center">
                            <img src="assets\hvac.png" alt="Proyek HVAC" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Proyek HVAC</span>
                    </button>

                    <!-- Pasang unit -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#F99C1C] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#F99C1C] flex items-center justify-center">
                            <img src="assets\pasang.png" alt="Pasang Unit" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Pasang unit</span>
                    </button>

                    <!-- Perawatan -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#ED2024] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#ED2024] flex items-center justify-center">
                            <img src="assets\perawatan2.png" alt="Perawatan" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Perawatan</span>
                    </button>

                    <!-- Perbaikan -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#373E51] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#373E51] flex items-center justify-center">
                            <img src="assets\perbaikan2.png" alt="Perbaikan" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Perbaikan</span>
                    </button>
                </div>
            </div>

            <!-- Desktop Services - Centered -->
            <div class="hidden md:flex justify-center items-center gap-4">
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#3EB48A]">
                    <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center">
                        <img src="assets\pkcal.png" alt="PK Calculator" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">PK Calculator</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#41B8EA]">
                    <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center">
                        <img src="assets\hvac.png" alt="Proyek HVAC" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Proyek HVAC</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#F99C1C]">
                    <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center">
                        <img src="assets\pasang.png" alt="Pasang Unit" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Pasang unit</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#ED2024]">
                    <div class="w-10 h-10 rounded-full bg-[#ED2024] flex items-center justify-center">
                        <img src="assets\perawatan2.png" alt="Perawatan" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Perawatan</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#373E51]">
                    <div class="w-10 h-10 rounded-full bg-[#373E51] flex items-center justify-center">
                        <img src="assets\perbaikan2.png" alt="Perbaikan" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Perbaikan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Brand Logos -->
    <div class="bg-white py-6 border-b">
        <div class="container mx-auto px-4">
            <div class="flex justify-center items-center gap-4 md:gap-6 lg:gap-8 flex-wrap">
                <img src="assets\samsung.png" alt="SAMSUNG" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\sharp.png" alt="SHARP" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\changhong.png" alt="CHANGHONG" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\daikin.png" alt="DAIKIN" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\flife.png" alt="FLIFE" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\gree.png" alt="GREE" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\lg.png" alt="LG" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\midea.png" alt="MIDEA" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\panasonic.png" alt="PANASONIC" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="assets\polytron.png" alt="POLYTRON" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
            </div>
        </div>
    </div>

    <!-- PK Categories -->
    <div class="bg-white py-4 border-b">
        <div class="container mx-auto px-4">
            <!-- Mobile Dropdown -->
            <div class="md:hidden">
                <button id="pkCategoriesToggle" class="w-full flex items-center justify-between px-4 py-3 bg-white border border-gray-300 rounded-lg hover:border-[#41B8EA] transition-colors">
                    <span class="font-semibold text-[#373E51]">Kapasitas PK</span>
                    <i data-lucide="chevron-down" id="pkCategoriesChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
                </button>
                <div id="pkCategoriesContent" class="dropdown-content mt-3 space-y-3">
                    <!-- PK Categories Grid -->
                    <div class="grid grid-cols-2 gap-2">
                        <button class="pk-btn px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-pk="1/2 PK">
                            <span class="font-semibold text-sm">1/2 PK</span>
                        </button>
                        <button class="pk-btn px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-pk="3/4 PK">
                            <span class="font-semibold text-sm">3/4 PK</span>
                        </button>
                        <button class="pk-btn px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-pk="1 PK">
                            <span class="font-semibold text-sm">1 PK</span>
                        </button>
                        <button class="pk-btn px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-pk="1.5 PK">
                            <span class="font-semibold text-sm">1.5 PK</span>
                        </button>
                        <button class="pk-btn px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-pk="2 PK">
                            <span class="font-semibold text-sm">2 PK</span>
                        </button>
                        <button class="pk-btn px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-pk="2.5 PK">
                            <span class="font-semibold text-sm">2.5 PK</span>
                        </button>
                    </div>

                    <!-- Inverter / Non Inverter Buttons -->
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <button id="inverterBtnMobile" class="type-btn inverter px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#3EB48A] hover:shadow-md transition-all duration-200">
                            <span class="font-semibold text-sm">Inverter</span>
                        </button>
                        <button id="nonInverterBtnMobile" class="type-btn non-inverter px-4 py-3 rounded-lg border border-gray-300 bg-white hover:border-[#F99C1C] hover:shadow-md transition-all duration-200">
                            <span class="font-semibold text-sm">Non Inverter</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Desktop Horizontal Scroll -->
            <div class="hidden md:block">
                <div id="pkScrollContainer" class="flex justify-center items-center overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide cursor-grab">
                    <div class="w-full max-w-[1035px] h-[50px] min-w-[700px] md:min-w-0 snap-center flex flex-nowrap justify-center items-center gap-[10.88px]">
                        <button class="pk-btn relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#41B8EA] flex items-center justify-center" data-pk="1/2 PK">
                            <span class="font-semibold text-[#373E51] text-[16px]">1/2 PK</span>
                        </button>
                        <button class="pk-btn relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#41B8EA] flex items-center justify-center" data-pk="3/4 PK">
                            <span class="font-semibold text-[#373E51] text-[16px]">3/4 PK</span>
                        </button>
                        <button class="pk-btn relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#41B8EA] flex items-center justify-center" data-pk="1 PK">
                            <span class="font-semibold text-[#373E51] text-[16px]">1 PK</span>
                        </button>
                        <button class="pk-btn relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#41B8EA] flex items-center justify-center" data-pk="1.5 PK">
                            <span class="font-semibold text-[#373E51] text-[16px]">1.5 PK</span>
                        </button>
                        <button class="pk-btn relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#41B8EA] flex items-center justify-center" data-pk="2 PK">
                            <span class="font-semibold text-[#373E51] text-[16px]">2 PK</span>
                        </button>
                        <button class="pk-btn relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#41B8EA] flex items-center justify-center" data-pk="2.5 PK">
                            <span class="font-semibold text-[#373E51] text-[16px]">2.5 PK</span>
                        </button>
                        <button id="inverterBtn" class="type-btn inverter relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#3EB48A] flex items-center justify-center">
                            <span class="font-semibold text-[#41B8EA] text-[16px]">INVERTER</span>
                        </button>
                        <button id="nonInverterBtn" class="type-btn non-inverter relative bg-white border border-[#ced4da] h-[45.862px] overflow-hidden rounded-[100px] w-[134.478px] flex-shrink-0 cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 hover:border-[#F99C1C] flex items-center justify-center">
                            <span class="font-semibold text-[#41B8EA] text-[16px]">NON INVERTER</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Categories -->
    <div class="bg-white py-6 border-b">
        <div class="container mx-auto px-4">
            <!-- Mobile Dropdown -->
            <div class="md:hidden">
                <button id="productCategoriesToggle" class="w-full flex items-center justify-between px-4 py-3 bg-white border border-gray-300 rounded-lg hover:border-[#41B8EA] transition-colors">
                    <span class="font-semibold text-[#373E51]">Kategori Produk</span>
                    <i data-lucide="chevron-down" id="productCategoriesChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
                </button>
                <div id="productCategoriesContent" class="dropdown-content mt-3 space-y-2 overflow-hidden">
                    <!-- Wall Mounted Split -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="wall-mounted">
                        <img src="assets\wall.png" alt="Wall Mounted Split AC Icon" class="w-10 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Wall Mounted Split</div>
                            <p class="text-xs opacity-75 mt-0.5">88 Items Available</p>
                        </div>
                    </button>

                    <!-- Cassette -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="cassette">
                        <img src="assets\Cassette.png" alt="Wall Mounted Split AC Icon" class="w-7 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Cassette</div>
                            <p class="text-xs opacity-75 mt-0.5">64 Items Available</p>
                        </div>
                    </button>

                    <!-- Floor Standing -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="floor-standing">
                        <img src="assets\Floor.png" alt="Wall Mounted Split AC Icon" class="w-5 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Floor Standing</div>
                            <p class="text-xs opacity-75 mt-0.5">24 Items Available</p>
                        </div>
                    </button>

                    <!-- Ceiling Suspended -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="ceiling-suspended">
                        <img src="assets\Suspended.png" alt="Wall Mounted Split AC Icon" class="w-10 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Ceiling Suspended</div>
                            <p class="text-xs opacity-75 mt-0.5">24 Items Available</p>
                        </div>
                    </button>

                    <!-- Ceiling Duct -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="ceiling-duct">
                        <img src="assets\Duct.png" alt="Wall Mounted Split AC Icon" class="w-10 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Ceiling Duct</div>
                            <p class="text-xs opacity-75 mt-0.5">64 Items Available</p>
                        </div>
                    </button>

                    <!-- VRV/VRF -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="vrv-vrf">
                        <img src="assets\VRV.png" alt="Wall Mounted Split AC Icon" class="w-6 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">VRV/VRF</div>
                            <p class="text-xs opacity-75 mt-0.5">Hubungi Kami</p>
                        </div>
                    </button>

                    <!-- Produk Lainnya -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="produk-lainnya">
                        <img src="assets\lainnya.png" alt="Wall Mounted Split AC Icon" class="w-4 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Produk Lainnya</div>
                            <p class="text-xs opacity-75 mt-0.5">Pipa, ducting, kabel, etc</p>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Desktop Horizontal Scroll -->
            <div class="hidden md:block">
                <div id="productsScrollContainer" class="flex justify-center items-center overflow-x-auto md:overflow-x-visible scroll-smooth snap-x snap-mandatory scrollbar-hide cursor-grab">
                    <div class="w-full max-w-[1151.99px] h-[144px] min-w-[800px] md:min-w-0 snap-center">
                        <!-- Category Buttons - Grid Layout (Group5047 Style) -->
                        <div class="h-full flex items-stretch justify-center">
                            <!-- Wall Mounted Split -->
                            <button class="category-btn relative flex-1 flex flex-col items-center justify-center bg-[#f3f3f3] hover:bg-[#41B8EA] transition-all duration-200 group px-4" data-category="wall-mounted">
                                <div class="flex items-center justify-center mb-4">
                                    <img src="assets\wall.png" alt="Wall Mounted Split AC Icon" class="w-[58.79px] h-auto transition-all duration-200 category-icon-desktop">
                                </div>
                                <div class="text-center mt-0">
                                    <div class="font-semibold text-sm text-[#222] group-hover:text-white transition-colors">Wall Mounted Split</div>
                                    <p class="text-xs text-[#555] group-hover:text-white/90 mt-1 transition-colors">88 Items Available</p>
                                </div>
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[100px] w-px bg-[#ededed]"></div>
                            </button>
                            <!-- Cassette -->
                            <button class="category-btn relative flex-1 flex flex-col items-center justify-center bg-[#f3f3f3] hover:bg-[#41B8EA] transition-all duration-200 group px-4" data-category="cassette">
                                <div class="flex items-center justify-center mb-2">
                                    <img src="assets\Cassette.png" alt="Wall Mounted Split AC Icon" class="w-[45px] h-auto transition-all duration-200 category-icon-desktop">
                                </div>
                                <div class="text-center mt-0">
                                    <div class="font-semibold text-sm text-[#222] group-hover:text-white transition-colors">Cassette</div>
                                    <p class="text-xs text-[#555] group-hover:text-white/90 mt-1 transition-colors">64 Items Available</p>
                                </div>
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[100px] w-px bg-[#ededed]"></div>
                            </button>
                            <!-- Floor Standing -->
                            <button class="category-btn relative flex-1 flex flex-col items-center justify-center bg-[#f3f3f3] hover:bg-[#41B8EA] transition-all duration-200 group px-4" data-category="floor-standing">
                                <div class="flex items-center justify-center mb-0">
                                    <img src="assets\Floor.png" alt="Wall Mounted Split AC Icon" class="w-[30px] h-auto transition-all duration-200 category-icon-desktop">
                                </div>
                                <div class="text-center mt-0">
                                    <div class="font-semibold text-sm text-[#222] group-hover:text-white transition-colors">Floor Standing</div>
                                    <p class="text-xs text-[#555] group-hover:text-white/90 mt-1 transition-colors">24 Items Available</p>
                                </div>
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[100px] w-px bg-[#ededed]"></div>
                            </button>
                            <!-- Ceiling Suspended -->
                            <button class="category-btn relative flex-1 flex flex-col items-center justify-center bg-[#f3f3f3] hover:bg-[#41B8EA] transition-all duration-200 group px-4" data-category="ceiling-suspended">
                                <div class="flex items-center justify-center mb-2">
                                    <img src="assets\Suspended.png" alt="Wall Mounted Split AC Icon" class="w-[58.79px] h-auto transition-all duration-200 category-icon-desktop">
                                </div>
                                <div class="text-center mt-1">
                                    <div class="font-semibold text-sm text-[#222] group-hover:text-white transition-colors">Ceiling Suspended</div>
                                    <p class="text-xs text-[#555] group-hover:text-white/90 mt-1 transition-colors">24 Items Available</p>
                                </div>
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[100px] w-px bg-[#ededed]"></div>
                            </button>
                            <!-- Ceiling Duct -->
                            <button class="category-btn relative flex-1 flex flex-col items-center justify-center bg-[#f3f3f3] hover:bg-[#41B8EA] transition-all duration-200 group px-4" data-category="ceiling-duct">
                                <div class="flex items-center justify-center mb-0">
                                    <img src="assets\Duct.png" alt="Wall Mounted Split AC Icon" class="w-[65px] h-auto transition-all duration-200 category-icon-desktop">
                                </div>
                                <div class="text-center mt-5">
                                    <div class="font-semibold text-sm text-[#222] group-hover:text-white transition-colors">Ceiling Duct</div>
                                    <p class="text-xs text-[#555] group-hover:text-white/90 mt-1 transition-colors">64 Items Available</p>
                                </div>
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[100px] w-px bg-[#ededed]"></div>
                            </button>
                            <!-- VRV/VRF -->
                            <button class="category-btn relative flex-1 flex flex-col items-center justify-center bg-[#f3f3f3] hover:bg-[#41B8EA] transition-all duration-200 group px-4" data-category="vrv-vrf">
                                <div class="flex items-center justify-center mb-1">
                                    <img src="assets\VRV.png" alt="Wall Mounted Split AC Icon" class="w-[40px] h-auto transition-all duration-200 category-icon-desktop">
                                </div>
                                <div class="text-center mt-1">
                                    <div class="font-semibold text-sm text-[#222] group-hover:text-white transition-colors">VRV/VRF</div>
                                    <p class="text-xs text-[#555] group-hover:text-white/90 mt-1 transition-colors">Hubungi Kami</p>
                                </div>
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[100px] w-px bg-[#ededed]"></div>
                            </button>
                            <!-- Produk Lainnya -->
                            <button class="category-btn relative flex-1 flex flex-col items-center justify-center bg-[#f3f3f3] hover:bg-[#41B8EA] transition-all duration-200 group px-4" data-category="produk-lainnya">
                                <div class="flex items-center justify-center mb-1">
                                    <img src="assets\lainnya.png" alt="Wall Mounted Split AC Icon" class="w-[30px] h-auto transition-all duration-200 category-icon-desktop">
                                </div>
                                <div class="text-center mt-1">
                                    <div class="font-semibold text-sm text-[#222] group-hover:text-white transition-colors">Produk Lainnya</div>
                                    <p class="text-xs text-[#555] group-hover:text-white/90 mt-1 transition-colors">Pipa, ducting, kabel, etc</p>
                                </div>
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 h-[100px] w-px bg-[#ededed]"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
   <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">
            
            <aside class="w-full lg:w-64 flex-shrink-0">
                
                <div class="bg-white rounded-lg p-4 shadow mb-6">
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
                                    <svg class="block w-full h-full" fill="none" viewBox="0 0 34 34"><g filter="url(#filter0_d_91_212)"><circle cx="17" cy="17" fill="#41B8EA" r="10" /><circle cx="17" cy="17" r="11.5" stroke="white" stroke-width="3" /></g></svg>
                                </div>
                            </div>
                            <input type="range" id="m2Slider" min="0" max="250" value="0" class="w-full h-[20px] opacity-0 cursor-pointer relative z-10">
                        </div>
                        <button id="calculateBtn" class="w-full bg-[#F99C1C] hover:bg-[#F99C1C]/90 text-white py-2 rounded-lg font-semibold transition-colors">Mulai Hitung</button>
                    </div>
                    
                    <div id="calculationResult" class="hidden mt-4 bg-[#f3f3f3] rounded-lg p-4">
                        <p class="text-sm font-semibold mb-2">Hasil:</p>
                        <p class="text-xs text-gray-600 mb-1">Daya: <span class="font-bold text-[#41B8EA]" id="btuResult">-</span> Btu/h</p>
                        <p class="text-xs text-gray-600">PK: <span class="font-bold text-[#41B8EA]" id="pkResult">-</span> PK</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-[#373E51]">Filter</h3>
                        <button id="resetFiltersBtn" class="text-xs text-red-500 hover:text-red-700 font-semibold hidden">
                            Reset Semua
                        </button>
                    </div>
                    
                    <div class="mb-6">
                        <button class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors toggle-filter-section">
                            <h4 class="font-semibold text-[#373E51] text-sm">Brands</h4>
                            <i data-lucide="chevron-down" class="h-4 w-4 text-[#41B8EA]"></i>
                        </button>
                        <div class="space-y-2 max-h-60 overflow-y-auto custom-scrollbar">
                            <?php if(!empty($brands)): ?>
                                <?php foreach($brands as $brand): ?>
                                    <button class="filter-btn w-full text-left px-3 py-2 rounded border border-gray-200 bg-white hover:border-[#41B8EA] hover:bg-blue-50 transition-all text-sm flex items-center gap-2 group" 
                                            data-group="brands" 
                                            data-value="<?= esc($brand['brand_name']) ?>">
                                        <div class="w-4 h-4 border border-gray-300 rounded flex items-center justify-center group-[.active]:bg-[#41B8EA] group-[.active]:border-[#41B8EA]">
                                            <i data-lucide="check" class="w-3 h-3 text-white opacity-0 group-[.active]:opacity-100"></i>
                                        </div>
                                        <?= esc($brand['brand_name']) ?>
                                    </button>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-6">
                        <button class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors toggle-filter-section">
                            <h4 class="font-semibold text-[#373E51] text-sm">Kapasitas PK</h4>
                            <i data-lucide="chevron-down" class="h-4 w-4 text-[#41B8EA]"></i>
                        </button>
                        <div class="space-y-2">
                            <?php if(!empty($pk_categories)): ?>
                                <?php foreach($pk_categories as $pk): ?>
                                    <button class="filter-btn w-full text-left px-3 py-2 rounded border border-gray-200 bg-white hover:border-[#41B8EA] hover:bg-blue-50 transition-all text-sm group" 
                                            data-group="pk" 
                                            data-value="<?= esc($pk['pk_category_name']) ?>">
                                        <span class="group-[.active]:font-bold group-[.active]:text-[#41B8EA]"><?= esc($pk['pk_category_name']) ?></span>
                                    </button>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-6">
                        <button class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors toggle-filter-section">
                            <h4 class="font-semibold text-[#373E51] text-sm">Tipe AC</h4>
                            <i data-lucide="chevron-down" class="h-4 w-4 text-[#41B8EA]"></i>
                        </button>
                        <div class="space-y-2">
                            <?php if(!empty($types)): ?>
                                <?php foreach($types as $type): ?>
                                    <button class="filter-btn w-full text-left px-3 py-2 rounded border border-gray-200 bg-white hover:border-[#41B8EA] hover:bg-blue-50 transition-all text-sm group" 
                                            data-group="type" 
                                            data-value="<?= esc($type['type_name']) ?>">
                                        <span class="group-[.active]:font-bold group-[.active]:text-[#41B8EA]"><?= esc($type['type_name']) ?></span>
                                    </button>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="flex-1">
                <div class="bg-white rounded-lg p-4 shadow mb-4">
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                        <div class="relative w-full md:w-auto flex-1 max-w-md">
                            <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                            <input type="text" id="searchQuery" placeholder="Cari nama produk, brand..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#41B8EA] focus:ring-1 focus:ring-[#41B8EA]">
                        </div>

                        <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                            <div class="flex bg-gray-100 rounded-lg p-1">
                                <button class="tab-btn active px-3 py-1.5 rounded text-sm font-medium transition-all text-gray-600 hover:text-[#41B8EA] [&.active]:bg-white [&.active]:text-[#41B8EA] [&.active]:shadow-sm" data-tab="terbaru">Terbaru</button>
                                <button class="tab-btn px-3 py-1.5 rounded text-sm font-medium transition-all text-gray-600 hover:text-[#41B8EA] [&.active]:bg-white [&.active]:text-[#41B8EA] [&.active]:shadow-sm" data-tab="diskon">Diskon</button>
                            </div>
                            <select id="priceSort" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#41B8EA]">
                                <option value="">Urutkan Harga</option>
                                <option value="low">Termurah</option>
                                <option value="high">Termahal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="activeFiltersContainer" class="flex flex-wrap gap-2 mb-4 empty:hidden">
                    </div>

                <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8 min-h-[300px]">
                    <div class="col-span-full flex flex-col justify-center items-center py-12 text-gray-400">
                         <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#41B8EA] mb-2"></div>
                         <p class="text-sm">Memuat produk...</p>
                    </div>
                </div>

                <div class="flex justify-center items-center gap-2 mt-auto">
                    <button class="page-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-[#41B8EA] hover:text-[#41B8EA] disabled:opacity-50" data-page="prev"><i data-lucide="chevron-left" class="h-4 w-4"></i></button>
                    <span id="pageIndicator" class="text-sm font-semibold text-gray-600 px-2">Halaman 1</span>
                    <button class="page-btn px-3 py-2 border border-gray-300 rounded-lg hover:border-[#41B8EA] hover:text-[#41B8EA] disabled:opacity-50" data-page="next"><i data-lucide="chevron-right" class="h-4 w-4"></i></button>
                </div>
            </main>
        </div>
    </div>

    <?php echo $this->endSection(); ?>