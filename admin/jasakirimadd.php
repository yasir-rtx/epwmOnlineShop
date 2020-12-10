<a href="<?php echo "?p=jasakirim"; ?>"><button class="btn btn-add">Jasa Pengiriman</button></a> &raquo;
<button class="btn btn-dis">Add Jasa Pengiriman</button>
<div class="card">
<div class="cardhead">Jasa Pengiriman</div>
<div class="cardbody" style="text-align:center;">
<form name="form1" method="post" action="" enctype="multipart/form-data">
    <p>
    <label for="nama">Nama : </label>
    <input type="text" name="nama" id="nama" placeholder="Nama">
    </p>

    <p>
    <label for="detail">Detail : </label>
    <textarea name="detail" id="detail" cols="30" rows="5" placeholder="Detail"></textarea>
    </p>

    <p>
    <label for="tarif">Tarif : </label>
    <input type="text" name="tarif" id="tarif" placeholder="Tarif">
    </p>

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
            }

            $detail = nl2br($_POST["detail"]);

            $sqlj = mysqli_query($kon, "INSERT INTO jasakirim (id_admin, nama, detail, logo, tarif) VALUES ('$ra[id_admin]', '$_POST[nama]', '$detail', '$nmlogo', '$_POST[tarif]')");

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