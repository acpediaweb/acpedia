<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - HVAC Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-screen w-64 bg-gray-800 border-r border-gray-700 overflow-y-auto z-50 transition-transform" :class="!sidebarOpen && '-translate-x-full'">
        <div class="p-6 border-b border-gray-700">
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center space-x-2">
                <span class="text-2xl font-black text-blue-500 tracking-tighter uppercase">AC<span class="text-gray-400 font-light">pedia</span></span>
                <span class="text-xs font-bold bg-red-600 px-2 py-1 rounded">ADMIN</span>
            </a>
        </div>

        <nav class="p-6 space-y-2">
            <!-- Dashboard -->
            <a href="<?= base_url('admin/dashboard') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'dashboard') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4l4 2m-8-2l4-2"></path>
                </svg>
                Dashboard
            </a>

            <!-- Products -->
            <a href="<?= base_url('admin/products') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'products') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4m0 0L4 7m16 0l-8 4m0 0l-8-4m0 0v10l8 4m0-4l8-4m-8 4v10m0-4l-8-4"></path>
                </svg>
                Products
            </a>

            <!-- Inventory -->
            <a href="<?= base_url('admin/inventory') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'inventory') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Inventory
            </a>

            <!-- Orders -->
            <a href="<?= base_url('admin/orders') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'orders') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Orders
            </a>

            <!-- Timeline -->
            <a href="<?= base_url('admin/timeline') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'timeline') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Timeline
            </a>

            <!-- Users -->
            <a href="<?= base_url('admin/users') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'users') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m4.646-4.354L15 5.646M9.354 15l-.646-1.354m4.646 4.354l.646 1.354M9 12h6m-7.646-3.646l-1.354-.646m8.292 8.292l1.354.646"></path>
                </svg>
                Users
            </a>

            <!-- Employee -->
            <a href="<?= base_url('admin/employee') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'employee') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM16 20a3 3 0 01-3-3v-2H9v2a3 3 0 01-3 3"></path>
                </svg>
                Employee
            </a>

            <!-- Forum -->
            <a href="<?= base_url('admin/forum') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'forum') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                Forum
            </a>

            <!-- Site Config -->
            <a href="<?= base_url('admin/siteconfig') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-gray-700 hover:text-white transition-colors <?= strpos(current_url(), 'siteconfig') !== false ? 'bg-blue-600 text-white' : '' ?>">
                <svg class="inline-block w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Site Config
            </a>
        </nav>

        <div class="border-t border-gray-700 p-6">
            <a href="<?= base_url('logout') ?>" class="block px-4 py-3 rounded-lg font-semibold text-gray-300 hover:bg-red-900 hover:text-red-100 transition-colors text-center">
                Sign Out
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 transition-all" :class="!sidebarOpen && 'ml-0'">
        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 sticky top-0 z-40">
            <div class="px-6 py-4 flex justify-between items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-gray-700 rounded-lg text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-400">Welcome, <span class="font-semibold text-white"><?= esc(session()->get('fullname')) ?></span></span>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-8 min-h-[calc(100vh-73px)]">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

</body>
</html>
