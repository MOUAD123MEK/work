

<?php
// 1. Chargement des produits depuis le cookie
if (isset($_COOKIE["produits"])) {
    $produits = json_decode($_COOKIE["produits"], true);
} else {
    $produits = [];
}

// 2. Récupérer l'index pour modification
$editIndex = $_GET["edit"] ?? null;
$editProduit = $editIndex !== null && isset($produits[$editIndex]) ? $produits[$editIndex] : null;

// 3. Traitement du formulaire (POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"] ?? "";
    $prix = $_POST["prix"] ?? "";
    $quantite = $_POST["quantite"] ?? "";
    $id = $_POST["id"] ?? null;

    // Gestion de l'image
    $imageData = null;
    if (!empty($_FILES["image"]["tmp_name"])) {
        $fileContent = file_get_contents($_FILES["image"]["tmp_name"]);
        $imageData = "data:" . $_FILES["image"]["type"] . ";base64," . base64_encode($fileContent);
    }

    if (!empty($nom) && !empty($prix) && !empty($quantite)) {
        $produit = [
            "nom" => $nom,
            "prix" => $prix,
            "quantite" => $quantite,
            "image" => $imageData ?? ($produits[$id]["image"] ?? null)
        ];

        if ($id !== null && isset($produits[$id])) {
            $produits[$id] = $produit;
        } else {
            $produits[] = $produit;
        }

        setcookie("produits", json_encode($produits), time() + 86400);
        header("Location: produits.php");
        exit;
    }
}

// 4. Suppression d’un produit
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    if (isset($produits[$id])) {
        array_splice($produits, $id, 1);
        setcookie("produits", json_encode($produits), time() + 86400);
        header("Location: produits.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">🛍️ Gestion des Produits</h2>

    <!-- Formulaire -->
    <form method="POST" action="" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
        <input type="hidden" name="id" value="<?= $editIndex !== null ? $editIndex : '' ?>">

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= $editProduit["nom"] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix (€)</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="<?= $editProduit["prix"] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantité</label>
            <input type="number" name="quantite" class="form-control" value="<?= $editProduit["quantite"] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <?php if ($editProduit && $editProduit["image"]): ?>
                <img src="<?= $editProduit["image"] ?>" class="mt-2" width="100">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-success"><?= $editProduit ? "Modifier" : "Ajouter" ?> le produit</button>
    </form>

    <!-- Liste des produits -->
    <h3 class="mt-5">📦 Produits</h3>

    <?php if (!empty($produits)): ?>
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $index => $p): ?>
                    <tr>
                        <td>
                            <?php if ($p["image"]): ?>
                                <img src="<?= $p["image"] ?>" width="80">
                            <?php else: ?>
                                <em>Pas d'image</em>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p["nom"]) ?></td>
                        <td><?= htmlspecialchars($p["prix"]) ?> €</td>
                        <td><?= htmlspecialchars($p["quantite"]) ?></td>
                        <td>
                            <a href="?edit=<?= $index ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="?delete=<?= $index ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Aucun produit enregistré.</div>
    <?php endif; ?>
</div>

</body>
</html>

