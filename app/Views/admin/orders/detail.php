<?= $this->extend('admin/admin-layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Order #<?= $order->id ?></h1>
            <p class="text-gray-400 mt-1">Manage order details and items</p>
        </div>
        <a href="<?= base_url('admin/orders') ?>" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded font-semibold transition-colors">
            Back to Orders
        </a>
    </div>

    <!-- Order Summary Card -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Info -->
        <div class="lg:col-span-2 bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-6">Order Information</h2>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Customer Name</p>
                        <p class="text-white font-semibold mt-1"><?= esc($customer->fullname ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Customer Email</p>
                        <p class="text-white font-semibold mt-1"><?= esc($customer->email ?? '-') ?></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Phone</p>
                        <p class="text-white font-semibold mt-1"><?= esc($customer->phone ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Order Date</p>
                        <p class="text-white font-semibold mt-1"><?= date('M d, Y H:i', strtotime($order->created_at)) ?></p>
                    </div>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Delivery Address</p>
                    <?php $delivery = $order->street_snapshot ?? $order->delivery_address_display ?? ($order->city_snapshot ?? '-'); ?>
                    <p class="text-white font-semibold mt-1"><?= esc($delivery) ?></p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Customer Notes</p>
                    <p class="text-white mt-1"><?= esc($order->customer_notes ?? '-') ?></p>
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 h-fit">
            <h3 class="text-lg font-bold text-white mb-4">Change Status</h3>
            
            <form action="<?= base_url('admin/orders/' . $order->id . '/update-status') ?>" method="post" class="space-y-3">
                <?= csrf_field() ?>
                
                <div>
                    <label class="text-gray-400 text-sm font-semibold">Current Status</label>
                    <p class="text-white font-bold mt-2">
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                            <?php
                                if ($order->order_status === 'Completed') echo 'bg-green-900 text-green-200';
                                elseif ($order->order_status === 'In Progress') echo 'bg-blue-900 text-blue-200';
                                elseif ($order->order_status === 'Pending') echo 'bg-yellow-900 text-yellow-200';
                                elseif ($order->order_status === 'Cancelled') echo 'bg-red-900 text-red-200';
                                else echo 'bg-gray-700 text-gray-200';
                            ?>">
                            <?= $order->order_status ?>
                        </span>
                    </p>
                </div>

                <div>
                    <label class="text-gray-400 text-sm font-semibold block mb-2">Update to</label>
                    <select name="status" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:border-blue-500">
                        <option value="">Select Status</option>
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?= $status ?>" <?= ($order->order_status === $status) ? 'selected' : '' ?>>
                                <?= $status ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors mt-4">
                    Update Status
                </button>
            </form>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white mb-6">Order Items</h2>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-900 border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Product</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Unit Price</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Quantity</th>
                        <th class="text-left py-3 px-4 text-gray-400 font-semibold text-sm">Addons</th>
                        <th class="text-right py-3 px-4 text-gray-400 font-semibold text-sm">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)): ?>
                        <?php $totalItems = 0; ?>
                        <?php foreach ($items as $item): ?>
                            <tr class="border-b border-gray-700">
                                <td class="py-3 px-4 text-white font-semibold"><?= esc($item->product_name) ?></td>
                                <td class="py-3 px-4 text-gray-300">Rp <?= number_format($item->price, 0, ',', '.') ?></td>
                                <td class="py-3 px-4 text-gray-300"><?= (int)$item->quantity ?> <?= esc($item->unit ?? '') ?></td>
                                <td class="py-3 px-4 text-gray-300">
                                    <?php if (!empty($item->addons)): ?>
                                        <div class="text-sm">
                                            <?php foreach ($item->addons as $addon): ?>
                                                <div>• <?= esc($addon['name']) ?> (+Rp <?= number_format($addon['price'], 0, ',', '.') ?>)</div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 text-right text-white font-semibold">
                                    Rp <?= number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') ?>
                                </td>
                            </tr>
                            <?php $totalItems += (int)$item->quantity; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-6 px-4 text-center text-gray-400">No items in order</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Order Total -->
        <div class="mt-6 border-t border-gray-700 pt-4">
            <div class="flex justify-end">
                <div class="w-full sm:w-80 space-y-2">
                    <div class="flex justify-between text-gray-300">
                        <span>Subtotal</span>
                        <span>Rp <?= number_format($order->total_amount_snapshot - ($order->discount_amount ?? 0) - ($order->tax_amount ?? 0) + ($order->shipping_cost ?? 0), 0, ',', '.') ?></span>
                    </div>

                    <?php if (!empty($order->discount_amount)): ?>
                        <div class="flex justify-between text-gray-300">
                            <span>Discount</span>
                            <span class="text-green-400">-Rp <?= number_format($order->discount_amount, 0, ',', '.') ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($order->tax_amount)): ?>
                        <div class="flex justify-between text-gray-300">
                            <span>Tax</span>
                            <span>Rp <?= number_format($order->tax_amount, 0, ',', '.') ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($order->shipping_cost)): ?>
                        <div class="flex justify-between text-gray-300">
                            <span>Shipping</span>
                            <span>Rp <?= number_format($order->shipping_cost, 0, ',', '.') ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="flex justify-between text-white font-bold text-lg border-t border-gray-700 pt-2">
                        <span>Total</span>
                        <span>Rp <?= number_format($order->total_amount_snapshot, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
