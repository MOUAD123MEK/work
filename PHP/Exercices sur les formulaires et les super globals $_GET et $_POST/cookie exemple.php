<?php
// 1. Set the cookie if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";

    if (!empty($name)) {
        // Cookie expires in 1 day (86400 seconds)
        setcookie("username", $name, time() + 86400, "/");

        // Optional: reload the page to read the cookie immediately
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// 2. Read the cookie
$user = $_COOKIE["username"] ?? null;

// 3. Delete the cookie if requested
if (isset($_GET["delete"])) {
    setcookie("username", "", time() - 3600, "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Cookie Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="mb-4">🍪 Cookie Example in PHP</h2>

    <?php if ($user): ?>
        <div class="alert alert-success">
            👋 Hello, <strong><?= htmlspecialchars($user) ?></strong>! Nice to see you again.
        </div>
        <a href="?delete=true" class="btn btn-danger">Delete Cookie</a>
    <?php else: ?>
        <form action="" method="POST" class="border p-4 shadow">
            <div class="mb-3">
                <label for="name" class="form-label">Enter your name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save in Cookie</button>
        </form>
    <?php endif; ?>
</body>
</html>
