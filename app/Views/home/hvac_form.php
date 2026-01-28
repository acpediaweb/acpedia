<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<!-- HVAC Form Header -->
<section class="page-header py-5 bg-light">
    <div class="container">
        <h1 class="display-5">Formulir HVAC</h1>
        <p class="lead text-muted">Isi formulir ini untuk mendapatkan solusi HVAC terbaik dari tim ahli kami</p>
    </div>
</section>

<!-- HVAC Form Content -->
<section class="form-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
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

                        <form method="post" action="/form-hvac" class="row g-3">
                            <?php echo csrf_field(); ?>

                            <div class="col-md-6">
                                <label for="first_name" class="form-label">Nama Depan*</label>
                                <input type="text" class="form-control <?php echo isset($validation) && $validation->hasError('first_name') ? 'is-invalid' : ''; ?>" 
                                       id="first_name" name="first_name" value="<?php echo old('first_name'); ?>" required>
                                <?php if(isset($validation) && $validation->hasError('first_name')): ?>
                                    <div class="invalid-feedback"><?php echo $validation->getError('first_name'); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Nama Belakang*</label>
                                <input type="text" class="form-control <?php echo isset($validation) && $validation->hasError('last_name') ? 'is-invalid' : ''; ?>" 
                                       id="last_name" name="last_name" value="<?php echo old('last_name'); ?>" required>
                                <?php if(isset($validation) && $validation->hasError('last_name')): ?>
                                    <div class="invalid-feedback"><?php echo $validation->getError('last_name'); ?></div>
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

                            <div class="col-12">
                                <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                                <input type="tel" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?php echo old('whatsapp_number'); ?>">
                            </div>

                            <div class="col-12">
                                <label for="subject" class="form-label">Subjek Pertanyaan*</label>
                                <select class="form-select <?php echo isset($validation) && $validation->hasError('subject') ? 'is-invalid' : ''; ?>" 
                                        id="subject" name="subject" required>
                                    <option value="">-- Pilih Subjek --</option>
                                    <option value="Instalasi Sistem Baru" <?php echo old('subject') === 'Instalasi Sistem Baru' ? 'selected' : ''; ?>>Instalasi Sistem Baru</option>
                                    <option value="Perbaikan/Service" <?php echo old('subject') === 'Perbaikan/Service' ? 'selected' : ''; ?>>Perbaikan/Service</option>
                                    <option value="Pemeliharaan" <?php echo old('subject') === 'Pemeliharaan' ? 'selected' : ''; ?>>Pemeliharaan</option>
                                    <option value="Konsultasi" <?php echo old('subject') === 'Konsultasi' ? 'selected' : ''; ?>>Konsultasi</option>
                                    <option value="Upgrade Sistem" <?php echo old('subject') === 'Upgrade Sistem' ? 'selected' : ''; ?>>Upgrade Sistem</option>
                                    <option value="Lainnya" <?php echo old('subject') === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                                <?php if(isset($validation) && $validation->hasError('subject')): ?>
                                    <div class="invalid-feedback d-block"><?php echo $validation->getError('subject'); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label">Deskripsi Kebutuhan*</label>
                                <textarea class="form-control <?php echo isset($validation) && $validation->hasError('message') ? 'is-invalid' : ''; ?>" 
                                          id="message" name="message" rows="6" 
                                          placeholder="Jelaskan kebutuhan HVAC Anda secara detail..." required><?php echo old('message'); ?></textarea>
                                <?php if(isset($validation) && $validation->hasError('message')): ?>
                                    <div class="invalid-feedback d-block"><?php echo $validation->getError('message'); ?></div>
                                <?php endif; ?>
                                <small class="text-muted">Minimal 5 karakter</small>
                            </div>

                            <div class="col-12">
                                <p class="text-muted small mb-3">* Kolom yang bertanda wajib diisi</p>
                                <button type="submit" class="btn btn-primary btn-lg">Kirim Formulir</button>
                                <a href="/" class="btn btn-outline-secondary btn-lg ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-5">
                    <h5 class="mb-4">Informasi Tambahan</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="bi bi-clock fs-2 text-primary mb-2"></i>
                                <h6>Respon Cepat</h6>
                                <p class="text-muted small">Kami akan merespons dalam 24 jam</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="bi bi-shield-check fs-2 text-primary mb-2"></i>
                                <h6>Konsultasi Gratis</h6>
                                <p class="text-muted small">Tanpa biaya untuk konsultasi awal</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="bi bi-person-check fs-2 text-primary mb-2"></i>
                                <h6>Tim Profesional</h6>
                                <p class="text-muted small">Ahli berpengalaman siap membantu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $this->endSection(); ?>
