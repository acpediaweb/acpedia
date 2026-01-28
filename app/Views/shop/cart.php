<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<script src="https://unpkg.com/lucide@latest"></script>

<?php
// --- 1. DATA PREPARATION (PHP to JS) ---

// A. Build Service Packets (Tabs) from DB '$pipes'
$jsServicePackets = [];
foreach ($pipes as $pipe) {
    // We use the pipe_type (e.g., "Premium", "Elite") as the key
    // Ensure your 'pipes' table has these columns or aliased in the model
    $jsServicePackets[$pipe->pipe_type] = [
        'price'         => (int)($pipe->price ?? 0), // Full packet price
        'pricePerMeter' => (int)($pipe->price_per_meter ?? 0),
        'thickness'     => $pipe->thickness ?? '-',
        'brand'         => $pipe->brand ?? 'Generic',
        'db_id'         => $pipe->id
    ];
}

// B. Build Cart Items
$jsItems = [];
$grandTotal = 0;

foreach ($items as $item) {
    // 1. Calculate Prices
    $unitPrice = ($item->sale_price > 0) ? $item->sale_price : $item->p_price;
    
    // 2. Determine if a Service (Pipe) is attached
    $attachedService = null;
    if (!empty($item->saved_pipe_id)) {
        foreach($pipes as $p) {
            if($p->id == $item->saved_pipe_id) {
                $attachedService = [
                    'type'  => $p->pipe_type,
                    'price' => (int)($p->price ?? 0), // Price of the packet
                    'id'    => $p->id
                ];
                break;
            }
        }
    }

    // 3. Build JS Object
    $jsItems[] = [
        'id'            => $item->id,
        'name'          => $item->product_name ?? $item->service_title,
        'image'         => $item->image ?? 'https://placehold.co/80x80/png?text=Unit', // Use DB image if available
        'variant'       => $item->variant ?? 'Standard Unit',
        'location'      => 'Jakarta', // Placeholder or fetch from $addresses[0]
        'price'         => (int)$unitPrice,
        'quantity'      => (int)$item->quantity,
        'selected'      => true,
        'service'       => $attachedService,
        // Store existing addons to prevent wiping them on update (Controller logic requires sending all)
        'saved_addons'  => $item->saved_addon_ids ?? [], 
        'config'        => $item->service_config ?? []
    ];
}
?>

<main class="container mx-auto px-4 py-8 max-w-[1280px] flex-grow font-sans">
    <h1 class="text-[32px] font-semibold text-[#222] mb-6">Keranjang</h1>

    <div class="bg-white shadow-[0_2px_8px_rgba(0,0,0,0.08)] rounded-sm overflow-hidden min-h-[500px] flex flex-col border border-gray-100">
        
        <div class="hidden md:flex bg-[#efefef] border-b border-[#dee2e6] text-[#222] font-bold text-sm h-[48px] items-center px-5">
            <div class="w-[50px] flex justify-center">
                <input type="checkbox" id="select-all" class="w-[18px] h-[18px] border-[#777] rounded cursor-pointer accent-[#41B8EA]">
            </div>
            <div class="w-[300px]">Produk</div>
            <div class="flex-1">Deskripsi</div>
            <div class="w-[250px]">Lokasi</div>
            <div class="w-[150px] text-right">Harga per unit</div>
            <div class="w-[120px] text-center">Kuantitas</div>
            <div class="w-[150px] text-right">Subtotal</div>
            <div class="w-[50px]"></div>
        </div>

        <div id="cart-items-container" class="divide-y divide-gray-100 flex-1">
            </div>

        <div class="bg-white mt-auto">
            <div class="border-t border-[#dee2e6] px-5 py-6 bg-gray-50/50">
                <div class="flex justify-between items-center mb-3">
                    <div class="text-right w-full text-[16px] font-medium text-[#626060] pr-8">Total Keranjang</div>
                    <div id="total-price" class="font-bold text-[16px] text-[#212529] w-[150px] text-right">Rp 0</div>
                </div>
                <div class="flex justify-between items-center mb-6">
                    <div class="text-right w-full text-[18px] font-bold text-[#373E51] pr-8">Grand Total</div>
                    <div id="grand-total" class="font-bold text-[18px] text-[#41B8EA] w-[150px] text-right">Rp 0</div>
                </div>

                <div class="flex justify-end gap-3 mb-2">
                    <a href="<?= base_url('shop') ?>" class="px-6 py-2.5 border border-[#777] rounded text-[#777] font-bold text-sm hover:bg-gray-100 transition-colors">
                        Lanjutkan Belanja
                    </a>
                    <form action="<?= base_url('shop/checkout') ?>" method="GET">
                        <button type="submit" class="px-6 py-2.5 bg-[#F99C1C] rounded text-white font-bold text-sm hover:bg-[#F99C1C]/90 transition-colors shadow-md">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="jasa-modal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeJasaModal()"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-[10px] bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-[400px] font-sans">
                
                <div class="p-6 pb-0">
                    <div class="mb-5">
                        <h3 class="text-[18px] font-semibold text-[#373e51] text-left leading-none">Pilih Kualitas Pipa AC</h3>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mb-5" id="modal-tabs">
                        </div>

                    <div class="bg-[#f8f9fa] border border-gray-200 rounded-[6px] p-3 text-center mb-5">
                        <p class="text-[12px] text-[#666]">Kualitas pipa mempengaruhi ketahanan terhadap bocor dan performa AC</p>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="bg-[#f8f9fa] rounded-[6px] px-4 py-2.5 flex justify-between items-center">
                            <span class="text-[13px] font-semibold text-[#555]">Ketebalan</span>
                            <span id="modal-thickness" class="text-[13px] text-[#333] font-medium">-</span>
                        </div>
                        <div class="bg-white rounded-[6px] border border-[#eee] px-4 py-1.5 flex justify-between items-center h-[42px]">
                            <span class="text-[13px] font-semibold text-[#555]">Merk</span>
                            <div class="h-[28px] min-w-[70px] flex items-center justify-end" id="modal-brand-container">
                                <span class="text-[13px] font-bold text-[#373e51]">-</span>
                            </div>
                        </div>
                        <div class="bg-[#f8f9fa] rounded-[6px] px-4 py-2.5 flex justify-between items-center">
                            <span class="text-[13px] font-semibold text-[#555]">Harga</span>
                            <span id="modal-price-meter" class="text-[13px] text-[#333] font-medium">-</span>
                        </div>
                    </div>

                    <div class="bg-[#fff9e6] border border-[#ffeeba] rounded-[6px] p-3.5 mb-6">
                        <p class="text-[12px] text-[#856404] leading-relaxed"><span class="font-bold">Catatan:</span> Harga yang tertera adalah harga estimasi paket pasang (Jasa + Material).</p>
                    </div>
                </div>

                <div class="border-t border-[#eee] p-5 bg-white sticky bottom-0 z-10 rounded-b-[10px]">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <div class="text-[12px] text-[#777] mb-0.5">Biaya Paket</div>
                            <div id="modal-total-price" class="text-[18px] font-bold text-[#41b8ea] leading-none">Rp 0</div>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="closeJasaModal()" class="flex-1 border border-[#ccc] rounded-[6px] text-[#555] font-semibold text-sm hover:bg-gray-50 h-[40px]">Batal</button>
                        <button onclick="saveJasaModal()" class="flex-1 bg-[#41b8ea] hover:bg-[#3aa3d0] rounded-[6px] text-white font-bold text-sm h-[40px] shadow-md">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // --- 1. CONFIGURATION ---
    // Injected from PHP
    let cartItems = <?= json_encode($jsItems) ?>;
    const servicePackets = <?= json_encode($jsServicePackets) ?>;
    
    // Get the first key from servicePackets to act as default
    const packetKeys = Object.keys(servicePackets);
    const defaultPacketKey = packetKeys.length > 0 ? packetKeys[0] : null;

    let currentModalItemId = null;
    let currentSelectedPacket = defaultPacketKey;

    // --- 2. FORMATTING HELPERS ---
    function formatRupiah(amount) {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // --- 3. SERVER SYNC (Crucial for Controller Compatibility) ---
    // The Controller::update() wipes addons, so we must send everything back
    async function syncCartItem(item) {
        const formData = new FormData();
        formData.append('item_id', item.id);
        formData.append('qty', item.quantity);
        
        // Add Pipe ID if service exists
        if(item.service && item.service.id) {
            formData.append('pipe_id', item.service.id);
        }

        // Add Saved Addons (Restoring them so they aren't deleted)
        if(item.saved_addons && Array.isArray(item.saved_addons)) {
            item.saved_addons.forEach(addonId => {
                formData.append('addons[]', addonId);
            });
        }

        // Add Config JSON
        if(item.config) {
            // Controller expects array/post for config
            // We iterate and append e.g. config[brand], config[pk]
            for (const [key, value] of Object.entries(item.config)) {
                formData.append(`config[${key}]`, value);
            }
        }

        try {
            // We use fetch to post to the update route
            // Note: Controller returns redirect, so fetch might follow it.
            // For a smoother UX, we ignore the redirect HTML response in JS 
            // unless we want to reload the page.
            await fetch('<?= base_url('shop/cart/update') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            console.log('Cart Synced');
        } catch (error) {
            console.error('Sync failed', error);
            alert('Gagal menyimpan perubahan. Silakan refresh halaman.');
        }
    }

    // --- 4. RENDER LOGIC ---
    function renderCart() {
        const container = document.getElementById('cart-items-container');
        container.innerHTML = ''; 

        if (cartItems.length === 0) {
            container.innerHTML = '<div class="p-10 text-center text-gray-500">Keranjang Anda kosong.</div>';
            updateSummary();
            return;
        }

        cartItems.forEach(item => {
            const itemTotal = (item.price * item.quantity) + (item.service ? (item.service.price * item.quantity) : 0);
            
            // Service Badge / Button Logic
            let serviceHtml = '';
            if (item.service) {
                serviceHtml = `
                    <div class="mt-2 inline-flex items-center gap-2 px-3 py-1 bg-[#eaf7fc] border border-[#bce0f0] rounded text-[12px] text-[#2c8bb5]">
                        <i data-lucide="wrench" class="w-3 h-3"></i>
                        <span>Paket: <b>${item.service.type}</b> (+${formatRupiah(item.service.price)})</span>
                        <button onclick="removeService(${item.id})" class="ml-2 hover:text-red-500" title="Hapus Jasa"><i data-lucide="x" class="w-3 h-3"></i></button>
                    </div>
                `;
            } else {
                serviceHtml = `
                    <button onclick="openJasaModal(${item.id})" class="mt-2 text-[12px] font-bold text-[#41B8EA] hover:underline flex items-center gap-1">
                        + Tambah Paket Pasang
                    </button>
                `;
            }

            const html = `
                <div class="flex flex-col md:flex-row items-start md:items-center px-5 py-6 gap-4 hover:bg-gray-50/50 transition-colors group">
                    <div class="w-[50px] flex justify-center mt-2 md:mt-0">
                        <input type="checkbox" onchange="toggleItem(${item.id})" ${item.selected ? 'checked' : ''} class="w-[18px] h-[18px] border-[#777] rounded cursor-pointer accent-[#41B8EA]">
                    </div>

                    <div class="w-full md:w-[300px] flex gap-4">
                        <img src="${item.image}" alt="${item.name}" class="w-[70px] h-[70px] object-cover rounded border border-gray-200 bg-white">
                        <div class="flex-1">
                            <h3 class="text-[14px] font-bold text-[#373E51] leading-snug mb-1 line-clamp-2">${item.name}</h3>
                            <span class="text-[12px] text-[#777] bg-gray-100 px-1.5 py-0.5 rounded">${item.variant}</span>
                            ${serviceHtml}
                        </div>
                    </div>

                    <div class="flex-1 hidden md:block text-[13px] text-[#555] px-2">
                        <p class="line-clamp-2">Garansi Resmi, Unit 100% Original.</p>
                    </div>

                    <div class="w-full md:w-[250px] text-[13px] text-[#555] flex items-center gap-1.5 mt-2 md:mt-0">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#999]"></i> ${item.location}
                    </div>

                    <div class="w-full md:w-[150px] text-left md:text-right font-semibold text-[#373E51] mt-2 md:mt-0">
                        ${formatRupiah(item.price)}
                    </div>

                    <div class="w-full md:w-[120px] flex justify-center mt-3 md:mt-0">
                        <div class="flex border border-[#ddd] rounded overflow-hidden w-[100px]">
                            <button onclick="updateQuantity(${item.id}, -1)" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-[#555]">-</button>
                            <input type="text" value="${item.quantity}" readonly class="w-9 h-8 text-center text-[13px] border-x border-[#ddd] text-[#333] focus:outline-none">
                            <button onclick="updateQuantity(${item.id}, 1)" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-[#555]">+</button>
                        </div>
                    </div>

                    <div class="w-full md:w-[150px] text-left md:text-right font-bold text-[#41B8EA] text-[15px] mt-2 md:mt-0">
                        ${formatRupiah(itemTotal)}
                    </div>

                    <div class="w-[50px] flex justify-end mt-2 md:mt-0">
                        <button onclick="deleteItem(${item.id})" class="text-[#999] hover:text-[#ed2024] transition-colors p-2">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });

        lucide.createIcons();
        updateSummary();
        checkSelectAllStatus();
    }

    // --- 5. INTERACTION LOGIC ---

    function updateQuantity(id, change) {
        const item = cartItems.find(x => x.id === id);
        if (item) {
            const newQty = item.quantity + change;
            if (newQty >= 1) {
                item.quantity = newQty;
                renderCart();
                // Debounce could be added here, but direct call is safer for data integrity
                syncCartItem(item);
            }
        }
    }

    function deleteItem(id) {
        if(confirm('Hapus produk ini dari keranjang?')) {
            // Optimistic UI update
            cartItems = cartItems.filter(x => x.id !== id);
            renderCart();
            // Trigger actual deletion endpoint
            window.location.href = '<?= base_url('shop/cart/remove/') ?>/' + id;
        }
    }

    function toggleItem(id) {
        const item = cartItems.find(x => x.id === id);
        if (item) {
            item.selected = !item.selected;
            updateSummary();
            checkSelectAllStatus();
        }
    }

    function checkSelectAllStatus() {
        const allSelected = cartItems.length > 0 && cartItems.every(item => item.selected);
        document.getElementById('select-all').checked = allSelected;
    }

    function updateSummary() {
        let grandTotal = 0;
        cartItems.forEach(item => {
            if (item.selected) {
                const productTotal = item.price * item.quantity;
                const serviceTotal = item.service ? (item.service.price * item.quantity) : 0;
                grandTotal += (productTotal + serviceTotal);
            }
        });
        document.getElementById('total-price').innerText = formatRupiah(grandTotal);
        document.getElementById('grand-total').innerText = formatRupiah(grandTotal);
    }

    // Select All Listener
    document.getElementById('select-all').addEventListener('change', (e) => {
        const isChecked = e.target.checked;
        cartItems.forEach(item => item.selected = isChecked);
        renderCart();
    });

    // --- 6. MODAL LOGIC ---
    const modal = document.getElementById('jasa-modal');

    function openJasaModal(id) {
        if(!defaultPacketKey) {
            alert("Tidak ada paket pipa tersedia saat ini.");
            return;
        }
        currentModalItemId = id;
        
        // Render Dynamic Tabs
        renderModalTabs();
        
        // Select Default or Existing
        selectPacket(defaultPacketKey);
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeJasaModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        currentModalItemId = null;
    }

    function renderModalTabs() {
        const tabsContainer = document.getElementById('modal-tabs');
        tabsContainer.innerHTML = '';
        
        // Create buttons dynamically based on DB pipes keys
        Object.keys(servicePackets).forEach(key => {
            const btn = document.createElement('button');
            btn.setAttribute('data-tab', key);
            btn.onclick = () => selectPacket(key);
            btn.innerText = key; // e.g., "Biasa", "Premium"
            // Base classes
            btn.className = "py-2.5 px-1 rounded-[4px] text-[14px] font-medium border transition-all text-center";
            tabsContainer.appendChild(btn);
        });
    }

    function selectPacket(type) {
        currentSelectedPacket = type;
        const data = servicePackets[type];

        // Update Tab Styles
        const tabs = document.querySelectorAll('#modal-tabs button');
        tabs.forEach(btn => {
            const tabType = btn.getAttribute('data-tab');
            btn.className = "py-2.5 px-1 rounded-[4px] text-[14px] font-medium border transition-all text-center";
            
            if(tabType === type) {
                // Active State (Teal/Blue style)
                btn.classList.add('bg-[#41b8ea]', 'border-[#41b8ea]', 'text-white', 'shadow-sm');
            } else {
                // Inactive State
                btn.classList.add('bg-white', 'border-[#777]', 'text-[#777]', 'hover:bg-gray-50');
            }
        });

        // Update Data
        document.getElementById('modal-thickness').innerText = data.thickness;
        document.getElementById('modal-price-meter').innerText = formatRupiah(data.pricePerMeter) + "/meter";
        document.getElementById('modal-total-price').innerText = formatRupiah(data.price);
        document.getElementById('modal-brand-container').innerHTML = `<span class="text-[13px] font-bold text-[#373e51]">${data.brand}</span>`;
    }

    function saveJasaModal() {
        if (currentModalItemId !== null && currentSelectedPacket) {
            const item = cartItems.find(x => x.id === currentModalItemId);
            if (item) {
                const packet = servicePackets[currentSelectedPacket];
                
                // Update Local JS State
                item.service = {
                    type: currentSelectedPacket,
                    price: packet.price,
                    id: packet.db_id // Important: ID for DB
                };
                
                renderCart();
                
                // Sync to Server
                syncCartItem(item);
            }
        }
        closeJasaModal();
    }

    function removeService(id) {
        const item = cartItems.find(x => x.id === id);
        if(item) {
            item.service = null;
            renderCart();
            // Sync removal to server (pipe_id will be missing/null in syncCartItem)
            syncCartItem(item);
        }
    }

    // Initial Render
    document.addEventListener('DOMContentLoaded', () => {
        renderCart();
    });
</script>

<?= $this->endSection() ?>