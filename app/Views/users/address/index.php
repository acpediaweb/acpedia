<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="flex gap-6">
    <?= view('users/user-sidebar') ?>

    <div class="flex-1">
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Addresses</h1>
                    <p class="text-gray-500">Manage your delivery addresses</p>
                </div>
                <a href="<?= base_url('customer/address/create') ?>" 
                   class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    + Add New Address
                </a>
            </div>

            <!-- Messages -->
            <?php if (session()->has('success')): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    <p class="text-sm font-medium"><?= session('success') ?></p>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <p class="text-sm font-medium"><?= session('error') ?></p>
                </div>
            <?php endif; ?>

            <!-- Addresses List -->
            <?php if (empty($addresses)): ?>
                <div class="bg-white rounded-2xl p-12 border border-gray-100 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">No addresses yet</h3>
                    <p class="text-gray-500 mb-6">Add your first address to get started with ordering</p>
                    <a href="<?= base_url('customer/address/create') ?>" 
                       class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        Add Address
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($addresses as $address): ?>
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <!-- Primary Badge -->
                            <?php if ($address->is_primary): ?>
                                <div class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold mb-4">
                                    PRIMARY ADDRESS
                                </div>
                            <?php endif; ?>

                            <div class="space-y-3 mb-6">
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase">Street</p>
                                    <p class="text-gray-900 font-semibold"><?= esc($address->street) ?></p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase">Sub-district</p>
                                        <p class="text-gray-700"><?= esc($address->sub_district) ?></p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase">District</p>
                                        <p class="text-gray-700"><?= esc($address->district) ?></p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase">City</p>
                                        <p class="text-gray-700"><?= esc($address->city) ?></p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase">Province</p>
                                        <p class="text-gray-700"><?= esc($address->province) ?></p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase">Postal Code</p>
                                    <p class="text-gray-700"><?= esc($address->postal_code) ?></p>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2 flex-wrap">
                                <a href="<?= base_url('customer/address/edit/' . $address->id) ?>" 
                                   class="flex-1 px-4 py-2 bg-blue-50 text-blue-600 font-semibold rounded-lg hover:bg-blue-100 transition-colors text-center text-sm">
                                    Edit
                                </a>

                                <?php if (!$address->is_primary): ?>
                                    <a href="<?= base_url('customer/address/set-primary/' . $address->id) ?>" 
                                       class="flex-1 px-4 py-2 bg-gray-50 text-gray-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors text-center text-sm">
                                        Set Primary
                                    </a>
                                    <a href="<?= base_url('customer/address/delete/' . $address->id) ?>" 
                                       onclick="return confirm('Are you sure?')"
                                       class="px-4 py-2 bg-red-50 text-red-600 font-semibold rounded-lg hover:bg-red-100 transition-colors text-sm">
                                        Delete
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
