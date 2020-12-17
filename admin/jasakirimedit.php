<?php 
    $sqlj = mysqli_query($kon, "SELECT * FROM jasakirim WHERE id_jasa='$_GET[idj]'");
    $rj = mysqli_fetch_array($sqlj);
?>

<a href="<?php echo "?p=jasakirim"; ?>"><button class="btn btn-add">Jasa Pengiriman</button></a> &raquo;
<button class="btn btn-dis">Edit Jasa Pengiriman</button>
<div class="card">
<div class="cardhead">Jasa Pengiriman</div>
<div class="cardbody" style="text-align:center;">
<form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id_jasa" value="<?php echo "$rj[id_jasa]"; ?>">
    <p>
    <label for="nama">Nama : </label>
    <input type="text" name="nama" id="nama" value="<?php echo "$rj[nama]"; ?>">
    </p>

    <p>
    <label for="detail">Detail : </label>
    <textarea name="detail" id="detail" cols="30" rows="5"><?php echo "$rj[detail]"; ?></textarea>
    </p>

    <p>
    <label for="tarif">Tarif : </label>
    <input type="text" name="tarif" id="tarif" value="<?php echo "$rj[tarif]"; ?>">
    </p>

    <p><img src="<?php echo "../logojasa/$rj[logo]"; ?>" width="200px"></p>
    <p>
    <label for="logo">Logo : </label>
    <input type="file" name="logo" id="logo" placeholder="Logo">
    </p>

    <p>
    <input type="submit" name="simpan" id="simpan" value="SIMPAN DATA">
    </p>
</form>

<?php 
    if ($_POST["simpan"]) {
        if (!empty($_POST["nama"]) AND !empty($_POST["tarif"]) AND !empty($_POST["detail"])) {
            $nmlogo = $_FILES["logo"]["name"];
            $loklogo = $_FILES["logo"]["tmp_name"];
            if (!empty($loklogo)) {
                move_uploaded_file($loklogo, "../logojasa/$nmlogo");
                $logo = ", logo='$nmlogo'";
            } else {
                $logo = "";
            }

            $detail = nl2br($_POST["detail"]);

            $sqlj = mysqli_query($kon, "UPDATE jasakirim SET nama='$_POST[nama]', detail='$detail' $logo, tarif='$_POST[tarif]' WHERE id_jasa='$_POST[id_jasa]'");

            if ($sqlj) {
                echo "DATA BERHASIL DISIMPAN";
            } else {
                echo "DATA GAGAL DISIMPAN";
            }
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=jasakirim'>";
        } else {
            echo "DATA HARUS DIISI DENGAN LENGKAP";
        }
    }
?>