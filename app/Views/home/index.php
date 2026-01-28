<?= $this->extend('layouts/company_profile') ?>

<?= $this->section('content') ?>

    <!-- Hero Section -->
    <section id="home" class="relative bg-gradient-to-br from-gray-50 via-white to-cyan-50 pt-4 pb-6 md:pt-8 md:pb-10 overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-20 -right-20 w-96 h-96 bg-[#41B8EA]/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-cyan-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808008_1px,transparent_1px),linear-gradient(to_bottom,#80808008_1px,transparent_1px)] bg-[size:64px_64px]"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-6 md:gap-8 items-center">
                <!-- Left Content -->
                <div class="space-y-4 md:space-y-5 observe-me">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 bg-[#41B8EA]/10 px-4 py-2 rounded-full border border-[#41B8EA]/20">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#41B8EA] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#41B8EA]"></span>
                        </span>
                        <span class="text-sm font-medium text-[#41B8EA]">Solusi AC Terpercaya #1 di Indonesia</span>
                    </div>

                    <!-- Main Heading -->
                    <div class="space-y-4">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black leading-tight uppercase">
                            <span class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 bg-clip-text text-transparent">
                                PROJECT HVAC
                            </span>
                            <br />
                            <span class="bg-gradient-to-r from-[#41B8EA] via-cyan-500 to-[#41B8EA] bg-clip-text text-transparent">
                                KOMERSIAL
                            </span>
                            <span class="bg-gradient-to-r from-[#F99C1C] via-[#F99C1C] to-[#F99C1C] bg-clip-text text-transparent">
                                & RESIDENSIAL
                            </span>
                        </h1>
                    </div>

                    <!-- Description -->
                    <p class="text-base md:text-lg text-gray-600 max-w-xl leading-relaxed">
                        Kami siap mengerjakan project <span class="font-semibold text-gray-900">Pemasangan, Perawatan, dan Perbaikan</span> unit HVAC Anda. Mudah, Cepat, dan Profesional di seluruh Indonesia.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="insertlink" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 bg-[#41B8EA] hover:bg-[#41B8EA]/90 text-white px-6 py-3 md:py-4 rounded-md shadow-lg hover:shadow-xl transition-all">
                            <i data-lucide="send" class="h-5 w-5"></i>
                            Isi Form & Kirim Penawaran
                        </a>
                        <a href="#about"
                           class="inline-flex items-center gap-2 border-2 border-gray-300 hover:bg-[#F99C1C] hover:border-[#F99C1C] hover:text-white px-6 py-3 md:py-4 rounded-md transition-all">
                            Lihat Layanan Kami →
                        </a>
                    </div>

                    <!-- Trust Badges -->
                    <div class="flex flex-wrap gap-4 pt-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i data-lucide="check-circle-2" class="h-4 w-4 text-[#41B8EA]"></i>
                            <span>Garansi Resmi</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i data-lucide="award" class="h-4 w-4 text-[#41B8EA]"></i>
                            <span>Teknisi Bersertifikat</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i data-lucide="shield" class="h-4 w-4 text-[#41B8EA]"></i>
                            <span>Terpercaya</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i data-lucide="clock" class="h-4 w-4 text-[#41B8EA]"></i>
                            <span>Layanan 24/7</span>
                        </div>
                    </div>
                </div>

                <!-- Right Image/Visual -->
                <div class="relative observe-me" style="animation-delay: 0.2s;">
                    <!-- Main Image -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="assets\hero.png"
                             alt="Nikmati Kenyamanan AC Anda"
                             class="w-full h-[350px] md:h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent"></div>
                    </div>

                    <!-- Floating Stats Card -->
                    <div class="absolute -bottom-8 -left-8 bg-white rounded-2xl p-6 shadow-xl hidden md:block">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-[#41B8EA]">
                                    <span class="counter" data-target="100">100</span>+
                                </div>
                                <div class="text-xs text-gray-600 mt-1 whitespace-nowrap">Proyek Selesai</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-[#F99C1C]">
                                    <span class="counter" data-target="500">500</span>+
                                </div>
                                <div class="text-xs text-gray-600 mt-1 whitespace-nowrap">Kepuasan Pelanggan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-[#3EB48A]">
                                    <span class="counter" data-target="15">15</span>+
                                </div>
                                <div class="text-xs text-gray-600 mt-1 whitespace-nowrap">Tahun Pengalaman</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logo Runner - Brand Partners -->
    <section class="py-6 md:py-8 bg-white border-t border-b border-gray-100 overflow-hidden">
        <div class="relative">
            <div class="overflow-hidden">
                <div class="flex gap-20 items-center logo-scroll" style="width: max-content;">
                    <!-- Logos repeated 4 times for infinite scroll -->
                    <img src="assets\samsung.png" alt="Samsung" class="h-10">
                    <img src="assets\sharp.png" alt="Sharp" class="h-8">
                    <img src="assets\changhong.png" alt="Changhong" class="h-8">
                    <img src="assets\daikin.png" alt="Daikin" class="h-6">
                    <img src="assets\flife.png" alt="FLiFE" class="h-10">
                    <img src="assets\gree.png" alt="Gree" class="h-10">
                    <img src="assets\lg.png" alt="LG" class="h-10">
                    <img src="assets\midea.png" alt="Midea" class="h-10">
                    <img src="assets\panasonic.png" alt="Panasonic" class="h-10">
                    <img src="assets\polytron.png" alt="Polytron" class="h-10">
                    
                    <!-- Duplicate for seamless loop -->
                    <img src="assets\samsung.png" alt="Samsung" class="h-10">
                    <img src="assets\sharp.png" alt="Sharp" class="h-8">
                    <img src="assets\changhong.png" alt="Changhong" class="h-8">
                    <img src="assets\daikin.png" alt="Daikin" class="h-6">
                    <img src="assets\flife.png" alt="FLiFE" class="h-10">
                    <img src="assets\gree.png" alt="Gree" class="h-10">
                    <img src="assets\lg.png" alt="LG" class="h-10">
                    <img src="assets\midea.png" alt="Midea" class="h-10">
                    <img src="assets\panasonic.png" alt="Panasonic" class="h-10">
                    <img src="assets\polytron.png" alt="Polytron" class="h-10">
                    
                    <!-- Triple for seamless loop -->
                    <img src="assets\samsung.png" alt="Samsung" class="h-10">
                    <img src="assets\sharp.png" alt="Sharp" class="h-8">
                    <img src="assets\changhong.png" alt="Changhong" class="h-8">
                    <img src="assets\daikin.png" alt="Daikin" class="h-6">
                    <img src="assets\flife.png" alt="FLiFE" class="h-10">
                    <img src="assets\gree.png" alt="Gree" class="h-10">
                    <img src="assets\lg.png" alt="LG" class="h-10">
                    <img src="assets\midea.png" alt="Midea" class="h-10">
                    <img src="assets\panasonic.png" alt="Panasonic" class="h-10">
                    <img src="assets\polytron.png" alt="Polytron" class="h-10">

                     <!-- Quadruple for seamless loop -->
                    <img src="assets\samsung.png" alt="Samsung" class="h-10">
                    <img src="assets\sharp.png" alt="Sharp" class="h-8">
                    <img src="assets\changhong.png" alt="Changhong" class="h-8">
                    <img src="assets\daikin.png" alt="Daikin" class="h-6">
                    <img src="assets\flife.png" alt="FLiFE" class="h-10">
                    <img src="assets\gree.png" alt="Gree" class="h-10">
                    <img src="assets\lg.png" alt="LG" class="h-10">
                    <img src="assets\midea.png" alt="Midea" class="h-10">
                    <img src="assets\panasonic.png" alt="Panasonic" class="h-10">
                    <img src="assets\polytron.png" alt="Polytron" class="h-10">
                </div>
            </div>
            
            <!-- Gradient Overlays -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent pointer-events-none z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent pointer-events-none z-10"></div>
        </div>
    </section>

    <!-- About Section - Layanan Kami -->
    <section id="about" class="py-8 md:py-12 bg-white relative overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 right-10 w-64 h-64 bg-[#41B8EA]/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-10 w-64 h-64 bg-[#F99C1C]/5 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-10 md:mb-12 observe-me">
                <div class="inline-block mb-4">
                    <span class="bg-[#41B8EA]/10 text-[#41B8EA] px-6 py-2 rounded-full text-sm font-medium border border-[#41B8EA]/20">
                        Layanan Profesional
                    </span>
                </div>
                
                <h2 class="text-2xl md:text-3xl font-black mb-3 bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 bg-clip-text text-transparent">
                    Layanan Inti Kami
                </h2>
                
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                    Solusi Tata Udara Terlengkap
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-7 max-w-7xl mx-auto">
                <!-- Service 1 -->
                <div class="card-hover observe-me">
                    <div class="bg-white rounded-2xl p-6 md:p-7 shadow-lg border border-gray-100 h-full flex flex-col">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center relative overflow-hidden mb-6"
                             style="background-color: rgba(249, 156, 28, 0.08);">
                            <img src="assets\pemasangan.png" 
                                 alt="Pemasangan" 
                                 class="w-10 h-10 relative z-10 object-contain">
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: #F99C1C;">
                            Pemasangan Unit AC (Instalasi)
                        </h3>
                        
                        <p class="text-gray-600 leading-relaxed flex-grow">
                            Instalasi unit efisien dari merek terkemuka, memastikan penempatan dan kinerja yang sempurna untuk penghematan dan kenyamanan jangka panjang.
                        </p>
                        
                        <div class="mt-6 h-1 rounded-full" style="background-color: rgba(249, 156, 28, 0.2);">
                            <div class="h-full rounded-full w-0 hover:w-full transition-all duration-300" style="background-color: #F99C1C;"></div>
                        </div>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="card-hover observe-me" style="animation-delay: 0.1s;">
                    <div class="bg-white rounded-2xl p-6 md:p-7 shadow-lg border border-gray-100 h-full flex flex-col">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center relative overflow-hidden mb-6"
                             style="background-color: rgba(237, 32, 36, 0.08);">
                            <img src="assets\perawatan.png" 
                                 alt="Perawatan" 
                                 class="w-10 h-10 relative z-10 object-contain">
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: #ED2024;">
                            Perawatan Rutin (Maintenance)
                        </h3>
                        
                        <p class="text-gray-600 leading-relaxed flex-grow">
                            Perpanjang umur sistem dan efisiensi dengan servis tahunan, penggantian filter, dan pembersihan mendalam. Cegah masalah sebelum terjadi.
                        </p>
                        
                        <div class="mt-6 h-1 rounded-full" style="background-color: rgba(237, 32, 36, 0.2);">
                            <div class="h-full rounded-full w-0 hover:w-full transition-all duration-300" style="background-color: #ED2024;"></div>
                        </div>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="card-hover observe-me" style="animation-delay: 0.2s;">
                    <div class="bg-white rounded-2xl p-6 md:p-7 shadow-lg border border-gray-100 h-full flex flex-col">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center relative overflow-hidden mb-6"
                             style="background-color: rgba(55, 62, 81, 0.08);">
                            <img src="assets\perbaikan.png" 
                                 alt="Perbaikan" 
                                 class="w-10 h-10 relative z-10 object-contain">
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: #373E51;">
                            Perbaikan & Diagnosis Darurat
                        </h3>
                        
                        <p class="text-gray-600 leading-relaxed flex-grow">
                            Layanan panggilan 24/7 untuk mendiagnosis dan memperbaiki kerusakan dengan cepat, mengembalikan kenyamanan Anda dengan suku cadang bergaransi.
                        </p>
                        
                        <div class="mt-6 h-1 rounded-full" style="background-color: rgba(55, 62, 81, 0.2);">
                            <div class="h-full rounded-full w-0 hover:w-full transition-all duration-300" style="background-color: #373E51;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom CTA -->
            <div class="text-center mt-10 md:mt-12 observe-me" style="animation-delay: 0.4s;">
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Setiap layanan kami dilakukan oleh teknisi bersertifikat dengan peralatan modern dan suku cadang original bergaransi resmi.
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-8 md:py-10 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-[#41B8EA]/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-[#F99C1C]/5 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 mb-8 md:mb-10">
            <div class="text-center observe-me">
                <h2 class="text-2xl md:text-3xl font-black text-gray-800">
                    Apa Kata Pelanggan Kami
                </h2>
            </div>
        </div>

        <!-- Running Cards Container -->
        <div class="relative">
            <div class="overflow-hidden">
                <div class="flex gap-6 items-center testimonial-scroll" style="width: max-content; animation: slideInfinite 60s linear infinite;">
                    <!-- Testimonial Cards repeated 5 times for infinite scroll -->
                    <!-- Card 1 -->
                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "ACpedia memasang sistem mini-split baru kami, dan seluruh prosesnya mulus dan profesional. Mereka cepat, bersih, dan tagihan listrik kami turun drastis."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center text-white font-bold">
                                    BS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Budi Santoso</div>
                                    <div class="text-xs text-gray-500">Pelanggan Puas, Ulasan Bintang 5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Pelayanan yang sangat memuaskan! Tim teknisi sangat profesional dan ramah. AC untuk restoran kami dipasang dengan rapi dan hasilnya luar biasa."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center text-white font-bold">
                                    IS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ibu Sari</div>
                                    <div class="text-xs text-gray-500">Pemilik Restoran</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Kami mempercayakan instalasi AC untuk 50+ unit apartemen kepada ACpedia. Hasilnya sangat memuaskan, dikerjakan tepat waktu dengan kualitas terbaik."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center text-white font-bold">
                                    AR
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ahmad Rizki</div>
                                    <div class="text-xs text-gray-500">Manager Properti</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Duplicate for seamless loop -->
                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "ACpedia memasang sistem mini-split baru kami, dan seluruh prosesnya mulus dan profesional. Mereka cepat, bersih, dan tagihan listrik kami turun drastis."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center text-white font-bold">
                                    BS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Budi Santoso</div>
                                    <div class="text-xs text-gray-500">Pelanggan Puas, Ulasan Bintang 5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Pelayanan yang sangat memuaskan! Tim teknisi sangat profesional dan ramah. AC untuk restoran kami dipasang dengan rapi dan hasilnya luar biasa."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center text-white font-bold">
                                    IS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ibu Sari</div>
                                    <div class="text-xs text-gray-500">Pemilik Restoran</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Kami mempercayakan instalasi AC untuk 50+ unit apartemen kepada ACpedia. Hasilnya sangat memuaskan, dikerjakan tepat waktu dengan kualitas terbaik."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center text-white font-bold">
                                    AR
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ahmad Rizki</div>
                                    <div class="text-xs text-gray-500">Manager Properti</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Triple for seamless loop -->
                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "ACpedia memasang sistem mini-split baru kami, dan seluruh prosesnya mulus dan profesional. Mereka cepat, bersih, dan tagihan listrik kami turun drastis."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center text-white font-bold">
                                    BS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Budi Santoso</div>
                                    <div class="text-xs text-gray-500">Pelanggan Puas, Ulasan Bintang 5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Pelayanan yang sangat memuaskan! Tim teknisi sangat profesional dan ramah. AC untuk restoran kami dipasang dengan rapi dan hasilnya luar biasa."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center text-white font-bold">
                                    IS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ibu Sari</div>
                                    <div class="text-xs text-gray-500">Pemilik Restoran</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Kami mempercayakan instalasi AC untuk 50+ unit apartemen kepada ACpedia. Hasilnya sangat memuaskan, dikerjakan tepat waktu dengan kualitas terbaik."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center text-white font-bold">
                                    AR
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ahmad Rizki</div>
                                    <div class="text-xs text-gray-500">Manager Properti</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quadruple for seamless loop -->
                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "ACpedia memasang sistem mini-split baru kami, dan seluruh prosesnya mulus dan profesional. Mereka cepat, bersih, dan tagihan listrik kami turun drastis."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center text-white font-bold">
                                    BS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Budi Santoso</div>
                                    <div class="text-xs text-gray-500">Pelanggan Puas, Ulasan Bintang 5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Pelayanan yang sangat memuaskan! Tim teknisi sangat profesional dan ramah. AC untuk restoran kami dipasang dengan rapi dan hasilnya luar biasa."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center text-white font-bold">
                                    IS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ibu Sari</div>
                                    <div class="text-xs text-gray-500">Pemilik Restoran</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Kami mempercayakan instalasi AC untuk 50+ unit apartemen kepada ACpedia. Hasilnya sangat memuaskan, dikerjakan tepat waktu dengan kualitas terbaik."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center text-white font-bold">
                                    AR
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ahmad Rizki</div>
                                    <div class="text-xs text-gray-500">Manager Properti</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quintuple for seamless loop -->
                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "ACpedia memasang sistem mini-split baru kami, dan seluruh prosesnya mulus dan profesional. Mereka cepat, bersih, dan tagihan listrik kami turun drastis."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#41B8EA] flex items-center justify-center text-white font-bold">
                                    BS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Budi Santoso</div>
                                    <div class="text-xs text-gray-500">Pelanggan Puas, Ulasan Bintang 5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Pelayanan yang sangat memuaskan! Tim teknisi sangat profesional dan ramah. AC untuk restoran kami dipasang dengan rapi dan hasilnya luar biasa."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#F99C1C] flex items-center justify-center text-white font-bold">
                                    IS
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ibu Sari</div>
                                    <div class="text-xs text-gray-500">Pemilik Restoran</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-[380px]">
                        <div class="bg-white border border-gray-200 hover:border-[#41B8EA] rounded-lg shadow-md hover:shadow-lg transition-all p-5">
                            <div class="flex gap-1 mb-3">
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                                <i data-lucide="star" class="h-4 w-4 text-[#F99C1C] fill-[#F99C1C]"></i>
                            </div>
                            <blockquote class="text-sm text-gray-700 mb-4 leading-relaxed">
                                "Kami mempercayakan instalasi AC untuk 50+ unit apartemen kepada ACpedia. Hasilnya sangat memuaskan, dikerjakan tepat waktu dengan kualitas terbaik."
                            </blockquote>
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#3EB48A] flex items-center justify-center text-white font-bold">
                                    AR
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">Ahmad Rizki</div>
                                    <div class="text-xs text-gray-500">Manager Properti</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gradient Overlays -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-gray-50 to-transparent pointer-events-none z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-gray-50 to-transparent pointer-events-none z-10"></div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="contact" class="py-8 md:py-12 bg-gradient-to-b from-white to-blue-50 relative overflow-hidden">
        <!-- Floating Shapes -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-blue-200 rounded-full blur-xl opacity-50"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-cyan-200 rounded-full blur-xl opacity-50"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center space-y-6 md:space-y-7 observe-me">
                <div class="space-y-4">
                    <h2 class="text-2xl md:text-4xl font-bold text-[#41B8EA]">
                        Siap untuk mengamankan kenyamanan proyek Anda?
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600">
                        Hubungi kami sekarang untuk konsultasi gratis dan penawaran terbaik
                    </p>
                </div>

                <div class="flex justify-center">
                    <a href="https://acpedia.id/hvac-contact" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 bg-[#F99C1C] hover:bg-[#F99C1C]/90 text-white px-6 py-3 md:py-4 rounded-md shadow-lg hover:shadow-xl transition-all">
                        <i data-lucide="rocket" class="h-5 w-5"></i>
                        Mulai Proyek Anda Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>