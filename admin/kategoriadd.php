<a href="<?php echo "?p=kategori"; ?>"><button type="button" class="btn btn-add">KATEGORI</button></a>
<button type="button" class="btn btn-dis">ADD KATEGORI</button>
<br>
<div class="card">
<div class="cardhead">Tambah Kategori</div>
<div class="cardbody" style="text-align:center;">

<form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="text" id="namakat" name="namakat" placeholder="Category Name">
    <textarea name="ketkat" id="ketkat" placeholder="Keterangan Kategori"></textarea><br>
    <input type="submit" id="simpan" name="simpan" value="SIMPAN">
</form>
<br>
<?php 
    if ($_POST["simpan"]) {
        if (!empty($_POST["namakat"]) and !empty($_POST["ketkat"])) {
            $sqlk = mysqli_query($kon, "insert into kategori (id_admin, namakat, ketkat, tglkat) values ('$ra[id_admin]', '$_POST[namakat]', '$_POST[ketkat]', NOW())");

            if($sqlk) {
                echo "Data Berhasil Disimpan";
            } else {
                echo "Gagal Menyimpan";
            }
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=kategori'>";
        } else {
            echo "ISI DATA DENGAN LENGKAP";
        }
    }
?>
</div> <!-- tutup cardbody -->
</div> <!-- Tutup card -->