<aside class="w-64 bg-white border-r border-gray-100 p-6 h-full">
    <nav class="space-y-2">
        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Account</h3>
        
        <a href="<?= base_url('users/profile') ?>" 
           class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors <?= strpos(current_url(), 'profile') !== false ? 'bg-blue-50 text-blue-600' : '' ?>">
            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Profile
        </a>

        <a href="<?= base_url('users/address') ?>" 
           class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors <?= strpos(current_url(), 'address') !== false ? 'bg-blue-50 text-blue-600' : '' ?>">
            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Addresses
        </a>

        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 mt-6">Shopping</h3>

        <a href="<?= base_url('users/orders') ?>" 
           class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors <?= strpos(current_url(), 'orders') !== false ? 'bg-blue-50 text-blue-600' : '' ?>">
            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            Order History
        </a>

        <a href="<?= base_url('users/units') ?>" 
           class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors <?= strpos(current_url(), 'units') !== false ? 'bg-blue-50 text-blue-600' : '' ?>">
            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            My AC Units
        </a>

        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 mt-6">Notifications</h3>

        <a href="<?= base_url('users/notification') ?>" 
           class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors <?= strpos(current_url(), 'notification') !== false ? 'bg-blue-50 text-blue-600' : '' ?>">
            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            Notifications
        </a>
    </nav>
</aside>
