<?php
//login
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: login/userLogin.php");
    exit();
}
?>

<!-- <?php header('Location: home/home.php'); ?> -->