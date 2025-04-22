<?php
require 'db.php';
$types = $pdo->query("SELECT * FROM typehotel")->fetchAll(PDO::FETCH_ASSOC);
$reservations = [];

if (isset($_POST['id_type'])) {
    $stmt = $pdo->prepare("
        SELECT r.*, h.titre FROM reservation r
        JOIN hotel h ON h.id_hotel = r.id_hotel
        WHERE h.id_type = ?
    ");
    $stmt->execute([$_POST['id_type']]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<form method="post">
    Type d'hôtel :
    <select name="id_type">
        <?php foreach ($types as $t): ?>
            <option value="<?= $t['id_type'] ?>"><?= $t['nom_type'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Rechercher</button>
</form>

<table border="1">
    <tr><th>Hôtel</th><th>Date début</th><th>Date fin</th></tr>
    <?php foreach ($reservations as $r): ?>
    <tr>
        <td><?= $r['titre'] ?></td>
        <td><?= $r['date_debut_sejour'] ?></td>
        <td><?= $r['date_fin_sejour'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
