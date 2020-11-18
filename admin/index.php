<?php 
    session_start();
    include "connection.php"
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Aministrator EPWM Online Shop</title>
</head>
<body>
    <?php 
        if (!empty($_SESSION["useradm"]) and !empty($_SESSION["passadm"])) {
            $sqla = mysqli_query($con, "select* from admin where username='$_SESSION[useradm]' and password='$_SESSION[passadm]");
            $ra = mysqli_fetch_array($sqla);
     ?>

    <div class="grid">
        <div class="dh12">
            <div class="container1">
                <span style="font-size:20px; cursor:pointer; padding-right:15px;" onclick="openNav()">&#9776</span>
                <a href="<?php echo "?p=home"; ?>">epwm Online Shop Admin</a>
            </div>
        </div>
    </div>

    <div class="sidenav" id="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <img src="../foto/Profil.jpg" width="150px">
        <p>Selamat Datang</p>
        <h3><?php echo "$ra[namalengkap]"; ?></h3>
        <hr><a href="<?php echo "?p=home"; ?>">Beranda</a>
        <hr><a href="<?php echo "?p=kategori"; ?>">Kategori</a>
        <hr><a href="<?php echo "?p=produk"; ?>">Produk</a>
        <hr><a href="<?php echo "?p=jasakirim"; ?>">Jasa Kirim</a>
        <hr><a href="<?php echo "?p=anggota"; ?>">Anggota</a>
        <hr><a href="<?php echo "?p=order&st=semua"; ?>">Transaksi</a>
        <hr><a href="<?php echo "?p=logout"; ?>">Logout</a>
    </div>

    <script>
        function openNav() {
            document.getElementById("sidenav").style.width="350px";
        }
        function closeNav() {
            document.getElementById("sidenav").style.width="0px";
        }
    </script>

    <div class="grid">
        <div class="dh12">
            <div class="container2">
                <?php 
                 if ($_GET["p"] == "logout") {
                     include "logout.php";
                 }
                 else {
                     include "home.php";
                 }
                 ?>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="dh12">
            <div class="container3">
                Copyright &copy; Muhammad Yasir, 2020
            </div>
        </div>
    </div>
    <?php 
        }else {
            include "login.php";
        }
     ?>
</body>
</html>