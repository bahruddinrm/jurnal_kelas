<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h1>HALLO <?php echo ($user) ?></h1>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>