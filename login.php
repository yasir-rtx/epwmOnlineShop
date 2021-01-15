<div id="signin">
    <fieldset>
        <img src="foto/Profil.jpg" alt="" width="120px">
        <form name="form1" method="post" action="" enctype="multipart/form-data">
            <h3>MEMBER</h3>
            <p>Please Login here...</p>

            <input type="text" name="email" id="email" placeholder="email...">
            <input type="password" id="password" name="password" placeholder="Password...">
            <input type="submit" id="login" name="login" value="login as member">
            <p>Belum Terdaftar? <a href="<?php echo "?p=register" ?>">daftar disini</a></p>
        </form>

        <?php 
            if ($_POST["login"]) {
                include "koneksi.php";
                $sqlag = mysqli_query($conn, "SELECT * FROM anggota WHERE email='$_POST[email]' AND password='$_POST[password]'");
                $rag = mysqli_fetch_array($sqlag);
                $row = mysqli_num_rows($sqlag);
                if ($row > 0) {
                    session_start();
                    $_SESSION["userag"] = $rag["email"];
                    $_SESSION["passag"] = $rag["password"];
                    echo "<div align='center'>Login Berhasil</div>";
                } else {
                    echo "<div align='center'>Login gagal</div>";
                }
                echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=beranda'>";
            }
        ?>
    </fieldset>
</div>