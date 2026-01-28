<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="py-10">
    <div class="flex items-baseline justify-between mb-10 border-b pb-6">
        <h1 class="text-4xl font-black text-gray-900">Your Cart</h1>
        <p class="text-gray-500"><?= count($items) ?> items selected</p>
    </div>

    <?php if (empty($items)): ?>
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed">
            <p class="text-gray-400 mb-6">Your cart is currently empty.</p>
            <a href="<?= base_url('shop') ?>" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold">Start Shopping</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2 space-y-6">
                <?php 
                $grandTotal = 0;
                foreach ($items as $item): 
                    $isService = !empty($item->service_id);
                    $name = $isService ? $item->service_title : $item->product_name;
                    $price = $isService ? $item->s_price : ($item->sale_price ?? $item->p_price);
                    $subtotal = $price * $item->quantity;
                    $grandTotal += $subtotal;
                ?>
                <div class="bg-white border border-gray-100 rounded-3xl p-6 flex items-center shadow-sm">
                    <div class="h-20 w-20 <?= $isService ? 'bg-blue-50 text-blue-600' : 'bg-gray-50 text-gray-400' ?> rounded-2xl flex items-center justify-center flex-shrink-0">
                        <?php if ($isService): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        <?php else: ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        <?php endif; ?>
                    </div>

                    <div class="ml-6 flex-grow">
                        <span class="text-[10px] uppercase font-black tracking-widest <?= $isService ? 'text-blue-500' : 'text-gray-400' ?>">
                            <?= $isService ? 'Service / Labor' : 'Hardware / Unit' ?>
                        </span>
                        <h3 class="font-bold text-gray-900 text-lg"><?= esc($name) ?></h3>
                        <p class="text-sm text-gray-500">Rp <?= number_format($price, 0, ',', '.') ?> x <?= $item->quantity ?></p>
                    </div>

                    <div class="text-right">
                        <p class="font-black text-gray-900">Rp <?= number_format($subtotal, 0, ',', '.') ?></p>
                        <a href="<?= base_url('shop/cart/remove/'.$item->id) ?>" class="text-xs text-red-500 hover:text-red-700 mt-2 inline-block">Remove</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="lg:col-span-1">
                <form action="<?= base_url('shop/checkout/process') ?>" method="POST" class="bg-gray-900 text-white rounded-3xl p-8 sticky top-28">
                    <?= csrf_field() ?>
                    <h2 class="text-xl font-bold mb-6">Order Summary</h2>
                    
                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Service Schedule</label>
                        <input type="datetime-local" name="scheduled_datetime" required
                            class="w-full bg-gray-800 border-none rounded-xl py-3 px-4 text-white focus:ring-2 focus:ring-blue-500">
                        <p class="text-[10px] text-gray-500 mt-2 italic">Select when you want our technician to arrive.</p>
                    </div>

                    <div class="space-y-4 border-t border-gray-800 pt-6 mb-8">
                        <div class="flex justify-between text-gray-400">
                            <span>Subtotal</span>
                            <span>Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Tax (Included)</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="flex justify-between text-xl font-black text-white pt-4">
                            <span>Total</span>
                            <span>Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold transition-all shadow-xl shadow-blue-900/20">
                        Proceed to Checkout
                    </button>
                    
                    <p class="text-[10px] text-center text-gray-500 mt-6">
                        By proceeding, you agree to our service terms and unit tracking policy.
                    </p>
                </form>
            </div>

        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>