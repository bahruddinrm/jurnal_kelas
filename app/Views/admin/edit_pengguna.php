<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<style>
    .required-symbol {
        color: red;
    }
</style>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">

                <h2 style="margin-bottom: 20px;">Edit Pengguna</h2>
                <form action="/admin/update_pengguna " method="post">
                    <div class="row mb-3">
                        <label for="nip_nik" class="col-sm-3 col-form-label">NIP / NIK<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip_nik" name="nip_nik" value="<?= $detail['nip_nik']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $detail['nama_lengkap']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-3 col-form-label">Username<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $detail['username']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="password" name="password" value="<?= $detail['password']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- <label for="jabatan" class="col-sm-3 col-form-label">Jabatan<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="jabatan" id="jabatan" onchange="aktif()">
                                <option selected disabled>< ?= $detail['jabatan']; ?></option>
                                < ?php foreach ($jenis_jabatan as $j): ?>
                                    <option value="< ?= $j['jabatan'] ?>">< ?= $j['jabatan']; ?></option>
                                < ?php endforeach ?>
                            </select>
                        </div> -->
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan<span class="required-symbol">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $detail['jabatan']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <label for="ttd" class="col-sm-3 col-form-label">Tanda Tangan<span class="required-symbol">*</span></label>
                        <img class="col-sm-2" id="signature_img" style="width: 100px; height: 50px;" src="<?= base_url('ttd/' . $file_name . '.png'); ?>" alt="...">

                        <div class="col-sm">
                            <div class="row">
                                <div class="col-sm">
                                    <canvas id="signature-pad" width="400" height="200" style="border: 1px solid; cursor: crosshair;"></canvas><br>
                                    <input type="hidden" id="signature" name="signature">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="#" id="hapus_ttd" class="btn-sm btn-warning" style="cursor: pointer;">Hapus Tanda Tangan</a>
                                </div>
                                <div class="col-sm-4" style="margin-left: 60px;">
                                    <a href="#" onclick="simpan_ttd()" id="simpan_ttd" class="btn-sm btn-success" style="cursor: pointer;">Simpan Tanda Tangan</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/admin/guru" class="btn btn-danger float-right">Batal</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<script>
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

    function simpan_ttd() {
        var canvasData = signaturePad.toDataURL();
        var img = document.getElementById('signature_img');

        img.src = canvasData;
    };
</script>



<?= $this->endSection(); ?>