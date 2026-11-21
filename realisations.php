<?php
session_start();
include "inc/infos.php";
$page = "realisations";
$titre = "Nos réalisations";
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Nos réalisations</h1>
    <p>Quelques clients que nous accompagnons.</p>
  </div>
  <main class="section">
    <section class="carte">
      <h2>Cabinet Lafon</h2>
      <p>Brive-la-Gaillarde : installation de 12 postes et d’un serveur de fichiers.</p>
    </section>
    <section class="carte">
      <h2>Boulangerie Dupuy</h2>
      <p>Tulle : mise en place du Wi-Fi et d’une caisse connectée.</p>
    </section>
    <section class="carte">
      <h2>Garage Martinez</h2>
      <p>Limoges : sauvegarde automatique des données et site vitrine.</p>
    </section>
  </main>
<?php include "inc/pied.php"; ?>
