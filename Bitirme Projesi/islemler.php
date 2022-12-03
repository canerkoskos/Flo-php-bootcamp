<?php
    session_start();
    $metin = "";
    class Islemler {
        
        public function __construct(){
            $baglan = new PDO("mysql:hostname=localhost;dbname=ogrenci_yonetim;charset=utf8","root","");
            $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $baglan->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $baglan->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $baglan;
        }
       
        public function kontrol($email,$sifre){

            $baglanti = self::__construct();
            $encrypted = sha1(md5($sifre));
            $sorgu = $baglanti->query("SELECT * FROM kullanicilar WHERE (email= '$email' && sifre= '$encrypted' )");
            $dizi = array();
            foreach($sorgu as $row){
                array_push($dizi, $row["ad"], $row["soyad"], $row["unvan"], $row["adres"], $row["telefon"], $row["email"]);
            }
            if(sizeof($dizi)>0){
                $_SESSION["kullanici"] = $dizi;              
                $_SESSION["giris"] = sha1(md5("var"));
                return true;
            }
            else{
                return false;
            }
        }

        public function ogrenci_kayit($ad, $soyad, $tckimlik, $okul_no, $bolum, $sinif, $cinsiyet, $dogum_tarihi){
            $baglanti = self::__construct();
            $sorgu1 = $baglanti->prepare("INSERT into ogrenciler values(?,?,?,?,?,?,?,?,?)");
            $ekle1 = $sorgu1->execute(array(NULL,$ad, $soyad, $tckimlik, $okul_no, $bolum, $sinif, $cinsiyet, $dogum_tarihi));
            $sorgu2 = $baglanti->prepare("INSERT into notlar values(?,?,?,?,?,?,?,?,?)");
            $ekle2 = $sorgu2->execute(array(NULL,$ad, $soyad, $okul_no, 0, 0, 0, 0, "Not Girişi Yapılmadı"));
            if($ekle1 && $ekle2){
                $metin = "Öğrenci Kayıt Edildi";
            }
            else {
                $metin = "Kayıt Gerçekleştirilemedi";
            }
            return $metin;
        }

        public function ogrenci_tablosu(){
            $baglanti = self::__construct();
            $sorgu = $baglanti->query("SELECT * FROM ogrenciler ");

            return $sorgu;
        }

        public function not_tablosu(){
            $baglanti = self::__construct();
            $sorgu = $baglanti->query("SELECT * FROM notlar ");

            return $sorgu;
        }
        
        public function not_girisi($okul_no, $vize, $odev, $final){
            $ortalama = ((($vize + $odev) / 2) + $final) / 2;
            $gecme_durumu = "";
            $harf_notu = "";
            if( $ortalama >= 40 && $final >= 50 ){
                
                if($ortalama <=44){
                    $harf_notu = "DD";
                }
                else if($ortalama <=49){
                    $harf_notu = "DC";
                }
                else if($ortalama <=59){
                    $harf_notu = "CC";
                }
                else if($ortalama <= 69){
                    $harf_notu = "CB";
                }
                else if($ortalama <= 79){
                    $harf_notu = "BB";
                }
                else if($ortalama <= 89){
                    $harf_notu = "BA";
                }
                else if($ortalama <= 100){
                    $harf_notu = "AA";
                }
                $gecme_durumu = "Geçti / ".$harf_notu;
            }
            else{
                $gecme_durumu = "Kaldı / FF";
            }
            $baglanti = self::__construct();
            $sorgu = $baglanti->prepare("UPDATE notlar SET vize=?, odev=?, final=?, ortalama=?, gecme_durumu=? WHERE (okul_no='$okul_no')");
            $ekle = $sorgu->execute(array($vize, $odev, $final, $ortalama, $gecme_durumu));
            if($ekle){
                $metin = "Not Girişi Yapıldı";
            }
            else{
                $metin = "İşlem Gerçekleşemedi ";
            }

            return $metin;
        }

        public function kayit_sil($okul_no){
            $baglanti = self::__construct();
            $sorgu1 = $baglanti->prepare("DELETE FROM ogrenciler WHERE (okul_no=?)");
            $sil1 = $sorgu1->execute(array($okul_no));
            $sorgu2 = $baglanti->prepare("DELETE FROM notlar WHERE (okul_no=?)");
            $sil2 = $sorgu2->execute(array($okul_no));

            if($sil1 && $sil2){
                $metin = "Öğrenci Kaydı Silindi";
            }
            else{
                $metin = "Kayıt Silinemedi! ";
            }

            return $metin;
        }

        public function ogrenciler_csv(){
            $baglanti = self::__construct();
            $sorgu = $baglanti->query("SELECT * FROM ogrenciler ");
            $dosya = "ogrenciler.csv";
            
            $handle = fopen($dosya, "wbt");
            fwrite($handle, "AD | SOYAD | TC KİMLİK NO | BÖLÜM | SINIF | OKUL NO | CİNSİYET | DOĞUM TARİHİ \n");
            foreach($sorgu as $row){
                fwrite($handle, "$row[ad] | $row[soyad] | $row[tckimlik] | $row[bolum] | $row[sinif] | $row[okul_no] | $row[cinsiyet] | $row[dogum_tarihi] \n");         
            }
            
            if(touch($dosya)){
                $metin = "CSV Dosyası Başarıyla Oluşturuldu";
            }
            else{
                $metin = "Dosya Oluşturma Başarısız!";
            }
            fclose($handle);
            return $metin;
           
        }  
        
        public function notlar_csv(){
            $baglanti = self::__construct();
            $sorgu = $baglanti->query("SELECT * FROM notlar ");
            $dosya = "notlar.csv";
            
            $handle = fopen($dosya, "wbt");
            fwrite($handle, "AD | SOYAD | OKUL NO | VİZE | ÖDEV | FİNAL | ORTALAMA | GEÇME DURUMU \n");
            foreach($sorgu as $row){
                fwrite($handle, "$row[ad] | $row[soyad] | $row[okul_no] | $row[vize] | $row[odev] | $row[final] | $row[ortalama] | $row[gecme_durumu] \n");         
            }
            
            if(touch($dosya)){
                $metin = "CSV Dosyası Başarıyla Oluşturuldu";
            }
            else{
                $metin = "Dosya Oluşturma Başarısız!";
            }
            fclose($handle);
            return $metin;
           
        }

        public function sifre_degistirme($email, $eski_sifre, $yeni_sifre){
            $baglanti = self::__construct();
            $encrypted1 = sha1(md5($eski_sifre));
            $encrypted2 = sha1(md5($yeni_sifre));
            $sorgu = $baglanti->query("SELECT * FROM kullanicilar WHERE (email= '$email' && sifre= '$encrypted1')");
            $dizi = array();
            foreach($sorgu as $row){
                array_push($dizi, $row["id"]);
            }
            if(sizeof($dizi)>0){
                    
                $sorgu = $baglanti->prepare("UPDATE kullanicilar SET sifre=? WHERE (email='$email')");
                $guncelle = $sorgu->execute(array($encrypted2));
                if($guncelle){
                    $metin = "Şifre Değiştirildi Tekrar Giriş Yapmanız Gerekmektedir!";
                }
                else{
                    $metin = "İşlem Gerçekleşemedi ";
                }
            }
            else{
                $metin = "Eski Şifre Hatalı ";
            }

            return $metin;
        }

        public function bilgileri_guncelle($unvan, $adres, $telefon, $email){
            $baglanti = self::__construct();
            $sorgu = $baglanti->prepare("UPDATE kullanicilar SET unvan=?, adres=?, telefon=? WHERE (email='$email')");
            $guncelle = $sorgu->execute(array($unvan, $adres, $telefon));
           
            if($guncelle){
                $metin = "Bilgi Değişikliği Kaydedildi Tekrar Giriş Yapmanız Gerekmektedir !";
            }
            else {
                $metin = "Değişiklik Gerçekleştirilemedi";
            }
            return $metin;
        }

    }
?>