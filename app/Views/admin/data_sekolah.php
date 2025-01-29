<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px;">Data Sekolah</h2>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>
                <form action="/admin/simpan_data_sekolah" method="post">
                    <?php foreach ($detail as $sekolah): ?>
                        <input type="hidden" name="id" value="<?= $sekolah['id']; ?>">
                        <div class="row mb-3">
                            <label for="nama_sekolah" class="col-sm-3 col-form-label">Nama Sekolah<span class="required-symbol">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?= $sekolah['nama_sekolah']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat_sekolah" class="col-sm-3 col-form-label">Alamat Sekolah<span class="required-symbol">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" value="<?= $sekolah['alamat_sekolah']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kepala_sekolah" class="col-sm-3 col-form-label">Kepala Sekolah<span class="required-symbol">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kepala_sekolah" name="kepala_sekolah" value="<?= $nama_ks; ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nip" class="col-sm-3 col-form-label">NIP<span class="required-symbol">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nip" name="nip" value="<?= $nip_ks; ?>" readonly>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>