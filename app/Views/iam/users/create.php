<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Create User<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Create New User</h2>
            </div>
            <div class="card-body">
                <form method="post" action="/users/store">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <option value="">-- Select Role --</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role->id ?>"><?= $role->role_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Active</label>
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                    </div>

                    <button type="submit" class="btn btn-primary">Create User</button>
                    <a href="/users" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
