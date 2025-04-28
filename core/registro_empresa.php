<?php
require_once '../php/db.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO empresas (nombre, direccion, telefono, correo, clave) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $direccion, $telefono, $correo, $clave]);
        $mensaje = "✅ Empresa registrada exitosamente.";
    } catch (PDOException $e) {
        $mensaje = "❌ Error al registrar la empresa: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Empresa | CriolloS POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card p-4 shadow" style="width: 28rem;">
    <div class="text-center mb-4">
        <img src="img/CriolloS.png" alt="Logo CriolloS" style="width: 100px;">
        <h3 class="mt-2">Registrar Empresa</h3>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="registro_empresa.php">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Empresa</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>

        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-2">Registrar Empresa</button>
        <a href="login_empresa.php" class="btn btn-outline-secondary w-100">¿Ya tienes una cuenta? Iniciar Sesión</a>
    </form>
</div>

</body>
</html>