<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'HVAC SHOP' ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900" x-data="{ cartOpen: false, notifOpen: false, userOpen: false }">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center relative">
            
            <a href="<?= base_url() ?>" class="text-2xl font-black text-blue-700 uppercase tracking-tighter">
                AC<span class="text-gray-400 font-light">pedia</span>
            </a>
            
            <nav class="hidden md:flex space-x-8 font-medium text-sm">
                <a href="<?= base_url('shop') ?>" class="text-gray-600 hover:text-blue-600 transition-colors">Products</a>
                <a href="<?= base_url('shop/services') ?>" class="text-gray-600 hover:text-blue-600 transition-colors">Services</a>
            </nav>

            <div class="flex items-center space-x-4">
                
                <div class="relative">
                    <button @click="notifOpen = !notifOpen; cartOpen = false; userOpen = false" class="p-2 text-gray-400 hover:text-blue-600 relative transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-2 right-2 h-2 w-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>

                    <div x-show="notifOpen" x-cloak @click.away="notifOpen = false" 
                         class="absolute right-0 mt-3 w-80 bg-white border rounded-2xl shadow-xl z-50 overflow-hidden">
                        <div class="p-4 border-b font-bold text-xs uppercase tracking-widest text-gray-400">Updates</div>
                        <div class="p-8 text-center text-xs text-gray-400">No new notifications.</div>
                    </div>
                </div>

                <div class="relative">
                    <button @click="cartOpen = !cartOpen; notifOpen = false; userOpen = false" 
                            class="flex items-center space-x-2 p-2 bg-blue-50 rounded-xl text-blue-700 font-bold hover:bg-blue-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="text-xs"><?= count($headerCartItems ?? []) ?></span>
                    </button>

                    <div x-show="cartOpen" x-cloak @click.away="cartOpen = false" 
                         class="absolute right-0 mt-3 w-80 bg-white border rounded-2xl shadow-xl z-50 overflow-hidden">
                        <div class="p-4 border-b font-bold text-sm">Your Cart</div>
                        
                        <div class="max-h-64 overflow-y-auto">
                            <?php if (!empty($headerCartItems)): ?>
                                <?php foreach ($headerCartItems as $item): 
                                    $name = !empty($item->service_id) ? $item->service_title : $item->product_name;
                                    $price = !empty($item->service_id) ? $item->s_price : ($item->sale_price ?? $item->p_price);
                                ?>
                                    <div class="p-4 border-b last:border-0 hover:bg-gray-50 flex justify-between items-center">
                                        <div class="pr-4">
                                            <p class="text-xs font-bold text-gray-900 truncate w-40"><?= esc($name) ?></p>
                                            <p class="text-[10px] text-gray-400"><?= $item->quantity ?> x Rp <?= number_format($price, 0, ',', '.') ?></p>
                                        </div>
                                        <span class="text-xs font-black text-blue-600">
                                            Rp <?= number_format($price * $item->quantity, 0, ',', '.') ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="p-8 text-center">
                                    <p class="text-xs text-gray-400 italic">Your cart is empty.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-4 bg-gray-50 border-t">
                            <a href="<?= base_url('shop/cart') ?>" class="block w-full bg-blue-600 text-white text-center py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition-colors">
                                View Full Cart & Checkout
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <button @click="userOpen = !userOpen; cartOpen = false; notifOpen = false" class="flex items-center space-x-2 border-l pl-4 ml-2">
                        <?php if (session()->get('isLoggedIn')): ?>
                            <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                <?= strtoupper(substr(session()->get('fullname'), 0, 1)) ?>
                            </div>
                        <?php else: ?>
                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </button>

                    <div x-show="userOpen" x-cloak @click.away="userOpen = false" 
                         class="absolute right-0 mt-3 w-52 bg-white border rounded-2xl shadow-xl z-50 overflow-hidden">
                        
                        <?php if (session()->get('isLoggedIn')): ?>
                            <div class="p-4 border-b bg-gray-50/50">
                                <p class="text-xs font-bold text-gray-900"><?= session()->get('fullname') ?></p>
                                <p class="text-[10px] text-gray-400 tracking-tight">Standard Account</p>
                            </div>
                            <div class="p-2">
                                <a href="<?= base_url('customer/dashboard') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">My Orders</a>
                                <a href="<?= base_url('customer/profile') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Settings</a>
                                <hr class="my-1 border-gray-100">
                                <a href="<?= base_url('logout') ?>" class="block px-4 py-2 text-xs text-red-600 hover:bg-red-50 rounded-lg font-bold">Logout</a>
                            </div>
                        <?php else: ?>
                            <div class="p-4 border-b">
                                <p class="text-xs font-bold">Welcome, Guest</p>
                                <p class="text-[10px] text-gray-400 italic">Sign in to track orders</p>
                            </div>
                            <div class="p-2">
                                <a href="<?= base_url('login') ?>" class="block px-4 py-2 text-xs text-blue-600 font-bold hover:bg-blue-50 rounded-lg transition-colors">Sign In</a>
                                <a href="<?= base_url('register') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">Create Account</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10 min-h-[70vh]">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-white border-t py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm">
            <p>&copy; 2026 ACpedia Marketplace. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-900">Privacy Policy</a>
                <a href="#" class="hover:text-gray-900">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>
</html>