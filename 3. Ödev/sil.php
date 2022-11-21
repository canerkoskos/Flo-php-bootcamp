<?php

    include_once("baglanti.php");

    $gelenid = $_GET["silinecek"];
    $sorgu = $baglan->prepare("DELETE FROM rehber WHERE id=?");
    $sil = $sorgu->execute(array($gelenid));

    if($sil){
        echo'<script>
            alert("Kayıt Silindi!");
            window.location="listele.php";
          </script> ';
    }
    
?>