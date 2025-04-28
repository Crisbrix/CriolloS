<?php
session_start();
require_once '../php/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $stmt = $pdo->prepare("SELECT * FROM empresas WHERE correo = ?");
    $stmt->execute([$correo]);
    $empresa = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($empresa && password_verify($clave, $empresa['clave'])) {
        $_SESSION['empresa_id'] = $empresa['id'];
        $_SESSION['empresa_nombre'] = $empresa['nombre'];
        header('Location: dashboard_empresa.php');
        exit();
    } else {
        $error = 'Correo o contraseña incorrectos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Empresa | CriolloS POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card p-4 shadow" style="width: 26rem;">
    <div class="text-center mb-4">
        <img src="../img/CriolloS.png" alt="Logo CriolloS" style="width: 100px;">
        <h3 class="mt-2">Iniciar Sesión Empresa</h3>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="login_empresa.php">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>

        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-2">Ingresar</button>
        <a href="registro_empresa.php" class="btn btn-outline-secondary w-100">Registrar Nueva Empresa</a>
    </form>
</div>

</body>
</html>
