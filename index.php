<?php
session_start();
include "inc/infos.php";
include "inc/bdd.php";
$page = "index";
$titre = "Accueil";

// Le texte de présentation est lu dans la base (l'administrateur peut le modifier)
$req = $pdo->query("SELECT contenu FROM pages WHERE nom = 'accueil'");
$accueil = $req->fetch();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>On s’occupe de votre informatique.</h1>
    <p><?php echo htmlspecialchars($accueil["contenu"]); ?></p>
    <a class="bouton" href="services.php">Découvrir nos services</a>
    <a class="bouton secondaire" href="contact.php">Demander un devis</a>
  </div>
<?php include "inc/pied.php"; ?>
