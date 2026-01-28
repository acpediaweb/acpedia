<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<!-- Product Detail -->
<section class="product-detail py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Product Image -->
            <div class="col-lg-6">
                <div class="card border-0">
                    <img src="<?php echo $product->image_url ?? '/images/placeholder.jpg'; ?>" 
                         class="card-img" alt="<?php echo $product->product_name; ?>"
                         style="height: 400px; object-fit: cover;">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <h1 class="mb-3"><?php echo $product->product_name; ?></h1>
                
                <div class="mb-4">
                    <p class="text-muted"><?php echo $product->category_id; ?></p>
                </div>

                <div class="mb-4">
                    <h4 class="text-primary">Rp <?php echo number_format($product->product_price, 0, ',', '.'); ?></h4>
                    <p class="text-muted">
                        Status: <span class="badge bg-success"><?php echo $product->product_status; ?></span>
                    </p>
                </div>

                <p class="mb-4"><?php echo $product->description ?? 'Deskripsi produk tidak tersedia'; ?></p>

                <div class="mb-4">
                    <h6 class="mb-2">Spesifikasi:</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-lg text-success me-2"></i> SKU: <?php echo $product->sku ?? '-'; ?></li>
                        <li><i class="bi bi-check-lg text-success me-2"></i> Brand: <?php echo $product->brand_id ?? '-'; ?></li>
                        <li><i class="bi bi-check-lg text-success me-2"></i> Berat: <?php echo $product->weight ?? '-'; ?> kg</li>
                    </ul>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="form-label">Kuantitas:</label>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">-</button>
                        <input type="number" class="form-control text-center" id="quantity" name="quantity" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">+</button>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-lg" onclick="addToCart(<?php echo $product->product_id; ?>)">
                        <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                    </button>
                    <button class="btn btn-outline-secondary btn-lg" onclick="wishlist(<?php echo $product->product_id; ?>)">
                        <i class="bi bi-heart me-2"></i> Wishlist
                    </button>
                </div>

                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="mb-2"><i class="bi bi-info-circle me-2"></i> Informasi Penting</h6>
                    <ul class="small text-muted mb-0">
                        <li>Pengiriman tersedia ke seluruh Indonesia</li>
                        <li>Garansi resmi dari manufaktur</li>
                        <li>Dukungan teknis purna jual tersedia</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <?php if(!empty($relatedProducts)): ?>
            <hr class="my-5">
            <h4 class="mb-4">Produk Terkait</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <?php foreach($relatedProducts as $related): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo $related->image_url ?? '/images/placeholder.jpg'; ?>" 
                                 class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title"><?php echo $related->product_name; ?></h6>
                                <p class="h6 text-primary mt-auto mb-2">Rp <?php echo number_format($related->product_price, 0, ',', '.'); ?></p>
                                <a href="/toko-kami/produk/<?php echo $related->product_id; ?>" class="btn btn-sm btn-outline-primary">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function increaseQty() {
    const qty = document.getElementById('quantity');
    qty.value = parseInt(qty.value) + 1;
}

function decreaseQty() {
    const qty = document.getElementById('quantity');
    if (parseInt(qty.value) > 1) {
        qty.value = parseInt(qty.value) - 1;
    }
}

function addToCart(productId) {
    const quantity = document.getElementById('quantity').value;
    
    fetch(`/toko-kami/add-to-cart/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // You might want to update cart count here
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function wishlist(productId) {
    alert('Fitur wishlist akan segera hadir!');
}
</script>

<?php echo $this->endSection(); ?>
