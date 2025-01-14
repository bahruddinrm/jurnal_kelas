<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<script>
    function upper_id() {
        var inputan = document.getElementById("id_kelas").value;
        var inputanUpper = inputan.toUpperCase();
        document.getElementById("id_kelas").value = inputanUpper;
    }

    function upper_nama() {
        var inputan = document.getElementById("nama_kelas").value;
        var inputanUpper = inputan.toUpperCase();
        document.getElementById("nama_kelas").value = inputanUpper;
    }


    // function proper() {
    //     var inputan = document.getElementById("nama_mapel").value;
    //     var inputanSplit = inputan.split(" ");
    //     for (var i = 0; i < inputanSplit.length; i++) {
    //         inputanSplit[i] = inputanSplit[i].charAt(0).toUpperCase() + inputanSplit[i].slice(1);
    //     }
    //     var inputanGabungan = inputanSplit.join(" ");
    //     document.getElementById("nama_mapel").value = inputanGabungan;
    // }
</script>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px; margin-left: 14px;">Input Kelas</h2>
                <form class="form-horizontal form-material" action="/admin/simpan_kelas" method="post">
                    <div class="form-group">
                        <label for="nama_kelas" class="col-md-12">Nama Kelas<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" oninput="upper_nama()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="wali_kelas" class="col-md-12">Wali Kelas<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <!-- <input type="text" id="wali_kelas"> -->
                            <select class="form-control" name="wali_kelas" id="wali_kelas">
                                <option selected disabled>Pilih Wali Kelas</option>
                                <?php foreach ($wali_kelas as $wk) : ?>
                                    <option value="<?= $wk['id_pengguna'] ?>">
                                        <?= $wk['nama_lengkap'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/admin/kelas" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<?= $this->endSection(); ?>