<?php 
    if (empty($_SESSION["userag"]) && empty($_SESSION["passag"])) {
        echo "<p><div align='center'>Anda harus Login untuk berbelanja</div></p>";
        echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=login'>";
    } else {
        $sqlc = mysqli_query($conn, "SELECT id_produk FROM cart WHERE id_produk='$_GET[idp]' AND id_anggota='$_GET[idag]'");
        $rowc = mysqli_num_rows($sqlc);

        $sqlp = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$_GET[idp]'");
        $rp = mysqli_fetch_array($sqlp);

        if ($rp["stock"] == 0) {
            echo "<div align='center'><p><b>STOK HABIS<br>untuk produk $rp[nama]</b></p></div>";
        } else {
            if ($rowc == 0) {
                mysqli_query($conn, "INSERT INTO cart (id_produk, id_anggota, jumlahbeli, tglcart) VALUES ('$_GET[idp]', '$_GET[idag]', 1, NOW())");
            } else {
                $sqlcr = mysqli_query($conn, "SELECT * FROM cart WHERE id_produk='$_GET[idp]'");
                $rcr = mysqli_fetch_array($sqlcr);
                if ($rcr["jumlahbeli"] >= $rp["stock"]) {
                    echo "<div align='center'><p><b>STOCK TIDAK MENCUKUPI<br>untuk produk $rp[nama]</b></p></div>";
                } else {
                    mysqli_query($conn, "UPDATE cart SET jumlahbeli=jumlahbeli+1 WHERE id_produk='$_GET[idp]' AND id_anggota='$_GET[idag]'");
                }
            }
        }
        echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=keranjangbelanja&idag=$rag[id_anggota]'>";
    }
?>