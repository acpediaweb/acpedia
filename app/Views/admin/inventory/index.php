<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-white">Inventory Management</h1>
        <p class="text-gray-400 mt-1">Manage all inventory items</p>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="get" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Product Filter -->
                <select name="product" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Products</option>
                    <?php foreach ($products as $prod): ?>
                        <option value="<?= $prod->id ?>" <?= ($selectedProduct === (string)$prod->id) ? 'selected' : '' ?>>
                            <?= esc($prod->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Brand Filter -->
                <select name="brand" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Brands</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= $brand->id ?>" <?= ($selectedBrand === (string)$brand->id) ? 'selected' : '' ?>>
                            <?= esc($brand->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Type Filter -->
                <select name="type" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Types</option>
                    <?php foreach ($types as $t): ?>
                        <option value="<?= $t->id ?>" <?= ($selectedType === (string)$t->id) ? 'selected' : '' ?>>
                            <?= esc($t->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Items Per Page -->
                <select name="items_per_page" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="20" <?= ($itemsPerPage === 20 || $itemsPerPage === '20') ? 'selected' : '' ?>>20 items</option>
                    <option value="50" <?= ($itemsPerPage === 50 || $itemsPerPage === '50') ? 'selected' : '' ?>>50 items</option>
                    <option value="100" <?= ($itemsPerPage === 100 || $itemsPerPage === '100') ? 'selected' : '' ?>>100 items</option>
                </select>

                <!-- Apply Button -->
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Inventory Table -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-900 border-b border-gray-700">
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">ID</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Product</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Serial / Barcode</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Brand</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Status</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Assigned To</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)): ?>
                        <?php foreach ($items as $item): ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="py-4 px-6 text-white font-semibold">#<?= $item->id ?></td>
                                <td class="py-4 px-6 text-gray-300"><?= esc($item->product_name) ?></td>
                                <td class="py-4 px-6 text-gray-300">
                                    <code class="text-xs bg-gray-900 px-2 py-1 rounded">
                                        <?= esc($item->serial_number ?? $item->barcode_number ?? '-') ?>
                                    </code>
                                </td>
                                <td class="py-4 px-6 text-gray-300"><?= esc($item->brand_name ?? '-') ?></td>
                                <td class="py-4 px-6">
                                    <?php if (!empty($item->assigned_to_user_id)): ?>
                                        <span class="inline-block px-3 py-1 bg-green-900 text-green-200 text-xs font-semibold rounded">
                                            Installed
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-block px-3 py-1 bg-gray-700 text-gray-200 text-xs font-semibold rounded">
                                            Available
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-gray-300 text-sm">
                                    <?php if (!empty($item->assigned_to_user_id)): ?>
                                        <div>User ID: <?= $item->assigned_to_user_id ?></div>
                                        <div class="text-gray-500 text-xs">Since <?= date('M d, Y', strtotime($item->assigned_at)) ?></div>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="<?= base_url('admin/inventory/' . $item->id) ?>" 
                                        class="text-blue-400 hover:text-blue-300 font-semibold text-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-8 px-6 text-center text-gray-400">No inventory items found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager): ?>
            <div class="bg-gray-900 border-t border-gray-700 px-6 py-4">
                <?= $pager->links('inventory', 'bootstrap_pagination') ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
