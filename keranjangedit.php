<?php 
    $id = $_POST["id"];
    $jml_data = count($id);
    $jumlah = $_POST["jml"];
    for ($i=1; $i <= $jml_data; $i++) { 
        $sqlc = mysqli_query($conn, "SELECT * FROM cart WHERE id_cart='$id[$i]'");
        $rc = mysqli_fetch_array($sqlc);
        $sqlp = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$rc[id_produk]'");
        $rp = mysqli_fetch_array($sqlp);
        $stok = $rp["stock"];
        if ($jumlah[$i] > $stok) {
            echo "<p>&nbsp;</p>";
            echo "<div align='center'><b>STOK TIDAK CUKUP</b><br>
                Anda ingin membeli <b>$jumlah[$i]</b> unit <b>$rp[nama]</b> dari <b>$stok</b> unit yang tersedia</div>";
        } else {
            echo "<p>&nbsp;</p>";
            echo "<div align='center'><b>STOK TERSEDIA</b><br>
                Anda ingin membeli <b>$jumlah[$i]</b> unit <b>$rp[nama]</b> dari <b>$stok</b> unit yang tersedia</div>";
            mysqli_query($conn, "UPDATE cart SET jumlahbeli='$jumlah[$i]' WHERE id_cart='$id[$i]'");
        }
        echo "<p>";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='3; URL=?p=keranjangbelanja&idag=$_POST[idag]'>";
?>