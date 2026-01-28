<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<!-- Services Header -->
<section class="page-header py-5 bg-light">
    <div class="container">
        <h1 class="display-5">Layanan Kami</h1>
        <p class="lead text-muted">Solusi HVAC lengkap untuk kebutuhan Anda</p>
    </div>
</section>

<!-- Services Content -->
<section class="services-section py-5">
    <div class="container">
        <div class="row g-5 mb-5">
            <div class="col-lg-6">
                <h2 class="mb-4">Instalasi Sistem HVAC</h2>
                <p class="mb-3">Kami menyediakan layanan instalasi sistem HVAC yang profesional dan sesuai dengan standar internasional. Tim teknisi kami yang berpengalaman akan memastikan sistem Anda terpasang dengan sempurna.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Konsultasi gratis sebelum instalasi</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Instalasi oleh teknisi bersertifikat</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Garansi pekerjaan instalasi</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Pelatihan penggunaan gratis</li>
                </ul>
                <a href="/hubungi-kami" class="btn btn-primary mt-3">Pesan Layanan</a>
            </div>
            <div class="col-lg-6">
                <img src="/images/service-installation.jpg" alt="Installation Service" class="img-fluid rounded">
            </div>
        </div>

        <hr class="my-5">

        <div class="row g-5 mb-5">
            <div class="col-lg-6 order-lg-2">
                <h2 class="mb-4">Pemeliharaan Rutin</h2>
                <p class="mb-3">Layanan pemeliharaan berkala untuk menjaga sistem HVAC Anda tetap berfungsi optimal. Kami menawarkan paket pemeliharaan yang fleksibel sesuai kebutuhan Anda.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Pembersihan filter berkala</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Pemeriksaan komponen lengkap</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Lubrikasi mesin dan motor</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Laporan pemeliharaan tertulis</li>
                </ul>
                <a href="/hubungi-kami" class="btn btn-primary mt-3">Daftar Pemeliharaan</a>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="/images/service-maintenance.jpg" alt="Maintenance Service" class="img-fluid rounded">
            </div>
        </div>

        <hr class="my-5">

        <div class="row g-5 mb-5">
            <div class="col-lg-6">
                <h2 class="mb-4">Perbaikan dan Service</h2>
                <p class="mb-3">Sistem HVAC Anda bermasalah? Hubungi tim service kami yang siap memberikan solusi cepat dan terpercaya.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Respons cepat 24/7</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Diagnosis gratis</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Spare part original</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Garansi perbaikan</li>
                </ul>
                <a href="/hubungi-kami" class="btn btn-primary mt-3">Panggil Service</a>
            </div>
            <div class="col-lg-6">
                <img src="/images/service-repair.jpg" alt="Repair Service" class="img-fluid rounded">
            </div>
        </div>

        <hr class="my-5">

        <div class="row g-5 mb-5">
            <div class="col-lg-6 order-lg-2">
                <h2 class="mb-4">Konsultasi HVAC</h2>
                <p class="mb-3">Bingung memilih sistem HVAC yang tepat? Tim ahli kami siap memberikan rekomendasi terbaik untuk kebutuhan spesifik Anda.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Analisis kebutuhan termal</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Rekomendasi sistem optimal</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Perkiraan biaya akurat</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-success me-2"></i> Desain teknis lengkap</li>
                </ul>
                <a href="/form-hvac" class="btn btn-primary mt-3">Minta Konsultasi</a>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="/images/service-consultation.jpg" alt="Consultation Service" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection(); ?>
