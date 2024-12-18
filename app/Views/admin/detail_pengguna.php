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
                        <td><?= $detail['nip_nik']; ?>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Nama Lengkap</td>
                        <td>:</td>
                        <td><?= $detail['nama_lengkap']; ?>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Username</td>
                        <td>:</td>
                        <td><?= $detail['username']; ?>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Password</td>
                        <td>:</td>
                        <td><?= $detail['password']; ?>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Jabatan</td>
                        <td>:</td>
                        <td><?= $detail['jabatan']; ?></td>
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