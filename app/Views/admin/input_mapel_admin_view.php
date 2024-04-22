<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<style>
    .required-symbol {
        color: red;
    }
</style>

<script>
    function upper() {
        var inputan = document.getElementById("id_mapel").value;
        var inputanUpper = inputan.toUpperCase();
        document.getElementById("id_mapel").value = inputanUpper;
    }

    function proper() {
        var inputan = document.getElementById("nama_mapel").value;
        var inputanSplit = inputan.split(" ");
        for (var i = 0; i < inputanSplit.length; i++) {
            inputanSplit[i] = inputanSplit[i].charAt(0).toUpperCase() + inputanSplit[i].slice(1);
        }
        var inputanGabungan = inputanSplit.join(" ");
        document.getElementById("nama_mapel").value = inputanGabungan;
    }
</script>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-block">
                <h2 style="margin-bottom: 20px; margin-left: 14px;">Input Mapel</h2>
                <form class="form-horizontal form-material" action="/admin/simpan_mapel" method="post">
                    <div class="form-group">
                        <label class="col-md-12" for="id_mapel">ID Mapel<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="id_mapel" name="id_mapel" oninput="upper()" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_mapel" class="col-md-12">Nama Mapel<span class="required-symbol">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" oninput="proper()">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="col">
                            <a href="/admin/mapel" class="btn btn-danger float-right">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<?= $this->endSection(); ?>