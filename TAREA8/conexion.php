<?php
$servidor = 'localhost';
$basedatos = 'ventas_larubia';
$usuario = 'root';
$clave = '';

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$basedatos", $usuario, $clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("No se pudo conectar con la base de datos: " . $ex->getMessage());
}
?>
