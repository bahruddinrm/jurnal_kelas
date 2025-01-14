<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
        }

        .header p {
            margin: 0;
            font-size: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            text-align: center;
            padding: 5px;
            font-size: 10px;
        }

        .footer {
            text-align: left;
            margin-top: 40px;
        }

        .footer .left,
        .footer .right {
            display: inline-block;
            width: 45%;
        }

        .footer .right {
            text-align: right;
        }

        .signature {
            margin-top: 60px;
        }

        .signature p {
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="header">
        <h3>JURNAL KELAS</h3>
        <p>Kelas: <?= esc($kelas); ?> <?= esc($bulan); ?>
        </p>
        <!-- <p>Bulan: < ?= esc($bulan); ?> < ?= esc($tahun); ?>
        </p> -->
        <p>Nama Guru: < ?= esc($wali_kelas); ?>
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari, Tanggal</th>
                <th>Jam Ke</th>
                <th>Mapel</th>
                <th>Guru Mapel</th>
                <th>Hadir</th>
                <th>Ijin</th>
                <th>Alpa</th>
                <th>Nama Siswa Tidak Hadir</th>
                <th>Uraian Materi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($jurnal as $j) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($j['hari_tanggal']); ?></td>
                    <td><?= esc($j['jam_ke']); ?></td>
                    <td><?= esc($j['mapel']); ?></td>
                    <td><?= esc($j['nama_lengkap']); ?></td>
                    <td><?= esc($j['jumlah_hadir']); ?></td>
                    <td><?= esc($j['jumlah_ijin']); ?></td>
                    <td><?= esc($j['jumlah_alpa']); ?></td>
                    <td><?= esc($j['nama_siswa_absen']); ?></td>
                    <td><?= esc($j['uraian_materi']); ?></td>
                    <td><?= esc($j['keterangan']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="left">
            <p>Mengetahui,</p>
            <p>Kepala SMPN 1 Pekalongan</p>
            <div class="signature">
                <p><strong><?= esc($kepala_sekolah); ?></strong></p>
                <p><?= esc($nip_ks); ?></p>
            </div>
        </div>

        <div class="right">
            <p>Pekalongan, <?= date('d-m-Y'); ?></p>
            <p>Wali Kelas</p>
            <div class="signature">
                <p><strong><?= esc($wali_kelas); ?></strong></p>
                <p><?= esc($nip); ?></p>
            </div>
        </div>
    </div>

</body>

</html>