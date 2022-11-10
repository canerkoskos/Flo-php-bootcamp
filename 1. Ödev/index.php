<?php
    
    $agilSayisi = 5;
    $kapasite = 30;
    $toplamKapasite = $agilSayisi*$kapasite;
    $koyun = 163;
    $bostaKoyun = 0;
    $agil = array();

    echo "Toplam Ağıl: ". $agilSayisi."<br>";
    echo "Toplam Kapasite: ". $toplamKapasite."<br>";
    echo "Toplam Koyun: ". $koyun."<br><br>";

    for($i=0; $i<$agilSayisi; $i++){

        if($koyun>0){
            if($koyun>$kapasite){
                array_unshift($agil,$kapasite);
                $koyun -= $kapasite;
                $bostaKoyun = $koyun;
            }else{  
                array_unshift($agil,$koyun);
                $koyun = 0;
                $bostaKoyun = $koyun;
            }

        }
        else array_unshift($agil,0);
    }
    
    for($i=$agilSayisi; $i>0; $i--){
        echo $i.". Ağıl: ".$agil[$i-1]." Koyun <br>";
    }

    if($bostaKoyun>0)
    echo "<br> Dışarıda Kalan: ".$bostaKoyun." Koyun";
?>
