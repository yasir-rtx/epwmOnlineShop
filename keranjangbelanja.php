<div class="container5">
    <div class="grid">
        <?php 
            echo "<p>&nbsp;</p>";
            echo "<h2>Keranjang Belanja Anda</h2>";
            $sqlc = mysqli_query($conn, "SELECT * FROM cart WHERE id_anggota='$rag[id_anggota]'");
            $rowc = mysqli_num_rows($sqlc);
        ?>
        <?php if ($rowc > 0) { ?>
            <form name="" method="post" action="?p=keranjangedit" enctype="multipart/form-data">
                <input type="hidden" name="idag" value="$rag[id_anggota]">
                <?php $no=1;  ?>
                <?php while ($rc = mysqli_fetch_array($sqlc)) : ?>
                    <?php 
                        $sqlp = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$rc[id_produk]'");
                        $rp = mysqli_fetch_array($sqlp);
                        $nm = substr($rp["nama"], 0, 30);
                        $hrg = number_format($rp["harga"]);
                        $disk = ($rp["harga"] * $rp["diskon"]) / 100;
                        $hargabaru = $rp["harga"] - $disk;
                        $hrgbr = number_format($hargabaru);
                        $subtotal = $hargabaru * $rc["jumlahbeli"];
                        $total = $total + $subtotal;
                        $st = number_format($subtotal);
                        $t = number_format($total);
                        $brt = $rc["jumlahbeli"] * $rp["berat"];
                        $berat = $berat + $brt;

                        if ($rp["stock"] > 0) {
                            $stok = "<font color='green'>Stok Tersedia</font>";
                        } else {
                            $stok = "<font color='red'>Stok Habis</font>";
                        }

                        if ($rp["diskon"] > 0) {
                            $diskon = "<font color='red'>-$rp[diskon]%</font>";
                            $hargalama = "<font style='text-decoration:line-through'>IDR $hrg</font>";
                        } else {
                            $diskon = "";
                            $hargalama = "";
                        }

                        if (!empty($rp["foto1"])) {
                            $foto1 = "fotoproduk/$rp[foto1]";
                        } else {
                            $foto1 = "fotoproduk/avatar.png";
                        }
                    ?>
                    <div class="dh6">
                        <div class="card">
                            <div class="cardbody">
                                <table width="100%" border="0" cellpadding="5" cellspacing="5">
                                    <tr valign="top">
                                        <td width="100px"><img src="fotoproduk/<?php echo "$rp[foto1]"; ?>" width="100px" height="120px"></td>
                                        <td>
                                            <big><?php echo "$nm..."; ?></big>
                                            <input type="hidden" name="<?php echo "id[$no]"; ?>" value="<?php echo "$rc[id_cart]"; ?>">
                                            <p>
                                                <?php echo "$diskon"; ?> <?php echo "$hargalama"; ?><br>
                                                <big>IDR <?php echo "$hrgbr * <span class='jmlbeli'><input type='text' name='jml[$no]' value='$rc[jumlahbeli]' size='5' style='textalign:center'></span>" ?> Unit</big>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="cardhead">
                                Subtotal : IDR <?php echo "$st"; ?>
                                <a href="<?php echo "?p=keranjangdel&idc=$rc[id_cart]&idag=$rag[id_anggota]"; ?>">
                                    <button type="button" class="btn-x">X</button>
                                </a>
                            </div>
                        </div>
                        <br>
                    </div>
                    <?php $no++; ?>
                <?php endwhile; ?>

                <div class="dh12">
                        <div class="cardhead">
                            Berat : <?php echo "$berat"; ?> Kg
                        </div><br>
                        <div class="cardhead">
                            Total : IDR <?php echo"$t"; ?>
                        </div>
                </div>
                <div class="dh12">
                    <div align="center">
                        <a href="?p=produkterbaru"><button type="button" class="btn btn-add">&laquo; Lanjut Belanja</button></a>
                        <input type="submit" value="Edit Keranjang" class="btn btn-add">
                        <a href="?p=selesaibelanja"><button type="button" class="btn btn-add">Selesai Belanja</button></a>
                    </div>
                </div>
            </form>
        <?php } else { ?>
            <p><div align="center"><b>Keranjang Belanja Anda Masih Kosong</b></div></p>
            <?php echo "<META HTTP-EQUIV='Refresh' Content='3; URL=?p=produkterbaru'>"; ?>
        <?php } ?>
    </div>
</div>