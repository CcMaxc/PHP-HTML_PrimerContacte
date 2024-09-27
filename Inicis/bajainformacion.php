<?php
$mysql = new mysqli("localhost", "root", "", "tutorialPHP");

if ($mysql->connect_error) {
    die("Error de connexió");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM informacio_personal WHERE id = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registre eliminat correctament.";
    } else {
        echo "Error al eliminar el registre: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No s'ha especificat cap ID.";
}

$mysql->close();
header("Location: index.php");
exit;
?>
