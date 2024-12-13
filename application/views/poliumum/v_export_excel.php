<?php 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$filename.".xls");
header("Pragma: no-cache");
header("Expires: 0");  ?>

<h1>Data Poli Umum</h1>

<h4>Tanggal : <?= date('Y-m-d H:i:s'); ?> </h4>

<table border="1">
    <thead>
        <tr>
            <th>Kode Antrian</th>
            <th>Poli</th>
            <th>Nama</th>
            <th>Keluhan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)):?>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['daftarpasienTrx']; ?></td>
                    <td><?= $row['daftarpasienpoliId']; ?></td>
                    <td><?= $row['daftarpasiennameId']; ?></td>
                    <td><?= $row['daftarpasienKeluhan']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No data available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>