<?php 
    session_start();
    include "koneksi.php";
    $sqlag = mysqli_query($conn, "SELECT * FROM anggota WHERE email='$_SESSION[userag]' AND password='$_SESSION[passag]'");
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
                <p style="text-align: right;">Padang, Indonesia | 081240125792 | obliviousknight@gmail.com</p>
            </div>
        </div>
    </div> -->

    <?php 
        include "menu.php";
    ?>
    <div class="container3">
        <div class="grid">
            <div class="dh12">
                <form name="" method="post" action="<?php echo "?p=produkterbaru"; ?>" enctype="multipart/form-data">
                    <label for="cari">Cari : </label>
                    <input type="text" name="cari" id="cari" placeholder="Ketikan nama produk...">
                    <input type="submit" value="CARI" name="submit">
                </form>
            </div>
        </div>
    </div>

    <!-- <?php include "home.php"; ?> -->
    <?php include "produkterbaru.php"; ?>

    <div class="container6">
        <div class="grid">
            <div class="dh12">
                Copyright &copy; Prof. Muhammad Yasir, P.hd 2021
            </div>
        </div>
    </div>

</body>
</html>