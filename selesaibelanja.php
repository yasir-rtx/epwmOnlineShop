<p><div class="container5">
    <div class="grid">
        <div class="dh12">
            <div class="card">
                <div class="cardhead">Proses Checkout</div>
                <div class="cardbody" style="text-align: center;">
                    <form name="" method="post" action="<?php echo "?p=selesaibelanjaaksi" ?>" enctype="multipart/form-data">
                            <input type="hidden" name="idag" value="<?php echo "$rag[id_anggota]"; ?>">
                            <input type="text" name="email" placeholder="" value="<?php echo "$rag[email]"; ?>">
                            <input type="text" name="nama" placeholder="" value="<?php echo "$rag[nama]"; ?>">
                            <input type="text" name="nohp" placeholder="" value="<?php echo "$rag[nohp]"; ?>">
                            <textarea name="alamat"><?php echo "$rag[alamat]"; ?></textarea>
                            <textarea name="alamatkirim" placeholder="Alamat Pengiriman"></textarea><br>
                            <?php $sqlj = mysqli_query($conn, "SELECT * FROM jasakirim ORDER BY nama ASC"); ?>
                            <select name="id_jasa">
                                <option value="o">Pilih jasa kirim</option>
                                <?php while ($rj = mysqli_fetch_array($sqlj)) : ?>
                                    <option value="<?php echo "$rj[id_jasa]"; ?>"><?php echo "$rj[nama]"; ?></option>
                                <?php endwhile; ?>
                            </select><br>
                            <input type="submit" name="submit" value="PROSES CHECKOUT">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div></p>