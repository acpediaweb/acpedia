<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-white">Site Configuration</h1>
        <p class="text-gray-400 mt-1">Manage system-wide settings</p>
    </div>

    <!-- Placeholder Card -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
        </svg>
        <h2 class="text-2xl font-bold text-white mt-4">Configuration Coming Soon</h2>
        <p class="text-gray-400 mt-2">This section is under development. Site configuration options will be available soon.</p>
    </div>

    <!-- Information Box -->
    <div class="bg-blue-900 border border-blue-700 rounded-lg p-6">
        <h3 class="text-white font-bold mb-2">Expected Features</h3>
        <ul class="text-blue-200 space-y-2">
            <li>• General site settings (name, description, contact info)</li>
            <li>• Email configuration</li>
            <li>• Payment gateway settings</li>
            <li>• SMS provider configuration</li>
            <li>• API keys management</li>
            <li>• System-wide preferences</li>
        </ul>
    </div>
</div>

<?= $this->endSection() ?>
