-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Ara 2022, 13:52:53
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ogrenci_yonetim`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `unvan` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(13) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad`, `soyad`, `unvan`, `adres`, `telefon`, `email`, `sifre`) VALUES
(1, 'Caner', 'KOSKOS', 'Doktora Öğretim Üyesi', 'Avcılar / İstanbul', '+905457867395', 'canerkoskos@gmail.com', 'b0403ddf2e47e59be335f12dd71f0cd22a283a31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `okul_no` int(11) NOT NULL,
  `vize` int(11) NOT NULL,
  `odev` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `ortalama` float NOT NULL,
  `gecme_durumu` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `notlar`
--

INSERT INTO `notlar` (`id`, `ad`, `soyad`, `okul_no`, `vize`, `odev`, `final`, `ortalama`, `gecme_durumu`) VALUES
(24, 'Ahmet', 'YILDIZ', 1308154638, 50, 70, 50, 55, 'Geçti / CC'),
(25, 'Sena', 'ŞENER', 1308210089, 0, 0, 0, 0, 'Not Girişi Yapılmadı'),
(26, 'Veli', 'ÖZTÜRK', 1309190048, 0, 0, 0, 0, 'Not Girişi Yapılmadı'),
(27, 'Fatma', 'TURGUT', 1306180048, 0, 0, 0, 0, 'Not Girişi Yapılmadı'),
(28, 'Osman', 'UZUN', 1306220074, 80, 90, 60, 72.5, 'Geçti / BB');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tckimlik` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `okul_no` int(11) NOT NULL,
  `bolum` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sinif` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `cinsiyet` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `dogum_tarihi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`id`, `ad`, `soyad`, `tckimlik`, `okul_no`, `bolum`, `sinif`, `cinsiyet`, `dogum_tarihi`) VALUES
(28, 'Ahmet', 'YILDIZ', '54876596832', 1308154638, 'Metalurji ve Malzeme Mühendisliği', '3.Sınıf', 'Erkek', '2001-11-04'),
(29, 'Sena', 'ŞENER', '64549351648', 1308210089, 'Endüstri Mühendisliği', '2.Sınıf', 'Kız', '1999-06-15'),
(30, 'Veli', 'ÖZTÜRK', '54308457070', 1309190048, 'Elektrik Elektronik Mühendisliği', '3.Sınıf', 'Erkek', '2001-11-18'),
(31, 'Fatma', 'TURGUT', '42574358630', 1306180048, 'Bilgisayar Mühendisliği', '4. Sınıf', 'Kız', '2000-12-26'),
(32, 'Osman', 'UZUN', '54218445325', 1306220074, 'Bilgisayar Mühendisliği', '1.Sınıf', 'Erkek', '2002-08-13');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
