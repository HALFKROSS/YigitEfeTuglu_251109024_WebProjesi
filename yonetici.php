<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "baglanti.php";

if(!isset($_SESSION["kullanici_id"]) || $_SESSION["kullanici_id"] == null) {
    header("Location: anasayfa.php");
    exit; 
}

// Hocam yönetim panelindeki tüm veritabanı silme taleplerini bu tek kontrol odasından yönetiyorum
if (isset($_GET["islem"]) && isset($_GET["id"])) {
    $islem_turu = $_GET["islem"];
    $hedef_id_degeri = intval($_GET["id"]);
    
    if ($islem_turu === "sil") {
        $sorgu_sil = $vt->prepare("DELETE FROM 251109024_geziler WHERE id = ?");
        $sorgu_sil->execute([$hedef_id_degeri]);
        header("Location: yonetici.php"); 
        exit;
    }
    
    if ($islem_turu === "mesaj_sil") {
        $sorgu_m_sil = $vt->prepare("DELETE FROM 251109024_mesajlar WHERE id = ?");
        $sorgu_m_sil->execute([$hedef_id_degeri]);
        header("Location: yonetici.php"); 
        exit;
    }
}

// Hocam form üzerinden yeni bir doğa rotası veya güncelleme post edildiğinde bu alan tetikleniyor
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["gezi_ekle_buton"])) {
        $eklenecek_rota_adi = trim($_POST["g_baslik"]);
        $eklenecek_rota_fiyati = intval($_POST["g_fiyat"]);
        
        if (!empty($eklenecek_rota_adi) && $eklenecek_rota_fiyati > 0) {
            $sorgu_ekle = $vt->prepare("INSERT INTO 251109024_geziler (baslik, fiyat) VALUES (?, ?)");
            $sorgu_ekle->execute([$eklenecek_rota_adi, $eklenecek_rota_fiyati]);
            header("Location: yonetici.php");
            exit;
        }
    }

    if (isset($_POST["gezi_guncelle_buton"])) {
        $guncelle_id = intval($_POST["g_id"]);
        $yeni_adi = trim($_POST["g_baslik"]);
        $yeni_fiyati = intval($_POST["g_fiyat"]);
        
        if (!empty($yeni_adi) && $yeni_fiyati > 0) {
            $sorgu_guncelle = $vt->prepare("UPDATE 251109024_geziler SET baslik = ?, fiyat = ? WHERE id = ?");
            $sorgu_guncelle->execute([$yeni_adi, $yeni_fiyati, $guncelle_id]);
            header("Location: yonetici.php");
            exit;
        }
    }
}

$guncellenecek_veri = null;
if (isset($_GET["islem"]) && $_GET["islem"] == "duzenle" && isset($_GET["id"])) {
    $duzenle_id = intval($_GET["id"]);
    // Hocam seçilen gezi detayını form alanına otomatik doldurmak için bu satırı ekledim
    $sorgu_getir = $vt->prepare("SELECT * FROM 251109024_geziler WHERE id = ?");
    $sorgu_getir->execute([$duzenle_id]);
    $guncellenecek_veri = $sorgu_getir->fetch(PDO::FETCH_ASSOC);
}

// Hocam kılavuzda istediğiniz 3lü inner join sorgusunu buraya bağladım
$sql_join = "select r.id as r_id, k.ad_soyad, g.baslik from 251109024_rezervasyonlar r inner join 251109024_kullanicilar k on r.kisi_id = k.id inner join 251109024_geziler g on r.gezi_id = g.id";
$joinSorgu = $vt->query($sql_join)->fetchAll(PDO::FETCH_ASSOC);

$tumGeziler = $vt->query("select * from 251109024_geziler")->fetchAll(PDO::FETCH_ASSOC);
$gelenMesajlar = $vt->query("select * from 251109024_mesajlar order by id desc")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Kontrol Panelı</title>
    <link rel="stylesheet" href="style.css?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Emblema+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
    <div id="y-zincirler-ustmenu">
        <img src="images/zincirtabela.png" alt="">
        <div><img src="images/karsilasma-foto.png" alt="">
            <h1>YÖNETİCİ KONTROL PANELİ</h1>
        </div>
        <img src="images/zincirtabela.png" alt="">
    </div>

    <div id="y-ust-panel">
        <img src="images/logo-ust.png" alt="logo" id="y-logo-menu">
        <div id="y-ust-baglantilar">
            <div><i class="fa-solid fa-house"></i><a href="anasayfa.php">AnaSayfa</a></div>
            <div><i class="fa-solid fa-tree"></i><a href="geziler.php">Geziler</a></div>
            <div><i class="fa-solid fa-screwdriver-wrench"></i><a href="yonetici.php">Yönetici Paneli</a></div>
        </div>
    </div>

    <div class="y-agaclar">
        <img src="images/agaclar.png" alt=""><img src="images/agaclar.png" alt="">
    </div>

    <div class="y-baslik">
        <h1>SİSTEM YETKİLİSİ KONTROL VE İŞLEM PANELİ</h1>
    </div>

    <div class="y-admin-cikis-kapsayici">
        <a href="cikis.php" class="y-admin-cikis"><i class="fa-solid fa-right-from-bracket"></i> Güvenli Çıkış</a>
    </div>

    <div class="y-iletisim-formu-alani">
        <?php if($guncellenecek_veri): ?>
            <h3 class="y-admin-h3">Gezi Planı Bilgilerini Güncelle</h3>
            <form action="yonetici.php" method="POST" class="y-admin-form">
                <input type="hidden" name="g_id" value="<?php echo $guncellenecek_veri['id']; ?>">
                <input type="text" name="g_baslik" class="y-admin-input" value="<?php echo $guncellenecek_veri['baslik']; ?>" required>
                <input type="number" name="g_fiyat" class="y-admin-input" value="<?php echo $guncellenecek_veri['fiyat']; ?>" required>
                <button type="submit" name="gezi_guncelle_buton" class="y-admin-buton">Kaydet</button>
                <a href="yonetici.php" class="y-admin-iptal">[İptal]</a>
            </form>
        <?php else: ?>
            <h3 class="y-admin-h3">Yeni Gezi Planı Ekle</h3>
            <form action="yonetici.php" method="POST" class="y-admin-form">
                <input type="text" name="g_baslik" class="y-admin-input" placeholder="Gezi Başlığı Giriniz" required>
                <input type="number" name="g_fiyat" class="y-admin-input" placeholder="Fiyat (TL) Giriniz" required>
                <button type="submit" name="gezi_ekle_buton" class="y-admin-buton">Yeni Gezi Planı Ekle</button>
            </form>
        <?php endif; ?>
    </div>

    <div class="y-iletisim-formu-alani">
        <h3 class="y-admin-h3">Aktif Gezi Planları</h3>
        
        <?php if(count($joinSorgu) > 0): ?>
            <?php foreach($joinSorgu as $satir): ?>
                <div class="y-liste-satir">
                    <b>Rezervasyon No:</b> #<?php echo $satir['r_id']; ?> | 
                    <b>Müşteri Adı:</b> <?php echo $satir['ad_soyad']; ?> | 
                    <b>Seçtiği Gezi Bölgesi:</b> <span class="y-admin-yesil-yazi"><?php echo $satir['baslik']; ?></span>
                </div>
                <hr class="y-admin-hr-10">
            <?php endforeach; ?>
        <?php else: ?>
            <p class="y-admin-p-bos">Henüz yapılmış rezervasyon bulunmuyor.</p>
        <?php endif; ?>
    </div>

    <div class="y-iletisim-formu-alani">
        <h3 class="y-admin-h3">Sistemdeki Mevcut Geziler</h3>
        
        <?php foreach($tumGeziler as $g): ?>
            <div class="y-liste-satir">
                <b>Gezi ID:</b> #<?php echo $g['id']; ?> | 
                <b>Bölge Başlığı:</b> <?php echo $g['baslik']; ?> | 
                <b>Fiyat:</b> <?php echo $g['fiyat']; ?> ₺ — 
                <a href="yonetici.php?islem=duzenle&id=<?php echo $g['id']; ?>" class="y-admin-link-duzenle">[Düzenle]</a>
                <a href="yonetici.php?islem=sil&id=<?php echo $g['id']; ?>" onclick="return confirm('Bu geziyi silmek istediğinize emin misiniz?')" class="y-admin-link-sil">[Sil]</a>
            </div>
            <hr class="y-admin-hr-15">
        <?php endforeach; ?>
    </div>

    <div class="y-iletisim-formu-alani y-admin-son-kutu">
        <h3 class="y-admin-h3">Ziyaretçi Mesajları ve Şikayetleri</h3>
        
        <?php if(count($gelenMesajlar) > 0): ?>
            <?php foreach($gelenMesajlar as $m): ?>
                <div class="y-liste-satir">
                    <b>Gönderen:</b> <span class="y-admin-yesil-yazi"><?php echo $m['ad_soyad']; ?></span> (<i><?php echo $m['mail']; ?></i>)<br>
                    <b>Mesajı:</b> <?php echo $m['mesaj']; ?> — 
                    <a href="yonetici.php?islem=mesaj_sil&id=<?php echo $m['id']; ?>" onclick="return confirm('Bu mesajı kalıcı olarak silmek istiyor musunuz?')" class="y-admin-link-mesaj-sil">[Mesajı Sil]</a>
                </div>
                <hr class="y-admin-hr-15">
            <?php endforeach; ?>
        <?php else: ?>
            <p class="y-admin-p-bos">Gelen şikayet veya öneri mesajı bulunmuyor.</p>
        <?php endif; ?>
    </div>

    <div class="y-assagi-menu-tamami">
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
                <a href="anasayfa.php"><i class="fa-solid fa-house"></i></a>
                <a href="iletisim.html"><i class="fa-solid fa-square-envelope"></i></a>
            </div>
        </div>
        <div id="y-assa-sayfa-telif-hakki">
            <p>© 2024 Bu site, okul projesi kapsamında tamamen öğrenmek ve kendimi geliştirmek amacıyla hazırlanmıştır.</p>
        </div>
    </div>
</body>

</html>