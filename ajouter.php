

<?php
require 'db.php';

$types = $pdo->query("SELECT * FROM typehotel")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO hotel (titre, adresse, prix_par_nuit, id_type, nombre_de_places) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['titre'],
        $_POST['adresse'],
        $_POST['prix_par_nuit'],
        $_POST['id_type'],
        $_POST['nombre_de_places']
    ]);
    header('Location: listerH.php');
}
?>

<form method="post">
    Titre: <input type="text" name="titre" required><br>
    Adresse: <input type="text" name="adresse" required><br>
    Prix: <input type="number" name="prix_par_nuit" required><br>
    Type:
    <select name="id_type" required>
        <?php foreach ($types as $t): ?>
            <option value="<?= $t['id_type'] ?>"><?= $t['nom_type'] ?></option>
        <?php endforeach; ?>
    </select><br>
    Places: <input type="number" name="nombre_de_places" required><br>
    <button type="submit">Ajouter</button>
</form>
