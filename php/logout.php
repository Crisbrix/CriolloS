<?php
session_start();
session_destroy();
header('Location: ../core/login_empresa.php');
exit();
?>
