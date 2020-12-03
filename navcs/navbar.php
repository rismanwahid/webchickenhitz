<div class="header-inner">
    <div class="container">
        <div class="cat-nav-head">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="menu-area">
                        <!-- Main Menu -->
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-collapse">
                                <div class="nav-inner">
                                    <ul class="nav main-menu menu navbar-nav">
                                        <li><a href="index.php?page=beranda">Home</a></li>
                                        <?php
                                        $query  = mysqli_query($db, "SELECT * FROM kategori");
                                        $hitung = mysqli_num_rows($query);
                                        if ($hitung > 0) {
                                            while ($pecah = mysqli_fetch_assoc($query)) {
                                        ?>
                                                <li><a href="index.php?page=menu&kd_ktgr=<?= $pecah['kd_ktgr']; ?>&nm_ktgr=<?= $pecah['nm_ktgr']; ?>"><?= $pecah['nm_ktgr']; ?></a></li>
                                        <?php }
                                        } ?>
                                        <li><a href="index.php?page=catering">Catering</a></li>
                                        <?php if (isset($_SESSION['id_user_member'])) { ?>
                                            <li><a href="index.php?page=riwayat_trans">Riwayat Tranksaksi</a></li><?php } ?>
                                        <li><a href="index.php?page=profile">Profil Chicken Hitz</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>