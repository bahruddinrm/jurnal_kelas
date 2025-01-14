<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <a href="/guru/isi_dh" class="btn btn-warning" title="isi daftar hadir">Isi Daftar Hadir</a>
            </div>
        </div>
    </div>
</div>

<div class="row" id="daftar_hadir">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">

                <h3 class="card-title" style="margin-bottom: 30px;">DAFTAR HADIR</h3>
                <form action="/guru/daftar_hadir" method="post" id="tanggal_dh">
                    <div class="form-group">
                        <label for="tanggal_dh" class="col-sm-12">Pilih Tanggal<span class="required-symbol">*</span></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" name="tanggal_dh" id="tanggal_dh" value="<?= $tanggal_dh; ?>" <?= ($tanggal_dh == session()->get('tanggal_dh')) ? 'selected' : ''; ?>>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">KELAS</th>
                                <th scope="col">HADIR</th>
                                <th scope="col">SAKIT</th>
                                <th scope="col">IJIN</th>
                                <th scope="col">ALPA</th>
                                <!-- <th scope="col">AKSI</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jumlah_hadir as $jh):
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $jh['nama_kelas']; ?></td>
                                    <td><?= $jh['hadir'] ?></td>
                                    <td><?= $jh['sakit'] ?></td>
                                    <td><?= $jh['ijin'] ?></td>
                                    <td><?= $jh['alpa'] ?></td>
                                    <!-- <td>
                                        <a href="/guru/hapus_dh/< ?= $jh['id_daftar_hadir']; ?>" title="delete" class="btn-sm btn-danger" onclick="return confirm('Daftar hadir tanggal < ?= $jh['hari_tanggal']; ?> akan terhapus secara permanen')"><i class='bx bx-message-alt-x'></i></a>
                                    </td> -->
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
    // SweetAlert untuk pesan sukses
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success'); ?>',
        });
    <?php endif; ?>
</script>

<script>
    document.getElementById('tanggal_dh').addEventListener('change', function() {
        document.getElementById('tanggal_dh').submit();
    })

    document.addEventListener('DOMContentLoaded', function() {
        var tanggal_dh = document.getElementById("tanggal_dh");
        var daftar_hadir = document.getElementById("daftar_hadir");

        tanggal_dh.addEventListener('change', function() {
            if (this.value) {
                daftar_hadir.classList.remove("hidden");
            } else {
                daftar_hadir.classList.add("hidden");
            }
        })
    });
</script>

<?= $this->endSection(); ?>