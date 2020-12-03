<?php
$kd = $_SESSION['ss_jual'];
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'batal') {

        $menu_kd = $_GET['kd_menu'];
        mysqli_query($db, "DELETE FROM tmp_detpenjualan WHERE kd_menu='$menu_kd' AND kd_penjualan='$kd'");


        echo "<script>alert('Menu Berhasil Dibatalkan')</script>";
        echo "<script>window.location='index.php?page=keranjang'</script>";
    }
}

?>
<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>No</th>
                            <th>Menu</th>
                            <th>Nama</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query  = mysqli_query($db, "SELECT tmp_detpenjualan.*,tmp_detpenjualan.jumlah*tmp_detpenjualan.harga AS subtotal,menu.* FROM tmp_detpenjualan JOIN menu ON tmp_detpenjualan.kd_menu=menu.kd_menu WHERE tmp_detpenjualan.kd_penjualan='$kd'");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {

                                $kd_menu = $pecah['kd_menu'];
                                $qty = $pecah['jumlah'];

                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td class="image" data-title="No"><img src="img/menu/<?= $pecah['gambar']; ?>"></td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a href="#"><?= $pecah['nama_menu']; ?></a></p>
                                        <p class="product-des"><?= $pecah['deskripsi']; ?></p>
                                    </td>
                                    <td class="price" data-title="Price"><span><?= $pecah['harga']; ?></span></td>
                                    <td class="qty" data-title="Qty">
                                        <!-- Input Order -->
                                        <div class="input-group">
                                            <input type="number" class="input-number update-qty" name="<?php echo $kd_menu ?>" data-min="1" value="<?= $qty; ?>">
                                        </div>
            </div>
            <!--/ End Input Order -->
            </td>
            <td class="total-amount" data-title="Total"><span><?= rupiah($pecah['subtotal']); ?></span></td>
            <td class="action" data-title="Remove"><a href="index.php?page=keranjang&aksi=batal&kd_menu=<?= $pecah['kd_menu']; ?>"><i class="ti-trash remove-icon"></i></a></td>
            </tr>
    <?php }
                        } ?>
    </tbody>
    </table>
    <!--/ End Shopping Summery -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Total Amount -->
            <div class="total-amount">
                <div class="row">
                    <div class="col-lg-8 col-md-5 col-12">
                        <div class="left">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7 col-12">
                        <div class="right">
                            <ul>
                                <?php
                                $query1  = mysqli_query($db, "SELECT SUM(tmp_detpenjualan.jumlah*tmp_detpenjualan.harga) AS totalall FROM tmp_detpenjualan WHERE kd_penjualan='$kd'");
                                $ouput = mysqli_fetch_assoc($query1);
                                ?>
                                <li class="last">Total<span><Strong><?= rupiah($ouput['totalall']); ?></Strong></span></li>
                            </ul>
                            <div class="button5">
                                <a href="index.php?page=checkout" class="btn">ORDER</a>
                                <a href="index.php?page=beranda" class="btn">Tambah Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Total Amount -->
        </div>
    </div>
</div>
</div>
<!--/ End Shopping Cart -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(".update-qty").on("input", function(e) {
        var barang_id = $(this).attr("name");
        var value = $(this).val();

        $.ajax({
                method: "POST",
                data: "barang_id=" + barang_id + "&value=" + value,
                url: 'http://localhost/chickenhitz/modulecs/updatecart.php',
            })
            .done(function(data) {
                location.reload();
            });

    });
</script>