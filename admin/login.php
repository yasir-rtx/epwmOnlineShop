<div class="signin">
    <fieldset>
        <img src="../foto/profil.jpg" width="120px" alt="">
        <form name="1" method="post" action="" enctype="multipart/form-data">
        <h3>ADMINISTRATOR</h3>
        <p>SILAHKAN LOGIN</p>
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="text" name="password" id="password" placeholder="Password">
            <input type="submit" value="LOGIN ADMINISTRATOR" name="login" id="login">
        </form>

        <?php 
            if($_POST["login"]){
                $sqla = mysqli_query($con, "SELECT* FROM admin WHERE username='$_POST[username]' and password='$_POST[password]'");
                $ra = mysqli_fetch_array($sqla);
                $row = mysqli_num_rows($sqla);
                
                if ($row > 0) {
                    session_start();
                    $_SESSION["useradm"] = $ra["username"];
                    $_SESSION["password"] = $Ra["password"];
                    echo "<div align='center'>Login Berhasil</div>";
                }
                else {
                    echo "<div align='center'>Login Gagal</div>";
                }
                echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=home'>";
            }
        ?>
    </fieldset>
</div>