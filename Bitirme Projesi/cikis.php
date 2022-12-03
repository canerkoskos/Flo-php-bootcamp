<?php
    session_start();
    unset($_SESSION["giris"]);
    echo "<script> window.location.href='index.php' </script>";
?>