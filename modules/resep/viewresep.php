<?php
include "../../db.php";

$kd_resep = $_POST['kd_resep'];

$query = mysqli_query($db, "SELECT tmpdet_resep.*,bahan_baku.nm_bk FROM tmpdet_resep JOIN bahan_baku ON tmpdet_resep.kd_bk=bahan_baku.kd_bk WHERE tmpdet_resep.kd_resep='$kd_resep'");
$result = array();

while ($fethdata = $query->fetch_assoc()) {
    $result[] = $fethdata;
}

echo json_encode($result);
