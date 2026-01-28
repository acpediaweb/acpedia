<div class="relative">
    <button @click="cartOpen = !cartOpen; notifOpen = false; userOpen = false" 
            class="flex items-center space-x-2 px-3 py-2 bg-blue-50 rounded-xl text-blue-700 font-bold hover:bg-blue-100 transition-all border border-blue-100 relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span class="text-xs"><?= $itemCount ?></span>
        
        <?php if ($itemCount > 0): ?>
            <span class="absolute -top-1 -right-1 flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
            </span>
        <?php endif; ?>
    </button>

    <div x-show="cartOpen" x-cloak @click.away="cartOpen = false" 
         class="absolute right-0 mt-3 w-96 bg-white border border-gray-100 rounded-2xl shadow-2xl z-50 overflow-hidden ring-1 ring-black ring-opacity-5 transform origin-top-right transition-all">
        
        <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <span class="font-bold text-sm text-gray-800">Your Selection</span>
            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider"><?= $itemCount ?> Items</span>
        </div>
        
        <div class="max-h-[24rem] overflow-y-auto custom-scrollbar">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): 
                    $isService = !empty($item->service_id);
                    $name = $isService ? $item->service_title : $item->product_name;
                    // Use p_image (aliased from main_image in Cell) or fallback
                    $image = $item->p_image ?? null; 
                ?>
                    <div class="p-4 border-b border-gray-50 last:border-0 hover:bg-gray-50 transition-colors group">
                        <div class="flex gap-4">
                            <div class="w-14 h-14 flex-shrink-0 bg-white border border-gray-100 rounded-xl flex items-center justify-center overflow-hidden">
                                <?php if (!$isService && !empty($image)): ?>
                                    <img src="<?= base_url($image) ?>" alt="Product" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $isService ? 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z' : 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4' ?>" />
                                        <?php if($isService): ?><circle cx="12" cy="12" r="3"></circle><?php endif; ?>
                                    </svg>
                                <?php endif; ?>
                            </div>

                            <div class="flex-grow min-w-0">
                                <div class="flex justify-between items-start mb-1">
                                    <h5 class="text-xs font-bold text-gray-900 truncate pr-2 w-32" title="<?= esc($name) ?>"><?= esc($name) ?></h5>
                                    <span class="text-xs font-black text-blue-600 whitespace-nowrap">
                                        Rp <?= number_format($item->final_price, 0, ',', '.') ?>
                                    </span>
                                </div>
                                
                                <?php if(!empty($item->config_summary)): ?>
                                    <p class="text-[10px] text-gray-500 leading-tight bg-gray-100 rounded-md p-1.5 mb-1.5">
                                        <?= esc($item->config_summary) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] text-gray-400 font-medium bg-gray-50 px-1.5 py-0.5 rounded">Qty: <?= $item->quantity ?></span>
                                    <?php if($isService): ?>
                                        <span class="text-[9px] uppercase font-bold text-blue-500 bg-blue-50 px-1.5 py-0.5 rounded">Service</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-12 text-center">
                    <div class="mb-3 inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium text-gray-900">Your cart is empty</p>
                    <p class="text-[10px] text-gray-400 mt-1">Add items to get started</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($items)): ?>
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Subtotal</span>
                    <span class="text-lg font-black text-gray-900">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                </div>
                <a href="<?= base_url('shop/cart') ?>" class="block w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-center rounded-xl text-xs font-bold uppercase tracking-widest transition-all shadow-lg shadow-blue-200 hover:shadow-blue-300">
                    View Cart & Checkout
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>