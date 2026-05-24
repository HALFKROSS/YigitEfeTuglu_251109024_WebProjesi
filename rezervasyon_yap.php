<?php
// hocam arkada dönen gizli hataları tarayıcıda görebilmek için bunları en başa aldım
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "baglanti.php";

// 1. KONTROL: hocam eğer adam hiç giriş yapmadan url ezberleyip geldiyse kapıdan çevirelim
if(!isset($_SESSION["kullanici_id"]) || $_SESSION["kullanici_id"] == null) {
    echo "<script>alert('Rezervasyon yapabilmek için önce sisteme üye girişi yapmalısınız!'); window.location.href='giris.html';</script>";
    exit;
}

// 2. KONTROL: url üzerinden gezi_id parametresi gelmiş mi bakıyoruz
if(isset($_GET["gezi_id"])) {
    $secilen_gezi_id = intval($_GET["gezi_id"]);
    $oturum_acan_kisi = $_SESSION["kullanici_id"]; // giriş yapan kullanıcının session id degeri
    
    // hocam eğer javascript tarafında gezi.id yerine yanlış bir sütun ismi yazdıysak burası 0 gelir ve kilitler
    if($secilen_gezi_id <= 0) {
        // hocam buradaki inline stilleri söktüm
        die("<h2 class='y-php-die-hata-kirmizi'>Hata: Tarayıcıdan geçersiz veya boş bir Gezi ID'si gönderildi! geziler.php dosyasındaki fetch döngüsünü kontrol edin.</h2>");
    }

    try {
        // hocam veritabanındaki 3lü inner join tablosunu besleyecek insert sorgusunu çalıştırıyoruz
        $sorgu_rez_ekle = $vt->prepare("INSERT INTO 251109024_rezervasyonlar (kisi_id, gezi_id) VALUES (?, ?)");
        $sorgu_rez_ekle->execute([$oturum_acan_kisi, $secilen_gezi_id]);
        
        // ekleme bitince kullanıcıyı uyarıp geziler sayfasına geri atıyoruz
        echo "<script>alert('Harika! Rezervasyonunuz başarıyla alındı. Şimdi yönetici paneline gidip aktif rezervasyonları görebilirsiniz.'); window.location.href='geziler.php';</script>";
        exit;
        
    } catch (PDOException $e) {
        // hocam eğer rezervasyonlar tablosundaki sütun isimleri (kisi_id, gezi_id) yanlışsa hata sessiz kalmayıp buraya düşecek
        die("<h2 class='y-php-die-hata-kirmizi'>Rezervasyon Veritabanına Kaydedilirken SQL Hatası Çıktı: " . $e->getMessage() . "</h2>");
    }
} else {
    // url'de gezi_id parametresi hiç yoksa direkt burası çalışır
    die("<h2 class='y-php-die-hata-turuncu'>Hata: Sayfaya herhangi bir gezi ID'si ulaşmadı!</h2>");
}
?>