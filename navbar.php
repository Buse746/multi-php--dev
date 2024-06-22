<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        body {
    font-family: Arial, sans-serif;
    background: url('background.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #333;
}
form {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    margin: auto;
    margin-top: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
input, textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php">Ana Sayfa</a>
    <a href="bize.php">Bize Ulaşın</a>
    <a href="admin.php">Admin</a>
    <?php if(isset($_SESSION['username'])): ?>
        <a href="oturum_ac.php">Hesapları Değiştir</a>
        <a href="logout.php">Çıkış Yap</a>
    <?php else: ?>
        <a href="giris.php">Giriş Yap</a>
        <a href="kayıt.php">Kayıt Ol</a>
    <?php endif; ?>
</div>
