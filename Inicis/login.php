<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar credenciales de inicio de sesión
    if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin123') {
        $_SESSION['user'] = 'Admin';
    } else {
        $_SESSION['user'] = 'Invitado';
    }
    header('Location: index.php'); // Redireccionar al index.php después del login
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
<h2>Iniciar Sessió</h2>

<form method="POST" action="">
    <label for="username">Usuari:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Contrasenya:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Iniciar Sessió">
</form>

</body>
</html>
