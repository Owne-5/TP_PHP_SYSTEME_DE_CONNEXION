<?php
session_start();
// 1. On vérifie que la connexion à la BDD est disponible
require_once 'config/connexion.php'; 

// 2. Si l'utilisateur n'est PAS connecté en session, mais qu'il a le COOKIE "Se souvenir de moi"
if (empty($_SESSION['utilisateur_id']) && isset($_COOKIE['remember_me'])) {
    
    $token_cookie = $_COOKIE['remember_me'];

    // 3. On cherche dans la base de données si un utilisateur possède ce jeton (token)
    $stmt = $pdo->prepare("SELECT id, prenom FROM utilisateurs WHERE remember_token = :token");
    $stmt->execute([':token' => $token_cookie]);
    $utilisateur_trouve = $stmt->fetch();

    // 4. Si on trouve une correspondance, on recrée sa session automatiquement !
    if ($utilisateur_trouve) {
        $_SESSION['utilisateur_id'] = $utilisateur_trouve['id'];
        $_SESSION['utilisateur_prenom'] = $utilisateur_trouve['prenom'];
    }
}
?>