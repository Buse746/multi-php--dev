<?php
// Veritabanı bağlantı bilgilerini burada tanımlayın
$host = "localhost";
$username = "root";
$password = "";
$dbname = "usersdb";

try {
    // Veritabanına bağlan
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mesajları veritabanından al
    $query = $db->query("SELECT * FROM iletisim_mesajlari");
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);

    // Mesajları ekrana yazdır
    echo "<h2>Mesajlar</h2>";
    echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
    echo "<thead><tr><th>ID</th><th>Ad Soyad</th><th>E-posta</th><th>Mesaj</th></tr></thead>";
    echo "<tbody>";
    foreach ($messages as $message) {
        echo "<tr>";
        echo "<td style='border: 1px solid #000; padding: 8px;'>".$message['id']."</td>";
        echo "<td style='border: 1px solid #000; padding: 8px;'>".$message['ad_soyad']."</td>";
        echo "<td style='border: 1px solid #000; padding: 8px;'>".$message['email']."</td>";
        echo "<td style='border: 1px solid #000; padding: 8px;'>".$message['mesaj']."</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} catch(PDOException $e) {
    // Hata oluştuğunda hatayı yakala ve ekrana yazdır
    echo "<p>Mesajları gösterme işlemi sırasında bir hata oluştu: " . $e->getMessage() . "</p>";
}

?>
<a href="adminpanel.php" class="btn btn-secondary mt-3">Geri Dön</a>

<!-- Bootstrap CSS ekleyin -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
