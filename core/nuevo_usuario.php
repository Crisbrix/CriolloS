<?php
session_start();
require_once '../php/db.php';

// Verificar que la empresa esté logueada
if (!isset($_SESSION['empresa_id'])) {
    header('Location: login_empresa.php');
    exit();
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];
    $empresa_id = $_SESSION['empresa_id'];

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (empresa_id, nombre, usuario, clave, rol) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$empresa_id, $nombre, $usuario, $clave, $rol]);
        $mensaje = "✅ Usuario creado exitosamente.";
    } catch (PDOException $e) {
        $mensaje = "❌ Error al crear usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario | CriolloS POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard_empresa.php">
            <img src="../img/CriolloST.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            CriolloS POS
        </a>
        <div class="d-flex">
            <a href="php/logout_empresa.php" class="btn btn-outline-light">Salir</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">Crear Nuevo Usuario</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="nuevo_usuario.php" class="card p-4 shadow">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario (para login)</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>

        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave" required>
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select" id="rol" name="rol" required>
                <option value="">Seleccione...</option>
                <option value="mesero">Mesero</option>
                <option value="cajero">Cajero</option>
                <option value="cocina">Cocina</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Crear Usuario</button>
        <a href="dashboard_empresa.php" class="btn btn-secondary w-100 mt-2">Volver al Dashboard</a>

    </form>
</div>

</body>
</html>
