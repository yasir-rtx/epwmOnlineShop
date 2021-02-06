<?php 
    $id = $_GET["id"];
    // var_dump($_POST["statusorder"]);echo "<br>";
    // var_dump($id);echo "<br>";
    // exit;
    $sqlo = mysqli_query($kon, "UPDATE orders SET statusorder='$_POST[statusorder]' WHERE id_order='$id'");

    if ($sqlo) {
        echo "STATUS BERHASIL DIUBAH";
    } else {
        echo "FAILED!!!";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=order&st=Semua'>";
?>