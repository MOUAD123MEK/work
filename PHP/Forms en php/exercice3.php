<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <h2>Formulaire de Contact</h2>
    <form action="" method="post">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>
        
        <input type="submit" name="submit" value="Envoyer">
    </form>       
</body>
</html>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        if (!empty($name) && !empty($email) && !empty($message)) {
            echo "<p style='color:green;'>Votre message a été envoyé avec succès !</p>";
        } else {
            echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
        }
    }
    ?>

