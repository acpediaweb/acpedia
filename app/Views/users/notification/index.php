<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="flex gap-6">
    <?= view('users/user-sidebar') ?>

    <div class="flex-1">
        <div class="space-y-6">
            <!-- Header -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Notifications</h1>
                <p class="text-gray-500">All your notifications including read and delivered ones</p>
            </div>

            <!-- Placeholder Content -->
            <div class="bg-white rounded-2xl p-12 border border-gray-100 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Coming Soon</h3>
                <p class="text-gray-500">Notification center is being developed</p>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
