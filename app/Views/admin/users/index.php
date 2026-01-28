<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Users</h1>
            <p class="text-gray-400 mt-1">Manage system users</p>
        </div>
        <a href="<?= base_url('admin/users/create') ?>" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold transition-colors">
            + Create User
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="get" class="flex flex-col sm:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" name="search" placeholder="Search by name, email, or phone..." 
                    value="<?= esc($searchQuery) ?>"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Role Filter -->
            <div class="flex gap-2">
                <select name="role" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Roles</option>
                    <?php if (!empty($roles)): ?>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id ?>" <?= ($selectedRole === (string)$role->id) ? 'selected' : '' ?>>
                                <?= esc($role->role_name ?? 'Unknown') ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-900 border-b border-gray-700">
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Name</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Email</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Phone</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Role</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Joined</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="py-4 px-6 text-white font-semibold"><?= esc($user->fullname) ?></td>
                                <td class="py-4 px-6 text-gray-300"><?= esc($user->email) ?></td>
                                <td class="py-4 px-6 text-gray-300"><?= esc($user->phone ?? '-') ?></td>
                                <td class="py-4 px-6">
                                    <span class="inline-block px-3 py-1 bg-purple-900 text-purple-200 text-xs font-semibold rounded">
                                        <?php 
                                            // Get role name from roles array
                                            $roleName = 'Unknown';
                                            foreach ($roles as $role) {
                                                if ($role->id === (int)$user->role_id) {
                                                    $roleName = esc($role->role_name);
                                                    break;
                                                }
                                            }
                                            echo $roleName;
                                        ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-300 text-sm"><?= date('M d, Y', strtotime($user->created_at)) ?></td>
                                <td class="py-4 px-6">
                                    <div class="flex gap-2">
                                        <a href="<?= base_url('admin/users/' . $user->id . '/edit') ?>" 
                                            class="text-blue-400 hover:text-blue-300 font-semibold text-sm">
                                            Edit
                                        </a>
                                        <?php if ($user->role_id !== 1): ?>
                                            <form action="<?= base_url('admin/users/' . $user->id . '/delete') ?>" method="post" class="inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" onclick="return confirm('Delete this user?')" 
                                                    class="text-red-400 hover:text-red-300 font-semibold text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-500 text-sm">Admin</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-8 px-6 text-center text-gray-400">No users found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager): ?>
            <div class="bg-gray-900 border-t border-gray-700 px-6 py-4">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
