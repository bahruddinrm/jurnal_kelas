<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px; margin-left: 14px;">Input Siswa</h2>
                <form class="form-horizontal form-material" action="/admin/simpan_siswa" method="post">
                    <!-- < ?= csrf_field() ?> -->
                    <div class="form-group">
                        <label for="nisn" class="col-md-12">NISN<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nisn" name="nisn">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nis" class="col-md-12">NIS<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nis" name="nis">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa" class="col-md-12">Nama Siswa<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas" class="col-md-12">Kelas<span class="required-symbol">*</span></label>
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
                            <a href="/admin/siswa" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<?= $this->endSection(); ?>