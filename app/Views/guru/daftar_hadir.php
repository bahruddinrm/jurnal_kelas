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
                                <th scope="col">AKSI</th>
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
                                    <td>
                                        <form id="deleteForm" action="/guru/hapus_dh" method="post">
                                            <input type="hidden" name="id_kelas" value="<?= $jh['id_kelas']; ?>" id="delete_id_kelas">
                                            <input type="hidden" name="tanggal_dh" value="<?= $tanggal_dh; ?>" id="delete_tanggal_dh">
                                            <button type="submit" class="btn btn-danger" onclick="confirmDelete('<?= esc($jh['nama_kelas']); ?>', '<?= esc($tanggal_dh); ?>')"><i class='bx bx-message-alt-x'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
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
    function confirmDelete(namaKelas, tanggalDh) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus daftar hadir untuk kelas ${namaKelas} pada tanggal ${tanggalDh}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika 'Hapus' dipilih, kirim form untuk menghapus
                document.getElementById('deleteForm').submit();
            }
        });
    }

    document.getElementById('tanggal_dh').addEventListener('change', function() {
        document.getElementById('tanggal_dh').submit();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var tanggal_dh = document.getElementById("tanggal_dh");
        var daftar_hadir = document.getElementById("daftar_hadir");

        tanggal_dh.addEventListener('change', function() {
            if (this.value) {
                daftar_hadir.classList.remove("hidden");
            } else {
                daftar_hadir.classList.add("hidden");
            }
        });

        // Mencegah form submit langsung, agar hanya terkirim setelah konfirmasi
        const deleteButton = document.querySelector('.btn-danger');
        deleteButton.addEventListener('click', function(event) {
            event.preventDefault();  // Mencegah pengiriman form langsung
            const namaKelas = this.closest('form').querySelector('input[name="nama_kelas"]').value;
            const tanggalDh = this.closest('form').querySelector('input[name="tanggal_dh"]').value;
            confirmDelete(namaKelas, tanggalDh);
        });
    });
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