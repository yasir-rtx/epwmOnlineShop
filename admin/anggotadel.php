<?php 
    $sqlag = mysqli_query($kon, "SELECT * FROM anggota WHERE id_anggota='$_GET[idag]'");
    if ($sqlag) {
        echo "DATA BERHASIL DIHAPUS";
    } else {
        echo " DATA GAGAL DIHAPUS";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=anggota'>";
?>