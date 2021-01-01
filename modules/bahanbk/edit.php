<?php
if (isset($_POST['simpan'])) {
    $kd_bk  = $_POST['kd_bk'];
    $nm_bk   = $_POST['nm_bk'];
    $suplier   = $_POST['suplier'];
    $stok = $_POST['stok'];

    mysqli_query($db, "UPDATE bahan_baku SET
    nm_bk = '$nm_bk',
    stok = '$stok',
    kd_suply = '$suplier' WHERE kd_bk='$kd_bk'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='admin.php?page=bahanbku'</script>";
}
?>

<div class="container-fluid">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="admin.php?page=bahanbku">Data Bahan Baku</a></li>
        <li class="breadcrumb-item active">Edit Data Bahan Baku</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <b>Edit Data Bahan Baku</b>
        </div>
        <form role="form" method="POST">
            <?php
            $id = $_GET['kd_bk'];
            $query  = mysqli_query($db, "SELECT bahan_baku.*,suplier.nm_suply FROM bahan_baku JOIN suplier ON bahan_baku.kd_suply=suplier.kd_suply WHERE kd_bk='$id'");
            $pecah = mysqli_fetch_assoc($query);
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label>KD Bahan Baku</label>
                    <input type="text" class="form-control" name="kd_bk" value="<?= $pecah['kd_bk']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Bahan Baku</label>
                    <input type="text" class="form-control" name="nm_bk" value="<?= $pecah['nm_bk']; ?>">
                </div>
                <div class="form-group">
                    <label>Suplier</label>
                    <select name="suplier" class="form-control">
                        <?php
                        $query = mysqli_query($db, "SELECT * FROM suplier");

                        while ($row = mysqli_fetch_array($query)) {
                            if ($pecah['kd_suply'] == $row['kd_suply']) {
                                echo "<option value=$row[kd_suply] selected>$row[nm_suply]</option>";
                            } else {
                                echo "<option value=$row[kd_suply]>$row[nm_suply]</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" class="form-control" name="stok" value="<?php echo $pecah['satuan']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok']; ?>" readonly>
                </div>

            </div>
            <div class="card-footer">
                <a href="admin.php?page=bahanbku" class="btn btn-warning">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>