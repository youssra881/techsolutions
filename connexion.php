<?php
session_start();

// Pas besoin de se reconnecter si on est déjà connecté : on va directement à l'espace
if (isset($_SESSION["id"])) {
    header("Location: espace.php");
    exit;
}
include "inc/infos.php";
$page = "connexion";
$titre = "Espace salariés";
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Espace salariés</h1>
    <p>Connectez-vous avec votre identifiant.</p>
  </div>
  <main class="section">
    <form class="carte" action="verifier.php" method="post">
      <h2>Se connecter</h2>
      <label for="identifiant">Identifiant</label>
      <input id="identifiant" name="identifiant" type="text" required>
      <label for="motdepasse">Mot de passe</label>
      <input id="motdepasse" name="motdepasse" type="password" required>
      <button class="bouton" type="submit">Se connecter</button>
      <p>Besoin d’aide ? <a href="contact.php">Contactez TechSolutions</a>.</p>
    </form>
  </main>
<?php include "inc/pied.php"; ?>
