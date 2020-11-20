<div id="signin">
    <fieldset>
        <img src="../foto/Profil.jpg" alt="" width="120px">
        <form name="form1" method="post" action="" enctype="multipart/form-data">
            <h3>ADMINISTRATOR</h3>
            <p>Please Login here...</p>

            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password">
            <input type="submit" id="login" name="login" value="login as admin">
        </form>

        <?php 
            if ($_POST["login"]) {
                include "koneksi.php";
                $sqla = mysqli_query($kon, "select * from admin where username='$_POST[username]' and password='$_POST[password]'");
                $ra = mysqli_fetch_array($sqla);
                $row = mysqli_num_rows($sqla);
                if ($row > 0) {
                    session_start();
                    $_SESSION["useradm"] = $ra["username"];
                    $_SESSION["passadm"] = $ra["password"];
                    echo "<div align='center'>Login Berhasil</div>";
                } else {
                    echo "<div align='center'>Login gagal</div>";
                }
                echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=home'>";
            }
        ?>
    </fieldset>
</div>