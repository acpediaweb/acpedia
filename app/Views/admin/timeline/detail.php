<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Timeline for Item #<?= $item->id ?></h1>
            <p class="text-gray-400 mt-1"><?= esc($item->product_name) ?></p>
        </div>
        <a href="<?= base_url('admin/timeline') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
            Back to Timeline
        </a>
    </div>

    <!-- Timeline -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white mb-6">Action History</h2>

        <?php if (!empty($logs)): ?>
            <div class="space-y-4">
                <?php foreach ($logs as $log): ?>
                    <div class="flex gap-4 pb-4 border-b border-gray-700 last:border-b-0">
                        <!-- Timeline Dot -->
                        <div class="flex flex-col items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded-full mt-2"></div>
                        </div>

                        <!-- Log Details -->
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-white font-bold">
                                    <?= ucfirst(esc($log->action)) ?>
                                </h3>
                                <span class="text-gray-400 text-sm">
                                    <?= date('M d, Y H:i:s', strtotime($log->created_at)) ?>
                                </span>
                            </div>

                            <div class="mt-2 space-y-1">
                                <?php if (!empty($log->actor_name)): ?>
                                    <p class="text-gray-300 text-sm">
                                        <span class="text-gray-500">By:</span> <?= esc($log->actor_name) ?>
                                    </p>
                                <?php else: ?>
                                    <p class="text-gray-300 text-sm">
                                        <span class="text-gray-500">By:</span> System
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($log->details)): ?>
                                    <p class="text-gray-300 text-sm">
                                        <span class="text-gray-500">Details:</span> <?= esc($log->details) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <p class="text-gray-400">No actions recorded for this item</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
