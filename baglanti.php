<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Hocam yerel sunucu bilgilerini hata vermemesi için değişkenlere dağıttım
$sunucu_adresi = "localhost";
$veritabani_ismi = "251109024_webproje_doga";
$veritabani_kullanicisi = "root";
$veritabani_sifresi = "";

try {
    // Hocam türkçe karakterlerin veritabanında bozulmaması için bu ayar dizisini oluşturdum
    $baglanti_ayarlari = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    
    $vt = new PDO("mysql:host=$sunucu_adresi;dbname=$veritabani_ismi", $veritabani_kullanicisi, $veritabani_sifresi, $baglanti_ayarlari);
    
} catch (PDOException $hata_mesaji) {
    // Hocam bağlantıda xampp kaynaklı bir kopma olursa burası ekrana hata çıkacak
    echo "Bağlantı hattında hata çıktı: " . $hata_mesaji->getMessage();
    die();
}
?>