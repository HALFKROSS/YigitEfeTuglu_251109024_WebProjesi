<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gezilerimiz</title>
    <link rel="stylesheet" href="style.css">
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
            <h1>Doğanın Derinlikleri Keşif Edilmeyi Bekliyor</h1>
        </div>
        <img src="images/zincirtabela.png" alt="">
    </div>

    <div id="y-ust-panel">
        <img src="images/logo-ust.png" alt="logo" id="y-logo-menu">
        <div id="y-ust-baglantilar">
            <div>
                <i class="fa-solid fa-house"></i><a href="anasayfa.php">AnaSayfa</a></div>
            <div>
                <i class="fa-solid fa-tree"></i><a href="geziler.php">Geziler</a></div>
            <?php 
            if(isset($_SESSION["kullanici_id"]) && $_SESSION["kullanici_id"] != null): 
            ?>
                <div><i class="fa-solid fa-screwdriver-wrench"></i><a href="yonetici.php">Yönetici Paneli</a></div>
            <?php else: ?>
                <div>
                <i class="fa-solid fa-square-envelope"></i><a href="iletisim.html">İletişim</a>
                </div>
                <div><i class="fa-solid fa-user"></i><a href="giris.html">Giriş</a></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="y-baslik y-gezi-baslik-alan">
        <h1>TÜM GEZİ PLANLARIMIZ</h1>
    </div>

    <div class="y-yapilanlar-tablosu-tamami y-gezi-tablo-kapsayici">
        <div class="y-yapilanlar-tablosu-kutu y-gezi-tablo-kutu-php">
            <table class="y-yapilanlar-tablosu">
                <thead>
                    <tr>
                        <th>Gezi Başlığı</th>
                        <th>Kişi Başı Fiyat (TL)</th>
                        <th>Rezervasyon İşlemi</th>
                    </tr>
                </thead>
                <tbody id="y-gezi-listesi-body">
                    <tr>
                        <td colspan="3" class="y-gezi-yukleniyor">Gezi planları yükleniyor...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="y-assagi-menu-tamami y-gezi-alt-menu">
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

    <script>
var aktif_kullanici_id = <?php echo isset($_SESSION["kullanici_id"]) ? intval($_SESSION["kullanici_id"]) : 0; ?>;

fetch("251109024_api.php")
.then(function(cevap) {
    return cevap.json();
})
.then(function(gelen_veri) {
    var tablo_alani = document.getElementById("y-gezi-listesi-body");
    tablo_alani.innerHTML = ""; 
    
    for (var i = 0; i < gelen_veri.length; i++) {
        var gezi = gelen_veri[i];
        var gercek_id = gezi.id ? gezi.id : gezi.ID;
        
        var buton_sutunu = "";
        if(aktif_kullanici_id > 0) {
            buton_sutunu = "<td><a href='rezervasyon_yap.php?gezi_id=" + gercek_id + "' class='y-rez-buton'>Rezervasyon Yap</a></td>";
        } else {
            buton_sutunu = "<td><a href='misafir_rezervasyon.php?gezi_id=" + gercek_id + "' class='y-rez-buton y-misafir-rez-buton'>Misafir Rezervasyonu</a></td>";
        }

        tablo_alani.innerHTML += "<tr>" +
            "<td>" + gezi.baslik + "</td>" +
            "<td>" + gezi.fiyat + " ₺</td>" +
            buton_sutunu +
            "</tr>";
    }
})
.catch(function(hata) {
    console.log("veriler sunucudan çekilirken bir sorun oluştu: ", hata);
});
    </script>
</body>

</html>