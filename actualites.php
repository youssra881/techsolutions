<?php
session_start();
include "inc/infos.php";
$page = "actualites";
$titre = "Actualités";
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Actualités</h1>
    <p>Actualités et informations sur le secteur informatique.</p>
  </div>
  <main class="section">
    <article class="carte">
      <p>Développement · PHP</p>
      <h2>Des vulnérabilités touchent PHP</h2>
      <p>Le CERT-FR recommande d’appliquer les correctifs dès qu’ils sont disponibles.</p>
      <p>Mis à jour le 27 octobre 2026</p>
      <a href="https://cert.cyber.gouv.fr/alerte/CERTFR-2026-ALE-014/">Source : CERT-FR</a>
    </article>
    <article class="carte">
      <p>Cybersécurité</p>
      <h2>Des vulnérabilités touchent Ivanti Connect Secure</h2>
      <p>Le CERT-FR signale plusieurs vulnérabilités et recommande d’installer les correctifs.</p>
      <p>Mis à jour le 2 novembre 2026</p>
      <a href="https://cert.cyber.gouv.fr/alerte/CERTFR-2026-ALE-013/">Source : CERT-FR</a>
    </article>
  </main>
<?php include "inc/pied.php"; ?>
