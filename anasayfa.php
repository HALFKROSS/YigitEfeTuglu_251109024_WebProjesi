<?php
// hocam anasayfada giriş yapan yöneticinin panel linkini görebilmesi için session kontrolü başlattım
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doğanın Derinlikleri - AnaSayfa</title>

    <link rel="stylesheet" href="style.css?v=999">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Emblema+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <i class="fa-solid fa-house"></i>
                <a href="anasayfa.php">AnaSayfa</a>
            </div>
            <div>
                <i class="fa-solid fa-tree"></i>
                <a href="geziler.php">Geziler</a>
            </div>

            <?php 
            // hocam eğer admin session id'si doluysa yani giriş yapıldıysa menüde panel linki çıksın, yoksa normal giriş çıksın
            if(isset($_SESSION["kullanici_id"]) && $_SESSION["kullanici_id"] != null): 
            ?>
                <div>
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <a href="yonetici.php">Yönetici Paneli</a>
                </div>
            <?php else: ?>
                
            <div>
                <i class="fa-solid fa-square-envelope"></i>
                <a href="iletisim.html">İletişim</a>
            </div>

                <div>
                    <i class="fa-solid fa-user"></i>
                    <a href="giris.html">Giriş</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="y-agaclar">
        <img src="images/agaclar.png" alt="">
        <img src="images/agaclar.png" alt="">
    </div>

    <div class="y-baslik">
        <h1>GRUBUMUZA NEDEN KATILMALISIN</h1>
    </div>

    <div class="y-etkinlik-kartlari-alani">
        <div class="y-etkinlik-kartlari-kutusu">
            <img src="images/balik-card.jpg" alt="" class="y-etkinlik-kartlari-ressim">
            <h2>BALIK TUTMAK</h2><br>
            <p>Akşam yemeklerimiz için balık tutarız; hem ruha iyi gelir, hem de doğada kalma yetenekleriniz artar.
                Böylece, ya doğada tek kalırken kendi başınıza yemeğinizi bulursunuz, ya da istediğiniz zaman balık
                tutarak kafanızı dağıtırsınız ve içinizdeki sıkıntıları bir kenara bırakıp huzura bir adım
                yaklaşırsınız.</p>
        </div>
        <div class="y-etkinlik-kartlari-kutusu-orta">
            <img src="images/doga-card.jpg" alt="" class="y-etkinlik-kartlari-ressim">
            <h2>DOĞAYI KEŞFETMEK</h2><br>
            <p>Doğayı keşfederek, günlük yaşadığımız gürültülü ve sağlığa zararlı hava kirliliğinden uzaklaşırız. Havası
                en temiz, kafamızı arındıran, huzurlu ve gürültüsüz bir ortamı keşfeder; doğa ananın güzelliklerinin
                tadını yavaşça, sindire sindire çıkarırız.
            </p>
        </div>
        <div class="y-etkinlik-kartlari-kutusu">
            <img src="images/tırman-card.jpg" alt="" class="y-etkinlik-kartlari-ressim">
            <h2>TREEKİNG YAPMAK</h2><br>
            <p>Ekstrem sporlardan biri olan ve gerçekten zorlu bir spor olan treeking yapıyoruz
                fakat bu spor biraz riskli olduğundan isteyenler katılabilir bilmeyip treeking yapmak isteyenler için
                ise ilk olarak
                güvenli ortamlarda treeking eğitim veriyoruz böylece hem kendi başınıza treeking yapıp dağların
                eteklerine tırmanıp doğanın en tepesinde siz olabilirsiniz</p>
        </div>
        <div class="y-etkinlik-kartlari-kutusu">
            <img src="images/yemek-card.jpg" alt="" class="y-etkinlik-kartlari-ressim">
            <h2>YEMEK YAPMAK</h2><br>
            <p>Her aktivitemizden sonra tabii ki enerjimiz tükenir, energy depomuz yavaş yavaş boşalır. Bunun önüne
                birlikte yemek yiyerek geçeriz. Yemek yaparken herkese, doğada tek başına kalındığında neler yapılması
                gerektiğini ve nasıl pratik, lezzetli yemekler hazırlanabileceğini öğretiriz. Böylece hem doğada hayatta
                kalma becerilerinizi geliştirir hem de tek başınıza kaldığınızda bile enfes mi enfes yemekler
                yapabilecek özgüveni kazanırsınız.
            </p>
        </div>
        <div class="y-etkinlik-kartlari-kutusu-orta">
            <img src="images/ates-card.avif" alt="" class="y-etkinlik-kartlari-ressim">
            <h2>KAMP ATEŞİ</h2><br>
            <p>Tabiki doğayı sadece doğanın güzelliklerini görmek için gelmeyiz ayrıca grubumuzu doğayı sevenleri
                toplamak için açtık böylece sosyal çevremiz genişler bunuda kamp ateşi yakıp etrafında toplanıp
                anılarımız ve deneyimlerimizden bahsederek gerçekleştiririz sizinle aynı düşüncelere sahip insanlarla
                aynı yerde buluşmanızı sağlarız</p>
        </div>
        <div class="y-etkinlik-kartlari-kutusu">
            <img src="images/yıldız-card.webp" alt="" class="y-etkinlik-kartlari-ressim">
            <h2>YILDIZLARI İNCELEME</h2><br>
            <p>Tabii ki yıldızlar da doğanın bir parçasıdır; fakat onlar ulaşamadığımız yerlerdedir. Bu sorunu teleskop
                ile çözeriz. Kampımızdaki herkes, yıldızların ve gezegenlerin gizemli güzelliğine teleskop aracılığıyla
                tanık olur. Böylece uzayın bizden gizlenmiş güzelliklerini yakından inceleme fırsatı buluruz.</p>
        </div>
    </div>

    <div class="y-baslik" id="y-baslik-orta-1">
            <h1>GÜN İÇEDİR YAPTIKLARIMIZ</h1>
    </div>

    <div class="y-yapilanlar-tablosu-tamami">
        <div class="y-yapilanlar-tablosu-kutu">
            <table class="y-yapilanlar-tablosu">
                <tr>
                    <th>Yapılanlar</th>
                    <th>Neler Yaparız</th>
                    <th>Zorluk Derecesi</th>
                </tr>
                <tr>
                    <td>Balık Tutmak</td>
                    <td>Doğayı gezip kamp alanına geri döndüğümüzde acıkırız ve yanımıza bazen yemek almayıp balık tutarız.</td>
                    <td>Basit</td>
                </tr>
                <tr>
                    <td>Doğayı Turlamak</td>
                    <td>Her hafta farklı yerlere gidip o yerlerin yeşilliğini hayvanlarını güzelliğini incelemek için doğada gezeriz</td>
                    <td>Basit</td>
                </tr>
                <tr>
                    <td>Kamp Ateşi Yakmak</td>
                    <td>Akşamları gece buz gibi soğuk olur bundan dolayı ateş yakıp içimizi ısıtıp hemde sohbet ederiz</td>
                    <td>Orta</td>
                </tr>
                <tr>
                    <td>Trekking Yapmak</td>
                    <td>Uzman gözetimi altında treeking yapıp doğanın iyi yönü değil zor yönlerine göğüs germeyide öğreniriz</td>
                    <td>Zorlu</td>
                </tr>
                <tr>
                    <td>Yemek Yapmak</td>
                    <td>Doğada tek kalırsanız nasıl enfes yemekler yapçağınızı uzman şefimizle sizlere öğretiriz </td>
                    <td>Basit</td>
                </tr>
                <tr>
                    <td>Yıldızlara Bakmak</td>
                    <td>Gece yıldızlar dağlarda çok daha net olur bu yüzden yanımızda teleskopu eksik etmeyiz</td>
                    <td>Basit</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="y-iframe-alani-tamami">
        <div class="y-baslik" id="y-baslik-orta-2">
             <h1>BULUNDUĞUMUZ GÜZEL ORTAMLARDAN BİR TANESİ</h1>
        </div>
        <div class="y-iframe-alani">
            <img src="images/agaclar.png" alt="" class="y-sag-duran-ressim">
            <img src="images/agaclar.png" alt="">
            <img src="images/agaclar.png" alt=""  class="y-sol-duran-ressim">
 
            <iframe src="https://www.youtube.com/embed/eNUpTV9BGac?autoplay=1&mute=1&controls=1&loop=1&playlist=eNUpTV9BGac" title="Gezdiğimiz Yerler" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen ></iframe>

            <img src="images/agaclar.png" alt="" class="y-assa-duran-ressim" class="y-sag-duran-ressim">
            <img src="images/agaclar.png" alt="" class="y-assa-duran-ressim">
            <img src="images/agaclar.png" alt="" class="y-assa-duran-ressim" class="y-sol-duran-ressim">
       </div>
    </div>

    <div class="y-assagi-menu-tamami">
        <div id="y-assa-sayfa-linkler">
            <h2>Sosyal Medyalarımız</h2>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-x-twitter"></i></a>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
        </div>

        <div id="y-assa-sayfa-telefon">
            <h2>Telefon Numaramız</h2>
            <div id="y-telefon-icerikler">
                <i class="fa-solid fa-phone"></i>
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
            <p>© 2024 Bu site, okul projesi kapsamında tamamen öğrenmek ve kendimi geliştirmek
              amacıyla hazırlanmıştır.Buradaki içerikler ticari bir amaç taşımaz ve resmi bir
              telif hakkı iddiasında bulunulmaz.</p>
        </div>
    </div>
</body>

</html>