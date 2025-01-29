<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<style>
    .required-symbol {
        color: red;
    }
</style>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">

                <h2 style="margin-bottom: 20px;">Edit Pengguna</h2>
                <form action="<?= base_url('admin/update_pengguna/' . $detail['id_pengguna']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="row mb-3">
                        <label for="nip_nik" class="col-sm-3 col-form-label">NIP / NIK<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip_nik" name="nip_nik" value="<?= $detail['nip_nik']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $detail['nama_lengkap']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-3 col-form-label">Username<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $detail['username']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="password" name="password" value="<?= $detail['password']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $detail['jabatan']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="signature_file" class="col-sm-3 col-form-label">Tanda Tangan</label>
                        <div class="col-sm-9">
                            <?php if (!empty($detail['ttd']) && file_exists('ttd/' . $detail['ttd'])): ?>
                                <img id="signature-preview" src="<?= base_url('ttd/' . $detail['ttd']); ?>" alt="Tanda Tangan" style="width: 150px; height: 75px; margin-bottom: 10px;">
                            <?php else: ?>
                                <p><em>Belum ada tanda tangan.</em></p>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="signature_file" name="signature_file" accept="image/png">
                            <small class="form-text text-muted">Unggah file PNG. Biarkan kosong jika tidak ingin mengubah tanda tangan.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/admin/pengguna" class="btn btn-danger float-right">Batal</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>