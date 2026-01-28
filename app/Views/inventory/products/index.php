<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Products<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Products</h2>
                <a href="/products/create" class="btn btn-primary float-end">Add New Product</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Base Price</th>
                            <th>Sale Price</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product->id ?></td>
                                <td><?= $product->product_name ?></td>
                                <td>Rp <?= number_format($product->base_price, 0, ',', '.') ?></td>
                                <td><?= $product->sale_price ? 'Rp ' . number_format($product->sale_price, 0, ',', '.') : '-' ?></td>
                                <td><?= $product->category_id ?></td>
                                <td><?= $product->brand_id ?></td>
                                <td>
                                    <a href="/products/<?= $product->id ?>" class="btn btn-sm btn-info">View</a>
                                    <a href="/products/<?= $product->id ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="/products/<?= $product->id ?>/delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
