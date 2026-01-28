<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'HVACPRO Shop' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            
            <a href="<?= base_url() ?>" class="text-2xl font-black text-blue-700">HVAC<span class="text-gray-400">SHOP</span></a>
            
            <nav class="hidden md:flex space-x-8 font-medium">
                <a href="<?= base_url('shop') ?>" class="text-blue-600">All Products</a>
                <a href="<?= base_url('services') ?>" class="hover:text-blue-600">Services</a>
            </nav>

            <div class="flex items-center space-x-5">
                <button class="p-2 text-gray-400 hover:text-blue-600 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2 h-2 w-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>

                <a href="<?= base_url('cart') ?>" class="flex items-center space-x-2 p-2 bg-blue-50 rounded-lg text-blue-700 font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>0</span>
                </a>

                <a href="<?= base_url('login') ?>" class="flex items-center space-x-2 border-l pl-5 ml-2">
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <?= $this->renderSection('content') ?>
    </main>

</body>
</html>