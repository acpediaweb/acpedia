<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
<?= $title ?? 'Service Detail' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1><?= ucfirst($service['name']) ?></h1>
        <p class="lead">Layanan profesional <?= strtolower($service['name']) ?> dari ACPedia</p>
        
        <div class="card mt-4">
            <div class="card-body">
                <?php if ($service['slug'] === 'pemasangan'): ?>
                    <h5>Layanan Pemasangan HVAC</h5>
                    <p>Kami menyediakan layanan pemasangan sistem HVAC (Heating, Ventilation, and Air Conditioning) yang profesional dan berpengalaman.</p>
                    <ul>
                        <li>Pemasangan AC Central</li>
                        <li>Pemasangan Split Air</li>
                        <li>Pemasangan Sistem Ventilasi</li>
                        <li>Konsultasi Layout dan Desain</li>
                    </ul>
                    <p class="mt-3"><a href="/form-hvac" class="btn btn-primary">Hubungi untuk Pemasangan</a></p>
                <?php elseif ($service['slug'] === 'perawatan'): ?>
                    <h5>Layanan Perawatan HVAC</h5>
                    <p>Perawatan berkala untuk menjaga performa optimal sistem HVAC Anda.</p>
                    <ul>
                        <li>Pembersihan Filter</li>
                        <li>Inspeksi Sistem</li>
                        <li>Penggantian Refrigerant</li>
                        <li>Maintenance Berkala</li>
                    </ul>
                    <p class="mt-3"><a href="/form-hvac" class="btn btn-primary">Jadwalkan Perawatan</a></p>
                <?php elseif ($service['slug'] === 'perbaikan'): ?>
                    <h5>Layanan Perbaikan HVAC</h5>
                    <p>Layanan perbaikan cepat dan tepat untuk masalah HVAC Anda.</p>
                    <ul>
                        <li>Diagnosis Kerusakan</li>
                        <li>Perbaikan Kompressor</li>
                        <li>Perbaikan Refrigerant Leak</li>
                        <li>Perbaikan Electrical System</li>
                    </ul>
                    <p class="mt-3"><a href="/form-hvac" class="btn btn-primary">Hubungi untuk Perbaikan</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Butuh Bantuan?</h5>
            </div>
            <div class="card-body">
                <p>Hubungi tim profesional kami untuk konsultasi gratis.</p>
                <a href="/hubungi-kami" class="btn btn-outline-primary w-100 mb-2">Kirim Pesan</a>
                <a href="/form-hvac" class="btn btn-primary w-100">Hubungi via Form</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
