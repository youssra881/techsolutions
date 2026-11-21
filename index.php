<?php
session_start();
include "inc/infos.php";
$page = "index";
$titre = "Accueil";
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>On s’occupe de votre informatique.</h1>
    <p>Des solutions informatiques pour accompagner les entreprises au quotidien.</p>
    <a class="bouton" href="services.php">Découvrir nos services</a>
    <a class="bouton secondaire" href="actualites.php">Lire nos actualités</a>
  </div>
<?php include "inc/pied.php"; ?>
