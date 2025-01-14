<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title" style="margin-bottom: 30px; margin-top: 10px; font-size: 36px; font-weight: bold;">Siswa</h4>

                <a href="/admin/tambah_siswa" class="btn-sm btn-warning" title="tambah siswa">Tambah Siswa</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NISN</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($siswa as $s) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $s['nisn']; ?></td>
                                    <td><?= $s['nis']; ?></td>
                                    <td><?= $s['nama_siswa']; ?></td>
                                    <td><?= isset($s['nama_kelas']) ? $s['nama_kelas'] : 'Tidak ada data'; ?></td>
                                    <td>
                                        <a href="#" class="btn-sm btn-danger" title="delete" onclick="confirmDelete(<?= $s['id_siswa']; ?>, '<?= $s['nama_siswa']; ?>')">
                                            <i class='bx bx-message-alt-x'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- < ?= $pager->links('siswa_pagination', 'siswa_pagination'); ?> -->
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
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: name + " akan terhapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL penghapusan dengan id
                window.location.href = '/admin/delete_siswa/' + id;
            }
        });
    }
</script>

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

<?= $this->endSection(); ?>