<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<style>
    .text-c-purple {
        color: #6f42c1;
    }

    .bg-c-purple {
        background-color: #6f42c1;
    }

    .text-c-green {
        color: #28a745;
    }

    .bg-c-green {
        background-color: #28a745;
    }

    .text-c-red {
        color: #dc3545;
    }

    .bg-c-red {
        background-color: #dc3545;
    }

    .text-c-blue {
        color: #007bff;
    }

    .bg-c-blue {
        background-color: #007bff;
    }

    .text-white {
        color: #ffffff;
    }

    .f-28 {
        font-size: 28px;
    }

    .f-16 {
        font-size: 16px;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h1>Selamat Datang, <?php echo ($user) ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h1 class="text-c-purple"><?= $jumlah_pengguna; ?></h1>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-user f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-purple">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Jumlah Pengguna</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="fa fa-user text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h1 class="text-c-green"><?= $jumlah_kelas; ?></h1>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-building f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-green">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Jumlah Kelas</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="fa fa-building text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h1 class="text-c-red"><?= $jumlah_siswa; ?></h1>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-graduation-cap f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-red">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Jumlah Siswa</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="fa fa-graduation-cap text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h1 class="text-c-blue"><?= $jumlah_mapel; ?></h1>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-book f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-blue">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Jumlah Mapel</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="fa fa-book text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>