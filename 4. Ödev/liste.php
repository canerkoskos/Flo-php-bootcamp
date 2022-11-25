<?php
    require_once("kontrol.php");
    $islem = new Islemler();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .button{
        text-align:center;
        
    }
</style>
</head>
<body>
    <table style="width:100%;text-align:center;">
        <tr>
           
            <th>ID</th>
            <th>Adı Soyadı</th>
            <th>TC Kimlik NO</th>
            <th>Durum</th>
        </tr>
        <?php 
            
            foreach($islem->listele("kisiler") as $row){

                echo
                "<tr>".
                    "<td>".$row['id']."</td>".
                    "<td>".$row['adsoyad']."</td>".
                    "<td>".$row['tckimlik']."</td>".
                    "<td>".$row['durum']."</td>
                </tr>                       
                ";
            }

        ?>
    </table>
</body>
</html>