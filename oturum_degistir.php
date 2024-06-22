<?php
session_start();

if (isset($_GET['session'])) {
    $session = $_GET['session'];
    if (in_array($session, $_SESSION['sessions'])) {
        $_SESSION['active_session'] = $session;
    }
}

header("Location: index.php");
exit();
?>
