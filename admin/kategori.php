<button type="buttom" class="btn btn-dis" >CATEGORY</button> &raquo;
<a href="<?php echo"?p=kategoriadd"; ?>">
    <button type="button" class="btn btn-add">Add Category</button>
</a>
<br>
<?php 
    $sqlk = mysqli_query($kon, "select * from kategori order by namakat asc");
    while ($rk = mysqli_fetch_array($sqlk)) {
        $sqlp = mysqli_query($kon, "select * from produk where id_kat='$rk[id_kat]'");
        $rowp = mysqli_num_rows($sqlp);
        echo "<div class='dh3'>";
        echo "<div class='card'>";
        echo "<div class cardbody";
        echo "<br>";
        echo "<hr><big>$rk[namakat]</big> <div class='badge'>$rowp</div>
              <hr>$rk[ketkat]
              <hr><small><i>Dibuat pada $rk[tglkat] WIB 
              <br>Oleh $ra[name]</i></small>";
        echo "</div>"; //Tutup cardbody
        echo "<div class='cardfoot'>";
        echo "<br><a href='?p=kategoriedit&id=rk[id_kat]'><button type='button' class='btn btn-add'>EDIT</button></a> ";
        echo "<a href='?p=kategoridel&id=rk[id_kat]'><button type='button' class='btn btn-add'>DELETE</button></a>";
        echo "</div>"; //Tutup kaki
        echo "</div>"; //tutup card
        echo "</div>"; //Tutup dh3
    }
?>