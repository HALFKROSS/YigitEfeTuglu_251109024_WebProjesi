<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "baglanti.php";

$giris_paneli_eposta = isset($_POST["y_posta"]) ? trim($_POST["y_posta"]) : "";
$giris_paneli_sifre = isset($_POST["y_sifre"]) ? $_POST["y_sifre"] : ""; 

if (!empty($giris_paneli_eposta) && !empty($giris_paneli_sifre) && $giris_paneli_sifre !== "misafir123") {
    // hocam giriş yapmaya çalışan e-posta adresini hazırladığım güvenli sorguyla aratıyorum
    $sistemdeki_uyeyi_sorgula = $vt->prepare("SELECT id, mail, sifre FROM 251109024_kullanicilar WHERE mail = ?");
    $sistemdeki_uyeyi_sorgula->execute([$giris_paneli_eposta]);
    $bulunan_uyenin_satirlari = $sistemdeki_uyeyi_sorgula->fetch(PDO::FETCH_ASSOC);

    //veritabanından gelen kullanıcı şifresiyle formdan girilen şifreyi burada karşılaştırıyorum hocam
    if ($bulunan_uyenin_satirlari && $bulunan_uyenin_satirlari["sifre"] === $giris_paneli_sifre) {
        $_SESSION["kullanici_id"] = $bulunan_uyenin_satirlari["id"];
        header("Location: yonetici.php");
        exit;
    } else {
        echo "<h3 class='y-giris-hata-mesaji'>Girdiğiniz bilgiler hatalı!</h3>";
    }
}
?>