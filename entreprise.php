<?php
session_start();
include "inc/infos.php";
include "inc/bdd.php";
$page = "entreprise";
$titre = "L’entreprise";

$req = $pdo->query("SELECT contenu FROM pages WHERE nom = 'entreprise'");
$presentation = $req->fetch();

$req = $pdo->query("SELECT prenom, nom, service FROM utilisateurs ORDER BY nom, prenom");
$equipe = $req->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>L’entreprise</h1>
    <p>Une équipe à votre service depuis <?php echo $creation; ?>.</p>
    <p>Soit <?php echo date("Y") - $creation; ?> ans d’expérience au service des entreprises.</p>
  </div>
  <main>
    <section class="carte">
      <h2>Qui sommes-nous ?</h2>
      <p><?php echo htmlspecialchars($presentation["contenu"]); ?></p>
    </section>
    <section class="carte">
      <h2>Notre équipe</h2>
      <ul>
        <?php foreach ($equipe as $membre) { ?>
          <li><?php echo htmlspecialchars($membre["prenom"] . " " . $membre["nom"] . ", " . $membre["service"]); ?></li>
        <?php } ?>
      </ul>
    </section>
  </main>
<?php include "inc/pied.php"; ?>
