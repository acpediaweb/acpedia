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

    // --- 3. Product Listing Logic ---
    const grid = document.getElementById('productsGrid');
    if (grid) {
        const state = { products: [], filters: { brands:[], pk:null, type:null, search:'', sort:'terbaru' } };

        // Fetch Data
        const loadProducts = async () => {
            try {
                // Build Query String from state.filters
                const params = new URLSearchParams();
                if (state.filters.brands.length) state.filters.brands.forEach(b => params.append('brands[]', b));
                if (state.filters.pk) params.append('pk', state.filters.pk);
                if (state.filters.type) params.append('type', state.filters.type);
                if (state.filters.search) params.append('search', state.filters.search);
                if (state.filters.sort) params.append('sort', state.filters.sort);
                
                // Call the API
                const res = await fetch(`/api/products?${params.toString()}`);
                state.products = await res.json();
                
                render();
            } catch (e) { 
                console.error(e);
                grid.innerHTML = '<div class="col-span-full text-center">Error loading data</div>'; 
            }
        };

        const render = () => {
            // NOTE: Filtering is now done on server-side (PHP), 
            // so we just render whatever state.products contains.
            const data = state.products;

            if (!data.length) return grid.innerHTML = '<div class="col-span-full py-8 text-center">Tidak ada produk ditemukan.</div>';

            grid.innerHTML = data.map(p => {
                // Formatting price
                const price = new Intl.NumberFormat('id-ID').format(p.final_price);
                
                return `
                <div class="product-card bg-white rounded shadow p-3 hover:shadow-lg transition-shadow">
                    <img src="${p.main_image}" alt="${p.product_name}" class="w-full h-48 object-contain mb-2">
                    <div class="text-xs text-gray-500 mb-1">${p.brand_name} - ${p.pk_category_name || ''}</div>
                    <h3 class="font-bold text-[#373E51] text-sm mb-2 h-10 overflow-hidden">${p.product_name}</h3>
                    <div class="text-[#F99C1C] font-bold">Rp ${price}</div>
                    ${p.sale_price ? `<div class="text-xs text-gray-400 line-through">Rp ${new Intl.NumberFormat('id-ID').format(p.base_price)}</div>` : ''}
                </div>`;
            }).join('');
            
            refreshIcons();
        };

        // Event Bindings
        document.querySelectorAll('.tab-btn').forEach(b => b.onclick = e => {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            e.target.classList.add('active');
            state.filters.sort = e.target.dataset.tab;
            render();
        });

        document.getElementById('searchQuery')?.addEventListener('input', e => { state.filters.search = e.target.value.toLowerCase(); render(); });
        
        // Generic Filter Button Handler
        const bindFilter = (cls, key, multi=false) => document.querySelectorAll(cls).forEach(btn => {
            btn.onclick = () => {
                const val = btn.dataset[key];
                if (multi) {
                    const idx = state.filters[key+'s']?.indexOf(val);
                    idx > -1 ? state.filters[key+'s'].splice(idx,1) : state.filters[key+'s'].push(val);
                    btn.classList.toggle('active'); // Simplified styling toggle
                } else {
                    state.filters[key] = state.filters[key] === val ? null : val;
                    document.querySelectorAll(cls).forEach(b => b.classList.remove('active'));
                    if(state.filters[key]) btn.classList.add('active');
                }
                loadProducts();
            };
        });

        bindFilter('.brand-filter-btn', 'brand', true);
        bindFilter('.pk-btn', 'pk');
        bindFilter('.type-filter-btn', 'type');
        
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