<?php 
    $sqlj = mysqli_query($kon, "DELETE FROM jasakirim WHERE id_jasa='$_GET[idj]'");
    if ($sqlj) {
        echo "Data Berhasil Dihapus";
    } else {
        echo "Data Gagal Dihapus";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=jasakirim'>";
?>