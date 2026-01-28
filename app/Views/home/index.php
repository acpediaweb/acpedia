<?= $this->extend('layouts/company_profile') ?>

<?= $this->section('content') ?>

<section class="relative py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-widest mb-6">
                Leading HVAC Excellence
            </span>
            <h1 class="text-6xl font-extrabold text-gray-900 tracking-tight mb-8">
                <?= $hero_title ?>
            </h1>
            <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                <?= $hero_subtitle ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="<?= base_url('shop') ?>" class="bg-blue-600 text-white px-10 py-4 rounded-full font-bold text-center hover:shadow-xl hover:-translate-y-1 transition-all">
                    Explore Inventory
                </a>
                <a href="<?= base_url('about') ?>" class="bg-white border-2 border-gray-200 px-10 py-4 rounded-full font-bold text-center hover:border-blue-600 transition-all">
                    Our Mission
                </a>
            </div>
        </div>
    </div>
    
    <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-50 -z-0 hidden lg:block rounded-l-3xl"></div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-black text-blue-600">15k+</div>
                <div class="text-sm text-gray-500 uppercase font-bold mt-2">Units Tracked</div>
            </div>
            <div>
                <div class="text-4xl font-black text-blue-600">98%</div>
                <div class="text-sm text-gray-500 uppercase font-bold mt-2">Service Accuracy</div>
            </div>
            <div>
                <div class="text-4xl font-black text-blue-600">24h</div>
                <div class="text-sm text-gray-500 uppercase font-bold mt-2">Response Time</div>
            </div>
            <div>
                <div class="text-4xl font-black text-blue-600">50+</div>
                <div class="text-sm text-gray-500 uppercase font-bold mt-2">Expert Technicians</div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>