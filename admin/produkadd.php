<a href="<?php echo "?p=produk"; ?>"><button type="button" class="btn btn-add">Product</button></a>
<button type="button" class="btn btn-dis">Add-Product</button>
<br>
<div class="card">
<div class="cardhead">Add Product</div>
<div class="cardbody" style="text-align:center;">
<form name="form1" method="post" action="" enctype="multipart/form-data">
    <?php 
        $sqlk = mysqli_query($kon, "SELECT * FROM kategori ORDER BY namakat ASC");
        echo "<select name='id_kat'>";
        echo "<option value=''>Kategori</option>";
        while ($rk = mysqli_fetch_array($sqlk)) {
            echo "<option value='$rk[id_kat]'>$rk[namakat]</option>";
        }
        echo "</select>";
    ?>
    <input type="text" name="nama" id="nama" placeholder="Nama Produk">
    <input type="text" name="harga" id="harga" placeholder="Harga Pprduk (IDR)">
    <input type="text" name="stock" id="stock" placeholder="Stok Produk">
    <textarea name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi Produk"></textarea>
    <textarea name="detail" id="detail" placeholder="Detail Produk"></textarea>
    <input type="text" name="diskon" id="diskon" placeholder="Diskon (%)">
    <input type="text" name="berat" id="berat"placeholder="Berat (kg)">
    <textarea name="isikotak" id="isikotak" placeholder="Isi dalam kotak"></textarea>
    <input type="file" name="foto1" id="foto1">
    <input type="file" name="foto2" id="foto2">
    <input type="submit" name="simpan" value="SIMPAN PRODUK">
</form>

<?php 
    if ($_POST["simpan"]) {
        if (!empty($_POST["id_kat"]) AND !empty($_POST["nama"]) AND !empty($_POST["harga"])) {
            $nmfoto1 = $_FILES["foto1"]["name"];
            $lokfoto1 = $_FILES["foto1"]["tmp_name"];
            if (!empty($lokfoto1)) {
                move_uploaded_file($lokfoto1, "../fotoproduk/$nmfoto1");
            }
            $nmfoto2 = $_FILES["foto2"]["name"];
            $lokfoto2 = $_FILES["foto2"]["tmp_name"];
            if (!empty($lokfoto2)) {
                move_uploaded_file($lokfoto2, "../fotoproduk/$nmfoto2");
            }

            $spek = nl2br($_POST["spesifikasi"]);
            $detail = nl2br($_POST["detail"]);
            $isi = nl2br($_POST["isikotak"]);

            $sqlp = mysqli_query($kon, "INSERT INTO produk (id_kat, id_admin, nama, harga, stock, spesifikasi, detail, diskon, berat, isikotak, foto1, foto2, tglproduk) VALUES ('$_POST[id_kat]', '$ra[id_admin]', '$_POST[nama]', '$_POST[harga]', '$_POST[stock]', '$spek', '$detail', '$_POST[diskon]', '$_POST[berat]', '$isi', '$nmfoto1', '$nmfoto2', NOW())");
            if($sqlp) {
                echo "Produk Berhasil Disimpan";
            } else {
                echo "Gagal Menyimpan";
            }
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=produk'>";
        } else {
            echo "DATA HARUS DIISI DENGAN LENGKAP!";
        }
    }
?>
