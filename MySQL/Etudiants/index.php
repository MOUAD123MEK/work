<!-- index.php -->
<?php include 'db.php'; include 'navbar.php'; ?>
<h2>Liste des Étudiants</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>CEF</th><th>Nom Complet</th><th>Email</th><th>GitHub</th><th>Filière</th><th>Image</th><th>Genre</th><th>Loisirs</th><th>Actions</th>
    </tr>
    <?php
    $stmt = $pdo->query("SELECT * FROM etudiants");
    foreach ($stmt as $row) {
        echo "<tr>
                <td>{$row['cef']}</td>
                <td>{$row['fullName']}</td>
                <td>{$row['email']}</td>
                <td>{$row['lien_github']}</td>
                <td>{$row['filiere']}</td>
                <td><img src='uploads/{$row['image']}' width='50'></td>
                <td>{$row['gente']}</td>
                <td>{$row['loisirs']}</td>
                <td>
                    <a href='edit.php?cef={$row['cef']}'>Edit</a> |
                    <a href='delete.php?cef={$row['cef']}' onclick="return confirm('Supprimer ?')">Delete</a>
                </td>
              </tr>";
    }
    ?>
</table>