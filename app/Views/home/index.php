<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<!-- Hero Section -->
<section class="hero-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">ACPedia - Solusi HVAC Terpadu</h1>
                <p class="lead mb-4">Penyedia layanan perawatan, perbaikan, dan penjualan sistem pendingin profesional dengan teknologi terkini.</p>
                <div class="d-flex gap-3">
                    <a href="/toko-kami" class="btn btn-primary btn-lg">Belanja Sekarang</a>
                    <a href="/tentang-kami" class="btn btn-outline-primary btn-lg">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="/images/hero-hvac.jpg" alt="HVAC System" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Mengapa Memilih ACPedia?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <i class="bi bi-tools fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Layanan Profesional</h5>
                    <p class="card-text">Tim teknisi berpengalaman siap melayani kebutuhan HVAC Anda 24/7.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <i class="bi bi-shield-check fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Garansi Terjamin</h5>
                    <p class="card-text">Semua produk dan jasa dilengkapi garansi resmi dan dukungan purna jual.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <i class="bi bi-bag-check fs-1 text-primary mb-3"></i>
                    <h5 class="card-title">Produk Berkualitas</h5>
                    <p class="card-text">Kami menjual produk-produk HVAC dari merek ternama dan terpercaya.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="featured-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Produk Unggulan</h2>
        <div class="row g-4" id="featured-products">
            <!-- Products will be loaded dynamically -->
            <p class="text-center text-muted">Loading produk...</p>
        </div>
        <div class="text-center mt-4">
            <a href="/toko-kami" class="btn btn-primary">Lihat Semua Produk</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Layanan Kami</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <i class="bi bi-wrench fs-1 text-primary mb-3"></i>
                    <h5>Instalasi</h5>
                    <p>Instalasi profesional sistem HVAC dengan standar internasional.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <i class="bi bi-speedometer fs-1 text-primary mb-3"></i>
                    <h5>Pemeliharaan</h5>
                    <p>Layanan perawatan berkala untuk performa optimal sistem Anda.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <i class="bi bi-exclamation-circle fs-1 text-primary mb-3"></i>
                    <h5>Perbaikan</h5>
                    <p>Layanan perbaikan cepat dengan garansi kepuasan pelanggan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <i class="bi bi-clipboard-check fs-1 text-primary mb-3"></i>
                    <h5>Konsultasi</h5>
                    <p>Konsultasi gratis untuk menentukan solusi HVAC terbaik untuk Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-4">Butuh Layanan HVAC?</h2>
        <p class="lead mb-4">Hubungi tim kami untuk konsultasi gratis dan penawaran terbaik.</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="/hubungi-kami" class="btn btn-light">Hubungi Kami</a>
            <a href="/form-hvac" class="btn btn-outline-light">Formulir HVAC</a>
        </div>
    </div>
</section>

<script>
// Load featured products
document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/products?limit=4')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('featured-products');
            if (data.products && data.products.length > 0) {
                container.innerHTML = data.products.map(product => `
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <img src="${product.image_url || '/images/placeholder.jpg'}" class="card-img-top" alt="${product.product_name}">
                            <div class="card-body">
                                <h6 class="card-title">${product.product_name}</h6>
                                <p class="card-text text-muted small">${product.description?.substring(0, 50) || ''}</p>
                                <h5 class="text-primary">Rp ${product.product_price?.toLocaleString('id-ID') || 0}</h5>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="/toko-kami/produk/${product.product_id}" class="btn btn-sm btn-outline-primary w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                `).join('');
            } else {
                container.innerHTML = '<p class="text-center text-muted">Tidak ada produk tersedia</p>';
            }
        })
        .catch(error => console.error('Error loading products:', error));
});
</script>

<?php echo $this->endSection(); ?>
