<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Orders</h1>
            <p class="text-gray-400 mt-1">Manage customer orders</p>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="get" class="flex flex-col sm:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" name="search" placeholder="Search by order ID..." 
                    value="<?= esc($searchQuery) ?>"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Status Filter -->
            <div class="flex gap-2">
                <select name="status" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Statuses</option>
                    <?php foreach ($statuses as $status): ?>
                        <option value="<?= $status ?>" <?= ($currentStatus === $status) ? 'selected' : '' ?>>
                            <?= $status ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-900 border-b border-gray-700">
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Order ID</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Customer</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Total Amount</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Status</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Date</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="py-4 px-6 text-white font-semibold">#<?= $order->id ?></td>
                                <td class="py-4 px-6 text-gray-300"><?= esc($order->fullname ?? 'Guest') ?></td>
                                <td class="py-4 px-6 text-white font-semibold">Rp <?= number_format($order->total_amount_snapshot, 0, ',', '.') ?></td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        <?php
                                            if ($order->order_status === 'Completed') echo 'bg-green-900 text-green-200';
                                            elseif ($order->order_status === 'In Progress') echo 'bg-blue-900 text-blue-200';
                                            elseif ($order->order_status === 'Pending') echo 'bg-yellow-900 text-yellow-200';
                                            elseif ($order->order_status === 'Cancelled') echo 'bg-red-900 text-red-200';
                                            else echo 'bg-gray-700 text-gray-200';
                                        ?>">
                                        <?= $order->order_status ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-300"><?= date('M d, Y H:i', strtotime($order->created_at)) ?></td>
                                <td class="py-4 px-6">
                                    <a href="<?= base_url('admin/orders/' . $order->id) ?>" 
                                        class="text-blue-400 hover:text-blue-300 font-semibold text-sm">View Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-gray-400">No orders found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager): ?>
            <div class="bg-gray-900 border-t border-gray-700 px-6 py-4">
                <?= $pager->links('orders', 'default') ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
