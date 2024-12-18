<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

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
                                <?php foreach ($kelas as $nk) : ?>
                                    <option value="<?= $nk['id_kelas']; ?>" <?= ($nk['id_kelas'] == session()->get('kelas')) ? 'selected' : ''; ?>><?= $nk['nama_kelas']; ?>
                                    <?php endforeach ?>
                            </select>
                        </div>
                    </div>
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

                <h3 class="card-title" style="margin-bottom: 30px;">JURNAL KELAS <?= esc($nama_kelas) ?></h3>
                <!-- <a href="/guru/tambah_jurnal" class="btn-sm btn-warning" title="isi jurnal kelas">Isi Jurnal Kelas</a> -->
                <a href="/guru/tambah_jurnal" id="btn-isi-jurnal" class="btn-sm btn-warning" title="Isi Jurnal Kelas" disabled>
                    Isi Jurnal Kelas
                </a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">KELAS</th>
                                <th scope="col">HARI, TANGGAL</th>
                                <th scope="col">JAM KE</th>
                                <th scope="col">MAPEL</th>
                                <th scope="col">URAIAN MATERI</th>
                                <th scope="col">MEDIA PEMBELAJARAN</th>
                                <!-- <th scope="col">HADIR</th>
                                <th scope="col">SAKIT</th>
                                <th scope="col">IJIN</th>
                                <th scope="col">ALPA</th>
                                <th scope="col">JUMLAH</th>
                                <th scope="col">NAMA SISWA TIDAK HADIR</th> -->
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jurnal as $j) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $j['nama_kelas']; ?></td>
                                    <td><?= $j['hari_tanggal']; ?></td>
                                    <td><?= $j['jam_ke']; ?></td>
                                    <td><?= $j['mapel']; ?></td>
                                    <td><?= $j['uraian_materi']; ?></td>
                                    <td><?= $j['media_pembelajaran']; ?></td>
                                <!-- < ?php endforeach ?> 
                                < ?php foreach ($jumlah_presensi as $jp) : ?>
                                    <td>< ?= $jp['hadir']; ?></td>
                                    <td>< ?= $jp['sakit']; ?></td>
                                    <td>< ?= $jp['ijin']; ?></td>
                                    <td>< ?= $jp['alpa']; ?></td>
                                    <td>< ?= $jp['jumlah']; ?></td>
                                    <td>< ?= $jp['nama_siswa_tidak_hadir']; ?></td> -->
                                    <td>
                                        <button class="btn-sm btn-danger btn-delete"
                                            data-id="<?= $j['jurnal_id']; ?>"
                                            data-url="/guru/hapus_jurnal/<?= $j['jurnal_id']; ?>"
                                            title="Hapus">
                                            <i class='bx bx-message-alt-x'></i>
                                        </button>
                                    </td>
                                <!-- </tr>  -->
                             <?php endforeach ?> 
                        </tbody>
                    </table>
                    <!-- < ?= $pager->links('user_pagination', 'user_pagination'); ?> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert ketika berhasil menginput jurnal -->
<script>
    // SweetAlert untuk pesan sukses
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success'); ?>',
        });
    <?php endif; ?>

    // SweetAlert untuk pesan error
    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error'); ?>',
        });
    <?php endif; ?>
</script>

<!-- SweetAlert ketika ingin menghapus data -->
<script>
    // SweetAlert untuk konfirmasi penghapusan
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah aksi default tombol

                const url = this.getAttribute('data-url'); // URL untuk hapus data
                const id = this.getAttribute('data-id'); // ID data yang akan dihapus

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Data akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke URL untuk menghapus data
                        window.location.href = url;
                    }
                });
            });
        });
    });

    // SweetAlert untuk pesan flashdata
    <?php if (session()->getFlashdata('delete')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('delete'); ?>',
        });
    <?php endif; ?>
</script>

<!-- JavaScript untuk menampilkan jurnal sesuai dengan kelas yang dipilih -->
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