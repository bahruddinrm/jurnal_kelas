<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title" style="margin-bottom: 30px;">User Pengguna</h4>

                <a href="/admin/tambah_pengguna" class="btn-sm btn-warning" title="tambah pengguna">Tambah Pengguna</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIK</th>
                                <th scope="col">NIP</th>
                                <th scope="col">NAMA LENGKAP</th>
                                <th scope="col">MAPEL</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_pengguna as $up) : ?>
                                <tr>
                                    <td><?= $up['nik']; ?></td>
                                    <td><?= $up['nip']; ?></td>
                                    <td><?= $up['nama_lengkap']; ?></td>
                                    <td><?= $up['mapel']; ?></td>
                                    <td><?= $up['status']; ?></td>
                                    <td>
                                        <a href="/admin/detail_pengguna/<?= $up['nik']; ?>" title="detail" class="btn-sm btn-success"><i class='bx bx-detail'></i></a>
                                        <a href="/admin/edit_pengguna/<?= $up['nik']; ?>" title="edit" class="btn-sm btn-warning"><i class='bx bx-edit'></i></a>
                                        <a href="/admin/delete_pengguna/<?= $up['nik']; ?>" title="delete" class="btn-sm btn-danger" onclick="return confirm('<?= $up['nama_lengkap']; ?> akan terhapus secara permanen')"><i class='bx bx-message-alt-x'></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?= $pager->links('user_pagination', 'user_pagination'); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>