<?php
include 'db.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Şifreyi hashleyerek saklama

    // Email kontrolü
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
        echo "Lütfen geçerli bir Gmail adresi girin.";
    } else {
        // Kullanıcı adının sadece sayı olmaması kontrolü
        if (is_numeric($username)) {
            echo "Kullanıcı adı sadece sayı olamaz.";
        } else {
            // Veritabanına kayıt ekleme
            $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $username, $password);

            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                header("Location: giris.php");
                exit();
            } else {
                echo "Hata: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol</title>

</head>
<body>
    <form method="POST" action="kayıt.php" id="registerForm">
        <label>Ad:</label>
        <input type="text" name="first_name" required>
        <label>Soyad:</label>
        <input type="text" name="last_name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Kullanıcı Adı:</label>
        <input type="text" name="username" required>
        <label>Şifre:</label>
        <input type="password" name="password" required>
        <button type="submit">Kayıt Ol</button>
        <div class="error" id="error_message"></div>
    </form>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            const username = document.querySelector('input[name="username"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const errorMessage = document.getElementById('error_message');
            errorMessage.textContent = '';

            if (!email.endsWith('@gmail.com')) {
                errorMessage.textContent = 'Lütfen geçerli bir Gmail adresi girin.';
                event.preventDefault();
            } else if (!isNaN(username)) {
                errorMessage.textContent = 'Kullanıcı adı sadece sayı olamaz.';
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
