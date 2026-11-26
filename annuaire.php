<?php
session_start();
include "inc/verif-connecte.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "annuaire";
$titre = "Annuaire";

$req = $pdo->query("SELECT prenom, nom, service, identifiant FROM utilisateurs ORDER BY service, nom, prenom");
$utilisateurs = $req->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Annuaire</h1>
    <p>Les membres de l’équipe, classés par service.</p>
  </div>
  <main class="section">
    <table>
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Service</th>
        <th>Identifiant</th>
      </tr>
      <?php foreach ($utilisateurs as $u) { ?>
        <tr>
          <td><?php echo htmlspecialchars($u["prenom"]); ?></td>
          <td><?php echo htmlspecialchars($u["nom"]); ?></td>
          <td><?php echo htmlspecialchars($u["service"]); ?></td>
          <td><?php echo htmlspecialchars($u["identifiant"]); ?></td>
        </tr>
      <?php } ?>
    </table>
  </main>
<?php include "inc/pied.php"; ?>
