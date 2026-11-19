<?php
require "inc/bdd.php";
$requete = $pdo->query("SELECT prenom, nom, service FROM utilisateurs ORDER BY nom");
$equipe = $requete->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notre entreprise | TechSolutions</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <nav class="navigation">
    <a href="index.php"><img src="images/logo.png" alt="TechSolutions" class="logo"></a>
    <a href="services.php">Services</a>
    <a href="pages/informations/actualites.html">Actualités</a>
    <a href="pages/informations/contact.php">Contact</a>
    <a href="pages/compte/connexion.php">Connexion</a>
  </nav>
  <main>
    <h1>Notre entreprise</h1>
    <h2>Notre équipe</h2>
    <ul>
      <?php foreach ($equipe as $membre) { ?>
      <li><?php echo htmlspecialchars($membre["prenom"] . " " . $membre["nom"] . ", " . $membre["service"]); ?></li>
      <?php } ?>
    </ul>
  </main>
</body>
</html>