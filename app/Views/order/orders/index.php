<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Orders<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>My Orders</h2>
            </div>
            <div class="card-body">
                <?php if (empty($orders)): ?>
                    <p class="text-muted">No orders yet. <a href="/products">Browse products</a></p>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $order->id ?></td>
                                    <td>Rp <?= number_format($order->total_amount_snapshot, 0, ',', '.') ?></td>
                                    <td><span class="badge bg-info"><?= $order->order_status ?></span></td>
                                    <td><?= date('d-m-Y', strtotime($order->created_at)) ?></td>
                                    <td>
                                        <a href="/orders/<?= $order->id ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="/discussion/<?= $order->id ?>" class="btn btn-sm btn-secondary">Chat</a>
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
