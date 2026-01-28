document.addEventListener('DOMContentLoaded', () => {
    // --- 1. Global UI & Utilities ---
    const refreshIcons = () => window.lucide?.createIcons();
    refreshIcons();

    // Generic Drag-to-Scroll
    ['pkScrollContainer', 'productsScrollContainer'].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        let isDown, startX, scrollLeft;
        el.onmousedown = e => { isDown=true; el.style.cursor='grabbing'; startX=e.pageX-el.offsetLeft; scrollLeft=el.scrollLeft; };
        el.onmouseleave = el.onmouseup = () => { isDown=false; el.style.cursor='grab'; };
        el.onmousemove = e => { if(isDown) { e.preventDefault(); el.scrollLeft = scrollLeft - (e.pageX-el.offsetLeft)*2; }};
    });

    // Mobile Menu
    const menuBtn = document.getElementById('mobileMenuBtn') || document.getElementById('mobileMenuToggle');
    const menu = document.getElementById('mobileMenu');
    if (menuBtn && menu) {
        const toggle = () => {
            menu.classList.toggle('active');
            const icon = menuBtn.querySelector('i');
            if (icon) icon.setAttribute('data-lucide', menu.classList.contains('active') ? 'x' : 'menu');
            refreshIcons();
        };
        menuBtn.onclick = toggle;
        document.querySelectorAll('.mobile-link').forEach(l => l.onclick = () => { menu.classList.remove('active'); refreshIcons(); });
    }

    // Scroll Effects (TopBar & Animations)
    const topBar = document.getElementById('topBar');
    const observer = new IntersectionObserver(entries => entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add(e.target.classList.contains('counter') ? 'counted' : 'animated');
            if (e.target.classList.contains('counter')) animateCounter(e.target);
        }
    }), { threshold: 0.1 });
    
    document.querySelectorAll('.observe-me, .observe-scale, .counter').forEach(el => observer.observe(el));
    
    window.addEventListener('scroll', () => {
        if (topBar) {
            const isHidden = window.pageYOffset > 100;
            topBar.style.transform = isHidden ? 'translateY(-100%)' : 'translateY(0)';
            topBar.style.opacity = isHidden ? '0' : '1';
        }
    });

    // --- 2. Calculator Logic ---
    const calcBtn = document.getElementById('calculateBtn');
    if (calcBtn) {
        const m2Slider = document.getElementById('m2Slider');
        const handle = document.getElementById('sliderHandle');
        
        m2Slider?.addEventListener('input', function() {
            document.getElementById('m2Display').textContent = this.value;
            if(handle) handle.style.left = `${(this.value / 250) * (this.offsetWidth - 20)}px`;
        });

        calcBtn.onclick = () => {
            const m2 = parseInt(m2Slider.value), cond = document.getElementById('roomCondition').value;
            if (!m2 || !cond) return alert('Pilih kondisi dan ukuran ruangan!');
            
            const btuMin = m2 * (cond === 'terkena-matahari' ? 500 : 400);
            const btuMax = m2 * 500;
            const getPK = b => b<=5000?.5:b<=7000?.75:b<=9000?1:b<=12000?1.5:b<=18000?2:2.5; // Compact lookup
            
            document.getElementById('btuResult').textContent = `${btuMin.toLocaleString()} - ${btuMax.toLocaleString()}`;
            document.getElementById('pkResult').textContent = `${getPK(btuMin)} - ${getPK(btuMax)} PK`;
            document.getElementById('calculationResult').classList.remove('hidden');
        };
    }

    // --- 3. Product Listing & Filtering ---

   const grid = document.getElementById('productsGrid');
    
    if (grid) {
        // State Management
        const state = { 
            products: [], 
            filters: { brands:[], pk:null, type:null, search:'', sort:'terbaru' },
            loading: false
        };

        // Helpers
        const rupiah = (num) => new Intl.NumberFormat('id-ID').format(num);
        const calculateDiscount = (base, sale) => Math.round(((base - sale) / base) * 100);

        // Fetch Data
        const loadProducts = async () => {
            state.loading = true;
            render(); // Show loading spinner
            
            try {
                // Build Query Params
                const params = new URLSearchParams();
                state.filters.brands.forEach(b => params.append('brands[]', b));
                if (state.filters.pk) params.append('pk', state.filters.pk);
                if (state.filters.type) params.append('type', state.filters.type);
                if (state.filters.search) params.append('search', state.filters.search);
                if (state.filters.sort) params.append('sort', state.filters.sort);
                
                const res = await fetch(`/api/products?${params.toString()}`);
                if(!res.ok) throw new Error('API Error');
                
                state.products = await res.json();
            } catch (e) { 
                console.error(e);
                grid.innerHTML = '<div class="col-span-full text-center py-10 text-red-500">Gagal memuat data produk.</div>'; 
            } finally {
                state.loading = false;
                render();
            }
        };

        // Render Active Filter Badges
        const renderActiveFilters = () => {
            const container = document.getElementById('activeFiltersContainer');
            const resetBtn = document.getElementById('resetFiltersBtn');
            if(!container) return;

            let html = '';
            let hasFilters = false;

            // Brands
            state.filters.brands.forEach(b => {
                hasFilters = true;
                html += createBadge(b, 'brands', b);
            });
            // PK
            if (state.filters.pk) {
                hasFilters = true;
                html += createBadge(`PK: ${state.filters.pk}`, 'pk');
            }
            // Type
            if (state.filters.type) {
                hasFilters = true;
                html += createBadge(`Tipe: ${state.filters.type}`, 'type');
            }

            container.innerHTML = html;
            
            // Show/Hide Reset Button
            if(resetBtn) resetBtn.classList.toggle('hidden', !hasFilters);
            
            // Bind Remove Events
            container.querySelectorAll('.remove-filter-btn').forEach(btn => {
                btn.onclick = () => {
                    const group = btn.dataset.group;
                    const value = btn.dataset.value;
                    toggleFilter(group, value, false); // false = remove/toggle
                };
            });
        };

        const createBadge = (label, group, value = '') => `
            <div class="inline-flex items-center gap-1 bg-[#41B8EA]/10 text-[#41B8EA] text-xs font-semibold px-2.5 py-1 rounded-full border border-[#41B8EA]/20">
                ${label}
                <button class="remove-filter-btn hover:text-red-500 transition-colors ml-1" data-group="${group}" data-value="${value}">
                    <i data-lucide="x" class="w-3 h-3"></i>
                </button>
            </div>`;

        // Main Render Function
        const render = () => {
            // 1. Loading State
            if (state.loading) {
                grid.innerHTML = `
                <div class="col-span-full flex flex-col justify-center items-center py-12 text-gray-400">
                     <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#41B8EA] mb-2"></div>
                     <p class="text-sm">Memuat produk...</p>
                </div>`;
                return;
            }

            // 2. Empty State
            if (!state.products.length) {
                grid.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center py-12 text-center text-gray-500">
                    <i data-lucide="package-open" class="w-12 h-12 mb-3 opacity-50"></i>
                    <p>Tidak ada produk ditemukan dengan filter ini.</p>
                </div>`;
                return;
            }

            // 3. Render Cards
            grid.innerHTML = state.products.map(p => {
                const finalPrice = p.sale_price || p.base_price;
                const hasDiscount = p.sale_price && p.sale_price < p.base_price;
                const discount = hasDiscount ? calculateDiscount(p.base_price, p.sale_price) : 0;
                
                // Random Rating for Demo (Since DB might be empty on ratings)
                const rating = (Math.random() * (5.0 - 4.0) + 4.0).toFixed(1); 
                
                return `
                <div class="product-card group bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col h-full relative overflow-hidden">
                    ${hasDiscount ? `<div class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm z-10">-${discount}%</div>` : ''}
                    
                    <div class="relative w-full h-48 bg-gray-50 flex items-center justify-center p-6 overflow-hidden">
                        <img src="${p.main_image}" alt="${p.product_name}" 
                             class="max-h-full max-w-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500">
                    </div>

                    <div class="p-4 flex-1 flex flex-col">
                        <div class="text-[11px] text-gray-500 mb-1 flex items-center gap-2 font-medium">
                            <span class="bg-gray-100 px-1.5 py-0.5 rounded">${p.brand_name || 'Brand'}</span>
                            <span class="bg-gray-100 px-1.5 py-0.5 rounded">${p.pk_category_name || 'PK'}</span>
                        </div>

                        <h3 class="font-bold text-[#373E51] text-sm mb-2 line-clamp-2 leading-tight min-h-[40px] group-hover:text-[#41B8EA] transition-colors">
                            ${p.product_name}
                        </h3>

                        <div class="flex items-center gap-1 mb-3">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                            </div>
                            <span class="text-xs text-gray-400">(${rating})</span>
                        </div>

                        <div class="mt-auto">
                            ${hasDiscount ? `
                                <div class="text-xs text-gray-400 line-through mb-0.5">Rp ${rupiah(p.base_price)}</div>
                                <div class="text-lg font-bold text-[#F99C1C]">Rp ${rupiah(finalPrice)}</div>
                            ` : `
                                <div class="h-4"></div> <div class="text-lg font-bold text-[#F99C1C]">Rp ${rupiah(finalPrice)}</div>
                            `}
                        </div>
                    </div>

                    <div class="px-4 pb-4 pt-0 grid grid-cols-2 gap-2 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity duration-200 lg:translate-y-2 lg:group-hover:translate-y-0">
                         <button class="w-full py-1.5 border border-[#41B8EA] text-[#41B8EA] rounded text-[11px] font-bold hover:bg-[#41B8EA] hover:text-white transition-all uppercase tracking-wide">
                            Komparasi
                         </button>
                         <button class="w-full py-1.5 bg-[#41B8EA] text-white rounded text-[11px] font-bold hover:bg-[#359bc7] transition-all shadow-md hover:shadow-lg uppercase tracking-wide">
                            Pesan
                         </button>
                    </div>
                </div>`;
            }).join('');

            updateUI();
            refreshIcons();
        };

        // Update UI (Sidebar Active States)
        const updateUI = () => {
            renderActiveFilters();

            // Reset all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));

            // Set Active: Brands
            state.filters.brands.forEach(brand => {
                const btn = document.querySelector(`.filter-btn[data-group="brands"][data-value="${brand}"]`);
                if(btn) btn.classList.add('active');
            });

            // Set Active: PK
            if(state.filters.pk) {
                const btn = document.querySelector(`.filter-btn[data-group="pk"][data-value="${state.filters.pk}"]`);
                if(btn) btn.classList.add('active');
            }

            // Set Active: Type
            if(state.filters.type) {
                const btn = document.querySelector(`.filter-btn[data-group="type"][data-value="${state.filters.type}"]`);
                if(btn) btn.classList.add('active');
            }
        };

        // Unified Toggle Logic
        const toggleFilter = (group, value, reload = true) => {
            if (group === 'brands') {
                const idx = state.filters.brands.indexOf(value);
                if (idx > -1) state.filters.brands.splice(idx, 1);
                else state.filters.brands.push(value);
            } 
            else {
                // For Single Selects (PK, Type), toggle off if same clicked
                state.filters[group] = state.filters[group] === value ? null : value;
            }

            if (reload) loadProducts();
            else {
                // If called from Remove Badge, just reload
                loadProducts();
            }
        };

        // Event Listeners
        
        // 1. Sidebar Filters
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.onclick = (e) => {
                e.preventDefault();
                toggleFilter(btn.dataset.group, btn.dataset.value);
            };
        });

        // 2. Search
        const searchInput = document.getElementById('searchQuery');
        let debounceTimer;
        if(searchInput) {
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    state.filters.search = e.target.value;
                    loadProducts();
                }, 500);
            });
        }

        // 3. Sort
        document.getElementById('priceSort')?.addEventListener('change', (e) => {
            state.filters.sort = e.target.value || 'terbaru';
            loadProducts();
        });

        // 4. Tabs (Terbaru/Diskon/Terlaris)
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.onclick = (e) => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                state.filters.sort = btn.dataset.tab;
                loadProducts();
            };
        });

        // 5. Reset Button
        document.getElementById('resetFiltersBtn')?.addEventListener('click', () => {
            state.filters.brands = [];
            state.filters.pk = null;
            state.filters.type = null;
            state.filters.search = '';
            document.getElementById('searchQuery').value = '';
            loadProducts();
        });

        // Initial Load
        loadProducts();
    }

    // --- 4. Product Detail (Gallery & Qty) ---
    const mainImg = document.getElementById('main-image');
    if (mainImg) {
        document.querySelectorAll('.thumb-btn').forEach(btn => btn.onclick = () => {
            mainImg.src = btn.querySelector('img').src;
            document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('ring-2', 'ring-blue-400'));
            btn.classList.add('ring-2', 'ring-blue-400');
        });

        let qty = 1;
        const updateQty = () => {
            document.getElementById('qty-display').textContent = qty;
            document.getElementById('btn-minus').disabled = qty <= 1;
        };
        document.getElementById('btn-plus')?.addEventListener('click', () => { qty++; updateQty(); });
        document.getElementById('btn-minus')?.addEventListener('click', () => { if(qty>1) qty--; updateQty(); });
    }
});

function animateCounter(el) {
    const target = +el.getAttribute('data-target');
    let cur = 0, step = target / 100;
    const run = () => { cur += step; el.textContent = Math.floor(cur); if(cur < target) requestAnimationFrame(run); else el.textContent = target; };
    run();
}