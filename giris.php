<?php
include 'db.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $dbUsername, $dbPassword);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $dbPassword)) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "Hatalı şifre!";
        }
    } else {
        echo "Kullanıcı bulunamadı!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
</head>
<body>
    <form method="POST" action="giris.php">
        <label>Kullanıcı Adı:</label>
        <input type="text" name="username" required><br>
        <label>Şifre:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>
