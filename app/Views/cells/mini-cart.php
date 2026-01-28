<div class="relative">
    <button @click="cartOpen = !cartOpen; notifOpen = false; userOpen = false" 
            class="flex items-center space-x-2 px-3 py-2 bg-blue-50 rounded-xl text-blue-700 font-bold hover:bg-blue-100 transition-all border border-blue-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span class="text-xs"><?= $itemCount ?></span>
    </button>

    <div x-show="cartOpen" x-cloak @click.away="cartOpen = false" 
         class="absolute right-0 mt-3 w-80 bg-white border rounded-2xl shadow-2xl z-50 overflow-hidden ring-1 ring-black ring-opacity-5">
        <div class="p-4 border-b font-bold text-sm flex justify-between items-center">
            <span>Review Selection</span>
            <span class="text-[10px] text-gray-400 font-normal"><?= $itemCount ?> items</span>
        </div>
        
        <div class="max-h-80 overflow-y-auto">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): 
                    $isService = !empty($item->service_id);
                    $name = $isService ? $item->service_title : $item->product_name;
                ?>
                    <div class="p-4 border-b last:border-0 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div class="pr-2 min-w-0">
                                <p class="text-xs font-bold text-gray-900 truncate"><?= esc($name) ?></p>
                                
                                <?php if(!empty($item->config_summary)): ?>
                                    <p class="text-[10px] text-gray-500 leading-tight mt-1">
                                        <?= esc($item->config_summary) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <p class="text-[10px] text-gray-400 mt-1">Qty: <?= $item->quantity ?></p>
                            </div>
                            
                            <span class="text-xs font-black text-blue-600 whitespace-nowrap">
                                Rp <?= number_format($item->final_price, 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-10 text-center">
                    <p class="text-xs text-gray-400 italic">Your cart is empty.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($items)): ?>
            <div class="p-4 bg-gray-50 border-t">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xs font-bold text-gray-500 uppercase">Subtotal</span>
                    <span class="text-lg font-black text-gray-900">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                </div>
                <a href="<?= base_url('shop/cart') ?>" class="block w-full bg-blue-600 text-white text-center py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition-all shadow-md shadow-blue-200">
                    View Full Cart & Schedule
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>