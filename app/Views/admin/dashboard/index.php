<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-8">
    <!-- Page Title -->
    <div>
        <h1 class="text-4xl font-bold text-white">Dashboard</h1>
        <p class="text-gray-400 mt-2">Welcome to the admin control panel</p>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-semibold">Total Users</p>
                    <p class="text-white text-3xl font-bold mt-2"><?= number_format($totalUsers) ?></p>
                </div>
                <svg class="w-12 h-12 text-blue-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a3 3 0 11-6 0 3 3 0 016 0zm6 0a3 3 0 11-6 0 3 3 0 016 0zM9 13a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM0 13a6 6 0 016-6v1h12v-1a6 6 0 01-6 6H0z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-semibold">Total Products</p>
                    <p class="text-white text-3xl font-bold mt-2"><?= number_format($totalProducts) ?></p>
                </div>
                <svg class="w-12 h-12 text-green-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Inventory -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-semibold">Total Inventory Items</p>
                    <p class="text-white text-3xl font-bold mt-2"><?= number_format($totalInventory) ?></p>
                </div>
                <svg class="w-12 h-12 text-purple-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-semibold">Total Orders</p>
                    <p class="text-white text-3xl font-bold mt-2"><?= number_format($totalOrders) ?></p>
                </div>
                <svg class="w-12 h-12 text-yellow-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Second Row KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pending Orders -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <p class="text-gray-400 text-sm font-semibold">Pending Orders</p>
            <p class="text-white text-3xl font-bold mt-2"><?= number_format($pendingOrders) ?></p>
            <p class="text-gray-500 text-xs mt-2"><?= number_format(($pendingOrders / max($totalOrders, 1)) * 100, 1) ?>% of total</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <p class="text-gray-400 text-sm font-semibold">Total Revenue</p>
            <p class="text-white text-3xl font-bold mt-2">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></p>
            <p class="text-green-500 text-xs mt-2">From completed orders</p>
        </div>

        <!-- Low Stock Alert -->
        <div class="bg-gray-800 border border-yellow-600 rounded-lg p-6">
            <p class="text-yellow-500 text-sm font-semibold">Low Stock Products</p>
            <p class="text-white text-3xl font-bold mt-2"><?= count($lowStockProducts) ?></p>
            <p class="text-yellow-600 text-xs mt-2">Products with < 5 items</p>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white mb-6">Recent Orders</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">#ID</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Customer</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Amount</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Status</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Date</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentOrders)): ?>
                        <?php foreach ($recentOrders as $order): ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="py-3 px-4 text-white font-semibold">#<?= $order->id ?></td>
                                <td class="py-3 px-4 text-gray-300"><?= esc($order->fullname ?? 'Guest') ?></td>
                                <td class="py-3 px-4 text-white">Rp <?= number_format($order->total_amount_snapshot, 0, ',', '.') ?></td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        <?php
                                            if ($order->order_status === 'Completed') echo 'bg-green-900 text-green-200';
                                            elseif ($order->order_status === 'In Progress') echo 'bg-blue-900 text-blue-200';
                                            elseif ($order->order_status === 'Pending') echo 'bg-yellow-900 text-yellow-200';
                                            else echo 'bg-gray-700 text-gray-200';
                                        ?>">
                                        <?= $order->order_status ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-300 text-sm"><?= date('M d, Y', strtotime($order->created_at)) ?></td>
                                <td class="py-3 px-4">
                                    <a href="<?= base_url('admin/orders/' . $order->id) ?>" class="text-blue-400 hover:text-blue-300 text-sm font-semibold">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-6 px-4 text-center text-gray-400">No orders yet</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
