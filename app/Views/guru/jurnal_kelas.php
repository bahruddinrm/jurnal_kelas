<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

<style>
    .required-symbol {
        color: red;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <form action="/guru/jurnal_kelas" method="post" id="form_pilih_kelas">
                    <div class="form-group">
                        <label for="pilih_kelas" class="col-sm-12">Pilih Kelas<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="pilih_kelas" id="pilih_kelas">
                                <option selected disabled>Pilih Kelas</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['nama_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <!-- <button class="btn btn-primary" type="submit">tampilkan</button> -->


                </form>
            </div>
        </div>
    </div>
</div>

<!-- < ?php if (isset($pilih_kelas)) : ?> -->
<!-- < ?php endif ?> -->

<div class="row" id="jurnal">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">

                <h3 class="card-title" style="margin-bottom: 30px;">JURNAL KELAS <?= $pilih_kelas ?></h3>
                <a href="/guru/tambah_jurnal" class="btn-sm btn-warning" title="isi jurnal kelas">Isi Jurnal Kelas</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">KELAS</th>
                                <th scope="col">HARI, TANGGAL</th>
                                <th scope="col">JAM KE</th>
                                <th scope="col">MAPEL</th>
                                <th scope="col">URAIAN MATERI</th>
                                <th scope="col">MEDIA PEMBELAJARAN</th>
                                <th scope="col">HADIR</th>
                                <th scope="col">SAKIT</th>
                                <th scope="col">IJIN</th>
                                <th scope="col">ALPA</th>
                                <th scope="col">JUMLAH</th>
                                <th scope="col">NAMA SISWA TIDAK HADIR</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jurnal as $j) : ?>
                                <tr>
                                    <td><?= $j['kelas']; ?></td>
                                    <td><?= $j['hari_tanggal']; ?></td>
                                    <td><?= $j['jam_ke']; ?></td>
                                    <td><?= $j['mapel']; ?></td>
                                    <td><?= $j['uraian_materi']; ?></td>
                                    <td><?= $j['media_pembelajaran']; ?></td>
                                    <td><?= $j['hadir']; ?></td>
                                    <td><?= $j['sakit']; ?></td>
                                    <td><?= $j['ijin']; ?></td>
                                    <td><?= $j['alpa']; ?></td>
                                    <td><?= $j['jumlah']; ?></td>
                                    <td><?= $j['nama_siswa_tidak_hadir']; ?></td>
                                    <td>
                                        <a href="/guru/hapus_jurnal/<?= $j['jurnal_id']; ?>" title="delete" class="btn-sm btn-danger" onclick="return confirm('<?= $j['jurnal_id']; ?> akan terhapus secara permanen')"><i class='bx bx-message-alt-x'></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- < ?= $pager->links('user_pagination', 'user_pagination'); ?> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('pilih_kelas').addEventListener('change', function() {
        document.getElementById('form_pilih_kelas').submit();
    })

    document.addEventListener('DOMContentLoaded', function() {
        var pilih_kelas = document.getElementById("pilih_kelas");
        var jurnal = document.getElementById("jurnal");

        pilih_kelas.addEventListener('change', function() {
            if (this.value) {
                jurnal.classList.remove("hidden");
            } else {
                jurnal.classList.add("hidden");
            }
        })
    });
</script>

<?= $this->endSection(); ?>