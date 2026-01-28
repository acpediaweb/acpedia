<?= $this->extend('layouts/shop_frontend') ?>

<?= $this->section('content') ?>

<div class="flex gap-6">
    <?= view('users/user-sidebar') ?>

    <div class="flex-1">
        <div class="space-y-6">
            <!-- Profile Header -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">My Profile</h1>
                <p class="text-gray-500">Manage your account information and preferences</p>
            </div>

            <!-- Messages -->
            <?php if (session()->has('success')): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    <p class="text-sm font-medium"><?= session('success') ?></p>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <p class="text-sm font-medium"><?= session('error') ?></p>
                </div>
            <?php endif; ?>

            <!-- Profile Information Section -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Profile Information</h2>
                        <p class="text-sm text-gray-500">Update your personal details</p>
                    </div>
                </div>

                <form action="<?= base_url('customer/profile/update') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Fullname -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="fullname" value="<?= esc($user->fullname) ?>" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   required>
                            <?php if (isset($errors['fullname'])): ?>
                                <p class="text-red-500 text-xs mt-1"><?= $errors['fullname'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Email (Read-only) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" value="<?= esc($user->email) ?>" disabled
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500">
                            <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                        </div>
                    </div>

                    <!-- User ID and Created Date -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">User ID</label>
                            <input type="text" value="<?= esc($user->id) ?>" disabled
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Member Since</label>
                            <input type="text" value="<?= date('F j, Y', strtotime($user->created_at)) ?>" disabled
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Profile Picture Section -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Profile Picture</h2>

                <div class="flex items-center gap-8">
                    <!-- Current Picture -->
                    <div class="flex-shrink-0">
                        <div class="h-32 w-32 rounded-lg bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center text-white text-4xl font-bold shadow-sm overflow-hidden">
                            <?php if ($user->profile_picture): ?>
                                <img src="<?= base_url('writable/uploads/' . esc($user->profile_picture)) ?>" 
                                     alt="Profile" class="w-full h-full object-cover">
                            <?php else: ?>
                                <?= strtoupper(substr($user->fullname, 0, 1)) ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <form action="<?= base_url('customer/profile/update-picture') ?>" method="POST" enctype="multipart/form-data" class="flex-1">
                        <?= csrf_field() ?>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Choose Image</label>
                                <input type="file" name="profile_picture" accept="image/jpeg,image/png,image/gif"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       required>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG, or GIF. Max 5MB.</p>
                            </div>

                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                Upload Picture
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Change Password</h2>

                <form action="<?= base_url('customer/profile/change-password') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>

                    <div class="space-y-4">
                        <!-- Old Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                            <input type="password" name="old_password" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   required>
                            <?php if (isset($errors['old_password'])): ?>
                                <p class="text-red-500 text-xs mt-1"><?= $errors['old_password'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                            <input type="password" name="new_password" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   required>
                            <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                            <?php if (isset($errors['new_password'])): ?>
                                <p class="text-red-500 text-xs mt-1"><?= $errors['new_password'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                            <input type="password" name="confirm_password" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   required>
                            <?php if (isset($errors['confirm_password'])): ?>
                                <p class="text-red-500 text-xs mt-1"><?= $errors['confirm_password'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
