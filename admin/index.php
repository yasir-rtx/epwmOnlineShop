<?php 
    session_start();
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Administrator epwmOnlineShop</title>
</head>
<body>
    <?php 
        if(!empty($_SESSION["useradm"]) and !empty($_SESSION["passadm"])) {
           $sqla = mysqli_query($kon, "select * from admin where username='$_SESSION[useradm]' and password='$_SESSION[passadm]'");
           $ra = mysqli_fetch_array($sqla);
    ?>

    <div class="grid">
        <div class="dh12">
            <div class="container1">
                <span style="font-size:20px; cursor:pointer; padding-right:15px;" onclick="openNav()">&#9776;</span>
                <a href="<?php echo "?p=home"; ?>">epwm Online Shop Admin</a>
            </div>
        </div>
    </div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times</a>
        <img src="../foto/Profil.jpg" width="150px" alt="">
        <p>Welcome</p>
        <h3><?php echo "$ra[name]"; ?></h3>
        <hr><a href="<?php echo "?p=home"; ?>">HOME</a>
        <hr><a href="<?php echo "?p=kategori"; ?>">KATEGORI</a>
        <hr><a href="<?php echo "?p=produk"; ?>">PRODUK</a>
        <hr><a href="<?php echo "?p=jasakirim"; ?>">JASA KIRIM</a>
        <hr><a href="<?php echo "?p=anggota"; ?>">ANGGOTA</a>
        <hr><a href="<?php echo "?p=order&st=semua"; ?>">TRANSAKSI</a>
        <hr><a href="<?php echo "?p=logout"; ?>">LOGOUT</a>
    </div>
    <!-- Script untuk buka tutup navigasi -->
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width="350px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width="0px";
        }
    </script>

    <div class="grid">
        <div class="dh12">
            <div class="container2">
                <?php 
                    if ($_GET["p"] === "logout") {  
                        include "logout.php";
                    } else if ($_GET["p"] == "kategori") {
                        include "kategori.php";
                    } else if ($_GET["p"] == "kategoriadd") {
                        include "kategoriadd.php";
                    } else if ($_GET["p"] == "kategoriedit") {
                        include "kategoriedit.php";
                    } else if ($_GET["p"] == "kategoridel") {
                        include "kategoridel.php";
                    } else if ($_GET["p"] == "produk") {
                        include "produk.php";
                    } else if ($_GET["p"] == "produkadd") {
                        include "produkadd.php";
                    } else if ($_GET["p"] == "produkedit") {
                        include "produkedit.php";
                    } else if ($_GET["p"] == "produkdel") {
                        include "produkdel.php";
                    } else if ($_GET["p"] == "produkdetail") {
                        include "produkdetail.php";
                    } else if ($_GET["p"] == "jasakirim") {
                        include "jasakirim.php";
                    } else if ($_GET["p"] == "jasakirimadd") {
                        include "jasakirimadd.php";
                    } else if ($_GET["p"] == "jasakirimedit") {
                        include "jasakirimedit.php";
                    } else if ($_GET["p"] == "jasakirimdel") {
                        include "jasakirimdel.php";
                    } else if ($_GET["p"] == "anggota") {
                        include "anggota.php";
                    } else if ($_GET["p"] == "anggotadel") {
                        include "anggotadel.php";
                    } else {
                        include "home.php";
                    }
                ?>
            </div>
        </div>
    </div>
    
    <div class="grid">
        <div class="dh12">
            <div class="container3">
                Copyright &copy; Muhammad Yasir 2020
            </div>
        </div>
    </div>

    <?php 
        } else {
            include "login.php";
        }
    ?>
</body>
</html>