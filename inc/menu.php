<?php // menu.php : le menu, écrit une seule fois. $page sert à souligner la page où on est. ?>
<header>
  <a class="logo" href="index.php"><img src="images/logo.png" alt="Logo TechSolutions"></a>
  <nav>
    <a href="index.php" <?php if ($page == "index") { echo 'class="actif"'; } ?>>Accueil</a>
    <a href="services.php" <?php if ($page == "services") { echo 'class="actif"'; } ?>>Services</a>
    <a href="entreprise.php" <?php if ($page == "entreprise") { echo 'class="actif"'; } ?>>Entreprise</a>
    <a href="realisations.php" <?php if ($page == "realisations") { echo 'class="actif"'; } ?>>Réalisations</a>
    <a href="actualites.php" <?php if ($page == "actualites") { echo 'class="actif"'; } ?>>Actualités</a>
    <a href="contact.php" <?php if ($page == "contact") { echo 'class="actif"'; } ?>>Contact</a>
    <?php if (isset($_SESSION["id"])) { ?>
      <a href="espace.php" <?php if ($page == "espace") { echo 'class="actif"'; } ?>>Mon espace</a>
      <a href="annuaire.php" <?php if ($page == "annuaire") { echo 'class="actif"'; } ?>>Annuaire</a>
      <?php if ($_SESSION["role"] == "admin") { ?>
        <a href="utilisateurs.php" <?php if ($page == "utilisateurs") { echo 'class="actif"'; } ?>>Utilisateurs</a>
        <a href="messages.php" <?php if ($page == "messages") { echo 'class="actif"'; } ?>>Messages</a>
      <?php } ?>
      <a href="donnees.php" <?php if ($page == "donnees") { echo 'class="actif"'; } ?>>Mes données</a>
      <a href="deconnexion.php">Se déconnecter</a>
    <?php } else { ?>
      <a href="connexion.php" <?php if ($page == "connexion") { echo 'class="actif"'; } ?>>Espace salariés</a>
    <?php } ?>
  </nav>
</header>
