<?php
session_start();
require_once 'config/connexion.php';

// Vérification de sécurité stricte
$stmt = $pdo->prepare("SELECT role FROM utilisateurs WHERE id = :id");
$stmt->execute([':id' => $_SESSION['utilisateur_id'] ?? 0]);
$user_role = $stmt->fetchColumn();

if ($user_role !== 'admin') {
    die("Accès refusé. Vous n'êtes pas administrateur.");
}

// Récupérer tous les utilisateurs
$stmt = $pdo->query("SELECT id, nom, prenom, email, date_inscription FROM utilisateurs");
$utilisateurs = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil — MonSite</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav>
        <a class="logo" href="accueil.php">MonSite</a>
        <div>
            <a href="profil.php">Mon profil</a>
            <a href="deconnexion.php">Se deconnecter</a>
        </div>
    </nav>

    <div class="welcome-box">
        <h1>Liste des utilisateurs</h1>
        <table style="padding:0px; border:solid 2px;">
            <tr> 
                <th style="padding: 1em; border-bottom:solid 2px;">ID</th>
                <th style="padding: 1em; border-bottom:solid 2px;">Nom</th>
                <th style="padding: 1em; border-bottom:solid 2px;">Prénom</th>
                <th style="padding: 1em; border-bottom:solid 2px;">Email</th>
                <th style="padding: 1em; border-bottom:solid 2px;">Date</th>
            </tr>
            <?php foreach ($utilisateurs as $u): ?>
                <tr>
                    <td style="padding: 1.5em;"><?= $u['id'] ?></td>
                    <td style="padding: 1.5em;"><?= htmlspecialchars($u['nom']) ?></td>
                    <td style="padding: 1.5em;"><?= htmlspecialchars($u['prenom']) ?></td>
                    <td style="padding: 1.5em;"><?= htmlspecialchars($u['email']) ?></td>
                    <td style="padding: 1.5em;"><?= $u['date_inscription'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>