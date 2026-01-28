<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

   <!-- Tagline -->
    <div class="bg-white py-4">
        <div class="container mx-auto px-4 text-center">
            <img 
                src="\assets\quote.png" 
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
                            <img src="\assets\pkcal.png" alt="PK Calculator" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">PK Calculator</span>
                    </button>

                    <!-- Proyek HVAC -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#41B8EA] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#41B8EA] flex items-center justify-center">
                            <img src="\assets\hvac.png" alt="Proyek HVAC" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Proyek HVAC</span>
                    </button>

                    <!-- Pasang unit -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#F99C1C] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#F99C1C] flex items-center justify-center">
                            <img src="\assets\pasang.png" alt="Pasang Unit" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Pasang unit</span>
                    </button>

                    <!-- Perawatan -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#ED2024] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#ED2024] flex items-center justify-center">
                            <img src="\assets\perawatan2.png" alt="Perawatan" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Perawatan</span>
                    </button>

                    <!-- Perbaikan -->
                    <button class="service-btn w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#373E51] transition-all duration-200">
                        <div class="flex-shrink-0 w-[42px] h-[42px] rounded-full bg-[#373E51] flex items-center justify-center">
                            <img src="\assets\perbaikan2.png" alt="Perbaikan" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                        <span class="font-semibold text-[#1c1c24]">Perbaikan</span>
                    </button>
                </div>
            </div>

            <!-- Desktop Services - Centered -->
            <div class="hidden md:flex justify-center items-center gap-4">
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#3EB48A]">
                    <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center">
                        <img src="\assets\pkcal.png" alt="PK Calculator" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">PK Calculator</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#41B8EA]">
                    <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center">
                        <img src="\assets\hvac.png" alt="Proyek HVAC" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Proyek HVAC</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#F99C1C]">
                    <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center">
                        <img src="\assets\pasang.png" alt="Pasang Unit" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Pasang unit</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#ED2024]">
                    <div class="w-10 h-10 rounded-full bg-[#ED2024] flex items-center justify-center">
                        <img src="\assets\perawatan2.png" alt="Perawatan" class="h-5 w-5 object-contain brightness-0 invert">
                    </div>
                    <span class="font-semibold text-[#1c1c24]">Perawatan</span>
                </button>
                <button class="service-btn flex items-center gap-3 px-6 py-3 bg-white border border-gray-300 rounded-full hover:shadow-lg hover:border-[#373E51]">
                    <div class="w-10 h-10 rounded-full bg-[#373E51] flex items-center justify-center">
                        <img src="\assets\perbaikan2.png" alt="Perbaikan" class="h-5 w-5 object-contain brightness-0 invert">
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
                <img src="\assets\samsung.png" alt="SAMSUNG" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\sharp.png" alt="SHARP" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\changhong.png" alt="CHANGHONG" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\daikin.png" alt="DAIKIN" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\flife.png" alt="FLIFE" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\gree.png" alt="GREE" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\lg.png" alt="LG" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\midea.png" alt="MIDEA" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\panasonic.png" alt="PANASONIC" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
                <img src="\assets\polytron.png" alt="POLYTRON" class="brand-logo h-6 md:h-7 lg:h-8 w-auto object-contain cursor-pointer">
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
                        <img src="\assets\wall.png" alt="Wall Mounted Split AC Icon" class="w-10 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Wall Mounted Split</div>
                            <p class="text-xs opacity-75 mt-0.5">88 Items Available</p>
                        </div>
                    </button>

                    <!-- Cassette -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="cassette">
                        <img src="\assets\Cassette.png" alt="Wall Mounted Split AC Icon" class="w-7 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Cassette</div>
                            <p class="text-xs opacity-75 mt-0.5">64 Items Available</p>
                        </div>
                    </button>

                    <!-- Floor Standing -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="floor-standing">
                        <img src="\assets\Floor.png" alt="Wall Mounted Split AC Icon" class="w-5 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Floor Standing</div>
                            <p class="text-xs opacity-75 mt-0.5">24 Items Available</p>
                        </div>
                    </button>

                    <!-- Ceiling Suspended -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="ceiling-suspended">
                        <img src="\assets\Suspended.png" alt="Wall Mounted Split AC Icon" class="w-10 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Ceiling Suspended</div>
                            <p class="text-xs opacity-75 mt-0.5">24 Items Available</p>
                        </div>
                    </button>

                    <!-- Ceiling Duct -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="ceiling-duct">
                        <img src="\assets\Duct.png" alt="Wall Mounted Split AC Icon" class="w-10 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">Ceiling Duct</div>
                            <p class="text-xs opacity-75 mt-0.5">64 Items Available</p>
                        </div>
                    </button>

                    <!-- VRV/VRF -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="vrv-vrf">
                        <img src="\assets\VRV.png" alt="Wall Mounted Split AC Icon" class="w-6 h-auto flex-shrink-0 transition-all duration-200 category-icon">
                        <div class="flex-1 text-left">
                            <div class="font-semibold text-sm">VRV/VRF</div>
                            <p class="text-xs opacity-75 mt-0.5">Hubungi Kami</p>
                        </div>
                    </button>

                    <!-- Produk Lainnya -->
                    <button class="category-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-[#ced4da] bg-[#f3f3f3] hover:border-[#41B8EA] hover:shadow-md transition-all duration-200" data-category="produk-lainnya">
                        <img src="\assets\lainnya.png" alt="Wall Mounted Split AC Icon" class="w-4 h-auto flex-shrink-0 transition-all duration-200 category-icon">
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
                                    <img src="\assets\wall.png" alt="Wall Mounted Split AC Icon" class="w-[58.79px] h-auto transition-all duration-200 category-icon-desktop">
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
                                    <img src="\assets\Cassette.png" alt="Wall Mounted Split AC Icon" class="w-[45px] h-auto transition-all duration-200 category-icon-desktop">
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
                                    <img src="\assets\Floor.png" alt="Wall Mounted Split AC Icon" class="w-[30px] h-auto transition-all duration-200 category-icon-desktop">
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
                                    <img src="\assets\Suspended.png" alt="Wall Mounted Split AC Icon" class="w-[58.79px] h-auto transition-all duration-200 category-icon-desktop">
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
                                    <img src="\assets\Duct.png" alt="Wall Mounted Split AC Icon" class="w-[65px] h-auto transition-all duration-200 category-icon-desktop">
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
                                    <img src="\assets\VRV.png" alt="Wall Mounted Split AC Icon" class="w-[40px] h-auto transition-all duration-200 category-icon-desktop">
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
                                    <img src="\assets\lainnya.png" alt="Wall Mounted Split AC Icon" class="w-[30px] h-auto transition-all duration-200 category-icon-desktop">
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
            
            <!-- Sidebar -->
            <aside class="w-full lg:w-64 flex-shrink-0">
                
                <!-- PK Calculator -->
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
                        
                        <!-- Custom Slider -->
                        <div class="relative w-full h-[50px] mt-0 mb-3">
                            <!-- Background Track -->
                            <div class="absolute bg-[#f3f3f3] h-[11px] left-0 rounded-full top-[5px] w-full"></div>
                            
                            <!-- Slider Handle -->
                            <div id="sliderHandle" class="absolute w-[20px] h-[20px] top-0 transition-all duration-150" style="left: 0px;">
                                <div class="absolute inset-[-35%]">
                                    <svg class="block w-full h-full" fill="none" preserveAspectRatio="none" viewBox="0 0 34 34">
                                        <g filter="url(#filter0_d_91_212)">
                                            <circle cx="17" cy="17" fill="#41B8EA" r="10" />
                                            <circle cx="17" cy="17" r="11.5" stroke="white" stroke-width="3" />
                                        </g>
                                        <defs>
                                            <filter color-interpolation-filters="sRGB" filterUnits="userSpaceOnUse" height="34" id="filter0_d_91_212" width="34" x="0" y="0">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                <feColorMatrix in="SourceAlpha" result="hardAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                                <feOffset />
                                                <feGaussianBlur stdDeviation="2" />
                                                <feComposite in2="hardAlpha" operator="out" />
                                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                                <feBlend in2="BackgroundImageFix" mode="normal" result="effect1_dropShadow_91_212" />
                                                <feBlend in="SourceGraphic" in2="effect1_dropShadow_91_212" mode="normal" result="shape" />
                                            </filter>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Labels -->
                            <p class="absolute font-normal left-0 text-[13px] text-black whitespace-nowrap top-[28px]">0 m²</p>
                            <p class="absolute font-normal right-0 text-[13px] text-black whitespace-nowrap top-[28px]">250 m²</p>
                            
                            <!-- Invisible Range Input -->
                            <input type="range" id="m2Slider" min="0" max="250" value="0" class="w-full h-[20px]">
                        </div>
                        
                        <div class="text-xs text-gray-600 leading-relaxed">Geser kiri atau kanan slider dibawah ini sesuai ukuran ruangan anda dan klik tombol "Mulai Hitung" dibawah ini</div>
                        
                        <button id="calculateBtn" class="w-full bg-[#F99C1C] hover:bg-[#F99C1C]/90 text-white py-2 rounded-lg font-semibold transition-colors">
                            Mulai Hitung
                        </button>
                    </div>
                </div>

                <!-- Calculation Result -->
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

                        <div class="text-xs text-[#626060] space-y-2">
                            <p>
                                <span class="font-semibold">Catatan Penting</span><br>
                                Hitungan diatas dengan asumsi tinggi plafon 2.8m dan kondisi ruangan tertutup.
                            </p>
                            
                            <p>
                                <span class="font-semibold">Kapan Menggunakan Nilai Minimum ?</span><br>
                                Untuk kebutuhan ruangan tertutup biasa pada umumnya cukup menggunakan nilai minimum namun perlu berhati-hati jika cuaca Jabodetabek mengalami cuaca ekstrem panas
                            </p>
                            
                            <p>
                                <span class="font-semibold">Kapan Menggunakan Nilai Maksimum ?</span><br>
                                Merupakan nilai yang direkomendasikan terutama Apabila ruangan menghadap matahari, Terdapat kaca sehingga terkena panas sinar matahari atau ruangan tersebut padat orang
                            </p>
                            
                            <p>
                                <span class="font-semibold">Tips & Trick</span><br>
                                Untuk kebutuhan ruangan High Plafon &gt; 2.8m silahkan nyalakan fitur advanced mode
                            </p>
                        </div>
                        
                        <button class="w-full bg-[#3EB48A] hover:bg-[#3EB48A]/90 text-white py-2 rounded-lg font-semibold transition-colors mt-3 text-sm">
                            Lihat Rekomendasi
                        </button>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="bg-white rounded-lg p-4 shadow">
                    <h3 class="font-bold mb-4 text-[#373E51]">Filter</h3>
                    
                    <!-- Brands Filter -->
                    <div class="mb-6">
                        <button id="brandsFilterToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
                            <h4 class="font-semibold text-[#373E51]">Brands</h4>
                            <i data-lucide="chevron-down" id="brandsFilterChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
                        </button>
                        <div id="brandsFilterContent" class="dropdown-content open space-y-2">
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Panasonic">
                                <span class="text-sm">Panasonic</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Daikin">
                                <span class="text-sm">Daikin</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="LG">
                                <span class="text-sm">LG</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Samsung">
                                <span class="text-sm">Samsung</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Gree">
                                <span class="text-sm">Gree</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="FLiFE">
                                <span class="text-sm">FLiFE</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Polytron">
                                <span class="text-sm">Polytron</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Changhong">
                                <span class="text-sm">Changhong</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Sharp">
                                <span class="text-sm">Sharp</span>
                            </button>
                            <button class="brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-brand="Midea">
                                <span class="text-sm">Midea</span>
                            </button>
                        </div>
                    </div>

                    <!-- PK Capacity Filter -->
                    <div class="mb-6">
                        <button id="pkFilterToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
                            <h4 class="font-semibold text-[#373E51]">Kapasitas PK</h4>
                            <i data-lucide="chevron-down" id="pkFilterChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
                        </button>
                        <div id="pkFilterContent" class="dropdown-content open space-y-2">
                            <button class="pk-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-pk="1/2 PK">
                                <span class="text-sm">1/2 PK</span>
                            </button>
                            <button class="pk-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-pk="3/4 PK">
                                <span class="text-sm">3/4 PK</span>
                            </button>
                            <button class="pk-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-pk="1 PK">
                                <span class="text-sm">1 PK</span>
                            </button>
                            <button class="pk-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-pk="1.5 PK">
                                <span class="text-sm">1.5 PK</span>
                            </button>
                            <button class="pk-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-pk="2 PK">
                                <span class="text-sm">2 PK</span>
                            </button>
                            <button class="pk-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-pk="2.5 PK">
                                <span class="text-sm">2.5 PK</span>
                            </button>
                        </div>
                    </div>

                    <!-- Type Filter -->
                    <div class="mb-6">
                        <button id="typeFilterToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
                            <h4 class="font-semibold text-[#373E51]">Tipe AC</h4>
                            <i data-lucide="chevron-down" id="typeFilterChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
                        </button>
                        <div id="typeFilterContent" class="dropdown-content open space-y-2">
                            <button id="inverterFilterBtn" class="type-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-type="Inverter">
                                <span class="text-sm">Inverter</span>
                            </button>
                            <button id="nonInverterFilterBtn" class="type-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-type="Non Inverter">
                                <span class="text-sm">Non Inverter</span>
                            </button>
                        </div>
                    </div>

                    <!-- Produk Lainnya Filter -->
                    <div>
                        <button id="otherProductsToggle" class="w-full flex items-center justify-between mb-3 hover:text-[#41B8EA] transition-colors">
                            <h4 class="font-semibold text-[#373E51]">Produk Lainnya</h4>
                            <i data-lucide="chevron-down" id="otherProductsChevron" class="h-5 w-5 text-[#41B8EA] transition-transform duration-200"></i>
                        </button>
                        <div id="otherProductsContent" class="dropdown-content open space-y-2">
                            <button class="other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-product="Air Purifier">
                                <span class="text-sm">Air Purifier</span>
                            </button>
                            <button class="other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-product="Kipas Angin">
                                <span class="text-sm">Kipas Angin</span>
                            </button>
                            <button class="other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-product="Kabel Power">
                                <span class="text-sm">Kabel Power</span>
                            </button>
                            <button class="other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-product="Pipa AC">
                                <span class="text-sm">Pipa AC</span>
                            </button>
                            <button class="other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-product="Panel">
                                <span class="text-sm">Panel</span>
                            </button>
                            <button class="other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-product="Ducting">
                                <span class="text-sm">Ducting</span>
                            </button>
                            <button class="other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 transition-all" data-product="Freon">
                                <span class="text-sm">Freon</span>
                            </button>
                        </div>
                    </div>
                </div>

            </aside>

            <!-- Main Products Area -->
            <main class="flex-1">
                
                <!-- Penjualan Section -->
                <div class="bg-white rounded-lg p-4 shadow mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl md:text-2xl font-bold text-[#373E51]">Penjualan</h2>
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
                        <span class="font-semibold hidden md:inline text-[#373E51]">Filter</span>
                        <div class="flex flex-col md:flex-row gap-3 md:gap-2 md:items-center flex-1">
                            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 scrollbar-hide">
                                <button class="tab-btn active px-4 py-2 rounded whitespace-nowrap transition-colors" data-tab="terbaru">
                                    Terbaru
                                </button>
                                <button class="tab-btn px-4 py-2 rounded whitespace-nowrap transition-colors hover:bg-gray-100" data-tab="diskon">
                                    Diskon
                                </button>
                                <button class="tab-btn px-4 py-2 rounded whitespace-nowrap transition-colors hover:bg-gray-100" data-tab="terlaris">
                                    Terlaris
                                </button>
                            </div>
                            
                            <!-- Search Box -->
                            <div class="relative flex-1 md:ml-4">
                                <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                                <input
                                    type="text"
                                    id="searchQuery"
                                    placeholder="Cari produk..."
                                    class="w-full border border-gray-300 rounded-lg focus:outline-none focus:border-[#41B8EA] focus:ring-1 focus:ring-[#41B8EA] transition-colors pl-10 pr-4 py-2"
                                />
                            </div>

                            <!-- Harga Dropdown -->
                            <select id="priceSort" class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-auto md:ml-auto focus:outline-none focus:border-[#41B8EA] focus:ring-1 focus:ring-[#41B8EA] transition-colors">
                                <option value="">Harga</option>
                                <option value="low">Harga: Rendah ke Tinggi</option>
                                <option value="high">Harga: Tinggi ke Rendah</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
                    <!-- Products will be dynamically inserted here -->
                </div>

                <!-- Pagination -->
                <div class="flex justify-center items-center gap-2 mt-8">
                    <button class="page-btn px-3 py-2 border border-gray-300 rounded-lg transition-colors" data-page="prev">
                        <i data-lucide="chevron-left" class="h-5 w-5"></i>
                    </button>
                    <button class="page-btn active px-4 py-2 border border-gray-300 rounded-lg transition-colors" data-page="1">1</button>
                    <button class="page-btn px-4 py-2 border border-gray-300 rounded-lg transition-colors" data-page="2">2</button>
                    <button class="page-btn px-4 py-2 border border-gray-300 rounded-lg transition-colors" data-page="3">3</button>
                    <button class="page-btn px-3 py-2 border border-gray-300 rounded-lg transition-colors" data-page="next">
                        <i data-lucide="chevron-right" class="h-5 w-5"></i>
                    </button>
                </div>

            </main>

        </div>
    </div>


  <script>
    /**
     * 1. DATA INITIALIZATION
     * We convert the PHP array directly into a JS object.
     */
    const rawData = <?php echo json_encode($products); ?>;
    
    // Fix ReferenceErrors: Define these globally before they are used
    let currentPage = 1;
    let filteredProducts = [];

    /**
     * 2. DATA MAPPING
     * Transforming Database columns to Frontend keys
     */
    const products = rawData.map(item => {
        // Handle Pricing & Discount
        const basePrice = parseFloat(item.base_price) || 0;
        const salePrice = parseFloat(item.sale_price) || 0;
        const discount = (salePrice > 0 && salePrice < basePrice) 
            ? Math.round(((basePrice - salePrice) / basePrice) * 100) 
            : 0;

        // FIX: "Object Object" JSON.parse error
        // If CI4 already returns an object, don't parse it.
        let featuresArr = ['Standard Unit'];
        if (item.extra_attributes) {
            if (typeof item.extra_attributes === 'object') {
                featuresArr = item.extra_attributes;
            } else {
                try {
                    featuresArr = JSON.parse(item.extra_attributes);
                } catch (e) {
                    console.warn("Invalid JSON in extra_attributes for ID: " + item.id);
                }
            }
        }

        return {
            id: parseInt(item.id),
            brand: item.brand_name || 'Generic',
            model: item.product_name,
            pk: item.pk_category_name || 'Unknown PK',
            type: item.type_name || 'Standard',
            rating: 4.5, // Placeholder for now
            reviews: 120, // Placeholder for now
            originalPrice: basePrice,
            price: salePrice > 0 ? salePrice : basePrice,
            discount: discount,
            // FIX: Image 404 - Ensure this folder exists in /public/uploads/products/
            image: '<?= base_url("uploads/products") ?>/' + (item.main_image || 'default-ac.png'),
            features: Array.isArray(featuresArr) ? featuresArr : [featuresArr]
        };
    });

    // Sync filtered products with the newly loaded data
    filteredProducts = [...products];

    /**
     * 3. RENDER LOGIC
     * This function should exist in your script to display the items
     */
    function renderProducts() {
        const productGrid = document.getElementById('product-grid');
        if (!productGrid) return;

        productGrid.innerHTML = ''; // Clear grid

        // Example: Only showing current page logic here
        filteredProducts.forEach(product => {
            productGrid.innerHTML += `
                <div class="product-card">
                    <img src="${product.image}" alt="${product.model}">
                    <h4>${product.brand}</h4>
                    <p>${product.model} - ${product.pk}</p>
                    <div class="price">Rp ${product.price.toLocaleString('id-ID')}</div>
                </div>
            `;
        });
    }

    // Run on load
    document.addEventListener('DOMContentLoaded', () => {
        renderProducts();
    });

</script>

<?= $this->endSection() ?>