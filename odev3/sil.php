<?php
    $baglan = new PDO("mysql:host=localhost;dbname=odev3;charset=utf8","root","");
    $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $gelenid = $_GET["silinecek"];
    $sorgu = $baglan->prepare("DELETE FROM rehber WHERE id=?");
    $sil = $sorgu->execute(array($gelenid));

    if($sil){
        echo'<script> window.location="listele.php"; </script> ';
    }
    
?>