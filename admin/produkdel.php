<?php 
    $sqlp = mysqli_query($kon, "DELETE FROM produk WHERE id_produk='$_GET[id]'");
    if ($sqlp) {
        echo "DATA BERHASIL DIHAPUS";
    } else {
        echo "DATA GAGAL DIHAPUS";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=produk'>";
?>