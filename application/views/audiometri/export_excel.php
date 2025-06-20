<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Tes_Audiometri.xls");
?>

<table border="1">
    <thead>
        <tr>
            <th colspan="23" style="text-align: center;">DATA TES AUDIOMETRI</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal Tes</th>
            <th>No RM</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Perusahaan</th>
            <th>Jabatan</th>
            <!-- Telinga Kanan AC -->
            <th>AC Right 250</th>
            <th>AC Right 500</th>
            <th>AC Right 1000</th>
            <th>AC Right 2000</th>
            <th>AC Right 3000</th>
            <th>AC Right 4000</th>
            <th>AC Right 6000</th>
            <!-- Telinga Kiri AC -->
            <th>AC Left 250</th>
            <th>AC Left 500</th>
            <th>AC Left 1000</th>
            <th>AC Left 2000</th>
            <th>AC Left 3000</th>
            <th>AC Left 4000</th>
            <th>AC Left 6000</th>
            <th>Impression</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        foreach($audiometri_data as $data): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= date('d/m/Y', strtotime($data['tanggal_tes'])) ?></td>
            <td><?= $data['no_rm'] ?></td>
            <td><?= $data['nama'] ?></td>
            <td><?= $data['umur'] ?></td>
            <td><?= $data['jenis_kelamin'] ?></td>
            <td><?= $data['perusahaan'] ?></td>
            <td><?= $data['jabatan'] ?></td>
            <!-- Telinga Kanan AC -->
            <td><?= $data['right_ac_250'] ?></td>
            <td><?= $data['right_ac_500'] ?></td>
            <td><?= $data['right_ac_1000'] ?></td>
            <td><?= $data['right_ac_2000'] ?></td>
            <td><?= $data['right_ac_3000'] ?></td>
            <td><?= $data['right_ac_4000'] ?></td>
            <td><?= $data['right_ac_6000'] ?></td>
            <!-- Telinga Kiri AC -->
            <td><?= $data['left_ac_250'] ?></td>
            <td><?= $data['left_ac_500'] ?></td>
            <td><?= $data['left_ac_1000'] ?></td>
            <td><?= $data['left_ac_2000'] ?></td>
            <td><?= $data['left_ac_3000'] ?></td>
            <td><?= $data['left_ac_4000'] ?></td>
            <td><?= $data['left_ac_6000'] ?></td>
            <td><?= $data['impression'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="23">
                <strong>Diekspor pada: </strong><?= date('d/m/Y H:i:s') ?>
            </td>
        </tr>
    </tfoot>
</table>
