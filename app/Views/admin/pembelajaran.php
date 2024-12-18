<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title" style="margin-bottom: 30px; margin-top: 10px; font-size: 36px; font-weight: bold;">Pembelajaran</h4>

                <a href="/admin/tambah_pembelajaran" class="btn-sm btn-warning" title="tambah mapel">Tambah Pembelajaran</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pembelajaran as $p) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $p['nama_lengkap']; ?></td>
                                    <td><?= $p['nama_mapel']; ?></td>
                                    <td><?= $p['nama_kelas']; ?></td>
                                    <td>
                                        <a href="/admin/delete_pembelajaran/<?= $p['id_pembelajaran']; ?>" title="delete" class="btn-sm btn-danger" onclick="return confirm('<?= $p['pengguna']; ?> akan terhapus secara permanen')"><i class='bx bx-message-alt-x'></i></a>
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

<?= $this->endSection(); ?>