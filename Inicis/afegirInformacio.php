<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Afegir Informació Personal</title>
</head>
<body>

<h2>Afegir Informació Personal</h2>

<form action="processaAfegir.php" method="post" enctype="multipart/form-data">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>

    <label for="cognom">Cognom:</label>
    <input type="text" id="cognom" name="cognom" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="telefon">Telèfon:</label>
    <input type="tel" id="telefon" name="telefon" required>

    <label for="data_naixement">Data de Naixement:</label>
    <input type="date" id="data_naixement" name="data_naixement" required>

    <label for="sexe">Sexe:</label>
    <select id="sexe" name="sexe" required>
        <option value="Masculí">Masculí</option>
        <option value="Femení">Femení</option>
        <option value="Altres">Altres</option>
    </select>

    <label for="imatge">Selecciona una imatge (opcional):</label>
    <input type="file" id="imatge" name="imatge"><br>

    <div class="button-container">
        <button type="submit" class="button">Afegir</button>
    </div>
</form>

<div class="button-container">
    <button onclick="window.location.href='index.php'" class="button">Tornar a la Llista</button>
</div>

<footer>
    <p>&copy; 2024 Gestió d'Informació Personal</p>
</footer>

</body>
</html>
