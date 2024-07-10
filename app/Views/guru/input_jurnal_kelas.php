<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

<style>
    .required-symbol {
        color: red;
    }
    .hidden{
        display: none;
    }
</style>

<!-- PILIH KELAS -->
<form action="/guru/simpan_jurnal" method="post">

    <div class="row" id="jurnal">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h2 style="margin-bottom: 20px; margin-left: 14px;">Jurnal Kelas <?= $pilih_kelas ?></h2>
                    <div class="form-group hidden">
                        <label for="kelas" class="col-md-12">kelas<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $pilih_kelas; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="hari_tanggal">Hari, Tanggal<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam_ke" class="col-md-12">Jam Ke</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="jam_ke" id="jam_ke">
                                <option value="" selected disabled>Pilih Jam Pelajaran Ke</option>
                                <option value="1-2">1-2</option>
                                <option value="1-3">1-3</option>
                                <option value="2-3">2-3</option>
                                <option value="2-4">2-4</option>
                                <option value="3-4">3-4</option>
                                <option value="3-5">3-5</option>
                                <option value="4-5">4-5</option>
                                <option value="4-6">4-6</option>
                                <option value="5-6">5-6</option>
                                <option value="5-7">5-7</option>
                                <option value="6-7">6-7</option>
                                <option value="6-8">6-8</option>
                            </select>
                        </div>
                        <!-- <div class="checkbox-float" style="float: left; width: 50%; padding-left: 20px;">
                            < ?php for ($i = 1; $i <= 4; $i++) : ?>
                                <input type="checkbox" id="jam_ke< ?= $i ?>" name="jam_ke[]" value="jam_ke< ?= $i ?>">
                                <label for="jam_ke< ?= $i ?>">< ?= $i ?></label></Br>
                            < ?php endfor; ?> 
                        </div> -->
                        <!-- <div class="checkbox-float" style="float: left; width: 50%;">
                            < ?php for ($i = 5; $i <= 8; $i++) : ?>
                                <input type="checkbox" class="form-control" id="jam_ke< ?= $i ?>" name="jam_ke[]" value="jam_ke< ?= $i ?>">
                                <label for="jam_ke< ?= $i ?>">< ?= $i ?></label></Br>
                            < ?php endfor ?>
                        </div> -->
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap" class="col-md-12">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mapel" class="col-md-12">Mapel<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="mapel" name="mapel" value="<?= $user_mapel; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uraian_materi" class="col-md-12">Uraian Materi<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="uraian_materi" name="uraian_materi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="media_pembelajaran" class="col-md-12">Media Pembelajaran<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="media_pembelajaran" name="media_pembelajaran" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="hadir" class="col-md-12">Hadir<span class="required-symbol">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="hadir" name="hadir" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="sakit" class="col-md-12">Sakit</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="sakit" name="sakit">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="ijin" class="col-md-12">Ijin</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="ijin" name="ijin">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="alpa" class="col-md-12">Alpa</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="alpa" name="alpa">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="jumlah" class="col-md-12">Jumlah<span class="required-symbol">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa_tidak_hadir" class="col-md-12">Nama Siswa Tidak Hadir</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_siswa_tidak_hadir" name="nama_siswa_tidak_hadir">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/guru/jurnal_kelas" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>