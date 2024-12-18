<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px; margin-left: 14px;">Input Pembelajaran</h2>
                <form class="form-horizontal form-material" action="/admin/simpan_pembelajaran" method="post">
                    <div class="form-group">
                        <label for="pengguna" class="col-md-12">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <select class="form-control" name="pengguna" id="pengguna">
                                <option selected disabled>Pilih Pengguna</option>
                                <?php foreach ($pengguna as $p) : ?>
                                    <option value="<?= $p['id_pengguna'] ?>">
                                        <?= $p['nama_lengkap'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mapel" class="col-md-12">Mapel<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <select class="form-control" name="mapel" id="mapel">
                                <option selected disabled>Pilih Mapel</option>
                                <?php foreach ($mapel as $m) : ?>
                                    <option value="<?= $m['id_mapel'] ?>">
                                        <?= $m['nama_mapel'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas" class="col-md-12">Nama Kelas<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <select class="form-control" name="kelas" id="kelas">
                                <option selected disabled>Pilih Kelas</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id_kelas'] ?>">
                                        <?= $k['nama_kelas'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/admin/pembelajaran" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<?= $this->endSection(); ?>