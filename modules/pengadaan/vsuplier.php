<?php
include '../../db.php';

echo "<option value=''>Pilih Suplier</option>";

$query = "SELECT * FROM suplier ORDER BY nm_suply ASC";
$dewan1 = $db->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    echo "<option value='" . $row['kd_suply'] . "'>" . $row['nm_suply'] . "</option>";
}
