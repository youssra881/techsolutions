<?php
session_start();
require "inc/verif-admin.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un utilisateur</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <main>
    <h1>Ajouter un utilisateur</h1>
    <form class="formulaire" action="creer.php" method="post">
      <p><label for="prenom">Prénom</label><input id="prenom" name="prenom" required></p>
      <p><label for="nom">Nom</label><input id="nom" name="nom" required></p>
      <p><label for="service">Service</label><input id="service" name="service" required></p>
      <p><label for="identifiant">Identifiant</label><input id="identifiant" name="identifiant" required></p>
      <p><label for="motdepasse">Mot de passe de départ</label><input id="motdepasse" name="motdepasse" type="password" required></p>
      <p><label for="role">Rôle</label><select id="role" name="role"><option value="salarie">Salarié</option><option value="admin">Administrateur</option></select></p>
      <p><button type="submit">Ajouter</button></p>
    </form>
    <p><a href="utilisateurs.php">Retour à la gestion</a></p>
  </main>
</body>
</html>
