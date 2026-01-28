<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">
                <?= $user ? 'Edit User' : 'Create New User' ?>
            </h1>
            <p class="text-gray-400 mt-1"><?= $user ? 'Update user information' : 'Add a new user to the system' ?></p>
        </div>
        <a href="<?= base_url('admin/users') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
            Back to Users
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/users/save') ?>" method="post" class="space-y-6">
        <?= csrf_field() ?>
        <?php if ($user): ?>
            <input type="hidden" name="id" value="<?= $user->id ?>">
        <?php endif; ?>

        <!-- User Information -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">User Information</h2>

            <div class="space-y-4">
                <!-- Full Name -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Full Name *</label>
                    <input type="text" name="fullname" value="<?= $user ? esc($user->fullname) : esc(old('fullname')) ?>"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                        placeholder="John Doe" required>
                    <?php if (isset($errors['fullname'])): ?>
                        <p class="text-red-400 text-sm mt-1"><?= $errors['fullname'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Email *</label>
                    <input type="email" name="email" value="<?= $user ? esc($user->email) : esc(old('email')) ?>"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                        placeholder="john@example.com" required>
                    <?php if (isset($errors['email'])): ?>
                        <p class="text-red-400 text-sm mt-1"><?= $errors['email'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Phone -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Phone Number</label>
                    <input type="tel" name="phone" value="<?= $user ? esc($user->phone ?? old('phone')) : esc(old('phone')) ?>"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                        placeholder="+62 812 3456 7890">
                    <?php if (isset($errors['phone'])): ?>
                        <p class="text-red-400 text-sm mt-1"><?= $errors['phone'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Role -->
                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Role *</label>
                    <select name="role_id" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id ?>" <?= ($user && $user->role_id === (int)$role->id) ? 'selected' : '' ?>>
                                <?= esc($role->role_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['role_id'])): ?>
                        <p class="text-red-400 text-sm mt-1"><?= $errors['role_id'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Password Section -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">
                <?= $user ? 'Change Password (Optional)' : 'Set Password *' ?>
            </h2>

            <div>
                <label class="text-gray-400 text-sm font-semibold block mb-2">
                    Password <?= !$user ? '*' : '' ?>
                </label>
                <input type="password" name="password" 
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500"
                    placeholder="<?= $user ? 'Leave blank to keep current password' : 'Enter password' ?>"
                    <?= !$user ? 'required' : '' ?>>
                <?php if (isset($errors['password'])): ?>
                    <p class="text-red-400 text-sm mt-1"><?= $errors['password'] ?></p>
                <?php endif; ?>
                <p class="text-gray-500 text-xs mt-1">Minimum 6 characters</p>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded font-bold transition-colors">
                <?= $user ? 'Update User' : 'Create User' ?>
            </button>
            <a href="<?= base_url('admin/users') ?>" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded font-bold transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
