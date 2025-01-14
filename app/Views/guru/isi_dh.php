<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <form action="/guru/isi_dh" method="post" id="form_dh_kelas">
                    <div class="form-group">
                        <label for="dh_kelas" class="col-sm-12">Pilih Kelas<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="dh_kelas" id="dh_kelas">
                                <option selected disabled>Pilih Kelas</option>
                                <?php foreach ($kelas as $nk) : ?>
                                    <option value="<?= $nk['id_kelas']; ?>" <?= ($nk['id_kelas'] == session()->get('dh_kelas')) ? 'selected' : ''; ?>><?= $nk['nama_kelas']; ?>
                                    <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row" id="daftar_hadir">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">

                <h3 class="card-title" style="margin-bottom: 30px;">ISI DAFTAR HADIR KELAS</h3>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif ?>

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif ?>

                <form action="/guru/simpan_dh" method="post" id="form_tambah_dh">
                    <label for="hari_tanggal" class="col-sm-12">Pilih Tanggal<span class="required-symbol">*</span></label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="hari_tanggal" id="hari_tanggal" required>

                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NAMA LENGKAP</th>
                                    <th scope="col">KELAS</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($dh_siswa as $ds) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++; ?></th>
                                        <td><?= $ds['nama_siswa']; ?></td>
                                        <td><input type="hidden" name="kelas" id="kelas" value="<?= $ds['kelas']; ?>"> <?= isset($ds['nama_kelas']) ? $ds['nama_kelas'] : 'Tidak ada data'; ?></td>
                                        <td>
                                            <select class="form-control" name="siswa[<?= $ds['id_siswa'] ?>]">
                                                <option value="hadir">Hadir</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="ijin">Ijin</option>
                                                <option value="alpa">Alpa</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/guru/daftar_hadir" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('dh_kelas').addEventListener('change', function() {
        document.getElementById('form_dh_kelas').submit();
    })

    document.addEventListener('DOMContentLoaded', function() {
        var dh_kelas = document.getElementById("dh_kelas");
        var daftar_hadir = document.getElementById("daftar_hadir");

        dh_kelas.addEventListener('change', function() {
            if (this.value) {
                daftar_hadir.classList.remove("hidden");
            } else {
                daftar_hadir.classList.add("hidden");
            }
        })
    });
</script>

<?= $this->endSection(); ?>