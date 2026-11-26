<?php
// verifier-client.php : vérifie l'e-mail et le mot de passe tapés sur client.php
session_start();

// Si on arrive ici sans avoir rempli le formulaire, retour à la connexion
if (!isset($_POST["email"])) {
    header("Location: client.php");
    exit;
}

$email = $_POST["email"];
$motdepasse = $_POST["motdepasse"];

include "inc/bdd.php";

// On cherche le client qui a cet e-mail (le ? est remplacé par $email)
$req = $pdo->prepare("SELECT id, prenom, mot_de_passe FROM clients WHERE email = ?");
$req->execute([$email]);
$client = $req->fetch();

// Il existe ET le mot de passe correspond au hash de la base ?
if ($client && password_verify($motdepasse, $client["mot_de_passe"])) {
    // On retient le client dans la session (jamais le mot de passe)
    $_SESSION["client_id"] = $client["id"];
    $_SESSION["client_prenom"] = $client["prenom"];
    header("Location: compte.php");
    exit;
}

// Sinon : message d'erreur
include "inc/infos.php";
$page = "client";
$titre = "Espace client";
?>
<?php include "inc/haut.php"; ?>
  <main>
    <h1>Espace client</h1>
    <p class="erreur">Adresse e-mail ou mot de passe incorrect.</p>
    <p><a href="client.php">Réessayer</a></p>
  </main>
<?php include "inc/pied.php"; ?>
