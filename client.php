<?php
session_start();

// Déjà connecté : on va directement à son compte
if (isset($_SESSION["client_id"])) {
    header("Location: compte.php");
    exit;
}
include "inc/infos.php";
$page = "client";
$titre = "Espace client";
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Espace client</h1>
    <p>Connectez-vous pour modifier vos données personnelles.</p>
  </div>
  <main>
    <?php if (isset($_GET["cree"])) { ?>
      <p class="succes">Votre compte est créé. Vous pouvez vous connecter.</p>
    <?php } ?>
    <form class="carte" action="verifier-client.php" method="post">
      <h2>Se connecter</h2>
      <label for="email">Adresse e-mail</label>
      <input id="email" name="email" type="email" required>
      <label for="motdepasse">Mot de passe</label>
      <input id="motdepasse" name="motdepasse" type="password" required>
      <button class="bouton" type="submit">Se connecter</button>
      <p>Pas encore de compte ? <a href="inscription.php">Créer un compte client</a></p>
    </form>
  </main>
<?php include "inc/pied.php"; ?>
