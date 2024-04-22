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
                <form action="/admin/update" method="post">
                    <div class="row mb-3">
                        <label for="nik" class="col-sm-2 col-form-label">NIK<span class="required-symbol">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $detail['nik']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nip" name="nip" value="<?= $detail['nip']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username<span class="required-symbol">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $detail['username']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password<span class="required-symbol">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password" value="<?= $detail['password']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $detail['nama_lengkap']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">Status<span class="required-symbol">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $detail['status']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mapel" class="col-sm-2 col-form-label">Mapel</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="mapel" id="mapel" disabled>
                                <option>Pilih salah satu</option>
                                <?php foreach ($id_mapel as $nm) : ?>
                                    <option value="<?= $nm['id_mapel'] ?>"><?= $nm['id_mapel'] ?></option>
                                <?php endforeach ?>
                            </select>
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
    <!-- Column -->
</div>




<?= $this->endSection(); ?>