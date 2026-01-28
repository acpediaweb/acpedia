<head>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<header class="bg-white shadow-sm sticky top-0 z-50" x-data="{ cartOpen: false, notifOpen: false, userOpen: false }">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center relative">
        
        <a href="<?= base_url() ?>" class="text-2xl font-black text-blue-700">HVAC<span class="text-gray-400">SHOP</span></a>

        <div class="flex items-center space-x-5">
            <div class="relative">
                <button @click="notifOpen = !notifOpen; cartOpen = false; userOpen = false" class="p-2 text-gray-400 hover:text-blue-600 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2 h-2 w-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>

                <div x-show="notifOpen" @click.away="notifOpen = false" class="absolute right-0 mt-2 w-80 bg-white border rounded-2xl shadow-xl z-50 overflow-hidden">
                    <div class="p-4 border-b font-bold text-sm">Notifications</div>
                    <div class="max-h-60 overflow-y-auto">
                        <div class="p-4 hover:bg-gray-50 border-b last:border-0 cursor-pointer">
                            <p class="text-xs font-bold text-blue-600">Order Confirmed</p>
                            <p class="text-xs text-gray-500">Your Daikin AC 1 order is being processed.</p>
                        </div>
                    </div>
                    <a href="#" class="block p-3 text-center text-xs text-blue-600 font-bold bg-gray-50">View All</a>
                </div>
            </div>

            <div class="relative">
                <button @click="cartOpen = !cartOpen; notifOpen = false; userOpen = false" class="flex items-center space-x-2 p-2 bg-blue-50 rounded-lg text-blue-700 font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>2</span>
                </button>

                <div x-show="cartOpen" @click.away="cartOpen = false" class="absolute right-0 mt-2 w-72 bg-white border rounded-2xl shadow-xl z-50 overflow-hidden">
                    <div class="p-4 border-b font-bold text-sm">Shopping Cart</div>
                    <div class="p-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="text-xs">
                                <p class="font-bold">Daikin AC 1</p>
                                <p class="text-gray-400">1 x Rp 5.500.000</p>
                            </div>
                            <button class="text-red-400 text-xs">Remove</button>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 border-t">
                        <div class="flex justify-between text-sm font-bold mb-4">
                            <span>Total:</span>
                            <span>Rp 5.500.000</span>
                        </div>
                        <a href="<?= base_url('shop/checkout') ?>" class="block w-full bg-blue-600 text-white text-center py-2 rounded-xl text-sm font-bold">Checkout</a>
                    </div>
                </div>
            </div>

            <div class="relative">
                <button @click="userOpen = !userOpen; cartOpen = false; notifOpen = false" class="flex items-center space-x-2 border-l pl-5 ml-2">
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 hover:bg-blue-100 hover:text-blue-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <div x-show="userOpen" @click.away="userOpen = false" class="absolute right-0 mt-2 w-48 bg-white border rounded-2xl shadow-xl z-50 overflow-hidden">
                    <div class="p-4 border-b">
                        <p class="text-xs font-bold">John Doe</p>
                        <p class="text-[10px] text-gray-400">Customer</p>
                    </div>
                    <div class="p-2">
                        <a href="<?= base_url('customer/dashboard') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg">Dashboard</a>
                        <a href="<?= base_url('customer/profile') ?>" class="block px-4 py-2 text-xs text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg">My Profile</a>
                        <hr class="my-1">
                        <a href="<?= base_url('logout') ?>" class="block px-4 py-2 text-xs text-red-600 hover:bg-red-50 rounded-lg">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-10">
    <?= $this->renderSection('content') ?>
</main>