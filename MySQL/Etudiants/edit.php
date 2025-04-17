<!-- edit.php -->
<?php
include 'db.php'; include 'navbar.php';
$cef = $_GET['cef'] ?? null;
if (!$cef) die("CEF manquant");

$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE cef = ?");
$stmt->execute([$cef]);
$etudiant = $stmt->fetch();
if (!$etudiant) die("Étudiant non trouvé");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $github = $_POST['lien_github'];
    $filiere = $_POST['filiere'];
    $gente = $_POST['gente'];
    $loisirs = $_POST['loisirs'] ?? [];
    $imageName = $etudiant['image'];

    if ($_FILES['image']['name']) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), ['png', 'jpg', 'jpeg'])) {
            $imageName = time() . "." . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        }
    }

    $stmt = $pdo->prepare("UPDATE etudiants SET fullName=?, email=?, lien_github=?, filiere=?, image=?, gente=?, loisirs=? WHERE cef=?");
    $stmt->execute([$fullName, $email, $github, $filiere, $imageName, $gente, implode(', ', $loisirs), $cef]);
    header("Location: index.php"); exit();
}
?>

<h2>Modifier Étudiant</h2>
<form method="POST" enctype="multipart/form-data">
    Nom Complet: <input type="text" name="fullName" value="<?= $etudiant['fullName'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $etudiant['email'] ?>"><br>
    GitHub: <input type="url" name="lien_github" value="<?= $etudiant['lien_github'] ?>"><br>
    Filière: <select name="filiere">
        <option <?= $etudiant['filiere'] == '' ? 'selected' : '' ?>>--Choisir--</option>
        <option value="Informatique" <?= $etudiant['filiere'] == 'Informatique' ? 'selected' : '' ?>>Informatique</option>
        <option value="Maths" <?= $etudiant['filiere'] == 'Maths' ? 'selected' : '' ?>>Maths</option>
    </select><br>
    Image: <input type="file" name="image"><br>
    Genre:
    <input type="radio" name="gente" value="Homme" <?= $etudiant['gente'] == 'Homme' ? 'checked' : '' ?>> Homme
    <input type="radio" name="gente" value="Femme" <?= $etudiant['gente'] == 'Femme' ? 'checked' : '' ?>> Femme<br>
    Loisirs:<br>
    <?php
    $loisirs = explode(', ', $etudiant['loisirs']);
    foreach (["Sport", "Lecture", "Musique"] as $l) {
        $checked = in_array($l, $loisirs) ? 'checked' : '';
        echo "<input type='checkbox' name='loisirs[]' value='$l' $checked> $l ";
    }
    ?><br>
    <button type="submit">Modifier</button>
</form>
