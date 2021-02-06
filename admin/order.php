<a href="<?php echo "?p=order&st=Semua"; ?>"><button class="btn btn-add">ALL TRANSACTION</button></a>
<br>
<a href="<?php echo "?p=order&st=Baru"; ?>"><button class="btn btn-add">NEW TRANSACTION</button></a>
<a href="<?php echo "?p=order&st=Lunas"; ?>"><button class="btn btn-add">LUNAS TRANSACTION</button></a>
<a href="<?php echo "?p=order&st=Dikirim"; ?>"><button class="btn btn-add">DELIVERED TRANSACTION</button></a>
<a href="<?php echo "?p=order&st=Diterima"; ?>"><button class="btn btn-add">PICKED TRANSACTION</button></a>
<br>

<?php 
    $limit = 4;
    $page = $_GET["pg"];
    if (empty($page)) {
        $posisi = 0;
        $page = 1;
    } else {
        $posisi = ($page - 1) * $limit;
    }

    if ($_GET["st"] == "Semua") {
        $status = "";
    } else {
        $status = "WHERE statusorder='$_GET[st]'";
    }

    $sqlo = mysqli_query($kon, "SELECT * FROM orders $status ORDER BY tglorder DESC");
    $no = 1;
    while ($ro = mysqli_fetch_array($sqlo)) {
        if ($ro["statusorder"] == "Baru") {
            $pilb = " selected"; 
            $pill = ""; 
            $pilk = ""; 
            $pilt = "";
        } else if ($ro["statusorder"] == "Lunas") {
            $pilb = ""; 
            $pill = " selected"; 
            $pilk = ""; 
            $pilt = "";
        } else if ($ro["statusorder"] == "Dikirim") {
            $pilb = ""; 
            $pill = ""; 
            $pilk = " selected"; 
            $pilt = "";
        } else if ($ro["statusorder"] == "Diterima") {
            $pilb = ""; 
            $pill = ""; 
            $pilk = ""; 
            $pilt = " selected";
        }
        // var_dump($pilb);echo "<br>";
        // var_dump($pill);echo "<br>";
        // var_dump($pilk);echo "<br>";
        // var_dump($pilt);echo "<br>";
        // exit;

        $sqlod = mysqli_query($kon, "SELECT * FROM orders WHERE id_order='$ro[id_order]'");
        $rod = mysqli_fetch_array($sqlod);

        $sqlag = mysqli_query($kon, "SELECT * FROM anggota WHERE id_anggota='$rod[id_anggota]'");
        $rag = mysqli_fetch_array($sqlag);

        echo "<div class='dh12'>";
        echo "<div class='card'>";
        echo "<div class='cardhead'>";
        echo "#$ro[noorder]";
        echo "</div>";
        echo "<div class='cardbody'>";
        echo "<br>Dipesan oleh : <b>$rag[nama]</b><br>";
        echo "Handphone &nbsp; &nbsp; <b>$rag[nohp]</b><br>";
        echo "Alamat Email : <b>$rag[email]</b><br>";
        echo "Dipesan pada : <b>$ro[tgloder] WIB</b><br>";
        echo "Dikirim ke : <b>$ro[alamatkirim]</b><br>";

        echo "<table border='0' cellpadding='3px'>";
        $sqlordt = mysqli_query($kon, "SELECT * FROM orderdetail WHERE id_order='$ro[id_order]'");
        while ($rordt = mysqli_fetch_array($sqlordt)) {
            $sqlpr = mysqli_query($kon, "SELECT * FROM produk WHERE id_produk='$rordt[id_produk]'");
            $rpr = mysqli_fetch_array($sqlpr);

            $sqlj = mysqli_query($kon, "SELECT * FROM jasakirim WHERE id_jasa='$rordt[id_jasa]'");
            $rj = mysqli_fetch_array($sqlj);

            $hrg = number_format($rpr["harga"]);
            $disk = ($rpr["harga"] * $rpr["diskon"]) / 100;
            $hargabaru = $rpr["harga"] - $disk;
            $hrgbr = number_format($hargabaru);
            $brt = $rordt["jumlahbeli"] * $rpr["berat"];
            $berat = $berat + $brt;

            if ($rp["diskon"] > 0) {
                $diskon = "<font color='red'>-$rp[diskon]</font>";
                $hargalama = "<font style='text-decoration:line-through;'>IDR $hrg</font>";
            } else {
                $diskon = "";
                $hargalama = "";
            }

            echo "<tr valign='top'>
            <td width='50px'><img src='../fotoproduk/$rpr[foto1]' height='50px'></td>
            <td><b>$rpr[nama]</b>
            <br>$rordt[jumlahbeli] * IDR $hrgbr
            <br>$brt Kg * $rj[tarif] (<b>$rj[nama]</b>)</td>
            </tr>";
        }
        echo "</table>";

        $sqlbyr = mysqli_query($kon, "SELECT * FROM pembayaran WHERE id_order='$ro[id_order]'");
        $rbyr = mysqli_fetch_array($sqlbyr);
        $rowbyr = mysqli_num_rows($sqlbyr);
        $jmltrs = number_format($rbyr["jumlahtransfer"]);

        if ($rowbyr > 0) {
            echo "<table width='100%' border='0'>";
            echo "<tr>";
            echo "<td width='100px'><a href='../buktibayar/$rbyr[bukti]' target='_blank'><img src='../buktibayar/$rbyr[bukti]' width='100px'></a></td>";
            echo "<td>Ditransfer oleh : <br><b>$rbyr[namapengirim]</b><br>
                    dari <b>$rbyr[namabankpengirim]</b><br>
                    ke <b>$rbyr[namabankpenerima]</b><br>
                    pada <b>$rbyr[tgltransfer]</b><br>
                    sebesar <br><big><b>IDR $jmltrs</b></big></td>";
            echo "</tr>";
            echo "</table>";
        }

        echo "<form method='post' action='?p=orderstatus&id=$ro[id_order]' enctype='multipart/form-data'>";
        echo "<input type='hidden' name'idorder' value='$ro[id_order]'>";
        echo "<input type='hidden' name'st' value='$_GET[st]'>";
        echo "<select name='statusorder'>";
        echo "<option value='Baru' $pilb>Baru</option>";
        echo "<option value='Lunas' $pill>Lunas</option>";
        echo "<option value='Dikirim' $pilk>Dikirim</option>";
        echo "<option value='Diterima' $pilt>Diterima</option>";
        echo "</select>";
        echo "<input type='submit' value='Ubah Status Pesanan'>";
        echo "<br>";
        // var_dump($ro["id_order"]);echo "<br>";
        // var_dump($_GET["st"]);echo "<br>";exit;
        echo "</form><br>";

        $total = number_format($ro["total"]);
        echo "</div>";
        echo "<div class='cardhead'>Total : IDR $total</div>";
        echo "</div><br>";
        echo "</div>";
    }

    echo "<div class='dh12' align='right'>";
    echo "Halaman";

    $sqlhal = mysqli_query($kon, "SELECT * FROM orders $status");
    $jmldata = mysqli_num_rows($sqlhal);
    $jmlhal = ceil($jmldata / $ $limit);

    for ($i=1; $i <= $jmlhal; $i++) { 
        if ($i == $page) {
            echo "<span class='box'><b>$i</b></span> ";
        }
    }

    if ($page > 1) {
        $prev = $page - 1;
        echo "<span class='box'><a href='?p=order&pg=$prev&st=$_GET[st]'>&laquo; Prev</a></span> ";
    } else {
        echo "<span class='box'>&laquo; Prev</span> ";
    }

    if ($page < $jmlhal) {
        $next = $page + 1;
        echo "<span class='box'><a href='?p=order&pg=$next&st=$_GET[st]'>Next &raquo; </a></span>";
    } else {
        echo "<span class='box'>Next &raquo;</span> ";
    }

    echo "Transkasi $_GET[st] <span class='box'><b>$jmldata</b></span>";
    echo "<p></div>";
    echo "<p>&nbsp;</p>"
?>