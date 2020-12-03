<?php
include '../../db.php';
$suplier = $_POST['suplier'];

echo "<option value=''>Pilih Bahan Baku</option>";

$query = "SELECT bahan_baku.kd_bk,bahan_baku.nm_bk,bahan_baku.kd_suply FROM bahan_baku WHERE kd_suply='$suplier' ORDER BY nm_bk ASC";
$dewan1 = $db->prepare($query);
$dewan1->bind_param("i", $suplier);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    echo "<option value='" . $row['kd_bk'] . "'>" . $row['nm_bk'] . "</option>";
}
