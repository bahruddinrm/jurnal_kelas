<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <form action="">
                    <div class="form-group">
                        <label for="kelas" class="col-sm-12">Pilih Kelas<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="kelas" id="kelas">
                                <option selected disabled>Pilih Kelas</option>
                                <option value="vii_a">VII A</option>
                                <option value="vii_b">VII B</option>
                                <option value="vii_c">VII C</option>
                                <option value="vii_d">VII D</option>
                                <option value="vii_e">VII E</option>
                                <option value="vii_f">VII F</option>
                                <option value="vii_g">VII G</option>
                                <option value="viii_a">VIII A</option>
                                <option value="viii_b">VIII B</option>
                                <option value="viii_c">VIII C</option>
                                <option value="viii_d">VIII D</option>
                                <option value="viii_e">VIII E</option>
                                <option value="viii_f">VIII F</option>
                                <option value="viii_g">VIII G</option>
                                <option value="ix_a">IX A</option>
                                <option value="ix_b">IX B</option>
                                <option value="ix_c">IX C</option>
                                <option value="ix_d">IX D</option>
                                <option value="ix_e">IX E</option>
                                <option value="ix_f">IX F</option>
                                <option value="ix_g">IX G</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px; margin-left: 14px;">Jurnal Kelas</h2>
                <form class="form-horizontal form-material" action="/admin/simpan_pengguna" method="post">
                    <div class="form-group">
                        <label class="col-md-12" for="kelas">Kelas<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hari_tanggal" class="col-md-12">Hari, Tanggal</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam_ke" class="col-md-12">Jam Ke</label>
                        <div class="checkbox-float" style="float: left; width: 50%; padding-left: 20px;">
                            <?php for ($i = 1; $i <= 4; $i++) : ?>
                                <input type="checkbox" name="jam_ke<?= $i ?>" id="jam_ke<?= $i ?>" value="1">
                                <label for="jam_ke<?= $i ?>"><?= $i ?></label></Br>
                            <?php endfor ?>
                        </div>
                        <div class="checkbox-float" style="float: left; width: 50%;">
                            <?php for ($i = 5; $i <= 8; $i++) : ?>
                                <input type="checkbox" name="jam_ke<?= $i ?>" id="jam_ke<?= $i ?>" value="1">
                                <label for="jam_ke<?= $i ?>"><?= $i ?></label></Br>
                            <?php endfor ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mapel" class="col-sm-12">Mapel</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="mapel" id="mapel">
                                <option selected disabled>Pilih salah satu</option>
                                <?php foreach ($id_mapel as $im) : ?>
                                    <option value="<?= $im['id_mapel'] ?>"><?= $im['id_mapel'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uraian_materi" class="col-md-12">Uraian Materi<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="uraian_materi" name="uraian_materi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="media_pembelajaran" class="col-md-12">Media Pembelajar<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="status" id="status" onchange="aktif()">
                                <option selected disabled>Pilih salah satu</option>
                                <option value="buku_paket">Buku Paket</option>
                                <option value="pembelajaran_lisan">Pembelajaran Lisan</option>
                                <option value="diskusi">Diskusi</option>
                            </select>
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
                                <label for="sakit" class="col-md-12">Sakit<span class="required-symbol">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="sakit" name="sakit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="ijin" class="col-md-12">Ijin<span class="required-symbol">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="ijin" name="ijin" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="alpa" class="col-md-12">Alpa<span class="required-symbol">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="alpa" name="alpa" required>
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
                        <label for="nama_siswa_tidak_hadir" class="col-md-12">Nama Siswa Tidak Hadir<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_siswa_tidak_hadir" name="nama_siswa_tidak_hadir" required>
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
</div>

<?= $this->endSection(); ?>