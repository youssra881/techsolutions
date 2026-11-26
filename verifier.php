<?php
// verifier.php : vérifie l'identifiant et le mot de passe tapés sur connexion.php
session_start();

// Si on arrive ici sans avoir rempli le formulaire, retour à la connexion
if (!isset($_POST["identifiant"])) {
    header("Location: connexion.php");
    exit;
}

$identifiant = $_POST["identifiant"];
$motdepasse = $_POST["motdepasse"];

include "inc/bdd.php";

// On cherche l'utilisateur qui a cet identifiant (le ? est remplacé par $identifiant)
$req = $pdo->prepare("SELECT id, prenom, nom, service, role, mot_de_passe FROM utilisateurs WHERE identifiant = ?");
$req->execute([$identifiant]);
$utilisateur = $req->fetch();

// Il existe ET le mot de passe correspond au hash de la base ?
if ($utilisateur && password_verify($motdepasse, $utilisateur["mot_de_passe"])) {
    // On retient la personne dans la session (jamais le mot de passe)
    $_SESSION["id"] = $utilisateur["id"];
    $_SESSION["prenom"] = $utilisateur["prenom"];
    $_SESSION["nom"] = $utilisateur["nom"];
    $_SESSION["service"] = $utilisateur["service"];
    $_SESSION["role"] = $utilisateur["role"];
    header("Location: espace.php");
    exit;
}

// Sinon : message d'erreur
include "inc/infos.php";
$page = "connexion";
$titre = "Espace salariés";
?>
<?php include "inc/haut.php"; ?>
  <main class="section">
    <h1>Espace salariés</h1>
    <p class="erreur">Identifiant ou mot de passe incorrect.</p>
    <p><a href="connexion.php">Réessayer</a></p>
  </main>
<?php include "inc/pied.php"; ?>
