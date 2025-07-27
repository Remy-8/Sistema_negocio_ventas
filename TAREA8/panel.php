<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: acceso.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Hola <?= htmlspecialchars($_SESSION['usuario']['username'] ?? 'Visitante') ?></h2>
        <nav>
            <ul class="menu">
                <li><a href="registro_venta.php">Nueva venta</a></li>
                <li><a href="informe_diario.php">Reporte del día</a></li>
                <li><a href="salir.php">Salir</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
