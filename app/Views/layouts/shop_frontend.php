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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="\style.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="bg-white border-b border-gray-200 py-2.5 hidden xl:block relative z-40">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Left -->
                <div class="flex items-center gap-6 flex-shrink-0">
                    <div class="flex items-center gap-6 text-sm">
                        <a href="proyek-hvac" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-gray-700 hover:text-[#41B8EA] transition-colors whitespace-nowrap">
                            <i data-lucide="building-2" class="h-4 w-4"></i>
                            Project HVAC
                        </a>
                        <a href="pk-kalkulator" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-gray-700 hover:text-[#41B8EA] transition-colors whitespace-nowrap">
                            <i data-lucide="calculator" class="h-4 w-4"></i>
                            Kalkulator PK
                        </a>
                        <a href="contact" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-gray-700 hover:text-[#41B8EA] transition-colors whitespace-nowrap">
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
<header 
    x-data="{ cartOpen: false, mobileMenuOpen: false, userOpen: false }" 
    class="bg-white border-b sticky top-0 z-50 transition-all duration-300 shadow-sm border-border">
    
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-14 md:h-16">
            
            <a href="#top">
                <div class="flex items-center gap-3 cursor-pointer">
                    <img src="\assets\acpedialogo.png" alt="ACpedia Logo" class="h-6 md:h-7 w-auto">
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-8">
                <a href="/" class="flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA] transition-colors">
                    <i data-lucide="home" class="h-4 w-4"></i> Beranda
                </a>
                <a href="/shop/services" class="flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA] transition-colors">
                    <i data-lucide="wrench" class="h-4 w-4"></i> Layanan Kami
                </a>
                <a href="/shop" class="flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA] transition-colors">
                    <i data-lucide="store" class="h-4 w-4"></i> Toko Kami
                </a>
                <a href="/contact" class="flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA] transition-colors">
                    <i data-lucide="mail" class="h-4 w-4"></i> Kontak
                </a>
            </nav>

            <div class="flex items-center gap-4">
                <div class="hidden lg:flex items-center gap-6">
                    <div class="flex items-center gap-4">
                        <i data-lucide="bell" class="w-5 h-5 text-[#373E51] cursor-pointer hover:text-[#41B8EA]"></i>
                        
                        <div class="relative">
                            <?= view_cell('App\Cells\CartCell::mini') ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-[#373E51] text-[13px]">
                        <i data-lucide="user" class="w-5 h-5"></i>
                        <?php if (session()->get('isLoggedIn')): ?>
                            <a href="/users/profile" class="hover:text-[#41B8EA]">Profile</a>
                        <?php else: ?>
                            <a href="/login" class="hover:text-[#41B8EA]">Login</a>
                            <span>|</span>
                            <a href="/register" class="hover:text-[#41B8EA]">Register</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="lg:hidden flex items-center gap-4">
                    <?= view_cell('App\Cells\CartCell::mini') ?>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 hover:bg-gray-100 rounded-lg">
                        <i data-lucide="menu" class="h-6 w-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" 
             x-cloak 
             @click.away="mobileMenuOpen = false" 
             class="lg:hidden border-t border-gray-100 pb-4">
            <nav class="flex flex-col py-2">
                <a href="/" class="px-4 py-3 text-[#373E51] hover:bg-gray-50">Beranda</a>
                <a href="/shop/services" class="px-4 py-3 text-[#373E51] hover:bg-gray-50">Layanan Kami</a>
                <a href="/shop" class="px-4 py-3 text-[#373E51] hover:bg-gray-50">Toko Kami</a>
                <a href="/contact" class="px-4 py-3 text-[#373E51] hover:bg-gray-50">Kontak</a>
                <div class="px-4 pt-3 border-t">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="/users/profile" class="text-sm">Profile Saya</a>
                    <?php else: ?>
                        <a href="/login" class="text-sm">Login / Register</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>
</header>


    <main>
  <?= $this->renderSection('content') ?>
</main>


        <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6285810000684" 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-50 bg-[#25D366] hover:bg-[#20BA5A] text-white rounded-full p-4 shadow-2xl transition-all duration-300">
        <i data-lucide="message-circle" class="h-7 w-7 relative z-10"></i>
    </a>

</body>
</html>