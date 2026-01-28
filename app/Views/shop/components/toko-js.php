<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const MAX_VISIBLE_ITEMS = 5;

    /**
     * Common navigation handler for all filter buttons with data-url.
     */
    function handleNavigationClick() {
        const url = this.dataset.url; 
        if (url) {
            window.location.href = url;
        }
    }

    /**
     * Initializes a filter section with show/hide functionality and navigation.
     */
    function initializeFilter(containerId, buttonClass, toggleButtonId, storageKey, showAllText, showAllClassName, useMaxHeight = false) {
        const content = document.getElementById(containerId);
        const toggleBtn = document.getElementById(toggleButtonId);

        if (!content) return;

        const filterButtons = content.querySelectorAll(buttonClass);

        // --- Toggle Logic ---

        const openContent = () => {
            if (useMaxHeight) {
                content.style.maxHeight = content.scrollHeight + "px"; 
            } else {
                content.style.display = 'block';
            }
            localStorage.setItem(storageKey, 'true');
        };

        const closeContent = () => {
            if (useMaxHeight) {
                content.style.maxHeight = "0px"; 
            } else {
                content.style.display = 'none';
            }
            localStorage.setItem(storageKey, 'false');
        };

        // Initialize state
        const savedState = localStorage.getItem(storageKey);
        if (savedState === 'false') {
            closeContent();
        } else {
            openContent(); 
        }

        // Attach toggle event
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                const isOpen = useMaxHeight 
                    ? (content.style.maxHeight && content.style.maxHeight !== "0px") 
                    : content.style.display !== 'none';
                
                if (isOpen) {
                    closeContent();
                } else {
                    openContent();
                }
            });
        }
        
        // --- Show/Hide Logic for items exceeding MAX_VISIBLE_ITEMS ---
        if (filterButtons.length > MAX_VISIBLE_ITEMS) {
            filterButtons.forEach((btn, index) => {
                if (index >= MAX_VISIBLE_ITEMS) {
                    btn.style.display = 'none';
                }
            });

            const showAllBtn = document.createElement('button');
            showAllBtn.textContent = showAllText;
            showAllBtn.className = showAllClassName;
            
            content.appendChild(showAllBtn);

            showAllBtn.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.style.display = 'block');
                this.style.display = 'none';
                
                if (useMaxHeight) {
                    if (content.style.maxHeight && content.style.maxHeight !== "0px") {
                         content.style.maxHeight = content.scrollHeight + "px";
                    }
                }
            });
        }

        // --- Navigation Logic ---
        filterButtons.forEach(btn => {
            btn.addEventListener('click', handleNavigationClick);
        });

        // Optional: adjust maxHeight on window resize for the animated filter
        if (useMaxHeight) {
            window.addEventListener('resize', () => {
                const isOpen = content.style.maxHeight && content.style.maxHeight !== "0px";
                if (isOpen) {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    }
    
    // 1. Initialise All Filters
    
    // Brand Filter (uses maxHeight for animation)
    initializeFilter(
        'brandsFilterContent', 
        '.brand-filter-btn', 
        'brandsFilterToggle', 
        'brandsFilterOpen', 
        'Show All Brands', 
        'brand-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 transition-all',
        true
    );

    // PK Filter (uses display)
    initializeFilter(
        'pkFilterContent', 
        '.pk-filter-btn', 
        'pkFilterToggle', 
        'pkFilterOpen', 
        'Show All PK', 
        'pk-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 transition-all show-all-pk-btn',
        false
    );
    
    // Type Filter (uses display)
    initializeFilter(
        'typeFilterContent', 
        '.type-filter-btn', 
        'typeFilterToggle', 
        'typeFilterOpen', 
        'Show All Types', 
        'type-filter-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 transition-all',
        false
    );

    // Other Products Filter (uses display)
    initializeFilter(
        'otherProductsContent', 
        '.other-product-btn', 
        'otherProductsToggle', 
        'otherProductsFilterOpen', 
        'Show All Products', 
        'other-product-btn w-full text-left px-3 py-2 rounded border border-gray-300 bg-white hover:border-[#41B8EA] hover:bg-gray-50 text-gray-700 transition-all',
        false
    );


    // 2. Attach general navigation listener for any other filter buttons
    document.querySelectorAll('.brand-filter-btn, .pk-filter-btn, .type-filter-btn, .other-product-btn').forEach(button => {
        button.addEventListener('click', handleNavigationClick);
    });

});


// --- Elemen DOM Umum ---
const m2Slider = document.getElementById('m2Slider');
const m2Display = document.getElementById('m2Display');
const sliderHandle = document.getElementById('sliderHandle');
const roomCondition = document.getElementById('roomCondition');
const calculateBtn = document.getElementById('calculateBtn');
const calculationResult = document.getElementById('calculationResult');
const btuResult = document.getElementById('btuResult');
const pkResult = document.getElementById('pkResult');

// --- Elemen Tombol Rekomendasi (Pastikan ID ini ada di HTML) ---
const recommendationBtn = document.getElementById('recommendationBtn'); 

// --- Variabel Global untuk Menyimpan Hasil PK (Hanya berlaku selama sesi halaman) ---
let globalPkMin = '';

// --- HARDCODED PK to Filter ID MAP ---
const pkToFilterIdMap = {
    '1/2': 2,
    '3/4': 3,
    '1': 4,
    '1.5': 5,
    '2': 7,
    '2.5': 8,
};

// --- Fungsi Helper untuk Update Posisi Slider Handle ---
function updateSliderVisuals(value) {
    m2Display.textContent = value;
    
    // Hitung posisi handle slider
    // Ambil lebar penuh container slider
    const parentWidth = m2Slider.parentElement.offsetWidth;
    const handleWidth = 20; 
    const maxWidth = parentWidth - handleWidth; 
    
    // Hitung posisi relatif handle (nilai 250 adalah nilai max slider)
    const position = (value / 250) * maxWidth;
    sliderHandle.style.left = position + 'px';
}

// --- 1. PK Slider Interaction (Input) ---
m2Slider.addEventListener('input', function() {
    const value = parseInt(this.value);
    
    // Update visual
    updateSliderVisuals(value);
});


// --- 2. PK Conversion Function ---
const btuToPK = (btu) => {
    // 
    if (btu <= 5000) return '1/2';
    if (btu <= 7000) return '3/4';
    if (btu <= 9000) return '1';
    if (btu <= 12000) return '1.5';
    if (btu <= 18000) return '2';
    return '2.5'; 
};

// --- 3. PK Calculation Logic ---
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

    const pkMin = btuToPK(btuMin);
    const pkMax = btuToPK(btuMax);
    
    // Simpan hasil PK minimum untuk navigasi
    globalPkMin = pkMin; 

    // Format dan tampilkan hasil
    const btuText = `${btuMin.toLocaleString('id-ID')} - ${btuMax.toLocaleString('id-ID')}`;
    const pkText = pkMin === pkMax ? `${pkMin}` : `${pkMin} s/d ${pkMax}`;
    
    btuResult.textContent = btuText;
    pkResult.textContent = pkText;
    
    // Tampilkan blok hasil
    calculationResult.classList.remove('hidden');
});

// --- 4. Tombol "Lihat Rekomendasi" Logic ---
recommendationBtn.addEventListener('click', function() {
    const pkToFilter = globalPkMin;
    
    if (!pkToFilter) {
        alert('Mohon hitung kebutuhan PK terlebih dahulu!');
        return;
    }

    const filterId = pkToFilterIdMap[pkToFilter];

    if (!filterId) {
        console.error(`PK value ${pkToFilter} tidak ditemukan di pkToFilterIdMap.`);
        alert('Terjadi kesalahan dalam menentukan filter PK. Silakan coba lagi.');
        return;
    }
    
    // Logika untuk menambahkan parameter ke URL saat ini
    const queryParam = 'pk_id';
    const currentUrl = new URL(window.location.href);

    currentUrl.searchParams.set(queryParam, filterId);

    // Navigasi ke URL yang dimodifikasi (muat ulang halaman)
    window.location.href = currentUrl.toString();
});

</script>

<script>



document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.pkCalculatorServiceBtn');
    const targetBlock = document.getElementById('pkCalculatorBlock');
    const OFFSET_PX = 100;

    if (!targetBlock) return;

    // 1. Move the logic into a reusable function
    const scrollToCalculator = (isInstant = false) => {
        const elementPosition = targetBlock.getBoundingClientRect().top;
        const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        const targetScrollPosition = currentScrollPosition + elementPosition - OFFSET_PX;

        window.scrollTo({
            top: targetScrollPosition,
            behavior: isInstant ? 'auto' : 'smooth'
        });

        // Highlight effect
        targetBlock.style.border = '3px solid red';
        targetBlock.style.boxShadow = '0 0 20px rgba(255, 0, 0, 0.8)';
        targetBlock.style.transition = 'all 0.5s ease-in-out';

        setTimeout(() => {
            targetBlock.style.border = '';
            targetBlock.style.boxShadow = '';
        }, 1500);
    };

    // 2. Handle Button Clicks
    buttons.forEach(btn => {
        btn.addEventListener('click', () => scrollToCalculator(false));
    });

    // 3. Check for URL Parameter on Load
    const urlParams = new URLSearchParams(window.location.search);
    
    // Checks for ?pkcalc or ?anything=pkcalc
    if (urlParams.has('pkcalc') || window.location.search.includes('pkcalc')) {
        // Delay slightly to ensure layout is fully rendered
        setTimeout(() => scrollToCalculator(false), 300);

        // 4. Remove the parameter from the URL without refreshing
        const newUrl = window.location.pathname + window.location.hash;
        window.history.replaceState({}, document.title, newUrl);
    }
});



function setupDropdown(toggleId, contentId, chevronId) {
    const toggle = document.getElementById(toggleId);
    const content = document.getElementById(contentId);
    const chevron = document.getElementById(chevronId);

    // Exit if any element is missing
    if (!toggle || !content || !chevron) return;

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



</script>