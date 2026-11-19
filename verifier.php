<?php
session_start();
require "inc/bdd.php";

$identifiant = $_POST["identifiant"] ?? "";
$motdepasse = $_POST["motdepasse"] ?? "";

$requete = $pdo->prepare("SELECT * FROM utilisateurs WHERE identifiant = ?");
$requete->execute([$identifiant]);
$utilisateur = $requete->fetch();

if ($utilisateur && password_verify($motdepasse, $utilisateur["mot_de_passe"])) {
    $_SESSION["id"] = $utilisateur["id"];
    $_SESSION["prenom"] = $utilisateur["prenom"];
    $_SESSION["nom"] = $utilisateur["nom"];
    $_SESSION["service"] = $utilisateur["service"];
    $_SESSION["role"] = $utilisateur["role"];
    header("Location: espace.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TechSolutions : espace salariés</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <h1>Espace salariés</h1>
  <p class="erreur">Identifiant ou mot de passe incorrect.</p>
  <p><a href="pages/compte/connexion.php">Réessayer</a></p>
</body>
</html>
