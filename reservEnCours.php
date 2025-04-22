<?php
session_start();
require 'db.php';
if (!isset($_SESSION['client'])) {
    header('Location: connexion.php');
    exit;
}

$client = $_SESSION['client'];

$stmt = $pdo->prepare("
    SELECT r.*, h.titre FROM reservation r
    JOIN hotel h ON h.id_hotel = r.id_hotel
    WHERE r.id_client = ?
");

$stmt->execute([$client['id_client']]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Bienvenue, <?= $client['nom'] ?> <?= $client['prenom'] ?></h2>

<h3>Vos réservations en cours :</h3>
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
