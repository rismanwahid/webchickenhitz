<!-- Start Blog Single -->
<section class="blog-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="blog-single-main">
                    <div class="row">
                        <div class="col-12">
                            <div class="image">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="img/profill.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img/profil.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="img/profill.jpg" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="blog-detail">
                                <h2 class="blog-title">Profile Dari Chicken Hitz</h2>
                                <div class="blog-meta"></div>
                                <div class="content">
                                    <p style="text-align: justify;">Chicken Hitz adalah sebuah usaha kuliner yang berbentuk restoran/café yang berdiri pada tanggal 17 Juni 2015. Chiken Hitz beralamat di Jl. Perumnas No.01, Condongsari, Condongcatur, Depok, Sleman, Yogyakarta. Chicken Hitz memiliki kategori yang bervariasi dari, <strong>Makanan,Minumam dan Beverages.</strong> Pada Website ini pelanggan dapat melakukan pemesanan menu dengan skala kecil dan pemesanan catering dengan skala besar</p>
                                    <p style="text-align: justify;"> Pemesanan Catering pelanggan dapat memesan <strong>H-3</strong> dari waktu yang diinginkan. Proses pembayaran pada pemesanan bisa dilakukan dengan <strong>Cash atau Transfer.</strong> Untuk metode pembayaran cash hanya berlaku untuk pemesanan skali kecil yaitu dibawah <strong>40</strong> dari jumlah yang di pesan dan untuk pemesanan catering pelanggan harus melakuan transfer total biaya pemesannya dengan maximal waktu tranfer kuran lebih <strong>12 Jam dari waktu pemesanan</strong>.</p>
                                    <h4>Visi dan Misi</h4>
                                    <p style="text-align: justify;">
                                        <b>Visi</b><br>
                                        Menjadi perusahaan kuliner yg bertaraf nasional, dg cabang yg banyak dan profitabel, bermanfaat dan berkah untuk umat. <br>
                                        <b>Misi</b><br>
                                        1. Menciptakan citra merk terpercaya <br>
                                        2. Menciptakan kwalitas menu yg lezat sesuai selera masyarakat indonesia<br>
                                        3. Membuat sistem dan management yg otomatis dan sistematis<br>
                                        4. Sdm yang ramah, terampil dan bersahaja<br>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="main-sidebar">
                    <!-- Single Widget -->
                    <div class="single-widget category">
                        <h3 class="title">Menu Yang ada pada Chicken Hitz</h3>
                        <ul class="categor-list">
                            <?php
                            $qr = mysqli_query($db, "SELECT menu.nama_menu FROM menu");
                            $hitung = mysqli_num_rows($qr);
                            if ($hitung > 0) {
                                while ($pecah = mysqli_fetch_assoc($qr)) {
                            ?>
                                    <li><a href="#"><?= $pecah['nama_menu']; ?></a></li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Blog Single -->