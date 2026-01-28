<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="flex gap-6">
    <?= view('users/user-sidebar') ?>

    <div class="flex-1">
        <div class="space-y-6">
            <!-- Header -->
            <div>
                <a href="<?= base_url('customer/address') ?>" class="text-blue-600 font-semibold mb-4 inline-flex items-center gap-2 hover:text-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Addresses
                </a>
                <h1 class="text-3xl font-bold text-gray-900 mt-2"><?= isset($address) ? 'Edit Address' : 'Add New Address' ?></h1>
            </div>

            <!-- Messages -->
            <?php if (session()->has('errors')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="text-sm">
                        <?php foreach (session('errors') as $error): ?>
                            <li>• <?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <form action="<?= isset($address) ? base_url('customer/address/update/' . $address->id) : base_url('customer/address/store') ?>" 
                      method="POST" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- Street -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Street Address *</label>
                        <input type="text" name="street" 
                               value="<?= isset($address) ? esc($address->street) : old('street') ?>"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="123 Main Street" required>
                    </div>

                    <!-- Sub-district and District -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sub-district (Kelurahan) *</label>
                            <input type="text" name="sub_district" 
                                   value="<?= isset($address) ? esc($address->sub_district) : old('sub_district') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Sub-district" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">District (Kecamatan) *</label>
                            <input type="text" name="district" 
                                   value="<?= isset($address) ? esc($address->district) : old('district') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="District" required>
                        </div>
                    </div>

                    <!-- City and Province -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">City/Regency (Kota/Kabupaten) *</label>
                            <input type="text" name="city" 
                                   value="<?= isset($address) ? esc($address->city) : old('city') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="City" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Province *</label>
                            <input type="text" name="province" 
                                   value="<?= isset($address) ? esc($address->province) : old('province') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Province" required>
                        </div>
                    </div>

                    <!-- Postal Code -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Postal Code *</label>
                        <input type="text" name="postal_code" 
                               value="<?= isset($address) ? esc($address->postal_code) : old('postal_code') ?>"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="12345" required>
                    </div>

                    <!-- Coordinates (Optional) -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Location Coordinates (Optional)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Latitude</label>
                                <input type="number" name="latitude" step="0.000001"
                                       value="<?= isset($address) ? $address->latitude : old('latitude') ?>"
                                       class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="-6.123456">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Longitude</label>
                                <input type="number" name="longitude" step="0.000001"
                                       value="<?= isset($address) ? $address->longitude : old('longitude') ?>"
                                       class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="106.123456">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3 justify-end">
                        <a href="<?= base_url('customer/address') ?>" 
                           class="px-6 py-3 border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                            <?= isset($address) ? 'Update Address' : 'Add Address' ?>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
