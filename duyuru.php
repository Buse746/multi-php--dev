<?php
session_start();

$baslik = "";
$icerik = "";
$message = "";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $baslik = $_POST["baslik"];
    $icerik = $_POST["icerik"];

    // Girişleri doğrulama ve güvenlik kontrolleri
    // Bu örnekte girişler doğrudan kullanılıyor, gerçek uygulamalarda girişleri uygun şekilde filtrelemek önemlidir

    // Duyuruyu duyurular.txt dosyasına ekleyin
    $dosya = fopen("duyurular.txt", "a");
    if ($dosya) {
        fwrite($dosya, "Başlık: " . $baslik . "\nİçerik: " . $icerik . "\n\n");
        fclose($dosya);
        $message = "Duyuru başarıyla eklendi.";
    } else {
        $message = "Duyuru eklenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyuru Ekleme Formu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color:#f4f4f4;
            color:black;
            text-align: center;
            padding: 1em;
        }

        .container {
            padding: 2em;
        }
    </style>
</head>

<body>
    <header>
        <h1>Duyuru Ekleme Formu</h1>
    </header>
    <div class="container p-5">
        <div class="card p-5">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="baslik" class="form-label">Başlık:</label><br>
                    <input type="text" class="form-control" id="baslik" name="baslik" value="<?php echo htmlspecialchars($baslik); ?>"><br>
                </div>
                <div class="mb-3">
                    <label for="icerik" class="form-label">İçerik:</label><br>
                    <textarea class="form-control" id="icerik" name="icerik" rows="4"><?php echo htmlspecialchars($icerik); ?></textarea><br>
                </div>
                <button type="submit" class="btn btn-primary" name="ekle">Duyuru Ekle</button>
            </form>
            <div class="mt-3">
                <?php echo htmlspecialchars($message); ?>
            </div>
        </div>
        <a href="adminpanel.php" class="btn btn-secondary mt-3">Geri Dön</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
