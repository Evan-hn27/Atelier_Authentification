<?php
// Liste des utilisateurs et mots de passe
$users = [
    'admin' => 'secret',
    'user' => 'utilisateur'
];

// Vérifier si le client a envoyé des identifiants
if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

// Récupérer les identifiants envoyés
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

// Vérifier les identifiants
if (!isset($users[$username]) || $users[$username] !== $password) {
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
}

// À partir d’ici, l’utilisateur est authentifié
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page protégée</h1>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($username); ?></p>

    <?php if ($username === 'admin'): ?>
        <h2>Section réservée à l'admin</h2>
        <p>Vous voyez ce contenu car vous êtes l'administrateur.</p>
    <?php else: ?>
        <h2>Section utilisateur</h2>
        <p>Contenu limité pour les utilisateurs standard.</p>
    <?php endif; ?>

    <a href="../index.html">Retour à l'accueil</a>
</body>
</html>
