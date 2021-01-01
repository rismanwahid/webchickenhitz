<?php
include '../../db.php';

$tmpkd_detresep = $_POST['tmpkd_detresep'];

mysqli_query($db, "DELETE FROM tmpdet_resep WHERE tmpkd_detresep='$tmpkd_detresep'");
