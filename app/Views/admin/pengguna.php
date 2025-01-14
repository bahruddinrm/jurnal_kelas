<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title" style="margin-bottom: 30px; margin-top: 10px; font-size: 36px; font-weight: bold;">Daftar Pengguna</h4>

                <a href="/admin/tambah_pengguna" class="btn-sm btn-warning" title="tambah pengguna" style="font-size: 14px;">Tambah Pengguna</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIP / NIK</th>
                                <th scope="col">NAMA LENGKAP</th>
                                <th scope="col">JABATAN</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($user_pengguna as $up) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $up['nip_nik']; ?></td>
                                    <td><?= $up['nama_lengkap']; ?></td>
                                    <td><?= $up['jabatan']; ?></td>
                                    <td>
                                        <a href="/admin/detail_pengguna/<?= $up['id_pengguna']; ?>" title="detail" class="btn-sm btn-success"><i class='bx bx-detail'></i></a>
                                        <a href="/admin/edit_pengguna/<?= $up['id_pengguna']; ?>" title="edit" class="btn-sm btn-warning"><i class='bx bx-edit'></i></a>
                                        <a href="#" class="btn-sm btn-danger" title="delete" onclick="confirmDelete(<?= $up['id_pengguna']; ?>, '<?= $up['nama_lengkap']; ?>')">
                                            <i class='bx bx-message-alt-x'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- < ?= $pager->links('pengguna_pagination', 'pengguna_pagination'); ?> -->
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
                window.location.href = '/admin/delete_pengguna/' + id;
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