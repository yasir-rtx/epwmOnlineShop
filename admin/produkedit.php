<?php 
    $sqlp = mysqli_query($kon, "SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $rp = mysqli_fetch_array($sqlp);
?>

<a href="<?php echo "?p=produk"; ?>"><button type="button" class="btn btn-add">Product</button></a> &raquo;
<button type="button" class="btn btn-dis">Edit-Product</button>
<br>
<div class="card">
<div class="cardhead">Edit Product</div>
<div class="cardbody" style="text-align:center;">
<form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id_produk" value="<?php echo "$rp[id_produk]"; ?>">
    <?php 
        $sqlk = mysqli_query($kon, "SELECT * FROM kategori WHERE id_kat='$rp[id_kat]'");
        $rk = mysqli_fetch_array($sqlk);
    ?>
    <input type="text" name="namakat" disabled value="<?php echo"$rk[namakat]"; ?>">

    <input type="text" name="nama" id="nama" value="<?php echo"$rp[nama]"; ?>">
    <input type="text" name="harga" id="harga" value="<?php echo"$rp[harga]"; ?>">
    <input type="text" name="stock" id="stock" value="<?php echo"$rp[stock]"; ?>">
    <textarea name="spesifikasi" id="spesifikasi"><?php echo"$rp[spesifikasi]"; ?></textarea>
    <textarea name="detail" id="detail"><?php echo"$rp[detail]"; ?></textarea>
    <input type="text" name="diskon" id="diskon" value="<?php echo"$rp[diskon]"; ?>">
    <input type="text" name="berat" id="berat" value="<?php echo"$rp[berat]"; ?>">
    <textarea name="isikotak" id="isikotak"><?php echo"$rp[isikotak]"; ?></textarea>

    <p><img src="<?php echo "../fotoproduk/$rp[foto1]"; ?>" height="200px"></p>
    <input type="file" name="foto1" id="foto1">
    <p><img src="<?php echo "../fotoproduk/$rp[foto2]"; ?>" height="200px"></p>
    <input type="file" name="foto2" id="foto2">
    <input type="submit" name="simpan" value="SIMPAN PRODUK">
</form>

<?php 
    if ($_POST["simpan"]) {
        if (!empty($_POST["nama"]) AND !empty($_POST["harga"])) {
            $nmfoto1 = $_FILES["foto1"]["name"];
            $lokfoto1 = $_FILES["foto1"]["tmp_name"];

            if (!empty($lokfoto1)) {
                move_uploaded_file($lokfoto1, "../fotoproduk/$nmfoto1");
                $foto1 = ", foto1='$nmfoto1";
            } else {
                $foto1 = "";
            }

            $nmfoto2 = $_FILES["foto2"]["name"];
            $lokfoto2 = $_FILES["foto2"]["tmp_name"];

            if (!empty($lokfoto2)) {
                move_uploaded_file($lokfoto2, "../fotoproduk/$nmfoto2");
                $foto2 = ", foto2='$nmfoto2";
            } else {
                $foto2 = "";
            }

            $sqlp = mysqli_query($kon, "UPDATE produk SET nama='$_POST[nama]',
                harga='$_POST[harga]',
                stock='$_POST[stock]',
                spesifikasi='$_POST[spesifikasi]',
                detail='$_POST[detail]',
                diskon='$_POST[diskon]',
                berat='$_POST[berat]',
                isikotak='$_POST[isikotak]'
                $foto1 $foto2 WHERE id_produk='$_POST[id_produk]'");
            if($sqlp) {
                echo "Produk Berhasil Diubah";
            } else {
                echo "Gagal Mengubah";
            }
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=produk'>";
        } else {
            echo "DATA HARUS DIISI DENGAN LENGKAP!";
        }
    }
?>
