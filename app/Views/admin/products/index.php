<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Products</h1>
            <p class="text-gray-400 mt-1">Manage your product catalog</p>
        </div>
        <a href="<?= base_url('admin/products/create') ?>" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold transition-colors">
            + Add Product
        </a>
    </div>

    <!-- Filters and Search -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="get" class="flex flex-col sm:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" name="search" placeholder="Search products..." 
                    value="<?= esc($searchQuery) ?>"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Brand Filter -->
            <div class="flex gap-2">
                <select name="brand" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Brands</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= $brand->id ?>" <?= ($selectedBrand === (string)$brand->id) ? 'selected' : '' ?>>
                            <?= esc($brand->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden hover:border-gray-600 transition-colors">
                    <!-- Product Image -->
                    <div class="relative bg-gray-900 h-40 overflow-hidden">
                        <?php if (!empty($product->main_image_url)): ?>
                            <img src="<?= base_url('file/uploads/' . $product->main_image_url) ?>" 
                                alt="<?= esc($product->name) ?>"
                                class="w-full h-full object-cover hover:scale-105 transition-transform">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gray-900">
                                <svg class="w-12 h-12 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4 space-y-3">
                        <div>
                            <h3 class="text-white font-bold truncate"><?= esc($product->name) ?></h3>
                            <p class="text-gray-400 text-sm"><?= esc($product->brand_name) ?></p>
                        </div>

                        <div class="flex justify-between items-center pt-2 border-t border-gray-700">
                            <div>
                                <p class="text-gray-400 text-xs">Price</p>
                                <p class="text-white font-bold">Rp <?= number_format($product->price, 0, ',', '.') ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs">Unit</p>
                                <p class="text-white font-semibold"><?= esc($product->unit) ?></p>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div>
                            <?php if ($product->is_active): ?>
                                <span class="inline-block px-3 py-1 bg-green-900 text-green-200 text-xs font-semibold rounded">Active</span>
                            <?php else: ?>
                                <span class="inline-block px-3 py-1 bg-red-900 text-red-200 text-xs font-semibold rounded">Inactive</span>
                            <?php endif; ?>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2 pt-2">
                            <a href="<?= base_url('admin/products/' . $product->id . '/edit') ?>" 
                                class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-center rounded font-semibold text-sm transition-colors">
                                Edit
                            </a>
                            <form action="<?= base_url('admin/products/' . $product->id . '/delete') ?>" method="post" class="flex-1">
                                <?= csrf_field() ?>
                                <button type="submit" onclick="return confirm('Delete this product?')" 
                                    class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-semibold text-sm transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-12">
                <p class="text-gray-400 text-lg">No products found</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <?= $pager->links('products', 'bootstrap_pagination') ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
