<?php
$mysql = new mysqli("localhost", "root", "", "tutorialPHP");

if ($mysql->connect_error) {
    die("Error de connexió");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM informacio_personal WHERE id = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultat = $stmt->get_result();
    $persona = $resultat->fetch_assoc();

    if (!$persona) {
        echo "No s'ha trobat cap registre amb aquest ID.";
        exit;
    }
} else {
    echo "No s'ha especificat cap ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Informació Personal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Modificar Informació Personal</h2>

<form action="modificainformacion2.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $persona['id']; ?>">

    <label for="nom">Escriu el teu nom:</label>
    <input type="text" name="nom" id="nom" value="<?php echo $persona['nom']; ?>" required><br>

    <label for="cognom">Escriu el teu cognom:</label>
    <input type="text" name="cognom" id="cognom" value="<?php echo $persona['cognom']; ?>" required><br>

    <label for="email">Escriu el teu email:</label>
    <input type="email" name="email" id="email" value="<?php echo $persona['email']; ?>" required><br>

    <label for="telefon">Escriu el teu telèfon:</label>
    <input type="tel" name="telefon" id="telefon" value="<?php echo $persona['telefon']; ?>" required><br>

    <label for="data_naixement">Escriu la teva data de naixement:</label>
    <input type="date" name="data_naixement" id="data_naixement" value="<?php echo $persona['data_naixement']; ?>" required><br>

    <label for="sexe">Selecciona el teu sexe:</label>
    <input type="radio" name="sexe" value="home" <?php if($persona['sexe'] == 'home') echo 'checked'; ?>> Home
    <input type="radio" name="sexe" value="dona" <?php if($persona['sexe'] == 'dona') echo 'checked'; ?>> Dona<br>

    <label for="imatge">Selecciona una imatge (opcional):</label>
    <input type="file" name="imatge" id="imatge"><br>

    <input type="submit" value="Modificar">
</form>

<div class="button-container">
    <button onclick="window.location.href='index.php'">Tornar a la pàgina principal</button>
</div>

<?php
$stmt->close();
$mysql->close();
?>

</body>
</html>
