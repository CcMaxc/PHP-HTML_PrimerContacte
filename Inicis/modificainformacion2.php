<?php
$mysql = new mysqli("localhost", "root", "", "tutorialPHP");

if ($mysql->connect_error) {
    die("Error de connexió");
}

if (isset($_POST['id'], $_POST['nom'], $_POST['cognom'], $_POST['email'], $_POST['telefon'], $_POST['data_naixement'], $_POST['sexe'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $cognom = $_POST['cognom'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $data_naixement = $_POST['data_naixement'];
    $sexe = $_POST['sexe'];

    $sql = "UPDATE informacio_personal SET nom = ?, cognom = ?, email = ?, telefon = ?, data_naixement = ?, sexe = ? WHERE id = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("ssssssi", $nom, $cognom, $email, $telefon, $data_naixement, $sexe, $id);

    if ($stmt->execute()) {
        echo "Registre actualitzat correctament.";
    } else {
        echo "Error al actualitzar el registre: " . $stmt->error;
    }

    if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] === UPLOAD_ERR_OK) {
        $imatge = $_FILES['imatge']['name'];
        $target = "imatges/" . basename($imatge);
        move_uploaded_file($_FILES['imatge']['tmp_name'], $target);

        $sql = "UPDATE informacio_personal SET imatge = ? WHERE id = ?";
        $stmt = $mysql->prepare($sql);
        $stmt->bind_param("si", $imatge, $id);
        $stmt->execute();
    }

    $stmt->close();
} else {
    echo "No s'han proporcionat totes les dades necessàries.";
}

$mysql->close();
header("Location: index.php");
exit;
?>
