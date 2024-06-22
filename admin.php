<?php
session_start();

// Kullanıcı adı ve şifre kontrolü
$valid_username = "admin";
$valid_password = "123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["loggedin"] = true;
        header("Location: adminpanel.php");
        exit;
    } else {
        $error = "Geçersiz kullanıcı adı veya şifre";
    }
}

// Giriş yapılmış mı kontrolü
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Girişi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Admin Panel Girişi</h2>
        <div>
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Şifre:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <input type="submit" value="Giriş Yap">
        </div>
    </form>
    <?php if(isset($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>