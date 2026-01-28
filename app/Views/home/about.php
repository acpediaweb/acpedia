<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<!-- About Header -->
<section class="page-header py-5 bg-light">
    <div class="container">
        <h1 class="display-5">Tentang ACPedia</h1>
        <p class="lead text-muted">Mitra terpercaya Anda dalam solusi sistem pendingin</p>
    </div>
</section>

<!-- About Content -->
<section class="about-section py-5">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="mb-4">Tentang Kami</h2>
                <p class="mb-3">ACPedia adalah perusahaan terkemuka dalam industri HVAC (Heating, Ventilation, and Air Conditioning) di Indonesia. Dengan pengalaman lebih dari 10 tahun, kami telah melayani ribuan pelanggan kepribadian dan korporat.</p>
                <p class="mb-3">Kami berkomitmen untuk memberikan solusi HVAC terbaik dengan kualitas premium, harga kompetitif, dan layanan purna jual yang memuaskan.</p>
                <p>Misi kami adalah menciptakan lingkungan yang nyaman dan sehat melalui teknologi HVAC terdepan dan tim profesional yang berdedikasi.</p>
            </div>
            <div class="col-lg-6">
                <img src="/images/about-us.jpg" alt="ACPedia Team" class="img-fluid rounded">
            </div>
        </div>

        <!-- Values Section -->
        <div class="row g-4 my-5">
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-heart fs-2 text-primary mb-3"></i>
                    <h5>Dedikasi</h5>
                    <p>Kami berdedikasi penuh untuk kepuasan pelanggan dalam setiap layanan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-star fs-2 text-primary mb-3"></i>
                    <h5>Kualitas</h5>
                    <p>Standar kualitas internasional dalam setiap produk dan layanan kami.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="bi bi-shield-check fs-2 text-primary mb-3"></i>
                    <h5>Integritas</h5>
                    <p>Transparansi dan kejujuran adalah fondasi bisnis kami.</p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <hr class="my-5">
        <h2 class="text-center mb-5">Tim Kami</h2>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <img src="/images/team-1.jpg" alt="Team Member" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                <h5>Budi Santoso</h5>
                <p class="text-muted">Direktur Utama</p>
                <p class="small">Spesialis HVAC dengan sertifikasi internasional</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/team-2.jpg" alt="Team Member" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                <h5>Siti Nurhaliza</h5>
                <p class="text-muted">Manajer Operasional</p>
                <p class="small">Bertanggung jawab atas kualitas layanan</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/team-3.jpg" alt="Team Member" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                <h5>Ahmad Wijaya</h5>
                <p class="text-muted">Kepala Teknisi</p>
                <p class="small">Supervisor tim teknisi profesional</p>
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection(); ?>
