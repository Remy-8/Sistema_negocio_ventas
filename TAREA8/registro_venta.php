<?php
$claveTexto = 'tareafacil25';
$claveEncriptada = password_hash($claveTexto, PASSWORD_DEFAULT);

echo "Clave encriptada: " . $claveEncriptada . "<br>";

if (password_verify('tareafacil25', $claveEncriptada)) {
    echo "¡La clave es válida!";
} else {
    echo "Clave incorrecta.";
}
?>
