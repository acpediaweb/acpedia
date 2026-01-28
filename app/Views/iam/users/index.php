<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Users<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Users Management</h2>
                <a href="/users/create" class="btn btn-primary float-end">Add New User</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= $user->fullname ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->role_id ?></td>
                                <td><span class="badge bg-<?= $user->is_active ? 'success' : 'danger' ?>"><?= $user->is_active ? 'Active' : 'Inactive' ?></span></td>
                                <td>
                                    <a href="/users/<?= $user->id ?>" class="btn btn-sm btn-info">View</a>
                                    <a href="/users/<?= $user->id ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="/users/<?= $user->id ?>/delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
