<p>
    <div class="container5">
        <div class="grid">
            <div class="dh12">
                <?php 
                    $sqlo = mysqli_query($conn, "SELECT * FROM orders WHERE id_anggota='$rag[id_anggota]' ORDER BY tglorder DESC");
                    $no = 1;
                ?>

                <?php while ($ro = mysqli_fetch_array($sqlo)) : ?>
                    <?php 
                        $sqlod = mysqli_query($conn, "SELECT * FROM orders WHERE id_order='$ro[idorder]'");    
                        $rod = mysqli_fetch_array($sqlod);
                        $sqlag = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota='$rod[id_anggota]'");
                        $rag = mysqli_fetch_array($sqlag);
                    ?>

                    <div class="dh12">
                        <div class="card">
                            <div class="cardbody">
                                <h1>#<?php echo "$ro[noorder]"; ?> - <small><?php echo "$ro[statusorder]"; ?></small></h1>
                                Tanggal Order : <?php echo "$ro[tglorder]"; ?> WIB <br>
                                <table border="0" cellpadding="3px">
                                    <?php 
                                        $sqlordt = mysqli_query($conn, "SELECT * FROM orderdetail WHERE id_order='$ro[id_order]'");
                                    ?>
                                    <?php while ($rordt = mysqli_fetch_array($sqlordt)) : ?>
                                        <?php 
                                            $sqlpr = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$rordt[id_produk]'");    
                                            $rpr = mysqli_fetch_array($sqlpr);
                                            $sqlj = mysqli_query($conn, "SELECT * FROM jasakirim WHERE id_jasa='$rordt[id_jasa]'");
                                            $rj = mysqli_fetch_array($sqlj);

                                            $hrg = number_format($rpr["harga"]);
                                            $disk = ($rpr["harga"] * $rpr["diskon"]) / 100;
                                            $hargabaru = $rpr["harga"] - $disk;
                                            $hrgbr = number_format($hargabaru);
                                            $brt = $rordt["jumlahbeli"] * $rpr["berat"];
                                            $berat = $berat + $brt;

                                            if ($rpr["diskon"] > 0) {
                                                $diskon = "<font color='red'>-$rpr[diskon]%</font>";
                                                $hargalama = "<font style='text-decoration: line-through'>IDR $hrg</font>";
                                            } else {
                                                $diskon = "";
                                                $hargalama = "";
                                            }
                                        ?>
                                        <tr valign="top">
                                            <td><img src="fotoproduk/<?php echo "$rpr[foto1]"; ?>" height="50px" alt=""></td>
                                            <td><b><?php echo "$rpr[nama]"; ?></b><br><?php echo "$rordt[jumlahbeli]"; echo "*"; echo "IDR $hrgbr"; ?> <br><?php echo "$brt Kg"; echo "*"; echo "IDR $rj[tarif]"; ?> (<b><?php echo "$rj[nama]"; ?></b>) </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </table>
                                <?php $total = number_format($ro["total"]); ?>
                            </div>
                            <div class="cardhead">Total : IDR <?php echo "$total"; ?></div>
                        </div><br>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</p>