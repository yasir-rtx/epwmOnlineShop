<div class="container5">
    <div class="grid">
        <div class="dh12">
            
            <?php 
                // Membuat nomor order
                $tgl = date("d");
                $bln = date("m");
                $thn = date("Y");
                $jam = date("H");
                $mnt = date("i");
                $dtk = date("s");

                // Menyimpan data order
                mysqli_query($conn, "INSERT INTO orders (noorder, id_anggota, alamatkirim, tglorder, statusorder) VALUES ('$thn$bln$tgl$jam$mnt$dtk', '$_POST[idag]', '$_POST[alamatkirim]', NOW(), 'Baru')");

                // Mendapatkan ID order
                $idorder = mysqli_insert_id($conn);

                // Memanggil fungsi dan menghitung produk yang dipesan
                $sqlc = mysqli_query($conn, "SELECT * FROM cart WHERE id_anggota='$_POST[idag]'");
                $rowc = mysqli_num_rows($sqlc);
                $jml = $rowc;

                // Menghapus data dari tabel cart
                mysqli_query($conn, "DELETE FROM cart WHERE id_anggota='$_POST[idag]'");

                // Menampilkan data dan order dari anggota
            ?>
            <div class="cardhead">Terimakasih</div>
            <div class="cardbody" style="text-align: left;">
                <p>NO. ORDER : <big><b><?php echo "#$thn$bln$tgl$jam$mnt$dtk"; ?></b></big></p>
                Nama : <big><b><?php echo "$_POST[nama]"; ?></b></big><br>
                Email : <big><b><?php echo "$_POST[email]"; ?></b></big><br>
                Nohp : <big><b><?php echo "$_POST[nohp]"; ?></b></big><br>
                Alamat : <big><b><?php echo "$_POST[alamat]"; ?></b></big><br>
                Alamat Pengiriman : <big><b><?php echo "$_POST[alamatkirim]"; ?></b></big><br>
            </div>
        </div>

            <?php while ($rc = mysqli_fetch_array($sqlc)) : ?>
                <?php 
                    // Merubah stok di tabel produk
                    $sqlp = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$rc[id_produk]'");
                    $rp = mysqli_fetch_array($sqlp);
                    $stok = $rp["stock"];
                    $jumlahbeli = $rc["jumlahbeli"];
                    $stokakhir = $stok - $jumlahbeli;
                    mysqli_query($conn, "UPDATE produk SET stock='$stokakhir' WHERE id_produk='$rc[id_produk]'");

                    $no = $i + 1;
                    $disk = ($rp["diskon"] * $rp["harga"]) / 100;
                    $hrgbaru = $rp["harga"] - $disk;
                    $subtotal = $jumlahbeli * $hrgbaru;
                    $tot = $tot + $subtotal;
                    $brt = $jumlahbeli * $rp["berat"];
                    $berat = $berat + $brt;
                    $st = number_format($subtotal);
                    $hrg = number_format($rp["harga"]);
                    $hrgbr = number_format($hrgbaru);

                    if ($rp["diskon"] > 0) {
                        $diskon = "<font color='red'>-$rp[diskon]%</font>";
                        $hrglama = "<font style='text-decoration:line-through'>IDR $hrg</font>";
                    } else {
                        $diskon = "";
                        $hrglama = "";
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
                                    <td width="100px">
                                        <img src="fotoproduk/<?php echo "$rp[foto1]"; ?>" width="100px" alt="">
                                    </td>

                                    <td>
                                        <big><?php echo "$rp[nama]"; ?></big><br>
                                        <?php echo "$diskon"; ?> <?php echo "$hrglama"; ?><br>
                                        <big>IDR <?php echo "$hrgbr"; echo "*"; echo "$jumlahbeli"; ?></big>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="cardhead">
                            Subtotal : IDR <?php echo "$st"; ?>
                        </div>
                    </div><br>
                </div>

                <?php 
                    // var_dump($idorder);echo "<br>";
                    // var_dump($rc["id_produk"]);echo "<br>";
                    // var_dump($_POST["id_jasa"]);echo "<br>";
                    // var_dump($jumlahbeli);echo "<br>";
                    // var_dump($subtotal);
                    // exit;
                    // simoan data detail order
                    $orderdetail = mysqli_query($conn, "INSERT INTO orderdetail (id_order, id_produk, id_jasa, jumlahbeli, subtotal) VALUES ('$idorder', '$rc[id_produk]', '$_POST[id_jasa]', '$jumlahbeli', '$subtotal')");
                    // if ($orderdetail) {
                    //     echo "
                    //         <script>alert('ORDER DETAIL BERHASIL DISIMPAN');</script>
                    //     ";
                    // } else {
                    //     echo "
                    //     <script>alert('ORDER DETAIL GAGAL DISIMPAN');</script>
                    // ";
                    // }
                ?>
            <?php endwhile;?>
            
            <?php
                $sqlj = mysqli_query($conn, "SELECT * FROM jasakirim WHERE id_jasa='$_POST[id_jasa]'");
                $rj = mysqli_fetch_array($sqlj);
                $tarif = $berat * $rj["tarif"];
                $trf = number_format($tarif);
                $total = $tot + $tarif;
                $t = number_format($total);
            ?>

            <div class="dh12">
                <div class="cardhead">
                    Berat : <?php echo "$berat Kg"; ?>
                </div><br>

                <div class="cardhead">
                    Jasa Pengiriman <?php echo "$rj[nama] : IDR $trf"; ?>
                </div><br>

                <div class="cardhead">
                    Total : IDR <?php echo "$t"; ?>
                </div>
            </div>

            <?php 
                // update data total
                mysqli_query($conn, "UPDATE orders SET total='$total' WHERE id_order='$idorder'");
            ?>

            <div class="dh12">
                <div align="right"><a href="javascript:window.print()"><button type="button" class="btn btn-add">Cetak Faktur</button></a></div>
            </div>
        </div>
    </div>
</div>