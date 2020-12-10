<button type="button" class="btn btn-dis">Product</button> &raquo;
<a href="<?php echo "?p=produkadd"; ?>"><button type="button" class="btn btn-add">Add Product</button></a>
<br>
<?php 
    $limit = 8;
    $halaman = $_GET["pg"];
    if (empty($halaman)) {
        $posisi = 0;
        $halaman = 1;
    } else {
        $posisi = ($halaman - 1) * $limit;
    }

    $sqlp = mysqli_query($kon, "SELECT * FROM produk ORDER BY tglproduk DESC limit $posisi, $limit");
    while ($rp = mysqli_fetch_array($sqlp)) {
        $sqlk = mysqli_query($kon, "SELECT *FROM kategori WHERE id_kat='$rp[id_kat]'");
        $rk = mysqli_fetch_array($sqlk);
        $hrg = number_format($rp["harga"]);
        $nm = substr($rp["nama"], 0, 25);
        if($rp["stock"] > 0) {
            $stock = "<font color='#00CC00'>STOK TERSEDIA</font>";
        } else {
            $stock = "<font color='#FF0000'>STOK HABIS</font>";
        }

        if($rp["diskon"] > 0) {
            $diskon = ($rp["diskon"] * $rp["harga"]) / 100;
            $hrgbaru = $rp["harga"] - $diskon;
            $hrgbr = number_format($hrgbaru);
            $disk = "<font color='#FF0000'> -$rp[diskon]%</font>";
            $hrglama = "<font style='text-decoration:line-through'><small>IDR $hrg</small></font>";
        } else {
            $hrgbr = "";
            $diskon = "";
            $hrglama = "<b>$hrg</b>";
        }

        echo "<div class='dh3'>";
        echo "<div class='card'>";
        echo "<div class='cardhead'><small>Kategori :</small> $rk[namakat]</div>";
        echo "<div class='cardbody' style='text-align:center;'>";
        echo "<br>";
        echo "<img src='../fotoproduk/$rp[foto1]' border='1' width='100px'>
              <img src='../fotoproduk/$rp[foto2]' border='1' width='100px'>
              <hr>
              <big>$nm</big>
              <hr>
              <b>IDR $hrgbr</b> $disk $hrglama
              <hr>
              <b>$stock</b>
              <hr>
              <small><i>Produk ini dibuat pada $rp[tglproduk] WIB
              <br>Oleh $ra[name]</i></small>";
        echo "</div>"; //Tutup cardbody
        echo "<div class='cardfoot'>";
        echo "<br><a href='?p=produkdetail&id=$rp[id_produk]'><button type'button' class='btn btn-add'>Detail</button></a>
              <a href='?p=produkedit&id=$rp[id_produk]'><button type'button' class='btn btn-add'>EDIT</button></a>
              <a href='?p=produkdel&id=$rp[id_produk]'><button type'button' class='btn btn-add'>DELETE</button></a>";
        echo "</div>"; //Tutup cardfoot
        echo "</div><br>"; //Tutup card
        echo "</div>"; //tutup dh3
    }

    echo "<div class='dh12' align='right'>";
    echo "Halaman";
    $sqlhal = mysqli_query($kon, "SELECT * FROM produk");
    $jmldata = mysqli_num_rows($sqlhal);
    $jmlhal = ceil($jmldata/$limit);

    for ($i=1; $i <=$jmlhal; $i++) { 
        if ($i == $halaman) {
            echo "<span class='box'><b>$i</b></span> ";
        }
    }

    if ($halaman > 1) {
        $prev = $halaman - 1;
        echo "<span class='box'><a href='?p=produk&pg=$prev'>&laquo; Prev</a></span> ";
    } else {
        echo "<span class='box'>&laquo; Prev</span> ";
    }

    if ($halaman < $jmlhal) {
        $next = $halaman + 1;
        echo "<span class='box'><a href='?p=produk&pg='$next'>Next &raquo;</a></span>";
    } else {
        echo "<span class='box'>Next &raquo;</span>";
    }

    echo "Total Produk <span class='box'><b>$jmldata</b></span>";
    echo "<p></div>";
    echo "<p>&nbsp;</p>";
?>