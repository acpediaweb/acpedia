<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'HVAC Solutions' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script> </head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <a href="<?= base_url() ?>" class="font-bold text-xl text-blue-600">HVAC_LOGO</a>
            
            <div class="flex items-center space-x-6">
                <a href="<?= base_url('shop') ?>" class="text-gray-600 hover:text-blue-600">Shop</a>
                <a href="<?= base_url('services') ?>" class="text-gray-600 hover:text-blue-600">Services</a>
                
                <div class="flex items-center space-x-4 border-l pl-6">
                    <button class="relative text-gray-500">
                        <span>Cart</span>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">0</span>
                    </button>
                    <button class="text-gray-500">Notif</button>
                    <a href="<?= base_url('login') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Account</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-gray-800 text-white py-10 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 HVAC Service System. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>