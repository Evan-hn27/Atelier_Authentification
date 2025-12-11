<?php
session_start();

// Vérifier le cookie et le rôle
if (!isset($_COOKIE['authToken']) || !isset($_SESSION['authToken']) || $_COOKIE['authToken'] !== $_SESSION['authToken'] || $_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Utilisateur</title>
</head>
<body>
    <h1>Bienvenue sur la page Utilisateur</h1>
    <p>Vous êtes connecté en tant que user.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
