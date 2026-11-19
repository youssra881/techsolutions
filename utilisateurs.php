<?php
session_start();
require "inc/bdd.php";

// Connexion obligatoire.
if (!isset($_SESSION["id"])) {
    header("Location: pages/compte/connexion.php");
    exit;
}

// Seul l'administrateur peut ouvrir cette page.
if ($_SESSION["role"] != "admin") {
    header("Location: espace.php");
    exit;
}

$requete = $pdo->query("SELECT id, prenom, nom, service, role FROM utilisateurs ORDER BY nom");
$utilisateurs = $requete->fetchAll();
$requeteAdmin = $pdo->query("SELECT id FROM utilisateurs WHERE role = 'admin'");
$administrateurs = $requeteAdmin->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TechSolutions : gestion des utilisateurs</title>
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
    <h1>Gestion des utilisateurs</h1>
    <p class="slogan">Les comptes du personnel</p>
    <p>Nombre de comptes : <?php echo count($utilisateurs); ?></p>
    <p>Dont <?php echo count($administrateurs); ?> administrateur</p>
    <table>
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Service</th>
        <th>Rôle</th>
        <th>Action</th>
      </tr>
      <?php foreach ($utilisateurs as $u) { ?>
      <tr>
        <td><?php echo htmlspecialchars($u["prenom"]); ?></td>
        <td><?php echo htmlspecialchars($u["nom"]); ?></td>
        <td><?php echo htmlspecialchars($u["service"]); ?></td>
        <td><?php echo htmlspecialchars($u["role"]); ?></td>
        <td>
          <?php if ((int) $u["id"] != (int) $_SESSION["id"]) { ?>
          <a class="bouton-supprimer" href="confirmer.php?id=<?php echo (int) $u["id"]; ?>">Supprimer</a>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </table>
    <p><a href="ajouter.php">Ajouter un utilisateur</a></p>
    <p><a href="espace.php">Retour à mon espace</a></p>
  </main>
</body>
</html>
