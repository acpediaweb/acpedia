<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="flex gap-6">
    <?= view('users/user-sidebar') ?>

    <div class="flex-1">
        <div class="space-y-6">
            <!-- Header -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Unit Details</h1>
                <p class="text-gray-500">View unit information and maintenance timeline</p>
            </div>

            <!-- Placeholder Content -->
            <div class="bg-white rounded-2xl p-12 border border-gray-100 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Coming Soon</h3>
                <p class="text-gray-500">Unit detail view with timeline is being developed</p>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
