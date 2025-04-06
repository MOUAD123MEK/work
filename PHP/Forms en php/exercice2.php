
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($name) || empty($email) || empty($password)) {
        echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red;'>L'email n'est pas valide.</p>";
        } elseif (strlen($password) < 6) {
            echo "<p style='color:red;'>Le mot de passe doit contenir au moins 6 caractères.</p>";
        } else {
            echo "<p style='color:green;'>Inscription réussie !</p>";
            echo "<p><strong>Nom :</strong> $name</p>";
            echo "<p><strong>Email :</strong> $email</p>";
            exit(); // Arrêter l'exécution après l'affichage du message de succès
        }
    }

    echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
</head>
<body>

<h2>Formulaire d'inscription</h2>
<!-- Formulaire d'inscription avec les champs nom, email et mot de passe -->

<form action="" method="post">
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="S'inscrire">
</form>

</body>
</html>