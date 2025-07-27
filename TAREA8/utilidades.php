<?php
function mostrar_moneda($monto) {
    return '$' . number_format($monto, 2);
}

function nuevo_codigo_recibo($conexion) {
    $total = $conexion->query("SELECT COUNT(*) FROM sales")->fetchColumn();
    return 'RECIBO-' . str_pad($total + 1, 3, '0', STR_PAD_LEFT);
}

function proteger_sesion() {
    session_start();
    if (empty($_SESSION['usuario'])) {
        header("Location: acceso.php");
        exit();
    }
}
?>
