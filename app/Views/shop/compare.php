<?= $this->extend('layouts/shop') ?>

<?= $this->section('title') ?>
<?= $title ?? 'Compare Products' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h1>Bandingkan Produk</h1>
        <p class="lead">Bandingkan spesifikasi dan harga produk untuk membuat keputusan terbaik</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-info">
            <strong>Tip:</strong> Pilih produk dari toko kami untuk membandingkan fitur, harga, dan spesifikasi secara langsung.
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center">
                <p class="text-muted">Belum ada produk yang dipilih untuk dibandingkan.</p>
                <a href="/toko-kami" class="btn btn-primary">Lihat Katalog Produk</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
