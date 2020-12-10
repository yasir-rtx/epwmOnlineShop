<a href="<?php echo "?p=produk"; ?>"><button type="button" class="btn btn-add">Product</button> &raquo;</a>
<button type="button" class="btn btn-dis">Detail Product</button>
<br>
<?php 
    $sqlp = mysqli_query($kon, "SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $rp = mysqli_fetch_array($sqlp);
        $sqlk = mysqli_query($kon, "SELECT *FROM kategori WHERE id_kat='$rp[id_kat]'");
        $rk = mysqli_fetch_array($sqlk);
        $hrg = number_format($rp["harga"]);
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

        echo "<div class='dh12'>";
        echo "<div class='card'>";
        echo "<div class='cardhead'><small>Kategori :</small> $rk[namakat]</div>";
        echo "<div class='cardbody' style='text-align:center;'>";
        echo "<br>";
        echo "<img src='../fotoproduk/$rp[foto1]' border='1' width='100px'>
              <img src='../fotoproduk/$rp[foto2]' border='1' width='100px'>
              <hr>
              <big>$rp[nama]</big>
              <hr>
              <b>IDR $hrgbr</b> $disk $hrglama
              <hr>
              <b>$stock</b>
              <hr>
              <b>Berat : $rp[berat] Kg</b>
              <hr>
              <b>Spesifikasi</b> : <br>$rp[spesifikasi]
              <hr>
              <b>Detail Produk</b> : <br>$rp[detail]
              <hr>
              <b>Isi dalam kotak</b> : <br>$rp[isikotak]
              <hr>
              <small><i>Produk ini dibuat pada $rp[tglproduk] WIB
              <br>Oleh $ra[name]</i></small>";
        echo "</div>"; //Tutup cardbody
        echo "<div class='cardfoot'>";
        echo "<br><a href='?p=produkedit&id=$rp[id_produk]'><button type'button' class='btn btn-add'>EDIT</button></a>
              <a href='?p=produkdel&id=$rp[id_produk]'><button type'button' class='btn btn-add'>DELETE</button></a>";
        echo "</div>"; //Tutup cardfoot
        echo "</div><br>"; //Tutup card
        echo "</div>"; //tutup dh3
?>