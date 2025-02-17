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

        .signature p {
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="header">
        <h3>JURNAL GURU</h3>
        <p>Bulan: <?= esc($bulan); ?> <?= esc($tahun); ?>
        </p>
        <p>Nama Guru: <?= esc($guru_mapel); ?>
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari, Tanggal</th>
                <th>Jam Ke</th>
                <th>Kelas</th>
                <th>Jumlah Hadir</th>
                <th>Jumlah Sakit</th>
                <th>Jumlah Ijin</th>
                <th>Jumlah Alpa</th>
                <th>Nama Siswa Tidak Hadir</th>
                <th>Uraian Materi</th>
                <th>Media Pembelajaran</th>
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
                    <td><?= esc($j['nama_kelas']); ?></td>
                    <td><?= esc($j['jumlah_hadir']); ?></td>
                    <td><?= esc($j['jumlah_sakit']); ?></td>
                    <td><?= esc($j['jumlah_ijin']); ?></td>
                    <td><?= esc($j['jumlah_alpa']); ?></td>
                    <td><?= esc($j['nama_siswa_absen']); ?></td>
                    <td><?= esc($j['uraian_materi']); ?></td>
                    <td><?= esc($j['media_pembelajaran']); ?></td>
                    <td><?= esc($j['keterangan']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="left">
            <p>Mengetahui,</p>
            <p><?= esc($nama_sekolah) ?></p>
            <div class="signature">
                <img style="width: 200px; height: 100px;" src="<?= base_url('ttd/' . $ttd_ks_string); ?>" alt="tanda tangan <?= $kepala_sekolah; ?>">
                <p><strong><?= esc($kepala_sekolah); ?></strong></p>
                <p><?= esc($nip_ks); ?></p>
            </div>
        </div>

        <div class="right">
            <p>Pekalongan, <?= date('d-m-Y'); ?></p>
            <p>Guru Pengajar</p>
            <div class="signature">
                <img style="width: 200px; height: 100px;" src="<?= base_url('ttd/' . $ttd_guru_mapel); ?>" alt="tanda tangan <?= $guru_mapel; ?>">
                <p><strong><?= esc($guru_mapel); ?></strong></p>
                <p><?= esc($nip); ?></p>
            </div>
        </div>
    </div>

</body>

<script>
    window.print()
</script>

</html>