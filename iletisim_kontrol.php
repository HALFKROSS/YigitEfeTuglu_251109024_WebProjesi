<?php
include "baglanti.php";

$isim = $_POST["y_ad_soyad"];
$eposta = $_POST["y_posta"];
$mesajicerik = $_POST["y_mesaj"];

if(empty($mesajicerik)){ 
    die("mesaj alani bos birakilamaz"); 
}

// hocam ziyaretçilerin üye olmadan attığı mesajları/şikayetleri direkt burda veritabanına insert ettim
$mesajEkle = $vt->prepare("insert into 251109024_mesajlar (ad_soyad, mail, mesaj) values (?, ?, ?)");
$mesajEkle->execute([$isim, $eposta, $mesajicerik]);

//hocam ham HTML çıktısını harici CSS sınıfına bağlayarak görsel kırılmaları engelledim
echo "<div class='y-iletisim-basari-kutusu'>
        <h3>Mesajınız başarıyla iletildi!</h3> 
        <a href='anasayfa.php'><i class='fa-solid fa-house'></i> Ana Sayfaya Dön</a>
      </div>";
?>