<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

    $baglan = new PDO("mysql:host=localhost;dbname=odev3;charset=utf8","root","");
    $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sorgu = $baglan->prepare("insert into rehber values(?,?,?)");
    $ekle = $sorgu->execute(array(NULL,"$_POST[name]","$_POST[phone]"));

    if ($ekle){
        echo'<script> window.location="index.php"; </script> ';
    }

    ?>

    <button onclick="document.location='listele.php'">Listele</button>
</body>
</html>

