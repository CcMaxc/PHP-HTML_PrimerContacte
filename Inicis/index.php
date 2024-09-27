<?php
session_start(); // Iniciar la sesión

// Verificar si un usuario está logueado
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'Invitado';  // Asignar un usuario genérico si no está logueado
}

// Conexión a la base de datos
$mysql = new mysqli("localhost", "root", "", "tutorialPHP");

if ($mysql->connect_error) {
    die("Error de connexió");
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Gestió d'Informació Personal</title>
</head>
<body>

<h2>Informació Personal</h2>

<!-- Mostrar mensaje dependiendo del usuario en sesión -->
<?php if ($_SESSION['user'] == 'Admin') : ?>
    <a href="logout.php" class="action-link delete">Logout</a></p>
<?php else : ?>
    <a href="login.php" class="action-link modify">Login</a></p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Cognom</th>
            <th>Email</th>
            <th>Telèfon</th>
            <th>Data de Naixement</th>
            <th>Sexe</th>
            <th>Imatge</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM informacio_personal";
        $resultat = $mysql->query($sql);

        if ($resultat->num_rows > 0) {
            while ($reg = $resultat->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $reg['id'] . '</td>';
                echo '<td>' . $reg['nom'] . '</td>';
                echo '<td>' . $reg['cognom'] . '</td>';
                echo '<td>' . $reg['email'] . '</td>';
                echo '<td>' . $reg['telefon'] . '</td>';
                echo '<td>' . $reg['data_naixement'] . '</td>';
                echo '<td>' . $reg['sexe'] . '</td>';
                echo '<td>';
                if ($reg['imatge']) {
                    echo '<img src="imatges/' . $reg['imatge'] . '" alt="Imatge" width="50">';
                } else {
                    echo 'Sense imatge';
                }
                echo '</td>';
                echo '<td>';
                
                // Mostrar accions només si l'usuari és Admin
                if ($_SESSION['user'] == 'Admin') {
                    echo '<a href="modificainformacion1.php?id=' . $reg['id'] . '" class="action-link modify">Modificar</a> ';
                    echo '<a href="bajainformacion.php?id=' . $reg['id'] . '" class="action-link delete">Borrar</a>';
                } else {
                    echo 'Sense permisos';
                }

                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="9">No s\'han trobat resultats.</td></tr>';
        }

        $mysql->close();
        ?>
    </tbody>
</table>

<div class="button-container">
    <!-- Amagar el botó d'afegir si no és admin -->
    <?php if ($_SESSION['user'] == 'Admin') : ?>
        <button onclick="window.location.href='afegirInformacio.php'" class="button">Afegir Informació Personal</button>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Gestió d'Informació Personal</p>
</footer>

</body>
</html>
