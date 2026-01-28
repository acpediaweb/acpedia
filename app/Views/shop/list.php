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
         <img src="<?= $product->getImageUrl() ?>" class="w-full h-full object-cover">
         
         <div class="absolute top-3 right-3">
             <span class="bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-bold shadow-sm">
                 <?= $product->brand_name ?> </span>
         </div>
    </div>
    <div class="p-5">
        <h3 class="font-bold text-gray-900"><?= $product->product_name ?></h3>
        <p class="text-sm text-gray-500 mb-4 mt-1">
            <?= $product->category_name ?> </p>
        <div class="flex items-center justify-between">
            <span class="text-lg font-black text-blue-700">
                Rp <?= number_format($product->getPrice(), 0, ',', '.') ?>
            </span>
            <a href="<?= base_url('shop/'.$product->slug) ?>" class="p-2 bg-gray-900 text-white rounded-lg">
                View
            </a>
        </div>
    </div>
    <form action="<?= base_url('shop/cart/add') ?>" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="product_id" value="<?= $product->id ?>">
    <input type="hidden" name="quantity" value="1">
    
    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg">
        Add to Cart
    </button>
</form>
</div>
<?php endforeach; ?>
</div>

<?= $this->endSection() ?>