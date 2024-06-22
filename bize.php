<?php
include 'navbar.php';
include 'db.php'; // Veritabanı bağlantısı için gerekli dosya
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayakkabı Mağazası</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 2em;
        }

        .container-fluid, .container {
            margin: 0 auto;
            max-width: 800px; /* İçeriğin genişliğini sınırla */
        }
        
        /* Form stilleri */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-container button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-button {
            margin-top: 10px;
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
  
<section>
    <div class="container form-container">
        <h2 class="mb-4">Bize Ulaşın</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Ad Soyad:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-posta:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mesaj:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Formdan gelen verileri al
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            
            // Tarih ve saat bilgisini al
            $date = date("Y-m-d H:i:s");

            // Veritabanına mesajı ekleme
            $sql = "INSERT INTO iletisim_mesajlari (ad_soyad, email, mesaj, tarih) VALUES ('$name', '$email', '$message', '$date')";

            if (mysqli_query($conn, $sql)) {
                echo "<p style='color: green;'>Mesajınız başarıyla kaydedildi. En kısa sürede size dönüş yapılacaktır.</p>";
            } else {
                echo "<p style='color: red;'>Mesajınız kaydedilirken bir hata oluştu: " . mysqli_error($conn) . "</p>";
            }
        }
        ?>
    </div>
</section>
<a href="index.php" class="back-button">Geri Dön</a>
</body>
</html>
