<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: core/login_empresa.php');
    exit();
}
?>