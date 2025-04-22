<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM client WHERE login = ? AND motPasse = ?");
    $stmt->execute([$_POST['login'], $_POST['motPasse']]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['client'] = $user;
        header("Location: reservEnCours.php");
    } else {
        echo "Login ou mot de passe incorrect.";
    }
}
?>

<form method="post">
    Login: <input type="text" name="login"><br>
    Mot de passe: <input type="password" name="motPasse"><br>
    <button type="submit">Connexion</button>
</form>
