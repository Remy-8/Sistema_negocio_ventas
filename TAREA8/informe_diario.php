<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: acceso.php");
    exit();
}

$ventas = $conexion->query("SELECT * FROM sales WHERE DATE(created_at) = CURDATE()")->fetchAll();
?>
<link rel="stylesheet" href="assets/style.css">

<h2>Informe del Día</h2>
<table>
    <thead>
        <tr><th>Recibo</th><th>Fecha</th><th>Total</th><th>Comentario</th></tr>
    </thead>
    <tbody>
    <?php foreach ($ventas as $venta): ?>
        <tr>
            <td><?= htmlspecialchars($venta['receipt_number']) ?></td>
            <td><?= htmlspecialchars($venta['created_at']) ?></td>
            <td>$<?= number_format($venta['total'], 2) ?></td>
            <td><?= htmlspecialchars($venta['comments']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<button onclick="window.location.href='panel.php'">Volver</button>
