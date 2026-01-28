<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-white">Employee Management</h1>
        <p class="text-gray-400 mt-1">Manage technicians and staff members</p>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <form method="get" class="flex flex-col sm:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <input type="text" name="search" placeholder="Search employees..." 
                    value="<?= esc($searchQuery) ?>"
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400 focus:outline-none focus:border-blue-500">
            </div>

            <!-- Role Filter -->
            <div class="flex gap-2">
                <select name="role" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                    <option value="">All Roles</option>
                    <option value="3" <?= ($selectedRole === '3') ? 'selected' : '' ?>>Technician</option>
                    <option value="4" <?= ($selectedRole === '4') ? 'selected' : '' ?>>Staff</option>
                </select>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Employees Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($employees)): ?>
            <?php foreach ($employees as $employee): ?>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                    <!-- Employee Avatar -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                            <?php if (!empty($employee->picture_url)): ?>
                                <img src="<?= base_url('file/uploads/' . $employee->picture_url) ?>" 
                                    alt="<?= esc($employee->fullname) ?>"
                                    class="w-full h-full rounded-full object-cover">
                            <?php else: ?>
                                <span class="text-white font-bold text-2xl">
                                    <?= strtoupper(substr($employee->fullname, 0, 1)) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex-1">
                            <h3 class="text-white font-bold"><?= esc($employee->fullname) ?></h3>
                            <p class="text-blue-400 text-sm font-semibold">
                                <?= $roles[$employee->role_id] ?? 'Unknown' ?>
                            </p>
                        </div>
                    </div>

                    <!-- Employee Info -->
                    <div class="space-y-2 mb-4 pb-4 border-b border-gray-700">
                        <p class="text-gray-400 text-sm">
                            <span class="text-gray-500">Email:</span> <?= esc($employee->email) ?>
                        </p>
                        <p class="text-gray-400 text-sm">
                            <span class="text-gray-500">Phone:</span> <?= esc($employee->phone ?? '-') ?>
                        </p>
                    </div>

                    <!-- Action Button -->
                    <a href="<?= base_url('admin/employee/' . $employee->id) ?>" 
                        class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-center rounded font-semibold transition-colors">
                        View Details
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-12">
                <p class="text-gray-400 text-lg">No employees found</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <?= $pager->links('employees', 'bootstrap_pagination') ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
