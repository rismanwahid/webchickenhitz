<?php
include '../../db.php';

$kd_detpengambilan = $_POST['kd_detpengambilan'];

mysqli_query($db, "DELETE FROM tmp_detpengambilan WHERE kd_detpengambilan='$kd_detpengambilan'");
