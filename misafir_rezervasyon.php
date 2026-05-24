<?php
// hocam hata gösterme kodları her ihtimale karşı açık
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// hocam üst navbarda admin oturumunu kontrol edebilmek için session başlattım
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "baglanti.php";

// url'den gezi id gelmiş mi kontrol ediyoruz
if(!isset($_GET["gezi_id"])) {
    header("Location: geziler.php");
    exit;
}

$secilen_gezi = intval($_GET["gezi_id"]);

// HOCAM FORM POST EDİLDİĞİNDE BURASI ÇALIŞACAK (MİSAFİRİ ÖNCE KULLANICI YAPIP SONRA REZERVASYONUNU ALACAĞIZ)
if(isset($_POST["misafir_kaydet_buton"])) {
    $isim = trim($_POST["m_adsoyad"]);
    $eposta = trim($_POST["m_posta"]);
    
    if(!empty($isim) && !empty($eposta)) {
        try {
            // 1. ADIM: hocam misafiri sanki üyeymiş gibi kullanıcılar tablosuna ekliyoruz
            $sorgu_kullanici = $vt->prepare("INSERT INTO 251109024_kullanicilar (ad_soyad, mail, sifre) VALUES (?, ?, ?)");
            $sorgu_kullanici->execute([$isim, $eposta, 'misafir123']);
            
            // 2. ADIM: otomatik oluşan ID değerini yakalıyoruz
            $yeni_kisi_id = $vt->lastInsertId();
            
            // 3. ADIM: yakaladığımız bu ID ile rezervasyonlar tablosuna köprü kaydını atıyoruz
            $sorgu_rez = $vt->prepare("INSERT INTO 251109024_rezervasyonlar (kisi_id, gezi_id) VALUES (?, ?)");
            $sorgu_rez->execute([$yeni_kisi_id, $secilen_gezi]);
            
            echo "<script>alert('Rezervasyonunuz başarıyla alındı!'); window.location.href='geziler.php';</script>";
            exit;
            
        } catch (PDOException $e) {
            die("Veritabanı hatası meydana çıktı: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misafir Rezervasyon Formu</title>
    <link rel="stylesheet" href="style.css?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Emblema+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>

    <div id="y-zincirler-ustmenu">
        <img src="images/zincirtabela.png" alt="">
        <div>
            <img src="images/karsilasma-foto.png" alt="">
            <h1>HIZLI REZERVASYON FORMU</h1>
        </div>
        <img src="images/zincirtabela.png" alt="">
    </div>

    <div id="y-ust-panel">
        <img src="images/logo-ust.png" alt="logo" id="y-logo-menu">
        <div id="y-ust-baglantilar">
            <div><i class="fa-solid fa-house"></i><a href="anasayfa.php">AnaSayfa</a></div>
            <div><i class="fa-solid fa-tree"></i><a href="geziler.php">Geziler</a></div>
            <div><i class="fa-solid fa-square-envelope"></i><a href="iletisim.html">İletişim</a></div>
            <?php if(isset($_SESSION["kullanici_id"]) && $_SESSION["kullanici_id"] != null): ?>
                <div><i class="fa-solid fa-gauge-high"></i><a href="yonetici.php">Yönetici Paneli</a></div>
            <?php else: ?>
                <div><i class="fa-solid fa-user"></i><a href="giris.html">Giriş</a></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="y-giris-form-kutusu-bolum y-misafir-kapsayici-kutu">
        <h3 class="y-misafir-form-alt-baslik">Rezervasyon Bilgilerinizi Giriniz</h3>
        
        <form action="" method="POST">
            <i class="fa-solid fa-user"></i> Adınız Soyadınız<br>
            <input type="text" name="m_adsoyad" placeholder="Adınız Soyadınız" required>
            <hr>
            <i class="fa-solid fa-envelope"></i> E-posta Adresiniz<br>
            <input type="text" name="m_posta" placeholder="E-posta Adresiniz" required>
            <hr>
            <button type="submit" name="misafir_kaydet_buton" class="y-misafir-tamamla-butonu">Rezervasyonu Tamamla</button>
        </form>
        <br>
        <a href="geziler.php" class="y-misafir-geri-don-linki">← Gezilere Geri Dön</a>
    </div>

    <div class="y-assagi-menu-tamami y-misafir-footer-ust-bosluk">
        <div id="y-assa-sayfa-linkler">
            <h2>Sosyal Medyalarımız</h2>
            <a href=""><i class="fa-brands fa-youtube"></i></a><a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-x-twitter"></i></a><a href=""><i class="fa-brands fa-facebook"></i></a>
        </div>
        <div id="y-assa-sayfa-telefon">
            <h2>Telefon Numaramız</h2>
            <div id="y-telefon-icerikler"><i class="fa-solid fa-phone"></i>
                <h3>+90 0000 0000</h3>
            </div>
        </div>
        <div id="y-assa-sayfa-site-sayfalari">
            <h2>Site Sayfalarımız</h2>
            <div id="y-assa-sayfa-site-sayfalari-icerik">
                <a href="anasayfa.php"><i class="fa-solid fa-house"></i></a><a href="iletisim.html"><i class="fa-solid fa-square-envelope"></i></a>
            </div>
        </div>
        <div id="y-assa-sayfa-telif-hakki">
            <p>© 2024 Bu site, okul projesi kapsamında tamamen öğrenmek ve kendimi geliştirmek amacıyla hazırlanmıştır.</p>
        </div>
    </div>

</body>
</html>