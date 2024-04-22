<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title" style="margin-bottom: 30px;">Mapel</h4>

                <a href="/admin/tambah_mapel" class="btn-sm btn-warning" title="tambah mapel">Tambah Mapel</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id Mapel</th>
                                <th scope="col">Nama Mapel</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mapel as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $m['id_mapel']; ?></th>
                                    <td><?= $m['nama_mapel']; ?></td>
                                    <td>
                                        <!-- <a href="/admin/detail_mapel/< ?= $m['id_mapel']; ?>" title="detail" class="btn-sm btn-success"><i class='bx bx-detail'></i></a> -->
                                        <!-- <a href="/admin/edit_mapel/< ?= $m['id_mapel']; ?>" title="edit" class="btn-sm btn-warning"><i class='bx bx-edit'></i></a> -->
                                        <a href="/admin/delete_mapel/<?= $m['id_mapel']; ?>" title="delete" class="btn-sm btn-danger" onclick="return confirm('<?= $m['nama_mapel']; ?> akan terhapus secara permanen')"><i class='bx bx-message-alt-x'></i></a>
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