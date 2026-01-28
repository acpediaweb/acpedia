<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'HVAC Marketplace' ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900" x-data="{ cartOpen: false, notifOpen: false, userOpen: false }">

    <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <a href="<?= base_url() ?>" class="flex items-center space-x-2">
                <span class="text-2xl font-black text-blue-700 tracking-tighter uppercase">AC<span class="text-gray-400 font-light">pedia</span></span>
            </a>
            
            <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-600">
                <a href="<?= base_url('shop') ?>" class="hover:text-blue-600 transition-colors">Browse Units</a>
                <a href="<?= base_url('shop/services') ?>" class="hover:text-blue-600 transition-colors">Maintenance & Labor</a>
            </nav>

            <div class="flex items-center space-x-4">
                
                <div class="relative">
                    <button @click="notifOpen = !notifOpen; cartOpen = false; userOpen = false" 
                            class="p-2 text-gray-400 hover:text-blue-600 relative transition-all rounded-full hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-2 right-2.5 h-2 w-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>

                    <div x-show="notifOpen" x-cloak @click.away="notifOpen = false" 
                         class="absolute right-0 mt-3 w-80 bg-white border rounded-2xl shadow-2xl z-50 overflow-hidden ring-1 ring-black ring-opacity-5">
                        <div class="p-4 border-b bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400">Recent Alerts</div>
                        <div class="p-8 text-center text-xs text-gray-400 italic">No new updates.</div>
                    </div>
                </div>

                <?= view_cell('App\Cells\CartCell::mini') ?>

                <div class="relative">
                    <button @click="userOpen = !userOpen; cartOpen = false; notifOpen = false" 
                            class="flex items-center space-x-2 border-l border-gray-100 pl-4 ml-2">
                        <?php if (session()->get('isLoggedIn')): ?>
                            <div class="h-9 w-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold shadow-sm ring-2 ring-blue-100">
                                <?= strtoupper(substr(session()->get('fullname'), 0, 1)) ?>
                            </div>
                        <?php else: ?>
                            <div class="h-9 w-9 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all border border-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </button>

                    <div x-show="userOpen" x-cloak @click.away="userOpen = false" 
                         class="absolute right-0 mt-3 w-56 bg-white border rounded-2xl shadow-2xl z-50 overflow-hidden ring-1 ring-black ring-opacity-5">
                        
                        <?php if (session()->get('isLoggedIn')): ?>
                            <div class="p-4 border-b bg-blue-50/30">
                                <p class="text-xs font-bold text-gray-900"><?= esc(session()->get('fullname')) ?></p>
                                <p class="text-[10px] text-gray-500 truncate"><?= esc(session()->get('email')) ?></p>
                            </div>
                            <div class="p-2">
                                <a href="<?= base_url('customer/orders') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Order History</a>
                                <a href="<?= base_url('customer/profile') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">Unit Records</a>
                                <hr class="my-1 border-gray-100">
                                <a href="<?= base_url('logout') ?>" class="block px-4 py-2 text-xs text-red-600 hover:bg-red-50 rounded-lg font-bold">Sign Out</a>
                            </div>
                        <?php else: ?>
                            <div class="p-4 border-b">
                                <p class="text-xs font-bold">Guest Account</p>
                                <p class="text-[10px] text-gray-400 italic">Login for unit history</p>
                            </div>
                            <div class="p-2">
                                <a href="<?= base_url('login') ?>" class="block px-4 py-2 text-xs text-blue-600 font-bold hover:bg-blue-50 rounded-lg">Sign In</a>
                                <a href="<?= base_url('register') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-gray-50 rounded-lg">Create Account</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10 min-h-[75vh]">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-gray-400 text-xs">
            <p>&copy; 2026 ACpedia Services. All professional records are stored persistently.</p>
            <div class="flex space-x-6 mt-6 md:mt-0 font-medium">
                <a href="#" class="hover:text-gray-900 transition-colors">Warranty Info</a>
                <a href="#" class="hover:text-gray-900 transition-colors">Terms of Work</a>
            </div>
        </div>
    </footer>

</body>
</html>