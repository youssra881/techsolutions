<?php
session_start();
require "inc/bdd.php";

// Protection côté serveur.
if (!isset($_SESSION["id"])) {
    header("Location: pages/compte/connexion.php");
    exit;
}

if ($_SESSION["role"] != "admin") {
    header("Location: espace.php");
    exit;
}

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$requete = $pdo->prepare("SELECT prenom, nom FROM utilisateurs WHERE id = ?");
$requete->execute([$id]);
$utilisateur = $requete->fetch();

if (!$utilisateur || $id == $_SESSION["id"]) {
    header("Location: utilisateurs.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Confirmer la suppression</title>
  <link rel="stylesheet" href="css/css.css">
</head>
<body>
  <main>
    <h1>Confirmer la suppression</h1>
    <p>Voulez-vous vraiment supprimer le compte de <?php echo htmlspecialchars($utilisateur["prenom"] . " " . $utilisateur["nom"]); ?> ?</p>
    <form action="supprimer.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <button type="submit" class="bouton-supprimer">Oui, supprimer</button>
      <a class="bouton" href="utilisateurs.php">Non, revenir à la liste</a>
    </form>
  </main>
</body>
</html>
