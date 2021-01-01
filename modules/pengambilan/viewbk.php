<?php
include "../../db.php";

$kd_pengambilan = $_POST['kd_pengambilan'];

$query = mysqli_query($db, "SELECT tmp_detpengambilan.*,GROUP_CONCAT(tmp_detpengambilan.jumlah,' ',tmp_detpengambilan.satuan SEPARATOR ' ') AS jumlahsat,bahan_baku.nm_bk FROM tmp_detpengambilan JOIN bahan_baku ON tmp_detpengambilan.kd_bk=bahan_baku.kd_bk WHERE tmp_detpengambilan.kd_pengambilan='$kd_pengambilan' GROUP BY tmp_detpengambilan.kd_bk");
$result = array();

while ($fethdata = $query->fetch_assoc()) {
    $resultt[] = $fethdata;
}

echo json_encode($resultt);
