<?php
if (isset($_POST['uploadresi'])) {
    $kd_jual  = $_POST['kd_jual'];
    $gambar_resi = $_FILES['resi']['name'];
    $gambar_new    = date('dmYHis') . $gambar_resi;
    move_uploaded_file($_FILES['resi']['tmp_name'], "img/resi_pembayaran/" . $gambar_new);

    mysqli_query($db, "UPDATE pembayaran SET status_bayar='Telah Melakukan Transfer',gambar_resi='$gambar_new' WHERE kd_penjualan='$kd_jual'");

    echo "<script>alert('Bukti Pembayaran Berhasil Di Upload')</script>";
    echo "<script>window.location='index.php?page=riwayat_trans'</script>";
}
?>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index.php?page=riwayat_trans">Riwayat Transaksi<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="#">Upload Resi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12">

            </div>
            <div class="col-lg-6 col-12">
                <h2>Upload Resi</h2>
                <p>Silahkan Upload Bukti Pembayaran Setelah Melakukan Transfer</p>
                <!-- Form -->
                <form class="form" method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>KD Penjualan</label>
                        <input type="text" name="kd_jual" class="form-control" value="<?= $_GET['kd_jual']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Resi</label>
                        <input type="file" name="resi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="uploadresi" class="btn">Upload Resi</button>
                    </div>
                </form>
                <!--/ End Form -->
            </div>
        </div>
    </div>
    </div>
</section>
<!--/ End Checkout -->