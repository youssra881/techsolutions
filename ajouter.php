<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] != "admin") {
    header("Location: pages/compte/connexion.php");
    exit;
}

require "inc/bdd.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifiant = trim($_POST["identifiant"] ?? "");
    $motdepasse = $_POST["motdepasse"] ?? "";
    $prenom = trim($_POST["prenom"] ?? "");
    $nom = trim($_POST["nom"] ?? "");
    $service = trim($_POST["service"] ?? "");
    $role = $_POST["role"] === "admin" ? "admin" : "salarie";

    if ($identifiant && $motdepasse && $prenom && $nom && $service) {
        $hash = password_hash($motdepasse, PASSWORD_DEFAULT);
        $requete = $pdo->prepare("INSERT INTO utilisateurs (identifiant, mot_de_passe, prenom, nom, service, role) VALUES (?, ?, ?, ?, ?, ?)");
        try {
            $requete->execute([$identifiant, $hash, $prenom, $nom, $service, $role]);
            header("Location: utilisateurs.php");
            exit;
        } catch (PDOException $e) {
            $message = "Cet identifiant existe déjà.";
        }
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un utilisateur</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <main>
    <h1>Ajouter un utilisateur</h1>
    <?php if ($message) { ?><p class="erreur"><?php echo htmlspecialchars($message); ?></p><?php } ?>
    <form class="formulaire" method="post">
      <p><label for="identifiant">Identifiant</label><input id="identifiant" name="identifiant" required></p>
      <p><label for="motdepasse">Mot de passe</label><input id="motdepasse" name="motdepasse" type="password" required></p>
      <p><label for="prenom">Prénom</label><input id="prenom" name="prenom" required></p>
      <p><label for="nom">Nom</label><input id="nom" name="nom" required></p>
      <p><label for="service">Service</label><input id="service" name="service" required></p>
      <p><label for="role">Rôle</label><select id="role" name="role"><option value="salarie">salarié</option><option value="admin">administrateur</option></select></p>
      <p><button type="submit">Ajouter</button></p>
    </form>
    <p><a href="utilisateurs.php">Retour à la gestion</a></p>
  </main>
</body>
</html>
