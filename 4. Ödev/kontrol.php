<?php

    class Islemler{

        public function __construct(){
            $baglan = new PDO("mysql:hostname=localhost;dbname=odev4;charset=utf8","root","");
            $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $baglan->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $baglan->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $baglan;
        }

        public function listele($tablo){
            $baglanti = self::__construct();
            $sorgu = $baglanti->query("SELECT * FROM $tablo");

            return $sorgu;
        }

        public function kaydet($adsoyad,$tckimlik){

            $durum = "";
            $metin = "";         
            $tekler = 0;
            $ciftler = 0;
            $kontrol1 = true;

            for( $i = 0; $i<strlen($tckimlik); $i++ ){
                if( !is_numeric ($tckimlik[$i]) ){
                    $kontrol1 = false;
                    break;
                }
            }
            if( strlen($tckimlik) != 11 || $tckimlik[0] == 0 || $kontrol1 == false){
                $metin = "Geçersiz Bilgi Girişi, Kayıt Edilemedi !!";
            }
            else{
                
                for($i=1; $i<=9; $i++){
                    if( $i % 2 == 0 ){
                        $ciftler += intval($tckimlik[$i-1]);
                    }
                    else{
                        $tekler += intval($tckimlik[$i-1]);
                    }
                }                
                $temp = (($tekler * 7) - $ciftler) % 10;
                if( $temp == intval($tckimlik[9])){

                    $temp2 = ($tekler + $ciftler + intval($tckimlik[9])) % 10;
                    
                    if($temp2 == intval($tckimlik[10])){
                        $durum = "TC Kimlik Geçerli";
                    }
                    else{
                        $durum = "TC Kimlik Geçersiz";
                    }
                }
                else{
                    $durum = "TC Kimlik Geçersiz";
                }

                $baglanti = self::__construct();
                $sorgu = $baglanti->prepare("INSERT into kisiler values(?,?,?,?)");
                $ekle = $sorgu->execute(array(NULL,$adsoyad,$tckimlik,$durum));

                if($ekle){
                    $metin = "Bilgiler Kaydedildi";
                }
                else {
                    $metin = "Bilgiler Kayıt Edilemedi";
                }
            }

            return $metin;
            
        }

    }

?>
