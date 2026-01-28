<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="profile-container">
    <div class="card">
        <div class="card-header">
            <h2>My Profile</h2>
        </div>
        <div class="card-body">
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>

            <form method="post" action="/auth/update-profile" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user->fullname ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>" required>
                </div>

                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    <?php if ($user->profile_picture): ?>
                        <img src="<?= base_url($user->profile_picture) ?>" alt="Profile" style="max-width: 100px; margin-top: 10px;">
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="/auth/logout" class="btn btn-danger">Logout</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
