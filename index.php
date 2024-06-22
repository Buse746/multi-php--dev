<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ana Sayfa</title>
    <style>
        .announcement-box {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 20px 0;
            background-color: #f9f9f9;
        }
        .announcement-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .announcement-content {
            font-size: 1em;
        }
    </style>
</head>
<body>
    <h1>Hoş geldiniz, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Misafir'; ?>!</h1>
    
    <div class="announcement-box">
        <div class="announcement-title">Duyurular</div>
        <div class="announcement-content">
            <ul>
                <?php
                // Duyurular dosyasını oku
                $file = fopen('duyurular.txt', 'r');
                if ($file) {
                    while (($line = fgets($file)) !== false) {
                        echo '<li>' . htmlspecialchars($line) . '</li>';
                    }
                    fclose($file);
                } else {
                    echo '<li>Duyurular yüklenemedi.</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    
</body>
</html>
