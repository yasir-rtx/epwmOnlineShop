<?php 
    mysqli_query($conn, "DELETE FROM cart WHERE id_cart='$_GET[idc]'");
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=keranjangbelanja&idag=$_GET[idag]'>";
?>