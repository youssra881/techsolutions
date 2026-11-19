<?php
session_start();
require "inc/verif-admin.php";
require "inc/bdd.php";

$prenom = $_POST["prenom"] ?? "";
$nom = $_POST["nom"] ?? "";
$service = $_POST["service"] ?? "";
$identifiant = $_POST["identifiant"] ?? "";
$motdepasse = $_POST["motdepasse"] ?? "";
$role = $_POST["role"] ?? "salarie";

$requete = $pdo->prepare("SELECT id FROM utilisateurs WHERE identifiant = ?");
$requete->execute([$identifiant]);
$existant = $requete->fetch();

if (!$existant) {
    $empreinte = password_hash($motdepasse, PASSWORD_DEFAULT);
    $requete = $pdo->prepare("INSERT INTO utilisateurs (identifiant, mot_de_passe, prenom, nom, service, role) VALUES (?, ?, ?, ?, ?, ?)");
    $requete->execute([$identifiant, $empreinte, $prenom, $nom, $service, $role]);
    header("Location: utilisateurs.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TechSolutions : ajouter un compte</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <main>
    <h1>Ajouter un compte</h1>
    <p class="erreur">Cet identifiant est déjà utilisé : le compte n'a pas été créé.</p>
    <p><a href="ajouter.php">Recommencer</a></p>
  </main>
</body>
</html>
