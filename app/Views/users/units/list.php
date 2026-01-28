<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="flex gap-6">
    <?= view('users/user-sidebar') ?>

    <div class="flex-1">
        <div class="space-y-6">
            <!-- Header -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">My AC Units</h1>
                <p class="text-gray-500">View all your installed AC units and maintenance history</p>
            </div>

            <!-- Placeholder Content -->
            <div class="bg-white rounded-2xl p-12 border border-gray-100 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Coming Soon</h3>
                <p class="text-gray-500">Unit inventory and timeline are being developed</p>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
