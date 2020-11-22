<?php 
    $sqlk = mysqli_query($kon, "DELETE FROM kategori WHERE id_kat='$_GET[id]'");
    if ($sqlk) {
        echo "Kategori berhasil dihapus";
    } else {
        echo "Gagal menghapus";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=kategori'>";
?>