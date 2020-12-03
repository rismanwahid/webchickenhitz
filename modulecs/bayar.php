<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="alert alert-warning" role="alert">
                    Silahkan Melakukan Transfer Ke Salah Satu Tujuan Dibawah ini:
                    <table>
                        <tr>
                        <tr>
                            <td>Mandiri</td>
                            <td>:</td>
                            <td>121889098809889</td>
                        </tr>
                        <tr>
                            <td>BNI</td>
                            <td>:</td>
                            <td>121889098809889</td>
                        </tr>
                        <tr>
                            <td>Gopay</td>
                            <td>:</td>
                            <td>1245323113</td>
                        </tr>
                        <tr>
                            <td>Ovo</td>
                            <td>:</td>
                            <td>1121212121</td>
                        </tr>
                        </tr>
                    </table>
                    <strong>Dengan Total:<?= rupiah($_SESSION['ss_total']); ?></strong>
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