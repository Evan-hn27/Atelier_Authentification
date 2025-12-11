<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'utilisateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
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
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
