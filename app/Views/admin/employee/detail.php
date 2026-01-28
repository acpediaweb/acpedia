<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white"><?= esc($employee->fullname) ?></h1>
            <p class="text-blue-400 mt-1 font-semibold"><?= $roleMap[$employee->role_id] ?? 'Unknown Role' ?></p>
        </div>
        <a href="<?= base_url('admin/employee') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
            Back to Employees
        </a>
    </div>

    <!-- Employee Info Card -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile -->
        <div class="lg:col-span-1 bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="text-center">
                <!-- Avatar -->
                <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center mb-4">
                    <?php if (!empty($employee->picture_url)): ?>
                        <img src="<?= base_url('file/uploads/' . $employee->picture_url) ?>" 
                            alt="<?= esc($employee->fullname) ?>"
                            class="w-full h-full rounded-full object-cover">
                    <?php else: ?>
                        <span class="text-white font-bold text-4xl">
                            <?= strtoupper(substr($employee->fullname, 0, 1)) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <h2 class="text-white font-bold text-xl mt-4"><?= esc($employee->fullname) ?></h2>
                <p class="text-blue-400 font-semibold mt-1"><?= $roleMap[$employee->role_id] ?></p>

                <!-- Contact Info -->
                <div class="mt-6 space-y-2 text-left">
                    <div class="bg-gray-700 rounded p-3">
                        <p class="text-gray-400 text-xs">Email</p>
                        <p class="text-white font-semibold break-all"><?= esc($employee->email) ?></p>
                    </div>

                    <div class="bg-gray-700 rounded p-3">
                        <p class="text-gray-400 text-xs">Phone</p>
                        <p class="text-white font-semibold"><?= esc($employee->phone ?? '-') ?></p>
                    </div>

                    <div class="bg-gray-700 rounded p-3">
                        <p class="text-gray-400 text-xs">Member Since</p>
                        <p class="text-white font-semibold"><?= date('M d, Y', strtotime($employee->created_at)) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Stats -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Today Summary -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">Today's Summary</h2>

                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-gray-700 rounded p-4 text-center">
                        <p class="text-gray-400 text-sm">Clock In/Out</p>
                        <p class="text-white font-bold text-2xl mt-2"><?= count($todayLogs) ?></p>
                    </div>
                    <div class="bg-gray-700 rounded p-4 text-center">
                        <p class="text-gray-400 text-sm">Hours Worked</p>
                        <p class="text-white font-bold text-2xl mt-2"><?= number_format($hoursWorked, 1) ?>h</p>
                    </div>
                    <div class="bg-gray-700 rounded p-4 text-center">
                        <p class="text-gray-400 text-sm">Status</p>
                        <p class="text-green-400 font-bold text-lg mt-2">
                            <?php 
                                $lastLog = end($todayLogs);
                                echo (!empty($lastLog) && empty($lastLog->clock_out_time)) ? 'Active' : 'Offline';
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recent Clock Records -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">Recent Clock Records</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-900 border-b border-gray-700">
                                <th class="text-left py-2 px-3 text-gray-400 font-semibold">Clock In</th>
                                <th class="text-left py-2 px-3 text-gray-400 font-semibold">Clock Out</th>
                                <th class="text-left py-2 px-3 text-gray-400 font-semibold">Duration</th>
                                <th class="text-left py-2 px-3 text-gray-400 font-semibold">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($clockLogs)): ?>
                                <?php foreach (array_slice($clockLogs, 0, 10) as $log): ?>
                                    <tr class="border-b border-gray-700">
                                        <td class="py-2 px-3 text-gray-300">
                                            <?= date('M d, H:i', strtotime($log->clock_in_time)) ?>
                                        </td>
                                        <td class="py-2 px-3 text-gray-300">
                                            <?= !empty($log->clock_out_time) ? date('H:i', strtotime($log->clock_out_time)) : '-' ?>
                                        </td>
                                        <td class="py-2 px-3 text-white font-semibold">
                                            <?php 
                                                if (!empty($log->clock_out_time)) {
                                                    $in = strtotime($log->clock_in_time);
                                                    $out = strtotime($log->clock_out_time);
                                                    $mins = intval(($out - $in) / 60);
                                                    echo ($mins / 60) . 'h';
                                                } else {
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                        <td class="py-2 px-3 text-gray-300">
                                            <?php if (!empty($log->location_latitude) && !empty($log->location_longitude)): ?>
                                                <code class="text-xs"><?= number_format($log->location_latitude, 4) ?>, <?= number_format($log->location_longitude, 4) ?></code>
                                            <?php else: ?>
                                                <span class="text-gray-500">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="py-4 px-3 text-center text-gray-400">No clock records</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
