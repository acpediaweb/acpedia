<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<!-- Shop Header -->
<section class="page-header py-5 bg-light">
    <div class="container">
        <h1 class="display-5">Toko Kami</h1>
        <p class="lead text-muted">Jelajahi koleksi lengkap produk HVAC berkualitas tinggi</p>
    </div>
</section>

<!-- Shop Content -->
<section class="shop-section py-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Filter</h5>

                        <!-- Category Filter -->
                        <div class="mb-4">
                            <h6 class="mb-3">Kategori</h6>
                            <form method="get" action="/toko-kami">
                                <div class="list-group list-group-flush">
                                    <a href="/toko-kami" class="list-group-item list-group-item-action <?php echo !isset($selectedCategory) ? 'active' : ''; ?>">
                                        Semua Kategori
                                    </a>
                                    <?php foreach($categories as $cat): ?>
                                        <a href="/toko-kami?category=<?php echo $cat->id; ?>" 
                                           class="list-group-item list-group-item-action <?php echo $selectedCategory == $cat->id ? 'active' : ''; ?>">
                                            <?php echo $cat->category_name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </form>
                        </div>

                        <!-- Search -->
                        <div class="mb-4">
                            <h6 class="mb-3">Cari Produk</h6>
                            <form method="get" action="/toko-kami">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Nama produk..." value="<?php echo $searchQuery ?? ''; ?>">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-lg-9">
                <!-- Showing info -->
                <div class="mb-4">
                    <p class="text-muted">
                        Menampilkan <?php echo count($products) > 0 ? 1 : 0; ?> - <?php echo count($products); ?> dari total produk
                        <?php if($selectedCategory): ?>
                            di kategori <strong><?php echo $selectedCategory; ?></strong>
                        <?php endif; ?>
                    </p>
                </div>

                <!-- Products Grid -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
                    <?php if(!empty($products)): ?>
                        <?php foreach($products as $product): ?>
                            <div class="col">
                                <div class="card h-100 product-card">
                                    <img src="<?php echo $product->image_url ?? '/images/placeholder.jpg'; ?>" 
                                         class="card-img-top" alt="<?php echo $product->product_name; ?>" 
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title"><?php echo $product->product_name; ?></h6>
                                        <p class="card-text text-muted small"><?php echo substr($product->description ?? '', 0, 60); ?></p>
                                        <div class="mt-auto">
                                            <p class="h5 text-primary mb-3">Rp <?php echo number_format($product->product_price, 0, ',', '.'); ?></p>
                                            <a href="/toko-kami/produk/<?php echo $product->product_id; ?>" class="btn btn-outline-primary w-100">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info text-center py-5">
                                <h6>Tidak ada produk ditemukan</h6>
                                <p class="text-muted mb-0">Coba ubah filter atau cari dengan kata kunci yang berbeda</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <?php if($pager): ?>
                    <nav aria-label="Page navigation" class="d-flex justify-content-center">
                        <?php echo $pager->links('shop'); ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection(); ?>
