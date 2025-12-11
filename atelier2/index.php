<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté avec un cookie valide
if (isset($_COOKIE['authToken']) && isset($_SESSION['authToken']) && $_COOKIE['authToken'] === $_SESSION['authToken']) {
    header('Location: page_admin.php');
    exit();
}

// Gestion du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification simple des identifiants
    if ($username === 'admin' && $password === 'secret') {

        // Générer un jeton unique
        $token = bin2hex(random_bytes(16));

        // Stocker le token dans le cookie (valable 1 minute)
        setcookie('authToken', $token, time() + 60, '/', '', false, true);

        // Stocker le token côté serveur pour validation
        $_SESSION['authToken'] = $token;

        // Redirection vers la page protégée
        header('Location: page_admin.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier Authentification par Cookie</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
