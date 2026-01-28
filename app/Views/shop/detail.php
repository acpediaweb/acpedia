<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
    <div>
        <div class="aspect-square bg-white rounded-3xl border overflow-hidden mb-4">
            <img src="<?= $product->getImageUrl() ?>" class="w-full h-full object-contain p-8">
        </div>
        
        <?php if (!empty($product->additional_images)): ?>
        <div class="grid grid-cols-4 gap-4">
            <?php foreach ($product->additional_images as $img): ?>
                <div class="aspect-square border rounded-xl overflow-hidden cursor-pointer hover:border-blue-600">
                    <img src="<?= base_url('uploads/products/' . $img) ?>" class="w-full h-full object-cover">
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="flex flex-col">
        <nav class="flex text-sm text-gray-400 mb-4">
            <a href="<?= base_url('shop') ?>" class="hover:text-blue-600">Shop</a>
            <span class="mx-2">/</span>
            <span><?= $product->category_name ?></span>
        </nav>

        <h1 class="text-4xl font-black text-gray-900 mb-2"><?= $product->product_name ?></h1>
        <div class="flex items-center space-x-4 mb-6">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase">
                <?= $product->brand_name ?>
            </span>
            <span class="text-gray-400 text-sm">SKU: <?= strtoupper(substr($product->slug, 0, 8)) ?></span>
        </div>

        <div class="bg-gray-50 p-6 rounded-2xl mb-8">
            <p class="text-sm text-gray-500 mb-1">Price</p>
            <div class="flex items-baseline space-x-3">
                <span class="text-3xl font-black text-blue-700">Rp <?= number_format($product->getPrice(), 0, ',', '.') ?></span>
                <?php if ($product->sale_price): ?>
                    <span class="text-gray-400 line-through">Rp <?= number_format($product->base_price, 0, ',', '.') ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="prose prose-sm text-gray-600 mb-8">
            <h3 class="text-gray-900 font-bold">Description</h3>
            <p><?= $product->product_description ?></p>
        </div>

        <?php if (!empty($product->extra_attributes)): ?>
        <div class="border-t pt-8">
            <h3 class="font-bold text-gray-900 mb-4">Technical Specifications</h3>
            <div class="grid grid-cols-2 gap-4">
                <?php foreach ($product->extra_attributes as $key => $value): ?>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-500 capitalize"><?= str_replace('_', ' ', $key) ?></span>
                        <span class="font-semibold text-gray-900"><?= $value ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="mt-auto pt-10 flex space-x-4">
            <button class="flex-1 bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                Add to Cart
            </button>
            <button class="p-4 border rounded-2xl hover:bg-gray-50">
                Favorite
            </button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>