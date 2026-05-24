<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Hocam session dizisindeki kullanıcı verisini siliyorum
if (isset($_SESSION["kullanici_id"])) {
    unset($_SESSION["kullanici_id"]);
}

// Hocam sunucudaki tüm oturumu kalıcı olarak kapatıyorum
session_destroy();

// Hocam veri kırıntısı silme bittiği için doğrudan ana sayfaya yönlendiriyorum
header("Location: anasayfa.php");
exit;
?>