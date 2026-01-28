<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
<?= $title ?? 'Projects' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h1>Proyek Kami</h1>
        <p class="lead">Lihat portfolio proyek-proyek sukses yang telah kami selesaikan</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">HVAC Contact System</h5>
                <p class="card-text">Sistem kontak dan koordinasi HVAC yang terintegrasi untuk kemudahan komunikasi dengan teknisi kami.</p>
                <a href="/proyek/hvac-contact" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Proyek Lainnya</h5>
                <p class="card-text">Kami terus mengembangkan solusi inovatif untuk kebutuhan HVAC dan sistem pendingin udara Anda.</p>
                <a href="/hubungi-kami" class="btn btn-outline-primary">Konsultasi Gratis</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5>Ingin Bergabung?</h5>
            </div>
            <div class="card-body">
                <p>Jika Anda memiliki proyek HVAC yang memerlukan expertise kami, hubungi tim kami untuk diskusi lebih lanjut.</p>
                <a href="/hubungi-kami" class="btn btn-primary">Hubungi Kami</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
