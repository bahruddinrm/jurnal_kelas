<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

<style>
    .hidden {
        display: none;
    }
</style>

<!-- PILIH KELAS -->
<form action="/guru/simpan_jurnal" method="post">

    <div class="row" id="jurnal">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h2 style="margin-bottom: 20px; margin-left: 14px;">Jurnal Kelas <?= esc($nama_kelas) ?></h2>
                    <div class="form-group" hidden>
                        <label for="nama_kelas" class="col-md-12">kelas<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= esc($kelas); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="hari_tanggal">Hari, Tanggal<span class="required-symbol">*</span></label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam_ke" class="col-md-12">Jam Ke<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="jam_ke" id="jam_ke" required>
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
                    </div>
                    <div class="form-group" hidden>
                        <label for="nama_lengkap" class="col-md-12">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= esc($idNama); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap" class="col-md-12">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="" name="" value="<?= esc($nama_lengkap); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <label for="mapel" class="col-md-12">Mapel<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="mapel" name="mapel" value="<?= esc($idMapel); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mapel" class="col-md-12">Mapel<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="" name="" value="<?= esc($mapel); ?>" readonly>
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