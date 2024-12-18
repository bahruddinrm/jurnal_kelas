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
                                        <a href="/admin/delete_siswa/<?= $s['id_siswa']; ?>" title="delete" class="btn-sm btn-danger" onclick="return confirm('<?= $s['nama_siswa']; ?> akan terhapus secara permanen')"><i class="bx bx-message-alt-x"></i></a>
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