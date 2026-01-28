<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>My Cart<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            <div class="card-body">
                <?php if (empty($items)): ?>
                    <p class="text-muted">Your cart is empty. <a href="/products">Browse products</a></p>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= $item->product_id ?></td>
                                    <td><?= $item->quantity ?></td>
                                    <td>Rp 0</td>
                                    <td>Rp 0</td>
                                    <td>
                                        <a href="/cart/remove-item/<?= $item->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Remove</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="/cart/checkout" class="btn btn-success">Proceed to Checkout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
