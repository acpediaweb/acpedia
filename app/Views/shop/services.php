<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="py-10">
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Professional AC Services</h1>
        <p class="text-gray-500 mt-3 max-w-2xl mx-auto">
            From expert installation to routine maintenance, every service call is recorded in your unit's persistent history thread.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($services as $service): ?>
        <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all flex flex-col group">
            
            <div class="mb-6">
                <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900"><?= esc($service->service_title) ?></h3>
                <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                    <?= esc($service->service_description) ?>
                </p>
            </div>

            <div class="mt-auto pt-6 border-t border-gray-50">
                <div class="flex flex-col mb-6">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Base Rate</span>
                    <span class="text-3xl font-black text-blue-700">
                        Rp <?= number_format($service->base_price, 0, ',', '.') ?>
                    </span>
                    <p class="text-[10px] text-gray-400 mt-1">*Final price may vary based on unit type (PK).</p>
                </div>

                <form action="<?= base_url('shop/cart/add') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <input type="hidden" name="service_id" value="<?= $service->id ?>">
                    <input type="hidden" name="quantity" value="1">
                    
                    <button type="submit" 
                        class="w-full bg-gray-900 text-white py-4 rounded-2xl font-bold hover:bg-blue-600 transform active:scale-95 transition-all flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Add Service</span>
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-16 bg-blue-50 rounded-2xl p-8 flex flex-col md:flex-row items-center justify-between">
        <div class="mb-4 md:mb-0">
            <h4 class="font-bold text-blue-900 text-lg">Bundling Hardware & Labor?</h4>
            <p class="text-blue-700 text-sm">Add an AC unit from the shop and an installation service together for a unified schedule.</p>
        </div>
        <a href="<?= base_url('shop') ?>" class="text-blue-700 font-bold border-b-2 border-blue-200 hover:border-blue-700 transition-all">
            Browse AC Units &rarr;
        </a>
    </div>
</div>

<?= $this->endSection() ?>