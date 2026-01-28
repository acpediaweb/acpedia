<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold">Air Conditioning Units</h1>
        <p class="text-gray-500">Professional units with lifetime tracking.</p>
    </div>
    <div class="flex space-x-2">
        <select class="border rounded-lg px-4 py-2 text-sm">
            <option>Latest Arrivals</option>
            <option>Price: Low to High</option>
            <option>Best Rating</option>
        </select>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($products as $product): ?>
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow group">
        <div class="h-48 bg-gray-100 relative">
             <div class="w-full h-full flex items-center justify-center text-gray-400">
                 [<?= $product['name'] ?> Image]
             </div>
             <div class="absolute top-3 right-3">
                 <span class="bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-bold shadow-sm">In Stock</span>
             </div>
        </div>
        <div class="p-5">
    <span class="text-xs text-blue-600 font-bold uppercase"><?= $product->brand_name ?></span>
    
    <h3 class="font-bold text-gray-900"><?= $product->product_name ?></h3>
    
    <img src="<?= $product->getImageUrl() ?>" alt="<?= $product->product_name ?>">

    <div class="flex items-center justify-between mt-4">
        <span class="text-lg font-black text-blue-700">
            Rp <?= number_format($product->getPrice(), 0, ',', '.') ?>
        </span>
        
        <span class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-500">
            <?= $product->pk_category_name ?>
        </span>
    </div>
</div>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>