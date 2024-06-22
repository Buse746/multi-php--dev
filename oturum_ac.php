<?php
session_start();

// Oturum değişkenleri yüklenip yüklenmediğini kontrol et
if (isset($_SESSION["id_array"]) && is_array($_SESSION["id_array"])) {
    // GET parametresi kontrolü (session veya id)
    if (isset($_GET['session'])) {
        $session = $_GET['session'];
        if (in_array($session, $_SESSION['sessions'])) {
            $_SESSION['active_session'] = $session;
        }
    }

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $_SESSION["userid"] = $id;
        header("Location: index.php");
        exit; // header yönlendirmesi sonrası kodun devam etmemesi için exit kullan
    }

    foreach ($_SESSION["id_array"] as $id) {
        // Her bir $id için gerekli işlemleri yap
        if (isset($_SESSION["userid"]) && isset($_SESSION["array"][$id]["kadi"])) {
            echo "<div class='change'> <span " . ($_SESSION["userid"] == $id ? 'style="color:red;"' : '') . ">" . $_SESSION["array"][$id]["kadi"] . "</span>";
            if ($_SESSION["userid"] != $id) {
                echo '<a href="degistir.php?id=' . $id . '">[seç]</a>';
            }
            echo "</div>";
        } else {
            echo "Oturum değişkenleri eksik veya hatalı.";
        }
    }
} else {
    echo "Oturum değişkenleri yüklenemedi.";
}

// Session parametresi kontrolü
if (isset($_GET['session'])) {
    header("Location: index.php");
    exit();
}
?>
