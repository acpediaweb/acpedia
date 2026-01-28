<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
<?= $title ?? 'HVAC Contact' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <h1>HVAC Contact System</h1>
        <p class="lead">Sistem Koordinasi dan Kontak HVAC Profesional</p>
        
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5>Tentang Project</h5>
            </div>
            <div class="card-body">
                <p>Proyek ini dirancang untuk memudahkan komunikasi dan koordinasi antara pelanggan dengan tim teknisi HVAC kami.</p>
                <p>Dengan sistem HVAC Contact, Anda dapat:</p>
                <ul>
                    <li>Menghubungi teknisi HVAC profesional dengan mudah</li>
                    <li>Melacak status perbaikan dan perawatan sistem Anda</li>
                    <li>Mendapatkan konsultasi dari expert HVAC</li>
                    <li>Menjadwalkan appointment dengan tim kami</li>
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5>Fitur Utama</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>📞 Direct Contact</h6>
                        <p>Hubungi teknisi kami secara langsung melalui sistem chat terintegrasi</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>📅 Appointment Scheduling</h6>
                        <p>Jadwalkan layanan pemasangan, perawatan, atau perbaikan dengan mudah</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>📋 Service Tracking</h6>
                        <p>Pantau status pekerjaan HVAC Anda secara real-time</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>💬 Expert Consultation</h6>
                        <p>Dapatkan saran dari expert HVAC untuk kebutuhan Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5>Hubungi Kami Sekarang</h5>
            </div>
            <div class="card-body">
                <p>Siap membantu kebutuhan HVAC Anda?</p>
                <a href="/form-hvac" class="btn btn-success w-100 mb-2">Hubungi via Form</a>
                <a href="/hubungi-kami" class="btn btn-outline-success w-100">Kirim Pesan</a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h5>Layanan Terkait</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><a href="/layanan/pemasangan">▸ Layanan Pemasangan</a></li>
                    <li><a href="/layanan/perawatan">▸ Layanan Perawatan</a></li>
                    <li><a href="/layanan/perbaikan">▸ Layanan Perbaikan</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
