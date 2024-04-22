<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<style>
    .required-symbol {
        color: red;
    }
</style>

<script>
    function aktif() {
        var status = document.getElementById("status").value;
        var mapel = document.getElementById("mapel");

        if (status === "guru") {
            mapel.disabled = false;
        } else {
            mapel.disabled = true;
        }
    }
</script>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px; margin-left: 14px;">Input Pengguna</h2>
                <form class="form-horizontal form-material" action="/admin/simpan_pengguna" method="post">
                    <div class="form-group">
                        <label class="col-md-12" for="nik">NIK<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nip" class="col-md-12">NIP</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nip" name="nip">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-md-12">Username<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-12">Password<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap" class="col-md-12">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-12">Status<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status" id="status" onchange="aktif()">
                                <option selected disabled>Pilih salah satu</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="kepsek">Kepala Sekolah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mapel" class="col-sm-12">Mapel</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="mapel" id="mapel" disabled>
                                <option selected disabled>Pilih salah satu</option>
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
                            <a href="/admin/pengguna" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<?= $this->endSection(); ?>