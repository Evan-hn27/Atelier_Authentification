<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Admin</title>
</head>
<body>
    <h1>Bienvenue sur la page Administrateur</h1>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
