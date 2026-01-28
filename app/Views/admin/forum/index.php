<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-white">Forum Moderation</h1>
        <p class="text-gray-400 mt-1">Manage forum threads and discussions</p>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="get" class="flex flex-col sm:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" name="search" placeholder="Search threads..." 
                    value="<?= esc($searchQuery) ?>"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Status Filter -->
            <div class="flex gap-2">
                <select name="status" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Statuses</option>
                    <option value="open" <?= ($selectedStatus === 'open') ? 'selected' : '' ?>>Open</option>
                    <option value="closed" <?= ($selectedStatus === 'closed') ? 'selected' : '' ?>>Closed</option>
                </select>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Threads List -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-900 border-b border-gray-700">
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Thread Title</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Author</th>
                        <th class="text-center py-4 px-6 text-gray-400 font-semibold text-sm">Posts</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Status</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Created</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($threads)): ?>
                        <?php foreach ($threads as $thread): ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="py-4 px-6 text-white font-semibold">
                                    <div class="max-w-xs truncate">
                                        <?= esc($thread->title) ?>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-300"><?= esc($thread->author_name ?? 'Unknown') ?></td>
                                <td class="py-4 px-6 text-center text-gray-300"><?= (int)($thread->post_count ?? 0) ?></td>
                                <td class="py-4 px-6">
                                    <?php if ($thread->is_closed): ?>
                                        <span class="inline-block px-3 py-1 bg-red-900 text-red-200 text-xs font-semibold rounded">
                                            Closed
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-block px-3 py-1 bg-green-900 text-green-200 text-xs font-semibold rounded">
                                            Open
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-gray-300 text-sm"><?= date('M d, Y', strtotime($thread->created_at)) ?></td>
                                <td class="py-4 px-6">
                                    <a href="<?= base_url('admin/forum/' . $thread->id) ?>" 
                                        class="text-blue-400 hover:text-blue-300 font-semibold text-sm">
                                        Moderate
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-gray-400">No threads found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager): ?>
            <div class="bg-gray-900 border-t border-gray-700 px-6 py-4">
                <?= $pager->links('forum', 'default') ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
