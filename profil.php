<?php
session_start();
require_once 'config/connexion.php';

// Redirection si non connecté
if (empty($_SESSION['utilisateur_id'])) {
    header('Location: connexion.php');
    exit;
}

$id_user = $_SESSION['utilisateur_id'];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveau_prenom = trim($_POST['prenom']);

    // Mise à jour du prénom
    if (!empty($nouveau_prenom)) {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET prenom = :prenom WHERE id = :id");
        $stmt->execute([':prenom' => htmlspecialchars($nouveau_prenom), ':id' => $id_user]);
        $_SESSION['utilisateur_prenom'] = $nouveau_prenom; // Mettre à jour la session
    }

    // Traitement de l'image
    if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] === UPLOAD_ERR_OK) {
        $dossier_destination = 'uploads/';
        if (!is_dir($dossier_destination)) mkdir($dossier_destination); // Créer le dossier s'il n'existe pas

        $nom_fichier = uniqid() . '_' . basename($_FILES['photo_profil']['name']);
        $chemin_complet = $dossier_destination . $nom_fichier;

        if (move_uploaded_file($_FILES['photo_profil']['tmp_name'], $chemin_complet)) {
            $stmt = $pdo->prepare("UPDATE utilisateurs SET photo_profil = :photo WHERE id = :id");
            $stmt->execute([':photo' => $nom_fichier, ':id' => $id_user]);
        }
    }
    $message = "Profil mis à jour !";
}

// Récupérer les infos actuelles
$stmt = $pdo->prepare("SELECT prenom, photo_profil FROM utilisateurs WHERE id = :id");
$stmt->execute([':id' => $id_user]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav>
        <a class="logo" href="accueil.php">MonSite</a>
        <div>
            <!-- On affiche le prenom de l'utilisateur connecte -->
            <span style="color:#a8d8ea; margin-right:10px;">
                Bonjour, <?= htmlspecialchars($user['prenom']) ?> !
            </span>
            <a href="profil.php">Mon profil</a>
            <a href="deconnexion.php">Se deconnecter</a>
        </div>
    </nav>
    <div class="container">
        <h1>Mon Profil</h1>
        <?php if (isset($message)) echo "<div class='alerte alerte-succes'>$message</div>"; ?>

        <form action="profil.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>">
            </div>
            <div class="form-group">
                <label>Photo de profil (actuelle : <?= htmlspecialchars($user['photo_profil']) ?>)</label>
                <input type="file" name="photo_profil" accept="image/png, image/jpeg">
            </div>
            <button type="submit" class="btn">Enregistrer</button>
            <a href="accueil.php" class="btn" style="background:#666; display:block; text-align:center;">Retour</a>
        </form>
    </div>
</body>

</html>