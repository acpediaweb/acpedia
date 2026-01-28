<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Create Forum Thread</h1>
            <p class="text-gray-400 mt-1">Create a new forum thread</p>
        </div>
        <a href="<?= base_url('admin/forum') ?>" class="px-4 py-2 bg-gray-700 text-white rounded">Back</a>
    </div>

    <form action="<?= base_url('admin/forum/save') ?>" method="post" class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <?= csrf_field() ?>
        <div class="space-y-4">
            <div>
                <label class="text-gray-400 text-sm block mb-2">Title *</label>
                <input type="text" name="thread_title" required
                    value="<?= esc(old('thread_title')) ?>"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">
            </div>

            <div>
                <label class="text-gray-400 text-sm block mb-2">Flair (optional)</label>
                <input type="number" name="flair_id" value="<?= esc(old('flair_id')) ?>" placeholder="Flair ID"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded">Create Thread</button>
                <a href="<?= base_url('admin/forum') ?>" class="px-6 py-2 bg-gray-700 text-white rounded">Cancel</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
