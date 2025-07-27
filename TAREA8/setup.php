<?php
$host = 'localhost';
$usuario = 'root';
$clave = '';
$base = 'ventas_larubia';

try {
    $conexion = new PDO("mysql:host=$host", $usuario, $clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conexion->exec("CREATE DATABASE IF NOT EXISTS $base");
    $conexion->exec("USE $base");

    $conexion->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL
        );
        CREATE TABLE IF NOT EXISTS sales (
            id INT AUTO_INCREMENT PRIMARY KEY,
            receipt_number VARCHAR(20) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            comments TEXT,
            total DECIMAL(10,2)
        );
        CREATE TABLE IF NOT EXISTS sale_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            sale_id INT NOT NULL,
            product_name VARCHAR(100),
            quantity INT,
            price DECIMAL(10,2),
            subtotal DECIMAL(10,2),
            FOREIGN KEY (sale_id) REFERENCES sales(id) ON DELETE CASCADE
        );
    ");

    $comprobar = $conexion->query("SELECT COUNT(*) FROM users");
    if ($comprobar->fetchColumn() == 0) {
        $claveSegura = password_hash('tareafacil25', PASSWORD_DEFAULT);
        $conexion->prepare("INSERT INTO users (username, password) VALUES (?, ?)")
                 ->execute(['demo', $claveSegura]);
        echo "Usuario creado: demo / tareafacil25<br>";
    } else {
        echo "Ya hay un usuario en el sistema.<br>";
    }

    echo "Configuración inicial completada. Se recomienda eliminar este archivo.";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
