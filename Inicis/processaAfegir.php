<?php
$mysql = new mysqli("localhost", "root", "", "tutorialPHP");

if ($mysql->connect_error) {
    die("Error de connexió");
}

if (isset($_POST['nom'], $_POST['cognom'], $_POST['email'], $_POST['telefon'], $_POST['data_naixement'], $_POST['sexe'])) {
    $nom = $_POST['nom'];
    $cognom = $_POST['cognom'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $data_naixement = $_POST['data_naixement'];
    $sexe = $_POST['sexe'];

    $imatge = null;
    if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] === UPLOAD_ERR_OK) {
        $imatge = $_FILES['imatge']['name'];
        $target = "imatges/" . basename($imatge);
        move_uploaded_file($_FILES['imatge']['tmp_name'], $target);
    }

    $sql = "INSERT INTO informacio_personal (nom, cognom, email, telefon, data_naixement, sexe, imatge) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("sssssss", $nom, $cognom, $email, $telefon, $data_naixement, $sexe, $imatge);

    if ($stmt->execute()) {
        echo "Registre afegit correctament.";
    } else {
        echo "Error al afegir el registre: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No s'han proporcionat totes les dades necessàries.";
}

$mysql->close();
header("Location: index.php");
exit;
?>
