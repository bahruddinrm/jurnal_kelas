<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <table class="table">
                    <h1 align='center'><?= $detail['nama_lengkap']; ?></h1>
                    <tr>
                        <td style="font-weight: bold;">NIK / NIP</td>
                        <td>:</td>
                        <td><?= $detail['nik']; ?> / <?= $detail['nip']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Username</td>
                        <td>:</td>
                        <td><?= $detail['username']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Password</td>
                        <td>:</td>
                        <td><?= $detail['password']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Mapel</td>
                        <td>:</td>
                        <td><?= $detail['mapel']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Status</td>
                        <td>:</td>
                        <td><?= $detail['status']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Tanda Tangan</td>
                        <td>:</td>
                        <td><img style="width: 200px; height: 100px;" src="<?= base_url('ttd/' . $file_name . '.png'); ?>" class="img-fluid rounded-start" alt="..."></td>
                    </tr>
                </table>
                <a href="/admin/pengguna" class="btn btn-success">Kembali</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>