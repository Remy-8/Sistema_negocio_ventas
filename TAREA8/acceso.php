<?php
session_start();
require 'conexion.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $clave = $_POST['password'];

    $consulta = $conexion->prepare("SELECT * FROM users WHERE username = ?");
    $consulta->execute([$usuario]);
    $registro = $consulta->fetch();

    if ($registro && password_verify($clave, $registro['password'])) {
        $_SESSION['usuario'] = $registro;
        header("Location: panel.php");
        exit();
    } else {
        $mensaje = "Datos incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Acceder al sistema</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="error"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Usuario" required />
            <input type="password" name="password" placeholder="Contraseña" required />
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>
