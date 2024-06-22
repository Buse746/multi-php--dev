<?php
// Veritabanı bağlantısı yapıldığını varsayalım
include("db.php");

// Oturumu başlat
session_start();

// Eğer kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
if (!isset($_SESSION["userid"])) {
    header("Location: cookie.php");
    exit();
}

// POST verisi kontrolü
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["switch_user"])) {
    // Seçilen kullanıcının id'sini al
    $switch_user_id = $_POST["switch_user"];

    // Kullanıcının mevcut oturumunu sonlandır
    session_unset();
    session_destroy();

    // Yeni kullanıcıya oturum başlat
    session_start();

    // Yeni kullanıcı bilgilerini veritabanından al
    $query = $baglanti->prepare("SELECT * FROM birinci WHERE id = ?");
    $query->bind_param("i", $switch_user_id);
    $query->execute();
    $result = $query->get_result();

    // Yeni kullanıcı bilgilerini oturum değişkenlerine ata
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["userid"] = $row["id"];
        $_SESSION["eposta"] = $row["eposta"];
        $_SESSION["adsoyad"] = $row["adsoyad"];
        $_SESSION["isAdmin"] = $row["isAdmin"];
    }

    // Profil sayfasına yönlendir
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesap Değiştir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Hesap Değiştir</h2>
        <form action="switch_user.php" method="post">
            <!-- Kullanıcıların seçebileceği hesaplar burada listelenir -->
            <?php
            $current_user_id = $_SESSION["userid"];
            $query = $baglanti->prepare("SELECT * FROM birinci WHERE id = ?");
            $query->bind_param("i", $current_user_id);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                // Mevcut oturumda giriş yapan kullanıcının hesabı buton olarak gösterilir
                $row = $result->fetch_assoc();
                echo '<button type="submit" name="switch_user" value="' . $row["id"] . '" class="btn btn-primary mt-3 me-2">Hesap ' . $row["id"] . '</button>';
            } else {
                // Oturum açan kullanıcının hesabı bulunamazsa, hata mesajı gösterilir
                echo "Mevcut oturumda giriş yapan kullanıcının hesabı bulunamadı.";
            }
            ?>
        </form>
    </div>
    <footer class="mt-5">
        <p>&copy; 2023 Tüm Hakları Saklıdır.</p>
    </footer>
</body>
</html>
