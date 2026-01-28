<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'HVAC Expert - Professional Climate Control' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">

    <header class="border-b sticky top-0 bg-white/90 backdrop-blur-md z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="<?= base_url() ?>" class="flex items-center space-x-2">
                <span class="text-2xl font-black tracking-tighter text-blue-700">HVAC<span class="text-gray-400">PRO</span></span>
            </a>
            
            <nav class="hidden md:flex items-center space-x-10 font-medium text-sm uppercase tracking-widest text-gray-600">
                <a href="<?= base_url() ?>" class="hover:text-blue-600 transition-colors">Home</a>
                <a href="<?= base_url('about') ?>" class="hover:text-blue-600 transition-colors">Our Story</a>
                <a href="<?= base_url('services') ?>" class="hover:text-blue-600 transition-colors">Services</a>
                <a href="<?= base_url('shop') ?>" class="hover:text-blue-600 transition-colors text-blue-600 font-bold">Visit Shop</a>
            </nav>

            <div class="flex items-center space-x-4">
                <a href="<?= base_url('contact') ?>" class="bg-gray-900 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-blue-700 transition-all">
                    Get a Quote
                </a>
            </div>
        </div>
    </header>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-gray-50 border-t py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-2">
                <span class="text-xl font-bold text-blue-700">HVACPRO</span>
                <p class="mt-4 text-gray-500 max-w-sm">
                    Providing precision climate control solutions since 2010. We specialize in persistent unit tracking and professional field services.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="<?= base_url('login') ?>">Staff Login</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>