

<?php
include 'db.php'; include 'navbar.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cef = $_POST['cef'] ?? '';
    $fullName = $_POST['fullName'] ?? '';
    $filiere = $_POST['filiere'] ?? '';
    $gente = $_POST['gente'] ?? '';
    $loisirs = $_POST['loisirs'] ?? [];
    $email = $_POST['email'] ?? '';
    $github = $_POST['lien_github'] ?? '';
    $image = $_FILES['image']['name'] ?? '';
    $image_tmp = $_FILES['image']['tmp_name'] ?? '';

    if (!$cef || !is_numeric($cef)) {
        $errors[] = "CEF est obligatoire et doit être numérique.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE cef = ?");
        $stmt->execute([$cef]);a
        if ($stmt->fetch()) $errors[] = "CEF déjà existant.";
    }

    if (!$fullName || !preg_match("/^[A-Z][A-Za-z']{2,}(\\s[A-Za-z']+)*$/", $fullName)) {
        $errors[] = "Nom invalide.";
    }

    if (!$filiere) $errors[] = "Filière obligatoire.";
    if (!$gente) $errors[] = "Genre obligatoire.";
    if (count($loisirs) < 2) $errors[] = "Choisissez au moins deux loisirs.";

    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if ($image && !in_array(strtolower($ext), ['png', 'jpg', 'jpeg'])) {
        $errors[] = "Image invalide.";
    }

    if (!$errors) {
        $imageName = time() . "." . $ext;
        move_uploaded_file($image_tmp, "uploads/" . $imageName);
        $stmt = $pdo->prepare("INSERT INTO etudiants (cef, fullName, email, lien_github, filiere, image, gente, loisirs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$cef, $fullName, $email, $github, $filiere, $imageName, $gente, implode(', ', $loisirs)]);
        header("Location: index.php"); exit();
    }
}
?>

<h2>Ajouter Étudiant</h2>
<?php foreach ($errors as $e) echo "<p style='color:red'>$e</p>"; ?>
<form method="POST" enctype="multipart/form-data">
    CEF: <input type="text" name="cef"><br>
    Nom Complet: <input type="text" name="fullName"><br>
    Email: <input type="email" name="email"><br>
    GitHub: <input type="url" name="lien_github"><br>
    Filière: <select name="filiere">
        <option value="">--Choisir--</option>
        <option value="Informatique">Informatique</option>
        <option value="Maths">Maths</option>
    </select><br>
    Image: <input type="file" name="image"><br>
    Genre:
    <input type="radio" name="gente" value="Homme"> Homme
    <input type="radio" name="gente" value="Femme"> Femme<br>
    Loisirs:<br>
    <input type="checkbox" name="loisirs[]" value="Sport"> Sport
    <input type="checkbox" name="loisirs[]" value="Lecture"> Lecture
    <input type="checkbox" name="loisirs[]" value="Musique"> Musique<br>
    <button type="submit">Enregistrer</button>
</form>