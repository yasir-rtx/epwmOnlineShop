<?php 
    session_start();
    session_destroy();
    echo "<p align='center'>YOU HAVE LOGOUT</p>";
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=home'>";
?>