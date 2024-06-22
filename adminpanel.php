<?php
include 'navbar.php';
include 'db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Giriş yapılmadıysa giriş sayfasına yönlendir
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin.php");
    exit();
}

// Yeni mesaj bildirimi
if (!isset($_SESSION['newMessageNotification'])) {
    $_SESSION['newMessageNotification'] = false;
}

// Kullanıcı Sil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = $db->prepare("DELETE FROM users WHERE id = ?");
    if ($query->execute([$id])) {
        header("Location: adminpanel.php");
        exit();
    } else {
        echo "Kullanıcı silinemedi: " . $query->errorInfo()[2];
    }
}

// Kullanıcı Ekle
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $db->prepare("INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)");
    if ($query->execute([$first_name, $last_name, $email, $username, $password])) {
        header("Location: adminpanel.php");
        exit();
    } else {
        echo "Kullanıcı eklenemedi: " . $query->errorInfo()[2];
    }
}

// Kullanıcı Güncelle
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $query = $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ? WHERE id = ?");
    if ($query->execute([$first_name, $last_name, $email, $username, $id])) {
        header("Location: adminpanel.php");
        exit();
    } else {
        echo "Kullanıcı güncellenemedi: " . $query->errorInfo()[2];
    }
}

// Kullanıcı Ara
$search_sql = "SELECT * FROM users";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_sql = "SELECT * FROM users WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR username LIKE ?";
    $query = $db->prepare($search_sql);
    $query->execute(["%$search%", "%$search%", "%$search%", "%$search%"]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = $db->query($search_sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="tel"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"], button {
            padding: 10px 15px;
            background-color: #5cb85c;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #4cae4c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f9f9f9;
        }
        .delete-button {
            color: #fff;
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Admin Paneli</h1>
    <?php if ($_SESSION['newMessageNotification']): ?>
    <div style="background-color: yellow; padding: 10px; margin-bottom: 10px;">
        Yeni bir mesaj var!
    </div>
    <?php 
    $_SESSION['newMessageNotification'] = false;
    endif; 
    ?>

    <form method="POST" action="adminpanel.php" style="display:inline;">
        <input type="text" name="search" placeholder="Kullanıcı Ara">
        <button type="submit" class="button" name="search">Ara</button>
    </form>
    <br><br>
    <a href="messages.php" class="button">Mesajlar</a>
    <a href="duyuru.php" class="button">Duyurular</a>
    <form method="POST" action="logout.php" style="display:inline;">
        <button type="submit" class="button">Çıkış</button>
    </form>
    <br><br>
    
    <button class="button" onclick="showSection('addUser')">Kullanıcı Ekle</button>
    <button class="button" onclick="showSection('userList')">Kullanıcılar</button>

    <!-- Kullanıcı Ekle Formu -->
    <div id="addUser" style="display:none;">
        <h2>Kullanıcı Ekle</h2>
        <form method="POST" action="adminpanel.php">
            <label for="first_name">Ad:</label>
            <input type="text" id="first_name" name="first_name" required><br>
            <label for="last_name">Soyad:</label>
            <input type="text" id="last_name" name="last_name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit" name="add" class="button">Kaydet</button>
        </form>
    </div>

    <!-- Kullanıcılar Tablosu -->
    <div id="userList" style="display:none;">
        <h2>Kullanıcılar</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Email</th>
                    <th>Kullanıcı Adı</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($results) > 0): ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]) ?></td>
                            <td><?= htmlspecialchars($row["first_name"]) ?></td>
                            <td><?= htmlspecialchars($row["last_name"]) ?></td>
                            <td><?= htmlspecialchars($row["email"]) ?></td>
                            <td><?= htmlspecialchars($row["username"]) ?></td>
                            <td>
                                <form method="POST" action="adminpanel.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <button type="submit" name="delete" class="delete-button">Sil</button>
                                </form>
                                <button class="button" onclick="openUpdateForm('<?=$row["id"] ?>', '<?= htmlspecialchars($row["first_name"]) ?>', '<?= htmlspecialchars($row["last_name"]) ?>', '<?= htmlspecialchars($row["email"]) ?>', '<?= htmlspecialchars($row["username"]) ?>')">Güncelle</button>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr><td colspan='6'>Kayıtlı kullanıcı yok</td></tr>
<?php endif; ?>
</tbody>
</table>
</div><!-- Kullanıcı Güncelleme Formu -->
<div id="updateForm" style="display:none;">
    <h2>Kullanıcı Güncelle</h2>
    <form method="POST" action="adminpanel.php">
        <input type="hidden" id="update_id" name="id">
        <label for="update_first_name">Ad:</label>
        <input type="text" id="update_first_name" name="first_name" required><br>
        <label for="update_last_name">Soyad:</label>
        <input type="text" id="update_last_name" name="last_name" required><br>
        <label for="update_email">Email:</label>
        <input type="email" id="update_email" name="email" required><br>
        <label for="update_username">Kullanıcı Adı:</label>
        <input type="text" id="update_username" name="username" required><br>
        <button type="submit" name="update" class="button">Kaydet</button>
        <button type="button" onclick="closeUpdateForm()" class="button">İptal</button>
    </form>
</div>

<script>
    function showSection(sectionId) {
        // Tüm sekmeleri gizle
        document.getElementById('addUser').style.display = 'none';
        document.getElementById('userList').style.display = 'none';
        document.getElementById('updateForm').style.display = 'none';

        // İstenilen sekme göster
        document.getElementById(sectionId).style.display = 'block';
    }

    function openUpdateForm(id, firstName, lastName, email, username) {
        document.getElementById('update_id').value = id;
        document.getElementById('update_first_name').value = firstName;
        document.getElementById('update_last_name').value = lastName;
        document.getElementById('update_email').value = email;
        document.getElementById('update_username').value = username;
        document.getElementById('updateForm').style.display = 'block';
    }

    function closeUpdateForm() {
        document.getElementById('updateForm').style.display = 'none';
    }
</script>
</body>
</html>
