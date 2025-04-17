<?php
include 'db.php';
$cef = $_GET['cef'] ?? null;
if ($cef) {
    $stmt = $pdo->prepare("DELETE FROM etudiants WHERE cef = ?");
    $stmt->execute([$cef]);
}
header("Location: index.php");
exit();
?>
