<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-white">Inventory Timeline</h1>
        <p class="text-gray-400 mt-1">View all inventory item action logs</p>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="get" class="flex flex-col sm:flex-row gap-4">
            <!-- Inventory Filter -->
            <div class="flex-1">
                <input type="number" name="inventory" placeholder="Filter by inventory ID..." 
                    value="<?= esc($selectedInventory) ?>"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Action Filter -->
            <select name="action" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                <option value="">All Actions</option>
                <option value="created" <?= ($selectedAction === 'created') ? 'selected' : '' ?>>Created</option>
                <option value="assigned" <?= ($selectedAction === 'assigned') ? 'selected' : '' ?>>Assigned</option>
                <option value="unassigned" <?= ($selectedAction === 'unassigned') ? 'selected' : '' ?>>Unassigned</option>
                <option value="serviced" <?= ($selectedAction === 'serviced') ? 'selected' : '' ?>>Serviced</option>
            </select>

            <!-- Apply Button -->
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors">
                Filter
            </button>
        </form>
    </div>

    <!-- Timeline Table -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-900 border-b border-gray-700">
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Inventory ID</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Action</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Actor</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Details</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Timestamp</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $log): ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="py-4 px-6 text-white font-semibold">#<?= $log->inventory_id ?></td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-3 py-1 bg-blue-900 text-blue-200 text-xs font-semibold rounded">
                                        <?= ucfirst(esc($log->action)) ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-300">
                                    <?php if (!empty($log->actor_name)): ?>
                                        <?= esc($log->actor_name) ?>
                                    <?php else: ?>
                                        <span class="text-gray-500">System</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-gray-300 text-sm">
                                    <?= esc($log->details ?? '-') ?>
                                </td>
                                <td class="py-4 px-6 text-gray-300 text-sm">
                                    <?= date('M d, Y H:i', strtotime($log->created_at)) ?>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="<?= base_url('admin/timeline/' . $log->inventory_id) ?>" 
                                        class="text-blue-400 hover:text-blue-300 font-semibold text-sm">
                                        View Item
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-gray-400">No logs found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager): ?>
            <div class="bg-gray-900 border-t border-gray-700 px-6 py-4">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
