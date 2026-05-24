-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 May 2026, 12:44:51
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `251109024_webproje_doga`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `251109024_geziler`
--

CREATE TABLE `251109024_geziler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(100) NOT NULL,
  `fiyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `251109024_geziler`
--

INSERT INTO `251109024_geziler` (`id`, `baslik`, `fiyat`) VALUES
(2, 'Sinop Boyabat', 433),
(3, 'Pamuk Kale', 644),
(4, 'Rusya', 5556);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `251109024_kullanicilar`
--

CREATE TABLE `251109024_kullanicilar` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `sifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `251109024_kullanicilar`
--

INSERT INTO `251109024_kullanicilar` (`id`, `ad_soyad`, `mail`, `sifre`) VALUES
(3, 'YiğitEfeTuğlu', 'admin@gmail.com', '123'),
(4, 'Paşazade Kerem', 'pasazadeKerem@gmail.com', 'misafir123'),
(5, 'Kemal', 'kemal153@gmail.com', 'misafir123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `251109024_mesajlar`
--

CREATE TABLE `251109024_mesajlar` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mesaj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `251109024_mesajlar`
--

INSERT INTO `251109024_mesajlar` (`id`, `ad_soyad`, `mail`, `mesaj`) VALUES
(1, 'Kemal', 'kemal@gmail.com', 'patates lazım tarlalara');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `251109024_rezervasyonlar`
--

CREATE TABLE `251109024_rezervasyonlar` (
  `id` int(11) NOT NULL,
  `kisi_id` int(11) NOT NULL,
  `gezi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `251109024_rezervasyonlar`
--

INSERT INTO `251109024_rezervasyonlar` (`id`, `kisi_id`, `gezi_id`) VALUES
(1, 4, 2),
(2, 5, 4);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `251109024_geziler`
--
ALTER TABLE `251109024_geziler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `251109024_kullanicilar`
--
ALTER TABLE `251109024_kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `251109024_mesajlar`
--
ALTER TABLE `251109024_mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `251109024_rezervasyonlar`
--
ALTER TABLE `251109024_rezervasyonlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `251109024_geziler`
--
ALTER TABLE `251109024_geziler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `251109024_kullanicilar`
--
ALTER TABLE `251109024_kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `251109024_mesajlar`
--
ALTER TABLE `251109024_mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `251109024_rezervasyonlar`
--
ALTER TABLE `251109024_rezervasyonlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
