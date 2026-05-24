<?php
include "baglanti.php";
header('Content-Type: application/json');

// Hocam istek türünü doğrudan if'e sokmak yerine bir değişkene bağladım
$istek_kanali = $_SERVER["REQUEST_METHOD"];

// Hocam get dışındaki veri değiştirme işlemlerini güvenli olması için bu blokta topladım
if ($istek_kanali !== "GET") {

    if ($istek_kanali == "POST") {
        // hocam form alanından gelen dataları isset ile kontrol ederek değişkenlere atadım
        $form_rota_adi = isset($_POST["b"]) ? trim($_POST["b"]) : "";
        $form_rota_fiyati = isset($_POST["f"]) ? intval($_POST["f"]) : 0;
        
        if ($form_rota_adi == "" || $form_rota_fiyati <= 0) {
            echo json_encode(["hata" => "Eksik bilgi ulaştı"]);
            exit;
        }
        
        // Hocam sql injection koruması olması amacıyla ödevde istediğiniz gibi prepare kullandım
        $rota_ekleme_komutu = $vt->prepare("INSERT INTO 251109024_geziler (baslik, fiyati) VALUES (?, ?)");
        $rota_ekleme_komutu->execute([$form_rota_adi, $form_rota_fiyati]);
        
        header("Location: yonetici.php");
        exit;
    }

    // Hocam put ve delete işlemleri için php://input üzerinden gelen ham girdiyi yakalıyorum
    $ham_veri_akisi = file_get_contents("php://input");

    if ($istek_kanali == "DELETE") {
        $silme_parcalari = explode("=", $ham_veri_akisi);
        $tablodan_silinecek_id = isset($silme_parcalari[1]) ? intval($silme_parcalari[1]) : 0;
        
        if ($tablodan_silinecek_id > 0) {
            $rota_sil_sorgusu = $vt->prepare("DELETE FROM 251109024_geziler WHERE id=?");
            $rota_sil_sorgusu->execute([$tablodan_silinecek_id]);
            echo json_encode(["durum" => "silme_basarili"]);
        } else {
            echo json_encode(["hata" => "Gecersiz kimlik"]);
        }
        exit;
    }

    if ($istek_kanali == "PUT") {
        $guncelleme_parametreleri = explode("&", $ham_veri_akisi);
        $id_kismi = explode("=", $guncelleme_parametreleri[0]);
        $baslik_kismi = explode("=", $guncelleme_parametreleri[1]);
        
        $duzenlenecek_gezi_id = isset($id_kismi[1]) ? intval($id_kismi[1]) : 0;
        $guncel_gezi_basligi = isset($baslik_kismi[1]) ? urldecode(trim($baslik_kismi[1])) : "";
        
        // Hocam veriler eksiksiz ulaştıysa update sorgusunu tetikleyip json basıyorum
        if ($duzenlenecek_gezi_id > 0 && !empty($guncel_gezi_basligi)) {
            $rota_guncelle_sorgusu = $vt->prepare("UPDATE 251109024_geziler SET baslik=? WHERE id=?");
            $rota_guncelle_sorgusu->execute([$guncel_gezi_basligi, $duzenlenecek_gezi_id]);
            echo json_encode(["sonuc" => "guncellendi"]);
        } else {
            echo json_encode(["sonuc" => "parametre_hatasi"]);
        }
        exit;
    }

} else {
    // harici kılavuzdaki gezi tablosunu doldurmak için verileri seçtiriyorum hocam
    $tablo_sorgusu = $vt->query("SELECT * FROM 251109024_geziler");
    $gezi_listesi_verisi = $tablo_sorgusu->fetchAll(PDO::FETCH_ASSOC);
    
    if (!$gezi_listesi_verisi) {
        echo json_encode(["durum" => "bos_veri"]);
        exit;
    }
    echo json_encode($gezi_listesi_verisi);
    exit;
}

echo json_encode(["mesaj" => "Gecersiz istek"]);
exit;
?>