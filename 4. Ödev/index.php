<?php
    require_once("kontrol.php");
    $islem = new Islemler();

    if(isset($_POST["adsoyad"]) || isset($_POST["tckimlik"])){

        if($_POST["adsoyad"] != "" || $_POST["tckimlik"] != ""){
            $metin = $islem->kaydet($_POST["adsoyad"],$_POST["tckimlik"]);
            echo "<script> alert('$metin')</script>";
        }
        else{
            echo "<script> alert('Geçersiz Bilgi Girişi, Kayıt Yapılamadı!')</script>";
        }
       
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    .button{
        text-align:center;
    }
</style>
</head>
<body>
    <form action="" method="post" style="text-align:center;">

        <h2>Ad Soyad:</h2>
        <input type="text" name="adsoyad" size="40">
        <h2>TC Kimlik Numarası:</h2>
        <input type="text" name="tckimlik" size="40">
        <br><br>
        <button style="background-color:powderblue" type="submit">Doğrula ve Kaydet</button>
    </form>
    <br><br><br>
    <div class="button">
        <button style="background-color:powderblue" onclick="document.location='liste.php'">Kayıtları Listele</button>   
    </div>
        
</body>
</html>