<?php
include "baglanti.php";

// Hocam kullanıcının tarayıcıda açık kalan tüm oturum verilerini bu fonksiyonla sıfırlıyorum
session_destroy();

// güvenli çıkış yapıldıktan sonra ziyaretçiyi direkt ana sayfaya yönlendiriyorum
header("Location: anasayfa.html");
exit;
?>