<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title" style="margin-bottom: 30px; margin-top: 10px; font-size: 36px; font-weight: bold;">Kelas</h4>

                <a href="/admin/tambah_kelas" class="btn-sm btn-warning" title="tambah kelas">Tambah Kelas</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Wali Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kelas as $k) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?= $k['nama_kelas']; ?></td>
                                    <!-- <td>< ?= $k['nama_lengkap']; ?></td> -->
                                    <td><?= isset($k['nama_lengkap']) ? $k['nama_lengkap'] : 'Tidak ada data'; ?></td>
                                    <td>
                                        <a href="/admin/delete_kelas/<?= $k['id_kelas']; ?>" title="delete" class="btn-sm btn-danger" onclick="return confirm('<?= $k['nama_kelas']; ?> akan terhapus secara permanen')"><i class="bx bx-message-alt-x"></i></a>
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