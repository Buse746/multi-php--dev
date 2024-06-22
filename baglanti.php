<?php
$servername = "127.0.0.1"; // veya $servername = "localhost";
$username = "root";
$password = "";
$dbname = "usersdb";

// MySQLi ile veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
echo "MySQLi ile bağlantı başarılı";

// PDO ile veritabanı bağlantısı
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "PDO ile bağlantı başarılı";
} catch(PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}
?>
