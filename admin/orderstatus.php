<?php 
    $sqlo = mysqli_query($kon, "UPDATE orders SET statusorder='$_POST[statusorder]' WHERE id_order='$_POST[id_order]'");

    if ($sqlo) {
        echo "STATUS BERHASIL DIUBAH";
    } else {
        echo "FAILED!!!";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=order&st=$_POST[st]'>";
?>