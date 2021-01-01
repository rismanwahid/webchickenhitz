<?php
include '../../db.php';

$kd_detpaketcat = $_POST['kd_detpaketcat'];

mysqli_query($db, "DELETE FROM det_paketcatering WHERE kd_detpaketcat='$kd_detpaketcat'");
