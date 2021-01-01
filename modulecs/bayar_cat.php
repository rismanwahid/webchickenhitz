<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="alert alert-warning" role="alert">
                    <?php
                    if ($_SESSION['ss_total'] == '') {
                        $total = rupiah($_SESSION['ss_totalnon']);
                        $dp = $_SESSION['ss_totalnon'];
                        $bagi = $dp / 2;
                    } else {
                        $total = rupiah($_SESSION['ss_total']);
                        $dp = $_SESSION['ss_total'];
                        $bagi = $dp / 2;
                    }
                    ?>
                    <strong>Total Yang Harus Dibayar : <?= $total; ?></strong><br>
                    <strong>Transaksi Pembayaran Bisa Dibayar DP 50% Senilai <?= rupiah($bagi); ?> MAX 12 Jam Setelah Melakukan Pemesanan.</strong><br>
                    Jika Tidak Maka Transaksi Akan Dibatalkan Oleh Admin.<br>
                    Silahkan Melakukan Transfer Ke Salah Satu Tujuan Dibawah ini:
                    <table>
                        <tr>
                        <tr>
                            <td>Mandiri</td>
                            <td>:</td>
                            <td>121889098809889 A/n Chicken Hitz</td>
                        </tr>
                        <tr>
                            <td>BNI</td>
                            <td>:</td>
                            <td>121889098809889 A/n Chicken Hitz</td>
                        </tr>
                        <tr>
                            <td>Gopay</td>
                            <td>:</td>
                            <td>1245323113 A/n Chicken Hitz</td>
                        </tr>
                        <tr>
                            <td>Ovo</td>
                            <td>:</td>
                            <td>1121212121 A/n Chicken Hitz</td>
                        </tr>
                        </tr>
                    </table>
                </div>
                <div class="button">
                    <a href="index.php?page=riwayat_trans" class="btn">
                        <p style="color: beige;">Konfirmasi Pembayaran</p>
                    </a>
                </div>
            </div>
        </div>
</section>
<!--/ End Checkout -->