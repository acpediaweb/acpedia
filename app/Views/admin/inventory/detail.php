<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Inventory Item #<?= $item->id ?></h1>
            <p class="text-gray-400 mt-1">Manage inventory item assignment</p>
        </div>
        <a href="<?= base_url('admin/inventory') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
            Back to Inventory
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Item Information -->
        <div class="lg:col-span-2 bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">Item Details</h2>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Product Name</p>
                        <p class="text-white font-semibold mt-1"><?= esc($item->product_name) ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Unit Price</p>
                        <p class="text-white font-semibold mt-1">Rp <?= number_format($item->price, 0, ',', '.') ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Brand</p>
                        <p class="text-white font-semibold mt-1"><?= esc($item->brand_name ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Unit</p>
                        <p class="text-white font-semibold mt-1"><?= esc($item->unit) ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Serial Number</p>
                        <p class="text-white font-semibold mt-1"><?= esc($item->serial_number ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Barcode</p>
                        <p class="text-white font-semibold mt-1"><?= esc($item->barcode_number ?? '-') ?></p>
                    </div>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Created At</p>
                    <p class="text-white font-semibold mt-1"><?= date('M d, Y H:i', strtotime($item->created_at)) ?></p>
                </div>
            </div>
        </div>

        <!-- Assignment Card -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 h-fit">
            <h3 class="text-lg font-bold text-white mb-4">Assignment</h3>

            <?php if (!empty($item->assigned_to_user_id)): ?>
                <div class="mb-4 p-3 bg-green-900 border border-green-700 rounded">
                    <p class="text-green-200 text-sm font-semibold">Currently Assigned</p>
                    <p class="text-white font-bold mt-2">User ID: <?= $item->assigned_to_user_id ?></p>
                    <p class="text-green-300 text-xs mt-2">Since <?= date('M d, Y', strtotime($item->assigned_at)) ?></p>
                </div>

                <form action="<?= base_url('admin/inventory/' . $item->id . '/unbind') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-semibold transition-colors"
                        onclick="return confirm('Uninstall this item from user?')">
                        Uninstall from User
                    </button>
                </form>
            <?php else: ?>
                <div class="mb-4 p-3 bg-gray-700 border border-gray-600 rounded">
                    <p class="text-gray-300 text-sm">No user assignment</p>
                </div>

                <form action="<?= base_url('admin/inventory/' . $item->id . '/bind') ?>" method="post" class="space-y-3">
                    <?= csrf_field() ?>
                    
                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">User ID</label>
                        <input type="number" name="user_id" placeholder="Enter user ID"
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="text-gray-400 text-sm font-semibold block mb-2">Address ID (Optional)</label>
                        <input type="number" name="address_id" placeholder="Enter address ID"
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold transition-colors">
                        Install to User
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Action Log -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white mb-4">Timeline</h2>
        <p class="text-gray-400 text-sm mb-4">
            <a href="<?= base_url('admin/timeline/' . $item->id) ?>" class="text-blue-400 hover:text-blue-300">
                View full timeline for this item →
            </a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>
