<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Forum<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Community Forum</h2>
                <?php if (session()->has('user_id')): ?>
                    <a href="/forum/create" class="btn btn-primary float-end">Create Thread</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if (empty($threads)): ?>
                    <p class="text-muted">No forum threads yet.</p>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($threads as $thread): ?>
                                <tr>
                                    <td><?= $thread->thread_title ?></td>
                                    <td><span class="badge bg-info"><?= $thread->status ?></span></td>
                                    <td><?= date('d-m-Y', strtotime($thread->created_at)) ?></td>
                                    <td>
                                        <a href="/forum/<?= $thread->id ?>" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
