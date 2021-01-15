<?php 
    session_start();
    session_destroy();
    echo "
        <script>
            alert('ANDA BERHASIL LOGOUT kami tunggu kunjungan anda berikutnya');
        </script>
    ";
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=beranda'>";
?>