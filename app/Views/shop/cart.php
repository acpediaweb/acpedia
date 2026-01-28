<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    window.SHOP_DATA = {
        pipePrices: {
            <?php foreach ($pipes as $p): ?>
            '<?= $p->id ?>': <?= (float)$p->price_per_meter ?>,
            <?php endforeach; ?>
        },
        addonPrices: {
            <?php foreach ($addons as $a): ?>
            '<?= $a->id ?>': <?= (float)$a->addon_price ?>,
            <?php endforeach; ?>
        }
    };
</script>

<div class="py-10" x-data="{ 
    saveGlobalConfig() {
        let formData = new FormData($refs.globalConfigForm);
        fetch('<?= base_url('shop/cart/updateConfig') ?>', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(res => res.json()).then(data => {
            console.log('Config saved');
        });
    }
}">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Your Cart</h1>
        <a href="<?= base_url('shop') ?>" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">&larr; Continue Shopping</a>
    </div>

    <?php if (empty($items)): ?>
        <div class="flex flex-col items-center justify-center bg-white border-2 border-dashed border-gray-200 rounded-[2rem] p-20 text-center">
            <p class="text-gray-500 font-medium">Your cart is currently empty.</p>
            <a href="<?= base_url('shop') ?>" class="mt-6 bg-blue-600 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">Browse Catalog</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <?php 
                $grandTotal = 0;
                foreach ($items as $item): 
                    $isService = !empty($item->service_id);
                    $basePrice = $isService ? $item->s_price : ($item->sale_price ?? $item->p_price);
                    
                    // PHP-Side Subtotal (Uses prepared data from Controller)
                    $addonTotal = 0;
                    
                    // Add Pipe Cost
                    if (!empty($item->saved_pipe_id)) {
                        foreach ($pipes as $p) {
                            if ($p->id == $item->saved_pipe_id) $addonTotal += $p->price_per_meter;
                        }
                    }
                    // Add Addon Costs
                    if (!empty($item->saved_addon_ids)) {
                        foreach ($addons as $a) {
                            if (in_array((string)$a->id, $item->saved_addon_ids)) $addonTotal += $a->addon_price;
                        }
                    }

                    $subtotal = ($basePrice + $addonTotal) * $item->quantity;
                    $grandTotal += $subtotal;
                ?>
                
                <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group"
                     x-data="cartItem({
                        qty: <?= (int)$item->quantity ?>,
                        basePrice: <?= (float)$basePrice ?>,
                        selectedPipe: '<?= $item->saved_pipe_id ?>', 
                        selectedAddons: <?= !empty($item->saved_addon_ids) ? json_encode($item->saved_addon_ids) : '[]' ?>
                     })">
                     
                    <form action="<?= base_url('shop/cart/update') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="item_id" value="<?= $item->id ?>">
                        
                        <div class="flex flex-col md:flex-row gap-6 relative z-10">
                            <div class="flex-grow">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider <?= $isService ? 'bg-blue-50 text-blue-600' : 'bg-emerald-50 text-emerald-600' ?>">
                                        <?= $isService ? 'Service' : 'Product' ?>
                                    </span>
                                    <h3 class="font-bold text-gray-900 text-lg leading-tight"><?= esc($isService ? $item->service_title : $item->product_name) ?></h3>
                                </div>

                                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 mt-2">
                                    <?php if ($isService): ?>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Brand</label>
                                                <select name="config[brand]" class="w-full text-xs border-gray-200 rounded-lg bg-white">
                                                    <option value="">Select...</option>
                                                    <?php foreach ($brands as $b): ?>
                                                        <option value="<?= esc($b->brand_name) ?>" <?= ($item->service_config['brand'] ?? '') == $b->brand_name ? 'selected' : '' ?>><?= esc($b->brand_name) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Type</label>
                                                <select name="config[type]" class="w-full text-xs border-gray-200 rounded-lg bg-white">
                                                    <option value="">Select...</option>
                                                    <?php foreach ($types as $t): ?>
                                                        <option value="<?= esc($t->type_name) ?>" <?= ($item->service_config['type'] ?? '') == $t->type_name ? 'selected' : '' ?>><?= esc($t->type_name) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Capacity</label>
                                                <select name="config[pk]" class="w-full text-xs border-gray-200 rounded-lg bg-white">
                                                    <option value="">Select...</option>
                                                    <?php foreach ($pk_categories as $pk): ?>
                                                        <option value="<?= esc($pk->pk_category_name) ?>" <?= ($item->service_config['pk'] ?? '') == $pk->pk_category_name ? 'selected' : '' ?>><?= esc($pk->pk_category_name) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Pipe Kit</label>
                                                <select name="pipe_id" x-model="selectedPipe" class="w-full text-xs border-gray-200 rounded-lg bg-white focus:ring-emerald-500">
                                                    <option value="">No Pipe Needed</option>
                                                    <?php foreach ($pipes as $p): ?>
                                                        <option value="<?= (string)$p->id ?>">
                                                            <?= esc($p->pipe_type) ?> (+Rp <?= number_format($p->price_per_meter, 0) ?>)
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if (!empty($addons)): ?>
                                                <div>
                                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Optional Services</label>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                        <?php foreach ($addons as $addon): ?>
                                                            <label class="flex items-center space-x-2 p-2 bg-white rounded-lg border border-gray-100 cursor-pointer hover:border-emerald-300">
                                                                <input type="checkbox" name="addons[]" 
                                                                       value="<?= (string)$addon->id ?>" 
                                                                       x-model="selectedAddons" 
                                                                       class="rounded text-emerald-600 border-gray-300">
                                                                <div class="text-xs">
                                                                    <span class="font-bold text-gray-700 block"><?= esc($addon->addon_name) ?></span>
                                                                    <span class="text-gray-400 text-[10px]">+Rp <?= number_format($addon->addon_price, 0) ?></span>
                                                                </div>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="flex flex-col justify-between items-end min-w-[140px]">
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Total Price</p>
                                    <p class="text-xl font-black text-gray-900 tracking-tight">
                                        Rp <span x-text="formatPrice(subtotal)"></span>
                                    </p>
                                </div>

                                <div class="flex flex-col items-end gap-3 w-full">
                                    <div class="flex items-center gap-2">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase">Qty:</label>
                                        <input type="number" name="qty" x-model="qty" min="1" class="w-16 text-center text-sm font-bold bg-white border-gray-200 rounded-lg">
                                    </div>

                                    <button type="submit" class="w-full py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-blue-200 flex items-center justify-center gap-2">
                                        Save Changes
                                    </button>
                                    
                                    <a href="<?= base_url('shop/cart/remove/'.$item->id) ?>" class="text-[10px] font-bold text-red-400 hover:text-red-600 underline">Remove</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="lg:col-span-1">
                <form action="<?= base_url('shop/checkout') ?>" method="GET" x-ref="globalConfigForm" class="bg-gray-900 text-white rounded-[2.5rem] p-8 sticky top-28 shadow-xl space-y-6">
                    <h2 class="text-xl font-bold mb-4">Checkout Details</h2>
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">Installation Location</label>
                        <?php if (!empty($addresses)): ?>
                            <div class="relative">
                                <select name="address_id" class="w-full bg-gray-800 border-none rounded-2xl py-3 px-4 text-sm text-white focus:ring-2 focus:ring-blue-500 appearance-none cursor-pointer">
                                    <?php foreach ($addresses as $addr): ?>
                                        <option value="<?= $addr->id ?>" <?= $addr->is_primary ? 'selected' : '' ?>>
                                            <?= esc($addr->street) ?> (<?= esc($addr->city) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute right-4 top-3.5 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="p-3 bg-red-900/50 rounded-xl border border-red-800">
                                <p class="text-xs text-red-300">No address found. Please add one.</p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-2 text-right">
                            <a href="<?= base_url('customer/profile') ?>" class="text-[10px] font-bold text-blue-400 hover:text-blue-300 flex items-center justify-end gap-1">
                                Manage Addresses &rarr;
                            </a>
                        </div>
                    </div>

                    <div x-data x-init="flatpickr($refs.picker, {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i',
                        minDate: 'today',
                        time_24hr: true,
                        defaultDate: '<?= $cart->scheduled_datetime ?? '' ?>',
                        onChange: function() { saveGlobalConfig(); }
                    })">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">Technician Arrival</label>
                        <input x-ref="picker" type="text" name="scheduled_datetime" 
                               class="w-full bg-gray-800 border-none rounded-2xl py-3 px-4 text-sm text-white focus:ring-2 focus:ring-blue-500 placeholder-gray-500 cursor-pointer"
                               placeholder="Select Date & Time...">
                    </div>

                    <div class="pt-4 border-t border-gray-800">
                        <label class="flex items-center space-x-4 cursor-pointer group">
                            <input type="checkbox" name="faktur" @change="saveGlobalConfig()" <?= ($cart->faktur_requested ?? false) ? 'checked' : '' ?> class="rounded bg-gray-800 border-gray-600 text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-bold text-gray-300 group-hover:text-white">Request Tax Invoice (Faktur)</span>
                        </label>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-800">
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Est. Total</span>
                            <span class="text-3xl font-black text-white">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                        </div>
                        
                        <button type="submit" class="block w-full bg-blue-600 hover:bg-blue-500 text-white text-center py-5 rounded-2xl font-black text-sm uppercase tracking-widest transition-all transform hover:scale-[1.02] shadow-xl shadow-blue-900/40">
                            Proceed to Checkout
                        </button>
                    </div>
                </form>
            </div>

        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cartItem', (config) => ({
            qty: Number(config.qty),
            basePrice: Number(config.basePrice),
            selectedPipe: config.selectedPipe, 
            selectedAddons: config.selectedAddons || [],

            get subtotal() {
                let total = this.basePrice;
                
                if (!window.SHOP_DATA) return total;

                // Pipe Price
                if (this.selectedPipe) {
                    let pipePrice = window.SHOP_DATA.pipePrices[this.selectedPipe] || 0;
                    total += pipePrice;
                }

                // Addon Prices
                this.selectedAddons.forEach(id => {
                    let addonPrice = window.SHOP_DATA.addonPrices[String(id)] || 0;
                    total += addonPrice;
                });

                return total * this.qty;
            },
            
            formatPrice(val) {
                if (isNaN(val)) return '0';
                return new Intl.NumberFormat('id-ID').format(val);
            }
        }))
    })
</script>

<?= $this->endSection() ?>