<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="mb-10 text-center">
    <h1 class="text-4xl font-black text-gray-900">Professional AC Services</h1>
    <p class="text-gray-500 mt-2">Expert care for your cooling systems, recorded in your unit's history.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <?php foreach ($services as $service): ?>
    <div class="bg-white border rounded-3xl p-8 hover:shadow-xl transition-all flex flex-col">
        <h3 class="text-2xl font-bold mb-4"><?= $service->service_title ?></h3>
        <p class="text-gray-600 mb-6 text-sm flex-grow"><?= $service->service_description ?></p>
        
        <div class="mb-6">
            <span class="text-gray-400 text-xs uppercase font-bold">Starts From</span>
            <div class="text-2xl font-black text-blue-700">Rp <?= number_format($service->base_price, 0, ',', '.') ?></div>
        </div>

        <div class="border-t pt-4 mb-6">
            <h4 class="text-xs font-bold text-gray-400 uppercase mb-3">Optional Addons</h4>
            <?php foreach ($addons as $addon): ?>
            <label class="flex items-center space-x-3 mb-2 cursor-pointer group">
                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-600 group-hover:text-gray-900"><?= $addon->addon_name ?> (+Rp <?= number_format($addon->addon_price, 0, ',', '.') ?>)</span>
            </label>
            <?php endforeach; ?>
        </div>

        <button class="w-full bg-gray-900 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition-colors">
            Add Service to Cart
        </button>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>