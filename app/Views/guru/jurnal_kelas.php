<?= $this->extend('layout/template_guru'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">

                <form action="">
                    <div class="form-group">
                        <label for="kelas" class="col-sm-12">Pilih Kelas<span class="required-symbol">*</span></label>
                        <div class="col-sm-12">
                            <select class="form-control" name="kelas" id="kelas" onchange="aktif()">
                                <option selected disabled>Pilih Kelas</option>
                                <option value="vii_a">VII A</option>
                                <option value="vii_b">VII B</option>
                                <option value="vii_c">VII C</option>
                                <option value="vii_d">VII D</option>
                                <option value="vii_e">VII E</option>
                                <option value="vii_f">VII F</option>
                                <option value="vii_g">VII G</option>
                                <option value="viii_a">VIII A</option>
                                <option value="viii_b">VIII B</option>
                                <option value="viii_c">VIII C</option>
                                <option value="viii_d">VIII D</option>
                                <option value="viii_e">VIII E</option>
                                <option value="viii_f">VIII F</option>
                                <option value="viii_g">VIII G</option>
                                <option value="ix_a">IX A</option>
                                <option value="ix_b">IX B</option>
                                <option value="ix_c">IX C</option>
                                <option value="ix_d">IX D</option>
                                <option value="ix_e">IX E</option>
                                <option value="ix_f">IX F</option>
                                <option value="ix_g">IX G</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function aktif() {
        var kelas = document.getElementById("kelas").value;
        var jurnal = document.getElementById("jurnal");

        if (kelas == <?php $kelas ?>) {
            jurnal.disabled = false;
        } else {
            jurnal.disabled = true;
        }
    }
</script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h1>HALLO <?php $kelas ?></h1>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>