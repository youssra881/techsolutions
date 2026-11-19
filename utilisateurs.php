<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: pages/compte/connexion.php");
    exit;
}

if ($_SESSION["role"] != "admin") {
    header("Location: espace.php");
    exit;
}

require "inc/bdd.php";

$requete = $pdo->query("SELECT id, prenom, nom, service, role FROM utilisateurs ORDER BY nom");
$utilisateurs = $requete->fetchAll();
$nombreAdministrateurs = $pdo->query("SELECT COUNT(*) AS total FROM utilisateurs WHERE role = 'admin'")->fetchColumn();
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
    <p>Dont <?php echo (int) $nombreAdministrateurs; ?> administrateur</p>
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
          <form action="supprimer.php" method="post">
            <input type="hidden" name="id" value="<?php echo (int) $u["id"]; ?>">
            <button type="submit" class="bouton-supprimer">Supprimer</button>
          </form>
        </td>
      </tr>
      <?php } ?>
    </table>
    <p><a href="ajouter.php">Ajouter un utilisateur</a></p>
    <p><a href="espace.php">Retour à mon espace</a></p>
  </main>
</body>
</html>
