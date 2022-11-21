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
    include_once("baglanti.php");
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $sorgu = $baglan->prepare("insert into rehber values(?,?,?)");

    if ($name != "" || $phone != ""){

        $ekle = $sorgu->execute(array(NULL,$name,$phone));

        if ($ekle){
            echo "<script> alert('Bilgiler Kaydedildi!!') 
                    window.top.location = 'index.php'
                </script>";  
        }
    }
    else {       
        echo "<script> alert('Lütfen Bilgilerinizi Kontrol Ediniz!') 
                    window.top.location = 'index.php'
            </script>";
    }
    ?>
</body>
</html>

