<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Categories<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Categories</h2>
                <a href="/categories/create" class="btn btn-primary float-end">Add New Category</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $category->id ?></td>
                                <td><?= $category->category_name ?></td>
                                <td><?= substr($category->category_description, 0, 50) ?>...</td>
                                <td><?= $category->icon ?></td>
                                <td>
                                    <a href="/categories/<?= $category->id ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="/categories/<?= $category->id ?>/delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
