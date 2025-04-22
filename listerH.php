<?php
require 'db.php';
$hotels = $pdo->query("SELECT * FROM hotel")->fetchAll(PDO::FETCH_ASSOC);
?>
<a href="ajouterH.php">Ajouter un hôtel</a>
<table border="1">
    <tr>
        <th>Titre</th><th>Adresse</th><th>Prix</th><th>Type</th><th>Places</th><th>Actions</th>
    </tr>
    <?php foreach ($hotels as $h): ?>
    <tr>
        <td><?= $h['titre'] ?></td>
        <td><?= $h['adresse'] ?></td>
        <td><?= $h['prix_par_nuit'] ?></td>
        <td><?= $h['id_type'] ?></td>
        <td><?= $h['nombre_de_places'] ?></td>
        <td>
            <a href="deleteH.php?id=<?= $h['id_hotel'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
