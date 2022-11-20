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
        $urunler = array(

            array("id"=>"1","urun"=>"Ülker Çikolatalı Gofret 40 gr.", "fiyat"=>"5"),
            array("id"=>"2","urun"=>"Eti Damak Kare Çikolata 60 gr.", "fiyat"=>"10"),
            array("id"=>"3","urun"=>"Lays Clasic 107 gr.", "fiyat"=>"11"),
            array("id"=>"4","urun"=>"Eti Hoşbeş 75 gr.", "fiyat"=>"14"),
            array("id"=>"5","urun"=>"Ülker Çubuk Kraker 75 gr.", "fiyat"=>"13"),
            array("id"=>"6","urun"=>"Nestle Bitter Çikolata 50 gr.", "fiyat"=>"15")
               
        );
        session_start();
              
        foreach($urunler as $row){           
            $adet = 0;
            if(isset($_POST[$row["id"]])){
                $adet = intval($_POST[$row["id"]]);
            }
            $id = $row["id"];
            $urun = $row["urun"];
            if($adet>0){
                $tutar = $adet * $row["fiyat"];
                $sepet = array(
                    "id"=>"$id","urun"=>"$urun","adet"=>"$adet","tutar"=>"$tutar"
                );
                if(!empty($_SESSION["sepet"][$id])){
                    $_SESSION["sepet"][$id]["adet"] += $sepet["adet"];
                    $_SESSION["sepet"][$id]["tutar"] += $sepet["tutar"];
                }
                else{
                    $_SESSION["sepet"][$id] = $sepet;
                }
            }          
        }             
    ?>
    <form method="post" action="index.php" style="text-align:center;">
    <table border="1" width="100%">
        <tr>
            <td>Ürün Adı</td>
            <td>Ürün Fiyatı</td>
            <td>Adet</td>
            <?php
                foreach($urunler as $row){                
                    $id = $row["id"];
                    echo "<tr>".
                    "<td>".$row["urun"]."</td>".
                    "<td>".$row["fiyat"]." TL.</td>".
                    "<td><input type='text' name='$id' value='0'></td>".
                    "</tr>";
                }
            ?>
        </tr>
    </table>
    <br><input type="submit" value="Sepete Ekle"><br><br>
    </form>
    <?php
        $genel_toplam = 0;
        $toplam_adet = 0;
        if(!empty($_SESSION["sepet"])){

            echo "<h2 style='text-align:left'>Sepetiniz:</h2>";
            echo"<table border='1' width='100%'>".
                    "<tr>
                        <td>Ürün Adı</td>            
                        <td>Adet</td>
                        <td>Toplam</td>";
                
                        foreach($_SESSION["sepet"] as $row){
                            $genel_toplam += $row["tutar"];
                            $toplam_adet += $row["adet"];
                            $id = $row["id"];
                            echo 
                            "<tr>".
                                "<td>".$row["urun"]."</td>".
                                "<td>".$row["adet"]."</td>".
                                "<td>".$row["tutar"]." TL.</td>".
                            "</tr>";
                        }
                    echo"<tr>
                            <td>Genel Toplam</td>
                            <td>$toplam_adet</td>
                            <td>$genel_toplam TL.</td>
                        </tr>
                    </tr>
                </table>";
        }
    ?>
   
</body>
</html>
