<?php
session_start();

// Supprimer le cookie et la session
setcookie('authToken', '', time() - 3600, '/', '', false, true);
unset($_SESSION['authToken']);

// Redirection vers la page de connexion
header('Location: index.php');
exit();
?>
