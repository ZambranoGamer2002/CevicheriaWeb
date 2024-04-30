<?php
session_start(); // Asegúrate de comenzar la sesión si aún no está iniciada

// Verifica si la variable de sesión existe antes de restablecerla
if (isset($_SESSION['mi_variable_global'])) {
    $_SESSION['mi_variable_global'] = 0; // Restablecer la variable de sesión a 0
}

// A partir de este punto, $_SESSION['mi_variable'] tendrá el valor 0 en esta sesión
header('Location: login.php');
?>
