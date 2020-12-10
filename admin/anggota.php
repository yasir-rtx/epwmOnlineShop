<button class="btn btn-dis">ANGGOTA</button>
<br>
<?php 
    $limit = 10;
    $page = $_GET["pg"];
    if (!empty($page)) {
        $posisi = 0;
        $page = 1;
    } else {
        $posisi = ($page - 1) * batas;
    }

    $sqlag = mysqli_query($kon, "SELECT * FROM anggota ORDER BY tgldaftar DESC LIMIT $posisi, $batas");
    while ($rag = mysqli_fetch_array($sqlag)) {
        echo "<div class='dh3'>";
        echo "<div class='card'>";
        echo "<div class='cardbody' style='text-align:center;'>";
        echo "<br>";
        echo "<img src='../foto/$rag[foto]' height='80px' style='border-radius:50%;'>
            <hr>
            <b>$rag[nama]</b>
            <hr>
            $rag[email]
            <hr>
            $rag[nohp]
            <hr>
            $rag[alamat]
            <hr>
            <small><i>Terdaftar Sejak $rag[tgldaftar] WIB</i></small>
        ";
        echo "</div>";
        echo "<div class='cardfoot'>";
        echo "<br><a href='?p=anggotadel&idag=$rag[id_anggota]'><button class='btn btn-add'>DELETE</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    echo "<div class'dh12' align='right'>";
    echo "Page ";

    $sqlhal = mysqli_query($kon, "SELECT * FROM anggota");
    $jmldata = mysqli_num_rows($sqlhal);
    $jmlhal = ceil($jmldata/$batas);

    for ($i=1; $i <= $jmlhal; $i++) { 
        if ($i == $page) {
            echo "<span class='box'><b>$i</b></span>";
        }
    }

    if ($page > 1) {
        $prev = $page - 1;
        echo "<span class='box'><a href='?p=anggota&pg=$prev'>&laquo; Prev</a></span>";
    } else {
        echo "<span class='box'>&laquo; Prev</span> ";
    }

    if ($page < $jmlhal) {
        $next = $page + 1;
        echo "<span class='box'><a href='?p=anggota&pg=$next'>&raquo; Next</a></span>";
    } else {
        echo "<span class='box'>&raquo; Next</span>";
    }
    
    echo "Total Anggota <span class='box'><b>$jmldata</b></span>";
    echo "<p></div>";
    echo "<p>&nbsp;</p>"
?>