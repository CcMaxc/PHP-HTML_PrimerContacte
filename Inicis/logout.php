<?php
session_start();
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión actual
header('Location: index.php'); // Redireccionar a index.php
exit;
?>
