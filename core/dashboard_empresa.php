<?php
session_start();
if (!isset($_SESSION['empresa_id'])) {
    header('Location: login_empresa.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Empresa | CriolloS POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../img/CriolloST.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            CriolloS POS - <?= htmlspecialchars($_SESSION['empresa_nombre']) ?>
        </a>
        <div class="d-flex">
            <a href="php/logout_empresa.php" class="btn btn-outline-light">Salir</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1 class="mb-4">Bienvenido, <?= htmlspecialchars($_SESSION['empresa_nombre']) ?></h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">➕ Crear Usuario</h5>
                    <p class="card-text">Agrega meseros, cajeros o cocina.</p>
                    <a href="nuevo_usuario.php" class="btn btn-primary">Crear Usuario</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">📋 Ver Ventas</h5>
                    <p class="card-text">Consulta las ventas realizadas.</p>
                    <a href="#" class="btn btn-primary">Ver Ventas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">⚙️ Configurar Empresa</h5>
                    <p class="card-text">Actualiza datos de tu restaurante.</p>
                    <a href="#" class="btn btn-primary">Configurar</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>