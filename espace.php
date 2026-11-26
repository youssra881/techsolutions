<?php
session_start();
include "inc/verif-connecte.php";   // page réservée aux personnes connectées
include "inc/infos.php";
$page = "espace";
$titre = "Mon espace";
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Mon espace</h1>
    <p>Votre espace salarié TechSolutions.</p>
  </div>
  <main>
    <p class="slogan">Bonjour <?php echo htmlspecialchars($_SESSION["prenom"] . " " . $_SESSION["nom"]); ?> !</p>
    <p>Service : <?php echo htmlspecialchars($_SESSION["service"]); ?></p>
    <p>Rôle : <?php echo htmlspecialchars($_SESSION["role"]); ?></p>
    <?php if ($_SESSION["role"] == "admin") { ?>
      <p>Vous êtes l’administrateur du site.</p>
      <p><a href="utilisateurs.php">Gérer les utilisateurs</a></p>
      <p><a href="clients.php">Gérer les clients</a></p>
      <p><a href="messages.php">Lire les messages reçus</a></p>
      <p><a href="contenu.php">Modifier le contenu du site</a></p>
    <?php } ?>
    <p><a href="donnees.php">Voir et modifier mes données</a></p>
    <p><a class="bouton" href="deconnexion.php">Se déconnecter</a></p>
  </main>
<?php include "inc/pied.php"; ?>
