<?php
session_start();

if (isset($_SESSION["id"])) {
    header("Location: ../../espace.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TechSolutions : espace salariés</title>
  <link rel="stylesheet" href="../../css/css.css">
</head>
<body>
  <nav class="navigation">
    <a href="../../index.php"><img src="../../images/logo.png" alt="TechSolutions" class="logo"></a>
    <a href="../../services.php">Services</a>
    <a href="../informations/actualites.html">Actualités</a>
    <a href="../informations/contact.php">Contact</a>
    <a href="connexion.php">Connexion</a>
  </nav>
  <main>
    <h1>Espace salariés</h1>
    <p class="slogan">Connectez-vous avec votre identifiant</p>
    <form class="formulaire" action="../../verifier.php" method="post">
      <p>
        <label for="identifiant">Identifiant</label>
        <input type="text" id="identifiant" name="identifiant" required>
      </p>
      <p>
        <label for="motdepasse">Mot de passe</label>
        <input type="password" id="motdepasse" name="motdepasse" required>
      </p>
      <p><button type="submit">Se connecter</button></p>
    </form>
  </main>
</body>
</html>
