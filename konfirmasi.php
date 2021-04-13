<div class="card">
    <div class="cardhead">Konfirmasi Pembayaran</div>
    <div class="cardbody" style="text-align: center;">
        <form name="" method="get" action="" enctype="multipart/form-data">
            <div class="dh12">
                <input type="hidden" name="p" placeholder="" value="<?php echo "$_GET[p]"; ?>">
                <input type="hidden" name="idag" placeholder="" value="<?php echo "$$_GET[idag]"; ?>">
                <input type="text" name="noorder" placeholder="Masukan nomor order (tanpa #)" value="<?php echo "$_GET[noorder]"; ?>">
                <br>
                <input type="submit" name="submit" placeholder="" value="Cari No. order">
            </div>
        </form>

        <?php 
            $sqlo = mysqli_query($conn, "SELECT * FROM orders WHERE noorder='$_GET[noorder]'");
            $ro = mysqli_fetch_array($sqlo);

            $sqlbyr = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_order='$ro[id_order]'");
            $rbyr = mysqli_fetch_array($sqlbyr);
            $rowbyr = mysqli_num_rows($sqlbyr);

            $sqlag = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota='$ro[id_anggota]'");
            $rag = mysqli_fetch_array($sqlag);

            $total = number_format($ro["total"]);
            $jmltrs = number_format($robyr["jumlahtransfer"]);
        ?>

        <form id="form2" name="form2" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id_order" placeholder="" value="<?php echo "$ro[id_order]"; ?>">
            <input type="text" name="tglorder" placeholder="" value="<?php echo "Tanggal order : $ro[tglorder] WIB"; ?>">
            <input type="text" name="nama" placeholder="" value="<?php echo "Atas nama : $rag[nama]"; ?>">
            <input type="text" name="total" placeholder="" value="<?php echo "Sebesar : IDR $total"; ?>">
            <p><h2>Dari rekening</h2>
            <input type="text" name="namabankpengirim" placeholder="Nama Bank Pengirim" value="<?php echo "$rbyr[namabankpengirim]"; ?>">
            <input type="text" name="namapengirim" placeholder="Nama Pengirim" value="<?php echo "$rbyr[namapengirim]"; ?>">
            <input type="text" name="jumlahtransfer" placeholder="Jumlah Transfer" value="<?php echo "$jmltrs"; ?>">
            <input type="date" name="tgltransfer" placeholder="Tanggal Transfer ex : 0000-00-00" value="<?php echo "$rbyr[tgltransfer]"; ?>"> <p>
            <h2>Ke Rekening</h2>
            <input type="text" name="namabankpenerima" placeholder="Nama bank penerima" value="<?php echo "$rbyr[namabankpenerima]"; ?>">
            <h2>Bukti Transfer</h2>
            <?php if ($rowbyr > 0) { ?>
                <div align="center"><a href="buktibayar/<?php echo "$rbyr[bukti]"; ?>" target="_blank"><img src="buktibayar/<?php echo "$rbyr[bukti]"; ?>" width="200px" alt=""></a></div>
            <?php } else { ?>
                <input type="file" name="bukti" placeholder="Nama bank penerima" value="">
                <input type="submit" value="KONFIRMASI PEMBAYARAN" name="konfirmasi">
            <?php } ?>
        </form>

        <?php 
            if ($_POST["konfirmasi"]) {
                $nmbukti = $_FILES["bukti"]["name"];
                $lokbukti = $_FILES["bukti"]["tmp_name"];

                if (!empty($lokbukti)) {
                    move_uploaded_file($lokbukti, "buktibayar/$nmbukti");
                }

                $sqlb = mysqli_query($conn, "INSERT INTO pembayaran (id_order, namabankpengirim, namapengirim, jumlahtransfer, tgltransfer, namabankpenerima, bukti) VALUES ('$_POST[id_order]', '$_POST[namabankpengirim]', '$_POST[namapengirim]', '$_POST[jumlahtransfer]', '$_POST[tgltransfer]', '$_POST[namabankpenerima]', '$nmbukti')");

                if ($sqlb) {
                    echo "Konfirmasi Pembayaran berhasil";
                } else {
                    echo "Konfirmasi Pembayaran gagal";
                }
                echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=beranda'>";
            }
        ?>
    </div>
</div>