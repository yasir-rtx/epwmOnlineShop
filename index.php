<?php 
    session_start();
    include "koneksi.php";
    $sqlag = mysqli_query($conn, "SELECT * FROM anggota WHERE email='$_SESSION[userag]' and password='$_SESSION[passag]'");
    $rag = mysqli_fetch_array($sqlag);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>epwm Online Shop</title>
</head>
<body>
    <!-- <div class="container1">
        <div class="grid">
            <div class="dh12">

            </div>
        </div>
    </div> -->

    <?php 
        include "menu.php";
    ?>

    <div class="container3">
        <div class="grid">
            <div class="dh12">
                <form method="post" action="<?php echo "?p=produkterbaru"; ?>">
                    <label for="cari">Cari</label>
                    <input type="text" name="cari" id="cari" placeholder="Ketikan nama produk yang akan dicari...">
                    <input type="submit" name="Submit" value="CARI">
                </form>
            </div>
        </div>
    </div>

    <?php
        if ($_GET["p"] == "produkterbaru") {
            include "produkterbaru.php";
        } elseif ($_GET["p"] == "produkdetail") {
            include "produkdetail.php";
        } else {
            include "home.php";
            include "produkterbaru.php";
        }
    ?>

    <div class="container6">
        <div class="grid">
            <div class="dh12">
                Copyright &copy; Prof. Muhammad Yasir, P.hd
            </div>
        </div>
    </div>

</body>
</html>