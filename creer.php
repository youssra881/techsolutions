<?php
session_start();
require "inc/bdd.php";

// Protection côté serveur.
if (!isset($_SESSION["id"])) {
    header("Location: pages/compte/connexion.php");
    exit;
}

if ($_SESSION["role"] != "admin") {
    header("Location: espace.php");
    exit;
}

$prenom = trim($_POST["prenom"] ?? "");
$nom = trim($_POST["nom"] ?? "");
$service = trim($_POST["service"] ?? "");
$identifiant = trim($_POST["identifiant"] ?? "");
$motdepasse = $_POST["motdepasse"] ?? "";
$role = $_POST["role"] ?? "salarie";

if ($prenom === "" || $nom === "" || $service === "" || $identifiant === "" || $motdepasse === "") {
    header("Location: ajouter.php");
    exit;
}

if (!in_array($role, ["salarie", "admin"], true)) {
    $role = "salarie";
}

if (
    strlen($prenom) > 50
    || strlen($nom) > 50
    || strlen($service) > 50
    || strlen($identifiant) > 30
    || strlen($motdepasse) < 8
) {
    header("Location: ajouter.php");
    exit;
}

// On vérifie si l'identifiant existe déjà.
$requete = $pdo->prepare("SELECT id FROM utilisateurs WHERE identifiant = ?");
$requete->execute([$identifiant]);
$existant = $requete->fetch();

if (!$existant) {
    // On transforme le mot de passe en empreinte avant de le ranger.
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
