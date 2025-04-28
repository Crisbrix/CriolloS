<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | CriolloS POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../img/CriolloST.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            CriolloS POS
        </a>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> (<?= htmlspecialchars($_SESSION['usuario_rol']) ?>)
            </span>
            <a href="../php/logout.php" class="btn btn-outline-light">Salir</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1 class="mb-4">Bienvenido al sistema CriolloS POS</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Ventas</h5>
                    <p class="card-text">Realizar ventas diarias.</p>
                    <a href="#" class="btn btn-primary">Ir a Ventas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text">Gestionar productos e inventario.</p>
                    <a href="#" class="btn btn-primary">Ir a Productos</a>
                </div>
            </div>
        </div>

        <?php if ($_SESSION['usuario_rol'] === 'admin'): ?>
        <div class="col-md-4">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Administrar usuarios del sistema.</p>
                    <a href="nuevo_usuario.php" class="btn btn-primary">Crear Usuario</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
