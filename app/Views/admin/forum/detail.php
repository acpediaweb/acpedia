<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white"><?= esc($thread->title) ?></h1>
            <p class="text-gray-400 mt-1">By <?= esc($thread->author_name ?? 'Unknown') ?> on <?= date('M d, Y', strtotime($thread->created_at)) ?></p>
        </div>
        <div class="flex gap-2">
            <?php if ($thread->is_closed): ?>
                <form action="<?= base_url('admin/forum/' . $thread->id . '/reopen') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold transition-colors">
                        Reopen Thread
                    </button>
                </form>
            <?php else: ?>
                <form action="<?= base_url('admin/forum/' . $thread->id . '/close') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-semibold transition-colors"
                        onclick="return confirm('Close this thread?')">
                        Close Thread
                    </button>
                </form>
            <?php endif; ?>

            <a href="<?= base_url('admin/forum') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
                Back
            </a>
        </div>
    </div>

    <!-- Thread Status -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm">Thread Status</p>
                <p class="text-white font-bold mt-1">
                    <?php if ($thread->is_closed): ?>
                        <span class="inline-block px-3 py-1 bg-red-900 text-red-200 text-sm font-semibold rounded">
                            Closed - No new replies allowed
                        </span>
                    <?php else: ?>
                        <span class="inline-block px-3 py-1 bg-green-900 text-green-200 text-sm font-semibold rounded">
                            Open - New replies allowed
                        </span>
                    <?php endif; ?>
                </p>
            </div>
            <div class="text-right">
                <p class="text-gray-400 text-sm">Total Posts</p>
                <p class="text-white font-bold text-2xl mt-1"><?= count($posts) ?></p>
            </div>
        </div>
    </div>

    <!-- Posts -->
    <div class="space-y-4">
        <h2 class="text-2xl font-bold text-white">Posts</h2>

        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <!-- Post Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-gray-700">
                        <div class="flex items-center gap-4">
                            <!-- Author Avatar -->
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                                <?php if (!empty($post->picture_url)): ?>
                                    <img src="<?= base_url('file/uploads/' . $post->picture_url) ?>" 
                                        alt="<?= esc($post->fullname) ?>"
                                        class="w-full h-full rounded-full object-cover">
                                <?php else: ?>
                                    <span class="text-white font-bold text-sm">
                                        <?= strtoupper(substr($post->fullname ?? 'A', 0, 1)) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div>
                                <h3 class="text-white font-bold"><?= esc($post->fullname ?? 'Anonymous') ?></h3>
                                <?php if (!empty($post->flair_name)): ?>
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded" 
                                        style="background-color: <?= esc($post->flair_color ?? '#374151') ?>; color: white;">
                                        <?= esc($post->flair_name) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-gray-400 text-sm"><?= date('M d, Y H:i', strtotime($post->created_at)) ?></p>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="mt-4">
                        <p class="text-gray-200 whitespace-pre-wrap"><?= esc($post->content) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-8 bg-gray-800 border border-gray-700 rounded-lg">
                <p class="text-gray-400">No posts yet</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
