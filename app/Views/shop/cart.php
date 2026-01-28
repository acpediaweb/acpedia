<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="py-10" x-data="{ 
    saveGlobalConfig() {
        let formData = new FormData($refs.globalConfigForm);
        fetch('<?= base_url('shop/cart/updateConfig') ?>', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(res => res.json()).then(data => {
            console.log('Schedule saved');
        });
    }
}">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Your Cart</h1>
        <a href="<?= base_url('shop') ?>" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">&larr; Continue Shopping</a>
    </div>

    <?php if (empty($items)): ?>
        <div class="flex flex-col items-center justify-center bg-white border-2 border-dashed border-gray-200 rounded-[2rem] p-20 text-center">
            <div class="bg-gray-50 p-4 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <p class="text-gray-500 font-medium">Your cart is currently empty.</p>
            <a href="<?= base_url('shop') ?>" class="mt-6 bg-blue-600 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">Browse Catalog</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <?php 
                $grandTotal = 0;
                
                // Prepare Pricing Data for JS to avoid loop overhead in x-data
                $jsPipePrices = [];
                foreach ($pipes as $p) $jsPipePrices[$p->id] = (float)$p->price_per_meter;
                
                $jsAddonPrices = [];
                foreach ($addons as $a) $jsAddonPrices[$a->id] = (float)$a->addon_price;

                foreach ($items as $item): 
                    $isService = !empty($item->service_id);
                    $basePrice = $isService ? $item->s_price : ($item->sale_price ?? $item->p_price);
                    
                    $savedPipeId = null;
                    $savedAddonIds = [];
                    $addonTotal = 0; // PHP Side Calculation for initial load
                    
                    if (!empty($item->saved_addons)) {
                        foreach ($item->saved_addons as $sa) {
                            if ($sa->pipe_id) {
                                $savedPipeId = $sa->pipe_id;
                                if(isset($jsPipePrices[$sa->pipe_id])) $addonTotal += $jsPipePrices[$sa->pipe_id]; // Assuming flat fee per unit for simplicity in display
                            }
                            if ($sa->addon_id) {
                                $savedAddonIds[] = $sa->addon_id;
                                if(isset($jsAddonPrices[$sa->addon_id])) $addonTotal += $jsAddonPrices[$sa->addon_id];
                            }
                        }
                    }
                    
                    $initialSubtotal = ($basePrice + $addonTotal) * $item->quantity;
                    $grandTotal += $initialSubtotal;
                ?>
                
                <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group"
                     x-data="cartItem({
                        qty: <?= $item->quantity ?>,
                        basePrice: <?= $basePrice ?>,
                        selectedPipe: '<?= $savedPipeId ?? '' ?>',
                        selectedAddons: <?= json_encode($savedAddonIds) ?>,
                        pipePrices: <?= json_encode($jsPipePrices) ?>,
                        addonPrices: <?= json_encode($jsAddonPrices) ?>
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
                                                <select name="config[brand]" class="w-full text-xs border-gray-200 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select...</option>
                                                    <?php foreach ($brands as $b): ?>
                                                        <option value="<?= esc($b->brand_name) ?>" <?= ($item->service_config['brand'] ?? '') == $b->brand_name ? 'selected' : '' ?>>
                                                            <?= esc($b->brand_name) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Type</label>
                                                <select name="config[type]" class="w-full text-xs border-gray-200 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select...</option>
                                                    <?php foreach ($types as $t): ?>
                                                        <option value="<?= esc($t->type_name) ?>" <?= ($item->service_config['type'] ?? '') == $t->type_name ? 'selected' : '' ?>>
                                                            <?= esc($t->type_name) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Capacity</label>
                                                <select name="config[pk]" class="w-full text-xs border-gray-200 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select...</option>
                                                    <?php foreach ($pk_categories as $pk): ?>
                                                        <option value="<?= esc($pk->pk_category_name) ?>" <?= ($item->service_config['pk'] ?? '') == $pk->pk_category_name ? 'selected' : '' ?>>
                                                            <?= esc($pk->pk_category_name) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Pipe Installation Kit</label>
                                                <select name="pipe_id" x-model="selectedPipe" class="w-full text-xs border-gray-200 rounded-lg bg-white focus:ring-emerald-500 focus:border-emerald-500">
                                                    <option value="">No Pipe Needed</option>
                                                    <?php foreach ($pipes as $p): ?>
                                                        <option value="<?= $p->id ?>">
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
                                                            <label class="flex items-center space-x-2 p-2 bg-white rounded-lg border border-gray-100 cursor-pointer hover:border-emerald-300 transition-colors">
                                                                <input type="checkbox" name="addons[]" value="<?= $addon->id ?>" x-model="selectedAddons"
                                                                    class="rounded text-emerald-600 border-gray-300 focus:ring-emerald-500">
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

                                <div class="flex items-center gap-2 bg-gray-50 p-1 rounded-xl">
                                    <input type="number" name="qty" x-model="qty" min="1" 
                                           class="w-12 text-center text-sm font-bold bg-white border-gray-200 rounded-lg focus:ring-0 focus:border-blue-500">
                                    
                                    <button type="submit" class="p-2 text-blue-600 hover:bg-white hover:shadow-sm rounded-lg transition-all" title="Update Cart">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>
                                    
                                    <a href="<?= base_url('shop/cart/remove/'.$item->id) ?>" class="p-2 text-red-500 hover:bg-white hover:shadow-sm rounded-lg transition-all" title="Remove Item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gray-900 text-white rounded-[2.5rem] p-8 sticky top-28 shadow-xl">
                    <h2 class="text-xl font-bold mb-8 flex items-center gap-2">
                        <span>Checkout Details</span>
                    </h2>
                    
                    <form x-ref="globalConfigForm" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div x-data x-init="flatpickr($refs.picker, {
                            enableTime: true,
                            dateFormat: 'Y-m-d H:i',
                            minDate: 'today',
                            time_24hr: true,
                            defaultDate: '<?= $cart->scheduled_datetime ?? '' ?>',
                            onChange: function(selectedDates, dateStr, instance) {
                                saveGlobalConfig();
                            }
                        })">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-3">Technician Arrival</label>
                            <input x-ref="picker" type="text" name="scheduled_datetime" 
                                   class="w-full bg-gray-800 border-none rounded-2xl py-4 px-5 text-sm text-white focus:ring-2 focus:ring-blue-500 transition-all placeholder-gray-500 cursor-pointer"
                                   placeholder="Select Date & Time...">
                            <p class="text-[10px] text-gray-500 mt-2 px-2">Required for service dispatch.</p>
                        </div>

                        <div class="pt-6 border-t border-gray-800">
                            <label class="flex items-center space-x-4 cursor-pointer group p-2 hover:bg-gray-800 rounded-xl transition-colors">
                                <div class="relative">
                                    <input type="checkbox" name="faktur" @change="saveGlobalConfig()" 
                                           <?= ($cart->faktur_requested ?? false) ? 'checked' : '' ?>
                                           class="peer sr-only">
                                    <div class="w-10 h-6 bg-gray-700 rounded-full peer-checked:bg-blue-500 transition-colors"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4"></div>
                                </div>
                                <span class="text-xs font-bold text-gray-300 group-hover:text-white transition-colors">Request Tax Invoice (Faktur)</span>
                            </label>
                        </div>
                    </form>

                    <div class="mt-10 pt-8 border-t border-gray-800">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Est. Total</span>
                            <span class="text-3xl font-black text-white">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                        </div>
                        <p class="text-[10px] text-gray-500 text-right mb-8">* Total updates after clicking 'Update Cart'.</p>

                        <a href="<?= base_url('shop/checkout') ?>" 
                           class="block w-full bg-blue-600 hover:bg-blue-500 text-white text-center py-5 rounded-2xl font-black text-sm uppercase tracking-widest transition-all transform hover:scale-[1.02] shadow-xl shadow-blue-900/40">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cartItem', (config) => ({
            qty: config.qty,
            basePrice: config.basePrice,
            selectedPipe: config.selectedPipe,
            selectedAddons: config.selectedAddons,
            pipePrices: config.pipePrices,
            addonPrices: config.addonPrices,

            get subtotal() {
                let total = this.basePrice;
                
                // Add Pipe Price (if selected)
                if (this.selectedPipe && this.pipePrices[this.selectedPipe]) {
                    total += this.pipePrices[this.selectedPipe];
                }

                // Add Addon Prices (if selected)
                this.selectedAddons.forEach(id => {
                    if (this.addonPrices[id]) {
                        total += this.addonPrices[id];
                    }
                });

                return total * this.qty;
            },
            
            formatPrice(val) {
                return new Intl.NumberFormat('id-ID').format(val);
            }
        }))
    })
</script>

<?= $this->endSection() ?>