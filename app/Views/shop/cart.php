<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>
<div class="py-10" x-data="{ 
    saveGlobalConfig() {
        let formData = new FormData($refs.globalConfigForm);
        fetch('<?= base_url('shop/cart/updateConfig') ?>', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(res => res.json()).then(data => {
            console.log('Cart config saved');
        });
    }
}">
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-black text-gray-900">Your Shopping Cart</h1>
        <a href="<?= base_url('shop') ?>" class="text-sm text-blue-600 font-bold hover:underline">&larr; Continue Shopping</a>
    </div>

    <?php if (empty($items)): ?>
        <div class="bg-white rounded-3xl border border-dashed border-gray-300 p-20 text-center">
            <p class="text-gray-400 italic">Your cart is empty.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-2 space-y-6">
                <?php 
                $grandTotal = 0;
                foreach ($items as $item): 
                    $isService = !empty($item->service_id);
                    $config = json_decode($item->config ?? '{}', true);
                    $price = $isService ? $item->s_price : ($item->sale_price ?? $item->p_price);
                    $subtotal = $price * $item->quantity;
                    $grandTotal += $subtotal;
                ?>
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <form action="<?= base_url('shop/cart/update') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="item_id" value="<?= $item->id ?>">
                        
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="flex-grow">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider <?= $isService ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' ?>">
                                        <?= $isService ? 'Service' : 'Hardware' ?>
                                    </span>
                                    <h3 class="font-bold text-gray-900"><?= $isService ? $item->service_title : $item->product_name ?></h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 bg-gray-50 p-4 rounded-2xl">
                                    <?php if ($isService): ?>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Unit Brand</label>
                                            <select name="config[brand]" required class="w-full text-xs border-gray-200 rounded-lg focus:ring-blue-500">
                                                <option value="">Choose Brand...</option>
                                                <?php foreach ($brands as $b): ?>
                                                    <option value="<?= $b->brand_name ?>" <?= ($config['brand'] ?? '') == $b->brand_name ? 'selected' : '' ?>><?= $b->brand_name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Unit Capacity (PK)</label>
                                            <select name="config[pk]" required class="w-full text-xs border-gray-200 rounded-lg focus:ring-blue-500">
                                                <option value="0.5" <?= ($config['pk'] ?? '') == '0.5' ? 'selected' : '' ?>>0.5 PK</option>
                                                <option value="1" <?= ($config['pk'] ?? '') == '1' ? 'selected' : '' ?>>1 PK</option>
                                                <option value="1.5" <?= ($config['pk'] ?? '') == '1.5' ? 'selected' : '' ?>>1.5 PK</option>
                                                <option value="2" <?= ($config['pk'] ?? '') == '2' ? 'selected' : '' ?>>2 PK</option>
                                            </select>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-span-2 space-y-2">
                                            <label class="flex items-center space-x-3 cursor-pointer">
                                                <input type="checkbox" name="config[install]" value="1" <?= ($config['install'] ?? false) ? 'checked' : '' ?> class="rounded text-blue-600 border-gray-300">
                                                <span class="text-xs text-gray-600 font-medium">Include Professional Installation (Mandatory for Warranty)</span>
                                            </label>
                                            <label class="flex items-center space-x-3 cursor-pointer">
                                                <input type="checkbox" name="config[apartment]" value="1" <?= ($config['apartment'] ?? false) ? 'checked' : '' ?> class="rounded text-blue-600 border-gray-300">
                                                <span class="text-xs text-gray-600 font-medium">Apartment/High-Rise Installation Fee</span>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="flex flex-col items-end justify-between min-w-[150px]">
                                <div class="text-right">
                                    <p class="text-sm text-gray-400">Subtotal</p>
                                    <p class="text-lg font-black text-gray-900">Rp <?= number_format($subtotal, 0, ',', '.') ?></p>
                                </div>
                                
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border rounded-xl px-2 py-1">
                                        <span class="text-[10px] font-bold text-gray-400 mr-2 uppercase">Qty</span>
                                        <input type="number" name="qty" value="<?= $item->quantity ?>" min="1" class="w-12 text-center border-none focus:ring-0 text-sm font-bold">
                                    </div>
                                    <button type="submit" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    </button>
                                    <a href="<?= base_url('shop/cart/remove/'.$item->id) ?>" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gray-900 text-white rounded-3xl p-8 sticky top-24 shadow-xl">
                    <h2 class="text-xl font-bold mb-8">Checkout Summary</h2>
                    
                    <form x-ref="globalConfigForm" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Technician Arrival Schedule</label>
                            <input type="datetime-local" name="scheduled_datetime" 
                                   @change="saveGlobalConfig()"
                                   value="<?= $cart->scheduled_datetime ?? '' ?>"
                                   class="w-full bg-gray-800 border-none rounded-xl py-3 px-4 text-sm text-white focus:ring-2 focus:ring-blue-500 transition-all">
                            <p class="text-[10px] text-gray-500 mt-2 italic">Schedule is required for orders containing services.</p>
                        </div>

                        <div class="pt-4 border-t border-gray-800">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" name="faktur" @change="saveGlobalConfig()" 
                                           <?= ($cart->faktur_requested ?? false) ? 'checked' : '' ?>
                                           class="peer sr-only">
                                    <div class="w-10 h-6 bg-gray-700 rounded-full peer-checked:bg-blue-600 transition-colors"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4"></div>
                                </div>
                                <span class="text-xs font-bold text-gray-300 group-hover:text-white transition-colors">Request Tax Invoice (Faktur)</span>
                            </label>
                        </div>
                    </form>

                    <div class="mt-10 pt-8 border-t border-gray-800 space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Order Subtotal</span>
                            <span class="font-bold">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-lg font-black text-white pt-4">
                            <span>Grand Total</span>
                            <span class="text-blue-400">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                        </div>
                    </div>

                    <a href="<?= base_url('shop/checkout') ?>" 
                       class="block w-full bg-blue-600 text-white text-center py-4 rounded-2xl font-bold mt-8 hover:bg-blue-700 transition-all transform active:scale-95 shadow-lg shadow-blue-900/20">
                        Proceed to Payment
                    </a>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>