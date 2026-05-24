<?php
include "baglanti.php";

$ad = $_POST["y_ad_soyad"];
$mail = $_POST["y_posta"];
$sifre = $_POST["y_sifre"];

if(strlen($sifre) < 1){ die("sifre bos olamaz"); }

// hocam forma yazilanlari veritabanina yeni kayit attim burda
$ekle = $vt->prepare("INSERT INTO 251109024_kullanicilar (ad_soyad, mail, sifre) VALUES (?, ?, ?)");
$ekle->execute([$ad, $mail, $sifre]);

echo "Kayıt başarılı. <a href='giris.html'>Giriş yap</a>";
?>