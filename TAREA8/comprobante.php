<?php
require 'conexion.php';
$id = $_GET['id'];

$venta = $conexion->prepare("SELECT * FROM sales WHERE id = ?");
$venta->execute([$id]);
$datosVenta = $venta->fetch();

$items = $conexion->prepare("SELECT * FROM sale_items WHERE sale_id = ?");
$items->execute([$id]);
$productos = $items->fetchAll();
?>
<link rel="stylesheet" href="assets/style.css">

<div class="container">
    <h2>Comprobante: <?= htmlspecialchars($datosVenta['receipt_number']) ?></h2>
    <p><strong>Fecha:</strong> <?= htmlspecialchars($datosVenta['created_at']) ?></p>
    <p><strong>Comentario:</strong> <?= htmlspecialchars($datosVenta['comments']) ?></p>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>$<?= number_format($item['subtotal'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total: $<?= number_format($datosVenta['total'], 2) ?></h3>

    <button onclick="window.print()">Imprimir</button>
</div>
