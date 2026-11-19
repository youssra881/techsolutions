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
$requete = $pdo->query("SELECT identifiant, prenom, nom, service, role FROM utilisateurs ORDER BY service, nom");
$utilisateurs = $requete->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TechSolutions : annuaire</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <main>
    <h1>Annuaire du personnel</h1>
    <table>
      <tr><th>Identifiant</th><th>Prénom</th><th>Nom</th><th>Service</th><th>Rôle</th></tr>
      <?php foreach ($utilisateurs as $u) { ?>
      <tr>
        <td><?php echo htmlspecialchars($u["identifiant"]); ?></td>
        <td><?php echo htmlspecialchars($u["prenom"]); ?></td>
        <td><?php echo htmlspecialchars($u["nom"]); ?></td>
        <td><?php echo htmlspecialchars($u["service"]); ?></td>
        <td><?php echo htmlspecialchars($u["role"]); ?></td>
      </tr>
      <?php } ?>
    </table>
  </main>
</body>
</html>
