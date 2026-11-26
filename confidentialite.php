<?php
session_start();
include "inc/infos.php";
$page = "confidentialite";
$titre = "Confidentialité";
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Confidentialité</h1>
    <p>Comment TechSolutions utilise vos données personnelles (RGPD).</p>
  </div>
  <main>
    <section class="carte">
      <h2>Les données enregistrées</h2>
      <p>Formulaire de contact : nom, adresse e-mail et message.</p>
      <p>Compte client : prénom, nom, entreprise, téléphone, adresse e-mail et mot de passe (le mot de passe est enregistré sous forme d’empreinte, jamais en clair).</p>
    </section>
    <section class="carte">
      <h2>Pourquoi ?</h2>
      <p>Ces données servent uniquement à répondre à vos demandes et à gérer votre compte. Vous donnez votre accord en cochant la case du formulaire ou en créant un compte.</p>
    </section>
    <section class="carte">
      <h2>Vos droits</h2>
      <p>Dans « Mon compte », un client peut modifier ses données (droit de rectification) et supprimer son compte (droit à l’effacement). Ses messages sont alors supprimés aussi.</p>
      <p>Le site n’utilise qu’un cookie technique : le numéro de session.</p>
    </section>
  </main>
<?php include "inc/pied.php"; ?>
