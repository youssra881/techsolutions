<?php
require "inc/bdd.php";

// ORDER BY nom trie les salariés par ordre alphabétique.
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
  <div class="navigation">
    <a href="index.php">
      <img src="images/logo.png" alt="TechSolutions" class="logo">
    </a>
    <a href="services.php">Services</a>
    <a href="pages/informations/actualites.html">Actualités</a>
    <a href="pages/informations/contact.php">Contact</a>
    <a href="entreprise.php">Entreprise</a>
    <a href="pages/compte/connexion.php">Connexion</a>
  </div>

  <div class="entete">
    <h1>Notre entreprise</h1>
    <p>TechSolutions accompagne les entreprises dans leur informatique au quotidien.</p>
  </div>

  <div class="section">
    <h2>Notre équipe</h2>
    <p>Découvrez les personnes qui composent l’équipe de TechSolutions.</p>
    <ul>
      <?php foreach ($equipe as $membre) { ?>
      <li><?php echo htmlspecialchars($membre["prenom"] . " " . $membre["nom"] . ", " . $membre["service"]); ?></li>
      <?php } ?>
    </ul>
  </div>

  <div class="pied">
    <p>© 2026 TechSolutions ·
      <a href="pages/informations/contact.php">Nous contacter</a>
    </p>
  </div>
</body>
</html>