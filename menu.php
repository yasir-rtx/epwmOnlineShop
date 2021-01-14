<div class="container2">
    <div class="grid">
        <div class="topnav" id="myTopnav">
            <div class="dh6">
                <a href="<?php echo "?p=beranda"; ?>">epwm Online Shop</a>
                <a href="javascript:void(0);" class="icon" style="font-size: 14px;" onclick="myFunction()">&#9776;</a>
                <?php 
                    if ($_GET["p"] == "beranda") {
                        $pilih = " class='pilih'";
                    } else {
                        $pilih = "";
                    }
                    echo "<a href='?p=beranda' $pilih>BERANDA</a>";

                    $sqlk = mysqli_query($conn, "SELECT * FROM kategori ORDER BY namakat ASC");

                    while ($rk = mysqli_fetch_array($sqlk)) {
                        if ($_GET["idk"] == $rk["id_kat"]) {
                            $pil = " class='pilih'";
                        } else {
                            $pil = "";
                        }
                        echo "<a href='?p=home&idk=$rk[id_kat]' $pil>$rk[namakat]</a>";
                    }
                ?>
            </div>

            <div class="dh6">
                <?php 
                    if (!empty($_SESSION["userag"]) && !empty($_SESSION["passag"])) {
                        echo "<a><b>$rag[nama]</b></a>";
                        echo "<a href='?p=konfirmasi&idag=$rag[id_anggota]'>Konfirmasi</a>";
                        echo "<a href='?p=riwayat&idag=$rag[id_anggota]'>Riwayat</a>";
                        echo "<a href='?p=keranjangbelanja&idag=$rag[id_anggota]'>Keranjang Belanja</a>";
                        echo "<a href='?p=logout&idag=$rag[id_anggota]'>Logout</a>";
                    } else {
                        echo "<a href='?p=register&idag=$rag[id_anggota]'>Register</a>";
                        echo "<a href='?p=login&idag=$rag[id_anggota]'>Login</a>";
                    }
                ?>
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
    </div>
</div>