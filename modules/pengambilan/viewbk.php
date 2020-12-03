<?php
include "../../db.php";

$kd_pengambilan = $_POST['kd_pengambilan'];

$query = mysqli_query($db, "SELECT tmp_detpengambilan.*,bahan_baku.nm_bk FROM tmp_detpengambilan JOIN bahan_baku ON tmp_detpengambilan.kd_bk=bahan_baku.kd_bk WHERE tmp_detpengambilan.kd_pengambilan='$kd_pengambilan'");
$result = array();

while ($fethdata = $query->fetch_assoc()) {
    $result[] = $fethdata;
}

echo json_encode($result);
