<button type="button" class="btn btn-dis">Jasa Pengiriman</button> &raquo;
<a href="<?php echo "?p=jasakirimadd"; ?>"><button type="button" class="btn btn-add">Add Jasa Pengiriman</button></a>
<br>
<?php 
    $sqlj = mysqli_query($kon, "SELECT * FROM jasakirim ORDER BY nama ASC");
    while ($rj = mysqli_fetch_array($sqlj)) {
        $tarif = number_format($rj["tarif"]);
        echo "<div class='dh3'>";
        echo "<div class='card'>";
        echo "<div class='cardhead' align='center'><big>$rj[nama]</big></div>";
        echo "<div class='cardbody' style='text-align:center;'><br>";
        echo "<img src='../logojasa/$rj[logo]' border='0' width='200px' height='120px'>
        <hr>
        $rj[detail]
        <hr>
        <b>IDR $tarif</b>
        <hr>";
        echo "</div>";
        echo "<div class='cardfoot'>";
        echo "<a href='?p=jasakirimedit&idj=$rj[id_jasa]'><button type='button' class='btn btn-add'>EDIT</button> </a>";
        echo "<a href='?p=jasakirimdel&idj=$rj[id_jasa]'><button type='button' class='btn btn-add'>DELETE</button></a>";
        echo "</div>";
        echo "</div><br>";
        echo "</div>";
    }
?>