<?php 
    $sqlk = mysqli_query($kon, "select * from kategori where id_kat='$_GET[id]'");
    $rk = mysqli_fetch_array($sqlk);
?>
<a href="<?php echo "?p=kategori"; ?>"><button type="button" class="btn btn-add">KATEGORI</button></a>
<button type="button" class="btn btn-dis">EDIT KATEGORI</button>
<br>
<div class="card">
<div class="cardhead">EDIT Kategori</div>
<div class="cardbody" style="text-align:center;">

<form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id_kat" value="<?php echo"$rk[id_kat]"; ?>">
    <input type="text" id="namakat" name="namakat" placeholder="Category Name" value="<?php echo"$rk[namakat]"; ?>">
    <textarea name="ketkat" id="ketkat" placeholder="Keterangan Kategori"><?php echo"$rk[ketkat]"; ?></textarea><br>
    <input type="submit" id="simpan" name="simpan" value="SIMPAN">
</form>
<br>
<?php 
    if ($_POST["simpan"]) {
        if (!empty($_POST["namakat"]) and !empty($_POST["ketkat"])) {
            $sqlk = mysqli_query($kon, "update kategori set namakat='$_POST[namakat]', ketkat='$_POST[ketkat]' where id_kat='$_POST[id_kat]'");

            if($sqlk) {
                echo "Data Berhasil Diupdate";
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