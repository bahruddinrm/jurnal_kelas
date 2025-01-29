<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<script>
    function aktif() {
        var jabatan = document.getElementById("jabatan").value;
        var mapel = document.getElementById("mapel");

        if (jabatan === "Guru") {
            mapel.disabled = false;
        } else {
            mapel.disabled = true;
        };
    };
</script>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px; margin-left: 14px;">Input Pengguna</h2>
                <form class="form-horizontal form-material" action="/admin/simpan_pengguna" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-12" for="nip_nik">NIP / NIK<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nip_nik" name="nip_nik" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap" class="col-md-12">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-md-12">Username<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-12">Password<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="col-sm-12">Jabatan<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="jabatan" id="jabatan" onchange="aktif()">
                                <option selected disabled>Pilih salah satu</option>
                                <?php foreach ($jabatan as $j): ?>
                                    <option value="<?= $j['jabatan'] ?>"><?= $j['jabatan']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="signature_file" class="col-md-12">Tanda Tangan<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="file" class="form-control" id="signature_file" name="signature_file" accept="image/png" required>
                            <small class="form-text text-muted">Unggah file tanda tangan dalam format PNG.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/admin/pengguna" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    document.getElementById('hapus_ttd').addEventListener('click', function(e) {
        e.preventDefault();
        signaturePad.clear();
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        var signatureInput = document.getElementById('signature');
        signatureInput.value = signaturePad.toDataURL();
    });
</script> -->

<?= $this->endSection(); ?>