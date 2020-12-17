<div class="grid">
    <!-- Kategori -->
    <?php 
        $sqlk = mysqli_query($kon, "SELECT * FROM kategori");
        $rowk = mysqli_num_rows($sqlk);
        $sqlkl = mysqli_query($kon, "SELECT * FROM kategori ORDER BY tglkat DESC limit 2");
    ?>
    <div class="dh3">
        <div id="boxval">
            <p>Kategori</p>
            <h3><?php echo "$rowk"; ?></h3>
        </div>
        <div class="card">
            <div class="cardhead">Kategori Terbaru</div>
            <div class="cardbody">
                <?php 
                    if ($rowk == 0) {
                        echo "<div align='center'>Belum ada kategori yang ditambahkan</div>";
                    } else {
                        echo "<hr>";
                        while ($rkl = mysqli_fetch_array($sqlkl)) {
                            echo "<big>$rkl[namakat]</big>
                            <br>$rkl[ketkat]
                            <hr>";
                        }
                    }
                ?>
            </div>
            <div class="cardfoot">
                <a href="<?php echo "?p=kategori"; ?>"><button class="btn btn-add">Lihat Semua Kategori &raquo;</button></a>
            </div>
        </div>
        <br>
    </div>

    <!-- Data Produk -->
    <?php 
        $sqlp = mysqli_query($kon, "SELECT * FROM produk");
        $rowp = mysqli_num_rows($sqlp);
        $sqlpl = mysqli_query($kon, "SELECT * FROM produk ORDER BY tglproduk DESC limit 1");
    ?>
    <div class="dh3">
        <div id="boxval">
            <p>Produk</p>
            <h3><?php echo "$rowp"; ?></h3>
        </div>
        <div class="card">
            <div class="cardhead">Produk Terbaru</div>
            <div class="cardbody" style="text-align:center;">
                <?php 
                    if ($rowp == 0) {
                        echo "<div align='center'>Belum ada Produk yang ditambahkan</div>";
                    } else {
                        while ($rpl = mysqli_fetch_array($sqlpl)) {
                            $hrg = number_format($rpl["harga"]);
                            $nm = substr($rpl["nama"],0,30);
                            if ($rpl["stock"] > 0) {
                                $stok = "<font color='#00CC00'>Stok Tersedia</font>";
                            } else {
                                $stok = "<font color='#FF0000'>Stok Habis</font>";
                            }

                            if ($rpl["diskon"] > 0) {
                                $disk = ($rpl["diskon"] * $rpl["harga"]) / 100;
                                $hrgbaru = $rpl["harga"] - $disk;
                                $hrgbr = number_format($hrgbaru);
                                $diskon = "<font color='#FF0000'> -$rpl[diskon]%</font>";
                                $hrglama = "<font style='text-decoration:line-through;'><small>IDR $hrg</small></font>";
                            } else {
                                $hrgbr = "";
                                $diskon = "";
                                $hrglama = "<b>$hrg</b>";
                            }
                            echo "<br>";
                            echo "<img src='../fotoproduk/$rpl[foto1]' height='60px'> ";
                            echo "<img src='../fotoproduk/$rpl[foto2]' height='60px'>";
                            echo "<hr>";
                            echo "<b>$nm...</b>";
                            echo "<hr>";
                            echo "<b>IDR $hrgbr</b> $diskon $hrglama";
                            echo "<hr>";
                            echo "<b>$stok</b>";
                            echo "<hr>";
                        }
                    }
                ?>
            </div>
            <div class="cardfoot">
                <a href="<?php echo "?p=produk"; ?>"><button class="btn btn-add">Lihat Semua Produk &raquo;</button></a>
            </div>
        </div>
        <br>
    </div>

    <!-- Anggota -->
    <?php 
        $sqlag = mysqli_query($kon, "SELECT * FROM anggota");
        $rowag = mysqli_num_rows($sqlag);
        $sqlagl = mysqli_query($kon, "SELECT * FROM anggota ORDER BY tgldaftar DESC limit 1");
    ?>
    <div class="dh3">
        <div id="boxval">
            <p>Anggota</p>
            <h3><?php echo "$rowag"; ?></h3>
        </div>
        <div class="card">
            <div class="cardhead">Anggota Terbaru</div>
            <div class="cardbody">
                <?php 
                    if ($rowag == 0) {
                        echo "<hr>";
                        echo "<div align='center'>Belum ada Anggota yang terdaftar</div>";
                        echo "<hr>";
                    } else {
                        echo "<hr>";
                        while ($ragl = mysqli_fetch_array($sqlagl)) {
                            echo "<br>";
                            echo "<img src='../foto/$ragl[foto]' height='64px' style='border-radius:50%;'>";
                            echo "<hr>";
                            echo "<b>$ragl[nama]</b>";
                            echo "<hr>";
                            echo "$ragl[email]";
                            echo "<hr>";
                            echo "$ragl[nohp]";
                            echo "<hr>";
                        }
                    }
                ?>
            </div>
            <div class="cardfoot">
                <a href="<?php echo "?p=anggota"; ?>"><button class="btn btn-add">Lihat Semua Anggota &raquo;</button></a>
            </div>
        </div>
        <br>
    </div>

    <!-- Transaksi -->
    <?php 
        $sqlo = mysqli_query($kon, "SELECT * FROM orders");
        $rowo = mysqli_num_rows($sqlo);
        $sqlol = mysqli_query($kon, "SELECT * FROM orders WHERE statusorder='Baru' ORDER BY tglorder DESC limit 2");
    ?>
    <div class="dh3">
        <div id="boxval">
            <p>Transaksi</p>
            <h3><?php echo "$rowo"; ?></h3>
        </div>
        <div class="card">
            <div class="cardhead">Transaksi Terbaru</div>
            <div class="cardbody">
                <hr>
                Status Order <br>
                <a href="<?php echo "?p=order&st=Baru"; ?>"><button class="btn btn-add">Baru</button></a>
                <a href="<?php echo "?p=order&st=Lunas"; ?>"><button class="btn btn-add">Lunas</button></a>
                <a href="<?php echo "?p=order&st=Dikirim"; ?>"><button class="btn btn-add">Dikirim</button></a>
                <a href="<?php echo "?p=order&st=Diterima"; ?>"><button class="btn btn-add">Diterima</button></a>
                <?php 
                    if ($rowo == 0) {
                        echo "<hr>";
                        echo "<div align='center'>Belum ada Transaksi</div>";
                        echo "<hr>";
                    } else {
                        echo "<hr>";
                        while ($rol = mysqli_fetch_array($sqlol)) {
                            echo "<big>#$rol[noorder] - $rol[statusorder]</big>";
                            echo "<br><small><i>Pada $rol[tglorder] WIB</i></small>";
                            echo "<hr>";
                        }
                    }
                ?>
            </div>
            <div class="cardfoot">
                <a href="<?php echo "?p=order"; ?>"><button class="btn btn-add">Lihat Semua Order &raquo;</button></a>
            </div>
        </div>
        <br>
    </div>
</div>