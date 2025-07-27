<?php
$clave_plana = 'tareafacil25';

$clave_hasheada = password_hash($clave_plana, PASSWORD_DEFAULT);
echo "Clave encriptada generada: " . $clave_hasheada . "<br>";

if (password_verify('tareafacil25', $clave_hasheada)) {
    echo "✔ La clave ingresada es válida.";
} else {
    echo "✘ La clave no coincide.";
}
?>
