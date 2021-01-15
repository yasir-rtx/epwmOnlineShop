<div class="card">
    <div class="cardhead">Registrasi Anggota</div>
        <div class="cardbody" style="text-align: center;">
            <form name="" method="post" action="" enctype="multipart/form-data">
            <p>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" placeholder="Email...">
            </p>
            <p>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" placeholder="Password...">
            </p>
            <p>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" placeholder="Nama...">
            </p>
            <p>
                <label for="jk">Jenis Kelamin : </label>
                <input type="radio" name="jk" id="l" value="L">
                <label for="l">Laki-laki</label>
                <input type="radio" name="jk" id="p" value="P">
                <label for="p">Perempuan</label>
            </p>
            <p>
                <label for="tgllahir">Tanggal Lahir : </label>
                <input type="date" name="tgllahir" id="tgllahir" placeholder="Tanggal Lahir">
            </p>
            <p>
                <label for="alamat">Alamat : </label>
                <input type="text" name="alamat" id="alamat" placeholder="Alamat...">
            </p>
            <p>
                <label for="nohp">No Handphone : </label>
                <input type="text" name="nohp" id="nohp" placeholder="Nohp...">
            </p>
            <p>
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" placeholder="">
            </p>
            <p>
                <input type="submit" value="REGISTER" name="register">
            </p>
            </form>

            <?php 
                if ($_POST["register"]) {
                    if (!empty($email) AND !empty($password) AND !empty($nama) AND !empty($jk) AND !empty($tgllahir) AND !empty($alamat) AND !empty($nohp) AND !empty($foto)) {
                        $nmfoto = $_FILES["foto"]["name"];
                        $lokfoto = $_FILES["foto"]["tmp_name"];
                        if (!empty($lokfoto)) {
                            move_uploaded_file($lokfoto, "foto/$nmfoto");
                            $foto = ", '$nmfoto'";
                        } else {
                            $foto = "";
                        }

                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $nama = $_POST["nama"];
                        $jk = $_POST["jk"];
                        $tgllahir = $_POST["tgllahir"];
                        $alamat = $_POST["alamat"];
                        $nohp = $_POST["nohp"];

                        $sqlag = mysqli_query($conn, "INSERT INTO anggota VALUES ('', '$email', '$password', '$nama', '$jk', '$tgllahir', '$alamat', '$nohp' $foto, NOW())");
                        if ($sqlag) {
                            echo "Registrasi Berhasil";
                        } else {
                            echo "Registrasi Gagal";
                        }
                        echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=login'>";
                    } else {
                        echo "Data harus lengkap";
                    }
                }   
            ?>
        </div>
</div>