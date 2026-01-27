<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kami - ACpedia</title>
    
    <!-- Google Fonts - Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- React Icons CDN for TikTok -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="bg-white border-b border-gray-200 py-2.5 hidden xl:block relative z-40">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Left -->
                <div class="flex items-center gap-6 flex-shrink-0">
                    <div class="flex items-center gap-6 text-sm">
                        <a href="insertlink" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-gray-700 hover:text-[#41B8EA] transition-colors whitespace-nowrap">
                            <i data-lucide="building-2" class="h-4 w-4"></i>
                            Project HVAC
                        </a>
                        <a href="insertlink" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-gray-700 hover:text-[#41B8EA] transition-colors whitespace-nowrap">
                            <i data-lucide="calculator" class="h-4 w-4"></i>
                            Kalkulator PK
                        </a>
                        <a href="insertlink" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-gray-700 hover:text-[#41B8EA] transition-colors whitespace-nowrap">
                            <i data-lucide="headphones" class="h-4 w-4"></i>
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <!-- Center -->
                <div class="flex items-center justify-center gap-3 flex-1">
                    <span class="text-sm text-gray-700">Layanan Bantuan Online</span>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <a href="https://wa.me/6285810000684" class="flex items-center gap-1 hover:text-[#41B8EA] transition-colors">
                            <i data-lucide="message-circle" class="h-3.5 w-3.5"></i>
                            0858-1000-0684
                        </a>
                        <span class="text-gray-300">|</span>
                        <a href="mailto:halo@acpedia.id" class="flex items-center gap-1 hover:text-[#41B8EA] transition-colors">
                            <i data-lucide="mail" class="h-3.5 w-3.5"></i>
                            halo@acpedia.id
                        </a>
                    </div>
                </div>

                <!-- Right -->
                <div class="flex items-center gap-6 flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <i data-lucide="truck" class="h-4 w-4 text-[#373E51]"></i>
                        <span class="text-[13px] text-[#373E51] font-normal">Pengiriman Gratis</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-700 mr-1">Ikuti Kami</span>
                        <a href="#" class="text-gray-600 hover:text-pink-600 transition-colors"><i data-lucide="instagram" class="h-4 w-4"></i></a>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors"><i class="fa-brands fa-tiktok h-3.5 w-3.5"></i></a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors"><i data-lucide="facebook" class="h-4 w-4"></i></a>
                        <a href="#" class="text-gray-600 hover:text-red-600 transition-colors"><i data-lucide="youtube" class="h-4 w-4"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white border-b sticky top-0 z-50 transition-all duration-300 shadow-sm border-border">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-14 md:h-16 transition-all duration-300">
                <a href="#top">
                    <div class="flex items-center gap-3 cursor-pointer">
                        <img src="C:\Users\Dody\Desktop\ACpedia\ACpedia\assets\acpedialogo.png" alt="ACpedia Logo" class="h-6 md:h-7 w-auto">
                    </div>
                </a>

                <nav class="hidden lg:flex items-center gap-8">
                    <a href="#home" class="transition-colors relative group flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                        <i data-lucide="home" class="h-4 w-4"></i> Beranda
                    </a>
                    <a href="#about" class="transition-colors relative group flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                        <i data-lucide="wrench" class="h-4 w-4"></i> Layanan Kami
                    </a>
                    <a href="#toko" class="transition-colors relative group flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                        <i data-lucide="store" class="h-4 w-4"></i> Toko Kami
                    </a>
                    <a href="#contact" class="transition-colors relative group flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                        <i data-lucide="mail" class="h-4 w-4"></i> Kontak
                    </a>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="hidden lg:block relative w-[115px] h-[16px] cursor-pointer hover:opacity-80 transition-opacity">
                        <div class="absolute -left-[56px] top-1/2 -translate-y-1/2 flex items-center gap-3">
                            <i data-lucide="bell" class="w-4 h-4 text-[#373E51] cursor-pointer hover:text-[#41B8EA] transition-colors"></i>
                            <i data-lucide="shopping-cart" class="w-4 h-4 text-[#373E51] cursor-pointer hover:text-[#41B8EA] transition-colors"></i>
                        </div>
                        <div class="absolute flex flex-col font-['Roboto',sans-serif] h-[15px] justify-center leading-[0] not-italic right-0 text-[#373e51] text-[13px] text-right top-[7.5px] translate-y-[-50%] w-[91.01px]">
                            <p class="leading-[13px]">Login/Register</p>
                        </div>
                        <div class="absolute left-0 size-[14px] top-px">
                            <i data-lucide="user" class="block size-full text-[#373E51]"></i>
                        </div>
                    </div>
                    
                    <!-- Mobile Notification & Cart Icons -->
                    <div class="flex items-center gap-4 lg:hidden">
                        <i data-lucide="bell" class="w-5 h-5 text-[#373E51] cursor-pointer hover:text-[#41B8EA] transition-colors"></i>
                        <i data-lucide="shopping-cart" class="w-5 h-5 text-[#373E51] cursor-pointer hover:text-[#41B8EA] transition-colors"></i>
                    </div>

                    <button id="mobileMenuToggle" class="lg:hidden p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <i data-lucide="menu" class="h-6 w-6"></i>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="mobile-menu md:hidden border-t border-gray-100">
                <div class="flex flex-col py-2">
                    <a href="#home" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Beranda</a>
                    <a href="#about" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Layanan Kami</a>
                    <a href="#toko" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Toko Kami</a>
                    <a href="#contact" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Kontak</a>
                    <div class="px-4 py-3 border-t border-gray-100 mt-2">
                        <div class="flex items-center gap-3 text-sm text-gray-600 mb-3">
                            <a href="#" class="flex items-center gap-2 hover:text-[#41B8EA]">
                                <i data-lucide="user" class="h-4 w-4"></i> Login / Register
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <?= $this->renderSection('content') ?>

        <footer class="text-white" style="background-color: #212529;">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 justify-center">
                
                <!-- Column 1 - Logo & Address -->
                <div class="lg:col-span-4 lg:col-start-2 observe-me">
                    <div class="mb-3">
                        <img src="assets/acpediawhite.png" 
                             alt="ACpedia Logo" 
                             class="h-12 w-auto">
                    </div>
                    <p class="text-sm text-slate-400 mb-6">
                        Solusi pendingin udara terdepan untuk kenyamanan hidup Anda. Temukan berbagai pilihan AC berkualitas dengan teknologi terkini.
                    </p>

                    <!-- Address -->
                    <div class="mb-6">
                        <div class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="h-5 w-5 text-[#41B8EA] flex-shrink-0 mt-0.5"></i>
                            <div>
                                <p class="text-sm text-slate-400 leading-relaxed">
                                    Ruko Colloseum No 55 lantai 3,<br />
                                    Jl. Green Lake City Boulevard, Green Lake City, Cipondoh, Tangerang 15147
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h6 class="text-sm uppercase mb-3">Ikuti Kami</h6>
                        <div class="flex gap-3">
                            <a href="" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#41B8EA] transition-colors">
                                <i data-lucide="facebook" class="h-5 w-5"></i>
                            </a>
                            <a href="" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#41B8EA] transition-colors">
                                <i data-lucide="instagram" class="h-5 w-5"></i>
                            </a>
                            <a href="" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#41B8EA] transition-colors">
                                <i data-lucide="twitter" class="h-5 w-5"></i>
                            </a>
                            <a href="" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#41B8EA] transition-colors">
                                <i data-lucide="youtube" class="h-5 w-5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Column 2 - Info Perusahaan -->
                <div class="lg:col-span-2 observe-me" style="animation-delay: 0.1s;">
                    <h6 class="text-sm uppercase mb-4">Info Perusahaan</h6>
                    <ul class="space-y-2">
                        <li><a href="https://acpedia.id/about" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Tentang Kami</a></li>
                        <li><a href="https://acpedia.id/contact-us" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Hubungi Kami</a></li>
                        <li><a href="https://acpedia.id/faq" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">FAQ</a></li>
                        <li><a href="https://acpedia.id/terms" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="https://acpedia.id/privacy" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <!-- Column 3 - Layanan -->
                <div class="lg:col-span-2 observe-me" style="animation-delay: 0.2s;">
                    <h6 class="text-sm uppercase mb-4">Layanan</h6>
                    <ul class="space-y-2">
                        <li><a href="https://acpedia.id/pk-calculator" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Kalkulator PK</a></li>
                        <li><a href="https://acpedia.id/hvac-contact" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Projek HVAC</a></li>
                        <li><a href="" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Jasa Pasang AC</a></li>
                        <li><a href="" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Jasa Perawatan</a></li>
                        <li><a href="https://acpedia.id/auth/login" target="_blank" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Lacak Pesanan</a></li>
                    </ul>
                </div>

                <!-- Column 4 - Produk -->
                <div class="lg:col-span-2 observe-me" style="animation-delay: 0.3s;">
                    <h6 class="text-sm uppercase mb-4">Produk</h6>
                    <ul class="space-y-2 mb-6">
                        <li><a href="" class="text-slate-400 hover:text-[#41B8EA] transition-colors">AC Split Wall</a></li>
                        <li><a href="" class="text-slate-400 hover:text-[#41B8EA] transition-colors">AC Cassette</a></li>
                        <li><a href="" class="text-slate-400 hover:text-[#41B8EA] transition-colors">AC Floor Standing</a></li>
                        <li><a href="" class="text-slate-400 hover:text-[#41B8EA] transition-colors">Produk Lainnya</a></li>
                    </ul>

                    <!-- Payment Methods -->
                    <div>
                        <h6 class="text-sm uppercase mb-3">Metode Pembayaran</h6>
                        <div class="bg-white/10 backdrop-blur-sm px-6 py-3 rounded-lg border border-white/20 hover:border-[#41B8EA] transition-colors cursor-pointer">
                            <div class="flex items-center gap-2 whitespace-nowrap">
                                <i data-lucide="credit-card" class="h-5 w-5 flex-shrink-0"></i>
                                <span class="text-sm">Lihat Metode Pembayaran</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-4 bg-black/20 border-t border-white/10">
            <p class="text-sm text-slate-400">
                © 2026 ACPEDIA. All Rights Reserved.
            </p>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6285810000684" 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-50 bg-[#25D366] hover:bg-[#20BA5A] text-white rounded-full p-4 shadow-2xl transition-all duration-300 whatsapp-pulse">
        <i data-lucide="message-circle" class="h-7 w-7 relative z-10"></i>
    </a>

    <script src="dodijs.js"></script>