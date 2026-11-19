<?php
session_start();
require "inc/verif-connecte.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TechSolutions : mon espace</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <nav class="navigation">
    <a href="index.php"><img src="images/logo.png" alt="TechSolutions" class="logo"></a>
  </nav>
  <main>
    <h1>Mon espace</h1>
    <p class="slogan">Bonjour <?php echo htmlspecialchars($_SESSION["prenom"] . " " . $_SESSION["nom"]); ?> !</p>
    <p>Service : <?php echo htmlspecialchars($_SESSION["service"]); ?></p>
    <p>Rôle : <?php echo htmlspecialchars($_SESSION["role"]); ?></p>
    <?php if ($_SESSION["role"] == "admin") { ?>
      <p><a href="utilisateurs.php">Gérer les utilisateurs</a></p>
      <p><a href="annuaire.php">Voir l'annuaire</a></p>
    <?php } ?>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
  </main>
</body>
</html>
