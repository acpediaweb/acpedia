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
<header class="bg-white border-b sticky top-0 z-50 transition-all duration-300 shadow-sm border-border">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-14 md:h-16 transition-all duration-300">
            <a href="/">
                <div class="flex items-center gap-3 cursor-pointer">
                    <img src="/assets/acpedialogo.png" alt="ACpedia Logo" class="h-6 md:h-7 w-auto">
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-8">
                <a href="/" class="transition-colors flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                    <i data-lucide="home" class="h-4 w-4"></i> Beranda
                </a>
                <a href="/shop/services" class="transition-colors flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                    <i data-lucide="wrench" class="h-4 w-4"></i> Layanan Kami
                </a>
                <a href="/shop" class="transition-colors flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                    <i data-lucide="store" class="h-4 w-4"></i> Toko Kami
                </a>
                <a href="/contact" class="transition-colors flex items-center gap-2 text-[#373E51] hover:text-[#41B8EA]">
                    <i data-lucide="mail" class="h-4 w-4"></i> Kontak
                </a>
            </nav>

            <div class="flex items-center gap-4">
                <div class="hidden lg:flex items-center gap-6">
                    <div class="flex items-center gap-4">
                        <i data-lucide="bell" class="w-5 h-5 text-[#373E51] cursor-pointer hover:text-[#41B8EA] transition-colors"></i>
                        
                        <div class="relative group">
                            <?= view_cell('App\Cells\CartCell::mini') ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-[#373E51] text-[13px] font-['Roboto',sans-serif]">
                        <i data-lucide="user" class="w-5 h-5"></i>
                        <?php if (session()->get('isLoggedIn')): ?>
                            <a href="users/profile" class="hover:text-[#41B8EA] transition-colors">Profile</a>
                        <?php else: ?>
                            <div class="flex gap-1">
                                <a href="/login" class="hover:text-[#41B8EA] transition-colors">Login</a>
                                <span>|</span>
                                <a href="/register" class="hover:text-[#41B8EA] transition-colors">Register</a>
                            </div>
                        <?php opacity: ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex items-center gap-4 lg:hidden">
                    <i data-lucide="bell" class="w-5 h-5 text-[#373E51] cursor-pointer"></i>
                    <?= view_cell('App\Cells\CartCell::mini') ?>
                    <button id="mobileMenuToggle" class="p-2 hover:bg-gray-100 rounded-lg">
                        <i data-lucide="menu" class="h-6 w-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobileMenu" class="mobile-menu hidden border-t border-gray-100">
            <div class="flex flex-col py-2">
                <a href="/" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Beranda</a>
                <a href="/about" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Layanan Kami</a>
                <a href="/shop" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Toko Kami</a>
                <a href="/contact" class="px-4 py-3 text-[#373E51] hover:bg-gray-50 hover:text-[#41B8EA] font-medium transition-colors">Kontak</a>
                
                <div class="px-4 py-3 border-t border-gray-100 mt-2">
                    <div class="flex items-center gap-2 text-sm text-[#373E51]">
                        <i data-lucide="user" class="h-4 w-4"></i>
                        <?php if (session()->get('isLoggedIn')): ?>
                            <a href="users/profile" class="hover:text-[#41B8EA]">Profile Saya</a>
                        <?php else: ?>
                            <a href="/login" class="hover:text-[#41B8EA]">Login</a>
                            <span class="text-gray-300">/</span>
                            <a href="/register" class="hover:text-[#41B8EA]">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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

    <!-- JavaScript -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Mock Products Data
        const products = Array.from({ length: 16 }, (_, i) => ({
            id: i + 1,
            brand: ['Daikin', 'Panasonic', 'Midea', 'Sharp'][i % 4],
            model: 'AC MULTI S 1/2 PK x 1/2 PK 2 Indoor',
            pk: ['1/2 PK', '3/4 PK', '1 PK', '1.5 PK'][i % 4],
            type: i % 3 === 0 ? 'Inverter' : 'Non Inverter',
            rating: 4.5 + (i % 3) * 0.2,
            reviews: 137,
            originalPrice: 11649000,
            price: 10019000,
            discount: 14 + (i % 3) * 2,
            image: 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=300&h=300&fit=crop',
            features: ['midea Pionner 10', 'WALA 09/10']
        }));

        let filteredProducts = [...products];
        let currentPage = 1;
        const productsPerPage = 12;
        let selectedPK = null;
        let selectedType = null;
        let selectedCategory = null;
        let selectedBrands = [];
        let selectedOtherProducts = [];
        let currentTab = 'terbaru';

        // Mobile Menu Toggle
        // Dropdown Toggles
        function setupDropdown(toggleId, contentId, chevronId) {
            const toggle = document.getElementById(toggleId);
            const content = document.getElementById(contentId);
            const chevron = document.getElementById(chevronId);

            toggle.addEventListener('click', () => {
                content.classList.toggle('open');
                chevron.classList.toggle('rotate-180');
            });
        }

        setupDropdown('servicesToggle', 'servicesContent', 'servicesChevron');
        setupDropdown('pkCategoriesToggle', 'pkCategoriesContent', 'pkCategoriesChevron');
        setupDropdown('productCategoriesToggle', 'productCategoriesContent', 'productCategoriesChevron');
        setupDropdown('brandsFilterToggle', 'brandsFilterContent', 'brandsFilterChevron');
        setupDropdown('pkFilterToggle', 'pkFilterContent', 'pkFilterChevron');
        setupDropdown('typeFilterToggle', 'typeFilterContent', 'typeFilterChevron');
        setupDropdown('otherProductsToggle', 'otherProductsContent', 'otherProductsChevron');

        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
            });
        }

        // PK Slider
        const m2Slider = document.getElementById('m2Slider');
        const m2Display = document.getElementById('m2Display');
        const sliderHandle = document.getElementById('sliderHandle');

        m2Slider.addEventListener('input', function() {
            const value = this.value;
            m2Display.textContent = value;
            
            // Calculate handle position (max width - handle width)
            const maxWidth = this.offsetWidth - 20; // 20px is handle width
            const position = (value / 250) * maxWidth;
            sliderHandle.style.left = position + 'px';
        });

        // PK Calculator
        const calculateBtn = document.getElementById('calculateBtn');
        const roomCondition = document.getElementById('roomCondition');
        const calculationResult = document.getElementById('calculationResult');
        const btuResult = document.getElementById('btuResult');
        const pkResult = document.getElementById('pkResult');

        calculateBtn.addEventListener('click', function() {
            const m2 = parseInt(m2Slider.value);
            const condition = roomCondition.value;

            if (m2 === 0 || !condition) {
                alert('Silakan pilih kondisi ruangan dan geser slider ukuran ruangan!');
                return;
            }

            const btuPerM2 = condition === 'terkena-matahari' ? 500 : 400;
            const btuMin = m2 * btuPerM2;
            const btuMax = m2 * 500;

            const btuToPK = (btu) => {
                if (btu <= 5000) return '1/2';
                if (btu <= 7000) return '3/4';
                if (btu <= 9000) return '1';
                if (btu <= 12000) return '1.5';
                if (btu <= 18000) return '2';
                return '2.5';
            };

            const pkMin = btuToPK(btuMin);
            const pkMax = btuToPK(btuMax);

            btuResult.textContent = `${btuMin.toLocaleString('id-ID')} - ${btuMax.toLocaleString('id-ID')}`;
            pkResult.textContent = pkMin === pkMax ? `${pkMin}` : `${pkMin} s/d ${pkMax}`;
            
            calculationResult.classList.remove('hidden');
        });

        // Lihat Rekomendasi Button - Auto filter berdasarkan hasil PK Calculator
        const lihatRekomendasiBtn = calculationResult?.querySelector('button');
        if (lihatRekomendasiBtn) {
            lihatRekomendasiBtn.addEventListener('click', function() {
                // Ambil nilai PK dari hasil perhitungan
                const pkText = pkResult.textContent.trim();
                
                // Parse PK value - ambil nilai maksimum untuk rekomendasi
                let recommendedPK = '';
                if (pkText.includes('s/d')) {
                    // Jika range, ambil nilai maksimum
                    const pkValues = pkText.split('s/d');
                    recommendedPK = pkValues[1].trim() + ' PK';
                } else {
                    // Jika single value
                    recommendedPK = pkText + ' PK';
                }
                
                // Set selected PK
                selectedPK = recommendedPK;
                
                // Update UI - highlight button PK yang sesuai
                document.querySelectorAll('.pk-btn').forEach(b => {
                    b.classList.remove('active');
                    if (b.dataset.pk === recommendedPK) {
                        b.classList.add('active');
                    }
                });
                
                // Update sidebar PK filter juga
                document.querySelectorAll('.pk-filter-btn').forEach(b => {
                    b.classList.remove('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                    b.classList.add('bg-white', 'border-gray-300');
                    if (b.dataset.pk === recommendedPK) {
                        b.classList.add('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                        b.classList.remove('bg-white', 'border-gray-300');
                    }
                });
                
                // Filter products
                filterProducts();
                
                // Scroll ke product grid dengan smooth behavior
                const productsGrid = document.getElementById('productsGrid');
                if (productsGrid) {
                    productsGrid.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                }
                
                // Optional: Scroll sedikit ke atas untuk show filter tabs
                setTimeout(() => {
                    window.scrollBy({
                        top: -100,
                        behavior: 'smooth'
                    });
                }, 300);
            });
        }

        // PK Button Filter
        document.querySelectorAll('.pk-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const pk = this.dataset.pk;
                
                if (selectedPK === pk) {
                    selectedPK = null;
                    this.classList.remove('active');
                } else {
                    document.querySelectorAll('.pk-btn').forEach(b => b.classList.remove('active'));
                    selectedPK = pk;
                    this.classList.add('active');
                }
                
                filterProducts();
            });
        });

        // Type Filter (Inverter/Non Inverter)
        function setupTypeBtn(btnId, type, className) {
            const btn = document.getElementById(btnId);
            if (btn) {
                btn.addEventListener('click', function() {
                    if (selectedType === type) {
                        selectedType = null;
                        this.classList.remove('active', className);
                    } else {
                        document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active', 'inverter', 'non-inverter'));
                        selectedType = type;
                        this.classList.add('active', className);
                    }
                    filterProducts();
                });
            }
        }

        setupTypeBtn('inverterBtn', 'Inverter', 'inverter');
        setupTypeBtn('nonInverterBtn', 'Non Inverter', 'non-inverter');
        setupTypeBtn('inverterBtnMobile', 'Inverter', 'inverter');
        setupTypeBtn('nonInverterBtnMobile', 'Non Inverter', 'non-inverter');

        // Brand Filter (Sidebar)
        document.querySelectorAll('.brand-filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const brand = this.dataset.brand;
                
                if (selectedBrands.includes(brand)) {
                    selectedBrands = selectedBrands.filter(b => b !== brand);
                    this.classList.remove('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                    this.classList.add('bg-white', 'border-gray-300');
                } else {
                    selectedBrands.push(brand);
                    this.classList.add('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                    this.classList.remove('bg-white', 'border-gray-300');
                }
                
                filterProducts();
            });
        });

        // PK Filter (Sidebar)
        document.querySelectorAll('.pk-filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const pk = this.dataset.pk;
                
                if (selectedPK === pk) {
                    selectedPK = null;
                    this.classList.remove('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                    this.classList.add('bg-white', 'border-gray-300');
                } else {
                    document.querySelectorAll('.pk-filter-btn').forEach(b => {
                        b.classList.remove('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                        b.classList.add('bg-white', 'border-gray-300');
                    });
                    selectedPK = pk;
                    this.classList.add('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                    this.classList.remove('bg-white', 'border-gray-300');
                }
                
                filterProducts();
            });
        });

        // Type Filter (Sidebar)
        function setupTypFilterBtn(btnId, type) {
            const btn = document.getElementById(btnId);
            if (btn) {
                btn.addEventListener('click', function() {
                    if (selectedType === type) {
                        selectedType = null;
                        this.classList.remove('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                        this.classList.add('bg-white', 'border-gray-300');
                    } else {
                        document.querySelectorAll('.type-filter-btn').forEach(b => {
                            b.classList.remove('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                            b.classList.add('bg-white', 'border-gray-300');
                        });
                        selectedType = type;
                        this.classList.add('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                        this.classList.remove('bg-white', 'border-gray-300');
                    }
                    filterProducts();
                });
            }
        }

        setupTypFilterBtn('inverterFilterBtn', 'Inverter');
        setupTypFilterBtn('nonInverterFilterBtn', 'Non Inverter');

        // Other Products Filter
        document.querySelectorAll('.other-product-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const product = this.dataset.product;
                
                if (selectedOtherProducts.includes(product)) {
                    selectedOtherProducts = selectedOtherProducts.filter(p => p !== product);
                    this.classList.remove('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                    this.classList.add('bg-white', 'border-gray-300');
                } else {
                    selectedOtherProducts.push(product);
                    this.classList.add('bg-[#41B8EA]', 'text-white', 'border-[#41B8EA]');
                    this.classList.remove('bg-white', 'border-gray-300');
                }
                
                filterProducts();
            });
        });

        // Category Filter
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const category = this.dataset.category;
                
                if (selectedCategory === category) {
                    selectedCategory = null;
                    this.classList.remove('active');
                } else {
                    document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                    selectedCategory = category;
                    this.classList.add('active');
                }
                
                filterProducts();
            });
        });

        // Tab Filter
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentTab = this.dataset.tab;
                filterProducts();
            });
        });

        // Search Functionality
        const searchInput = document.getElementById('searchQuery');
        let searchQuery = '';
        
        searchInput.addEventListener('input', function() {
            searchQuery = this.value.toLowerCase();
            filterProducts();
        });

        // Price Sort Dropdown
        const priceSortSelect = document.getElementById('priceSort');
        
        priceSortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            if (sortValue === 'low') {
                currentTab = 'harga-rendah';
            } else if (sortValue === 'high') {
                currentTab = 'harga-tinggi';
            }
            filterProducts();
        });

        // Filter Products
        function filterProducts() {
            filteredProducts = products.filter(product => {
                const brandMatch = selectedBrands.length === 0 || selectedBrands.includes(product.brand);
                const pkMatch = !selectedPK || product.pk === selectedPK;
                const typeMatch = !selectedType || product.type === selectedType;
                const searchMatch = searchQuery === '' || 
                    product.brand.toLowerCase().includes(searchQuery) ||
                    product.model.toLowerCase().includes(searchQuery) ||
                    product.pk.toLowerCase().includes(searchQuery) ||
                    product.type.toLowerCase().includes(searchQuery);
                return brandMatch && pkMatch && typeMatch && searchMatch;
            });

            // Sort based on tab
            switch(currentTab) {
                case 'diskon':
                    filteredProducts.sort((a, b) => b.discount - a.discount);
                    break;
                case 'terlaris':
                    filteredProducts.sort((a, b) => b.reviews - a.reviews);
                    break;
                case 'harga-rendah':
                    filteredProducts.sort((a, b) => a.price - b.price);
                    break;
                case 'harga-tinggi':
                    filteredProducts.sort((a, b) => b.price - a.price);
                    break;
                default: // terbaru
                    filteredProducts.sort((a, b) => b.id - a.id);
            }

            currentPage = 1;
            renderProducts();
        }

        // Render Products
        function renderProducts() {
            const grid = document.getElementById('productsGrid');
            const start = (currentPage - 1) * productsPerPage;
            const end = start + productsPerPage;
            const pageProducts = filteredProducts.slice(start, end);

            grid.innerHTML = pageProducts.map(product => `
                <div class="product-card bg-white rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="relative">
                        <img src="${product.image}" alt="${product.model}" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-[#F99C1C] text-white rounded-full w-12 h-12 flex items-center justify-center font-bold">
                            ${product.discount}%
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs px-2 py-1 bg-[#41B8EA] text-white rounded">${product.type === 'Inverter' ? 'Inverter' : 'Non Inv'}</span>
                            <span class="text-xs px-2 py-1 bg-[#3EB48A] text-white rounded">${product.pk}</span>
                        </div>
                        <h3 class="font-semibold text-sm mb-2 line-clamp-2">${product.brand} ${product.model}</h3>
                        <div class="flex items-center gap-1 mb-2">
                            ${Array.from({ length: 5 }).map((_, i) => 
                                `<i data-lucide="star" class="h-3 w-3 ${i < Math.floor(product.rating) ? 'fill-yellow-400 text-yellow-400' : 'text-gray-300'}"></i>`
                            ).join('')}
                            <span class="text-xs text-gray-500 ml-1">${product.reviews}</span>
                        </div>
                        <div class="mb-3">
                            <div class="text-xs text-gray-400 line-through">Rp ${product.originalPrice.toLocaleString('id-ID')}</div>
                            <div class="text-lg font-bold text-[#ED2024]">Rp ${product.price.toLocaleString('id-ID')}</div>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 text-xs border border-[#41B8EA] text-[#41B8EA] hover:bg-[#41B8EA] hover:text-white py-2 px-3 rounded transition-colors">
                                Komparasi
                            </button>
                            <button class="flex-1 text-xs bg-[#F99C1C] hover:bg-[#F99C1C]/90 text-white py-2 px-3 rounded transition-colors">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            lucide.createIcons();
        }

        // Pagination
        document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const page = this.dataset.page;
                const maxPages = Math.ceil(filteredProducts.length / productsPerPage);
                
                if (page === 'prev' && currentPage > 1) {
                    currentPage--;
                } else if (page === 'next' && currentPage < maxPages) {
                    currentPage++;
                } else if (!isNaN(page)) {
                    currentPage = parseInt(page);
                }

                document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                const currentBtn = document.querySelector(`.page-btn[data-page="${currentPage}"]`);
                if (currentBtn) currentBtn.classList.add('active');

                renderProducts();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        // Initial render
        renderProducts();

        // PK Scroll Container - Drag to Scroll
        const pkScrollContainer = document.getElementById('pkScrollContainer');
        let isPKDragging = false;
        let pkStartX;
        let pkScrollLeft;

        pkScrollContainer.addEventListener('mousedown', (e) => {
            isPKDragging = true;
            pkScrollContainer.style.cursor = 'grabbing';
            pkStartX = e.pageX - pkScrollContainer.offsetLeft;
            pkScrollLeft = pkScrollContainer.scrollLeft;
        });

        pkScrollContainer.addEventListener('mouseleave', () => {
            isPKDragging = false;
            pkScrollContainer.style.cursor = 'grab';
        });

        pkScrollContainer.addEventListener('mouseup', () => {
            isPKDragging = false;
            pkScrollContainer.style.cursor = 'grab';
        });

        pkScrollContainer.addEventListener('mousemove', (e) => {
            if (!isPKDragging) return;
            e.preventDefault();
            const x = e.pageX - pkScrollContainer.offsetLeft;
            const walk = (x - pkStartX) * 2;
            pkScrollContainer.scrollLeft = pkScrollLeft - walk;
        });

        // Products Scroll Container - Drag to Scroll
        const productsScrollContainer = document.getElementById('productsScrollContainer');
        let isProductsDragging = false;
        let productsStartX;
        let productsScrollLeft;

        productsScrollContainer.addEventListener('mousedown', (e) => {
            isProductsDragging = true;
            productsScrollContainer.style.cursor = 'grabbing';
            productsStartX = e.pageX - productsScrollContainer.offsetLeft;
            productsScrollLeft = productsScrollContainer.scrollLeft;
        });

        productsScrollContainer.addEventListener('mouseleave', () => {
            isProductsDragging = false;
            productsScrollContainer.style.cursor = 'grab';
        });

        productsScrollContainer.addEventListener('mouseup', () => {
            isProductsDragging = false;
            productsScrollContainer.style.cursor = 'grab';
        });

        productsScrollContainer.addEventListener('mousemove', (e) => {
            if (!isProductsDragging) return;
            e.preventDefault();
            const x = e.pageX - productsScrollContainer.offsetLeft;
            const walk = (x - productsStartX) * 2;
            productsScrollContainer.scrollLeft = productsScrollLeft - walk;
        });

        // Re-initialize Lucide icons periodically
        setInterval(() => {
            lucide.createIcons();
        }, 1000);

 /**
 * ACpedia Cart System
 * Handles: Toggle visibility, Click-away behavior, and UI Updates
 */
const CartManager = {
    // 1. Initialize selectors and attach events
    init() {
        this.cartButton = document.getElementById('cartButton');
        this.cartDropdown = document.getElementById('cartDropdown');
        this.itemCountText = document.getElementById('cartItemCountText');
        this.itemLabel = document.getElementById('cartItemLabel');
        this.notificationDot = document.getElementById('cartNotificationDot');
        this.cartFooter = document.getElementById('cartFooter');
        this.emptyMessage = document.getElementById('emptyCartMessage');
        this.grandTotalDisplay = document.getElementById('cartGrandTotal');

        // GUARD: Only proceed if the essential elements exist on this page
        if (!this.cartButton || !this.cartDropdown) {
            return; 
        }

        this.attachEvents();
    },

    // 2. Event Listeners
    attachEvents() {
        // Toggle cart on button click
        this.cartButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation(); // Prevents the 'window' click from firing immediately
            this.toggleCart();
        });

        // Close cart when clicking anywhere outside the dropdown
        window.addEventListener('click', (e) => {
            if (!this.cartDropdown.contains(e.target) && !this.cartButton.contains(e.target)) {
                this.closeCart();
            }
        });

        // Prevent the dropdown from closing when clicking inside it
        this.cartDropdown.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    },

    // 3. Actions
    toggleCart() {
        const isHidden = this.cartDropdown.classList.contains('hidden');
        if (isHidden) {
            this.openCart();
        } else {
            this.closeCart();
        }
    },

    openCart() {
        this.cartDropdown.classList.remove('hidden');
        // Optional: add animation classes here
    },

    closeCart() {
        this.cartDropdown.classList.add('hidden');
    },

    /**
     * Update the UI (Call this after AJAX 'Add to Cart' or 'Delete')
     * @param {number} count - Number of items
     * @param {number} total - Subtotal value
     */
    updateUI(count, total) {
        if (this.itemCountText) this.itemCountText.textContent = count;
        if (this.itemLabel) this.itemLabel.textContent = `${count} Items`;

        // Format price to IDR: 50000 -> Rp 50.000
        if (this.grandTotalDisplay) {
            this.grandTotalDisplay.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(total);
        }

        // Toggle visibility of empty states vs footer
        if (count > 0) {
            this.notificationDot?.classList.remove('hidden');
            this.cartFooter?.classList.remove('hidden');
            this.emptyMessage?.classList.add('hidden');
        } else {
            this.notificationDot?.classList.add('hidden');
            this.cartFooter?.classList.add('hidden');
            this.emptyMessage?.classList.remove('hidden');
        }
    }
};

// Start the manager once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    CartManager.init();
});
    </script>

</body>
</html>