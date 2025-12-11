<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_COOKIE['authToken']) && isset($_SESSION['authToken']) && $_COOKIE['authToken'] === $_SESSION['authToken']) {
    // Redirection selon le rôle stocké en session
    if ($_SESSION['role'] === 'admin') {
        header('Location: page_admin.php');
    } elseif ($_SESSION['role'] === 'user') {
        header('Location: page_user.php');
    }
    exit();
}

// Gestion du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants
    if ($username === 'admin' && $password === 'secret') {
        $role = 'admin';
    } elseif ($username === 'user' && $password === 'utilisateur') {
        $role = 'user';
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }

    if (isset($role)) {
        // Générer un jeton unique
        $token = bin2hex(random_bytes(16));

        // Stocker dans le cookie (1 minute)
        setcookie('authToken', $token, time() + 60, '/', '', false, true);

        // Stocker le token et le rôle côté serveur
        $_SESSION['authToken'] = $token;
        $_SESSION['role'] = $role;

        // Redirection selon le rôle
        if ($role === 'admin') {
            header('Location: page_admin.php');
        } elseif ($role === 'user') {
            header('Location: page_user.php');
        }
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
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
