<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<!-- Contact Header -->
<section class="page-header py-5 bg-light">
    <div class="container">
        <h1 class="display-5">Hubungi Kami</h1>
        <p class="lead text-muted">Kami siap membantu Anda dengan pertanyaan atau layanan apapun</p>
    </div>
</section>

<!-- Contact Content -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h3 class="mb-4">Informasi Kontak</h3>
                
                <div class="mb-4">
                    <h6 class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i> Alamat</h6>
                    <p class="text-muted">Jl. Merdeka No. 123<br>Jakarta Selatan, 12345<br>Indonesia</p>
                </div>

                <div class="mb-4">
                    <h6 class="mb-2"><i class="bi bi-telephone text-primary me-2"></i> Telepon</h6>
                    <p class="text-muted">
                        <a href="tel:+621234567890" class="text-decoration-none">+62 (123) 456-7890</a><br>
                        <a href="tel:+621234567891" class="text-decoration-none">+62 (123) 456-7891</a>
                    </p>
                </div>

                <div class="mb-4">
                    <h6 class="mb-2"><i class="bi bi-envelope text-primary me-2"></i> Email</h6>
                    <p class="text-muted">
                        <a href="mailto:info@acpedia.com" class="text-decoration-none">info@acpedia.com</a><br>
                        <a href="mailto:support@acpedia.com" class="text-decoration-none">support@acpedia.com</a>
                    </p>
                </div>

                <div class="mb-4">
                    <h6 class="mb-2"><i class="bi bi-clock text-primary me-2"></i> Jam Operasional</h6>
                    <p class="text-muted">
                        Senin - Jumat: 08:00 - 17:00<br>
                        Sabtu: 09:00 - 15:00<br>
                        Minggu: Tutup
                    </p>
                </div>

                <div class="mb-4">
                    <h6 class="mb-3">Follow Us</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <h3 class="mb-4">Formulir Kontak</h3>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="post" action="/hubungi-kami" class="row g-3">
                    <?php echo csrf_field(); ?>

                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Nama Lengkap*</label>
                        <input type="text" class="form-control <?php echo isset($validation) && $validation->hasError('full_name') ? 'is-invalid' : ''; ?>" 
                               id="full_name" name="full_name" value="<?php echo old('full_name'); ?>" required>
                        <?php if(isset($validation) && $validation->hasError('full_name')): ?>
                            <div class="invalid-feedback"><?php echo $validation->getError('full_name'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" class="form-control <?php echo isset($validation) && $validation->hasError('email') ? 'is-invalid' : ''; ?>" 
                               id="email" name="email" value="<?php echo old('email'); ?>" required>
                        <?php if(isset($validation) && $validation->hasError('email')): ?>
                            <div class="invalid-feedback"><?php echo $validation->getError('email'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo old('phone_number'); ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                        <input type="tel" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?php echo old('whatsapp_number'); ?>">
                    </div>

                    <div class="col-12">
                        <label for="subject" class="form-label">Subjek*</label>
                        <input type="text" class="form-control <?php echo isset($validation) && $validation->hasError('subject') ? 'is-invalid' : ''; ?>" 
                               id="subject" name="subject" value="<?php echo old('subject'); ?>" required>
                        <?php if(isset($validation) && $validation->hasError('subject')): ?>
                            <div class="invalid-feedback"><?php echo $validation->getError('subject'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="message" class="form-label">Pesan*</label>
                        <textarea class="form-control <?php echo isset($validation) && $validation->hasError('message') ? 'is-invalid' : ''; ?>" 
                                  id="message" name="message" rows="5" required><?php echo old('message'); ?></textarea>
                        <?php if(isset($validation) && $validation->hasError('message')): ?>
                            <div class="invalid-feedback"><?php echo $validation->getError('message'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg">Kirim Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection(); ?>
