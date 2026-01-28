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
            console.log('Cart preferences auto-saved');
        });
    }
}">
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-black text-gray-900">Your Shopping Cart</h1>
        <a href="<?= base_url('shop') ?>" class="text-sm text-blue-600 font-bold hover:underline">&larr; Back to Shop</a>
    </div>

    <?php if (empty($items)): ?>
        <div class="bg-white rounded-3xl border border-dashed border-gray-300 p-20 text-center">
            <p class="text-gray-400 italic font-medium">Your cart is currently empty.</p>
            <a href="<?= base_url('shop') ?>" class="mt-4 inline-block bg-blue-600 text-white px-8 py-3 rounded-xl font-bold text-sm">Browse Products</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-2 space-y-6">
                <?php foreach ($items as $item): 
                    $isService = !empty($item->service_id);
                    $config = json_decode($item->config ?? '{}', true);
                    $price = $isService ? $item->s_price : ($item->sale_price ?? $item->p_price);
                ?>
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <form action="<?= base_url('shop/cart/update') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="item_id" value="<?= $item->id ?>">
                        
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="flex-grow">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest <?= $isService ? 'bg-blue-100 text-blue-700' : 'bg-indigo-100 text-indigo-700' ?>">
                                        <?= $isService ? 'Labor / Service' : 'Hardware Unit' ?>
                                    </span>
                                    <h3 class="font-bold text-gray-900"><?= $isService ? esc($item->service_title) : esc($item->product_name) ?></h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 bg-gray-50 p-5 rounded-2xl border border-gray-100">
                                    <?php if ($isService): ?>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Unit Brand</label>
                                            <select name="config[brand]" required class="w-full text-xs border-gray-200 rounded-lg">
                                                <option value="">Select Brand</option>
                                                <?php foreach ($brands as $b): ?>
                                                    <option value="<?= esc($b->brand_name) ?>" <?= ($config['brand'] ?? '') == $b->brand_name ? 'selected' : '' ?>><?= esc($b->brand_name) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">AC Type</label>
                                            <select name="config[category]" required class="w-full text-xs border-gray-200 rounded-lg">
                                                <option value="">Select Type</option>
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= esc($cat->category_name) ?>" <?= ($config['category'] ?? '') == $cat->category_name ? 'selected' : '' ?>><?= esc($cat->category_name) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Capacity (Horsepower)</label>
                                            <select name="config[pk]" required class="w-full text-xs border-gray-200 rounded-lg">
                                                <?php foreach (['0.5', '1', '1.5', '2', '2.5'] as $val): ?>
                                                    <option value="<?= $val ?>" <?= ($config['pk'] ?? '') == $val ? 'selected' : '' ?>><?= $val ?> PK</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-span-2">
                                            <p class="text-[10px] font-bold text-gray-400 uppercase mb-3 tracking-widest">Recommended Addons</p>
                                            <div class="space-y-2">
                                                <?php foreach ($addons as $addon): ?>
                                                    <label class="flex items-center space-x-3 cursor-pointer group">
                                                        <input type="checkbox" name="config[addons][]" value="<?= esc($addon->service_title) ?>" 
                                                            <?= in_array($addon->service_title, $config['addons'] ?? []) ? 'checked' : '' ?>
                                                            class="rounded text-blue-600 border-gray-300 focus:ring-blue-500">
                                                        <span class="text-xs text-gray-600 group-hover:text-gray-900 transition-colors">
                                                            <?= esc($addon->service_title) ?> 
                                                            <span class="text-gray-400 ml-1">(+Rp <?= number_format($addon->base_price, 0, ',', '.') ?>)</span>
                                                        </span>
                                                    </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="flex flex-col items-end justify-between min-w-[140px]">
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 uppercase font-bold">Subtotal</p>
                                    <p class="text-lg font-black text-gray-900">Rp <?= number_format($price * $item->quantity, 0, ',', '.') ?></p>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center border rounded-xl px-2 py-1 bg-white">
                                        <input type="number" name="qty" value="<?= $item->quantity ?>" min="1" class="w-10 text-center border-none focus:ring-0 text-sm font-bold">
                                    </div>
                                    <button type="submit" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </button>
                                    <a href="<?= base_url('shop/cart/remove/'.$item->id) ?>" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gray-900 text-white rounded-[2rem] p-8 sticky top-24 shadow-2xl border border-gray-800">
                    <h2 class="text-xl font-bold mb-8">Order Logistics</h2>
                    
                    <form x-ref="globalConfigForm" class="space-y-6">
                        <?= csrf_field() ?>
                        
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-3">Service Date & Time</label>
                            <input type="datetime-local" name="scheduled_datetime" 
                                   @change="saveGlobalConfig()"
                                   value="<?= $cart->scheduled_datetime ?? '' ?>"
                                   class="w-full bg-gray-800 border-none rounded-xl py-3 px-4 text-sm text-white focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div class="pt-6 border-t border-gray-800">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" name="faktur" @change="saveGlobalConfig()" 
                                       <?= ($cart->faktur_requested ?? false) ? 'checked' : '' ?>
                                       class="rounded bg-gray-800 border-none text-blue-500 focus:ring-offset-gray-900 focus:ring-blue-500">
                                <span class="text-xs font-bold text-gray-400 group-hover:text-white transition-colors">Request Tax Invoice (Faktur)</span>
                            </label>
                        </div>
                    </form>

                    <div class="mt-10 pt-8 border-t border-gray-800">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-gray-500 text-sm font-bold uppercase tracking-widest">Total Est.</span>
                            <span class="text-2xl font-black text-blue-400">Rp <?= number_format($grandTotal ?? 0, 0, ',', '.') ?></span>
                        </div>

                        <a href="<?= base_url('shop/checkout') ?>" 
                           class="block w-full bg-blue-600 text-white text-center py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-900/30">
                            Proceed to Checkout
                        </a>
                        <p class="text-[9px] text-gray-500 mt-6 text-center leading-relaxed">
                            Final pricing for labor may vary based on actual on-site unit conditions and material usage.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>