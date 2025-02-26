<?= $this->extend('layout/template_kepsek'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <form action="/kepsek/lihat_jurnal_kelas" method="post" id="form_pilih_kelas">
                    <div class="row">
                        <!-- Bagian Pengguna -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pilih_kelas">Pilih Kelas<span class="required-symbol">*</span></label>
                                <select class="form-control" name="pilih_kelas" id="pilih_kelas">
                                    <option selected disabled>Pilih Kelas</option>
                                    <?php foreach ($kelas as $k) : ?>
                                        <option value="<?= $k['id_kelas']; ?>" <?= ($k['id_kelas'] == session()->get('pilih_kelas')) ? 'selected' : ''; ?>> <?= $k['nama_kelas']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <!-- Bagian Tanggal -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pilih_bulan">Pilih Bulan<span class="required-symbol">*</span></label>
                                <select class="form-control" id="pilih_bulan" name="pilih_bulan" required>
                                    <option selected disabled>Pilih Bulan</option>
                                    <?php foreach ($bulan as $b) : ?>
                                        <option value="<?= $b['id_bulan']; ?>" <?= ($b['id_bulan'] == session()->get('pilih_bulan')) ? 'selected' : ''; ?>><?= $b['nama_bulan']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <!-- Bagian Tahun -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pilih_tahun">Pilih Tahun<span class="required-symbol">*</span></label>
                                <select class="form-control" id="pilih_tahun" name="pilih_tahun" required>
                                    <option selected disabled>Pilih Tahun</option>
                                    <?php for ($tahun = 2023; $tahun <= 2026; $tahun++): ?>
                                        <option value="<?= $tahun; ?>" <?= ($tahun == session()->get('pilih_tahun')) ? 'selected' : ''; ?>><?= $tahun; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="margin-left: -15px;">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row" id="jurnal_kelas">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">
                <h3 class="card-title" style="margin-bottom: 30px;">JURNAL KELAS <?= esc($nama_kelas); ?> </h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">HARI, TANGGAL</th>
                                <th scope="col">JAM KE</th>
                                <th scope="col">MAPEL</th>
                                <th scope="col">GURU YANG MENGAJAR</th>
                                <th scope="col">JUMLAH HADIR</th>
                                <th scope="col">JUMLAH SAKIT</th>
                                <th scope="col">JUMLAH IJIN</th>
                                <th scope="col">JUMLAH ALPA</th>
                                <th scope="col">NAMA SISWA TIDAK HADIR</th>
                                <th scope="col">URAIAN MATERI</th>
                                <th scope="col">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jurnal as $j) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $j['hari_tanggal']; ?></td>
                                    <td><?= $j['jam_ke']; ?></td>
                                    <td><?= $j['nama_mapel']; ?></td>
                                    <td><?= $j['nama_lengkap']; ?></td>
                                    <td><?= $j['jumlah_hadir']; ?></td>
                                    <td><?= $j['jumlah_sakit']; ?></td>
                                    <td><?= $j['jumlah_ijin']; ?></td>
                                    <td><?= $j['jumlah_alpa']; ?></td>
                                    <td><?= $j['nama_siswa_absen']; ?></td>
                                    <td><?= $j['uraian_materi']; ?></td>
                                    <td><?= $j['keterangan']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- <a href="/guru/downloadJurnalKelas" class="btn btn-success">Download Jurnal Kelas</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>