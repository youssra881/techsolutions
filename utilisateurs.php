<?php
session_start();
include "inc/verif-admin.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "utilisateurs";
$titre = "Gestion des utilisateurs";

$req = $pdo->query("SELECT id, prenom, nom, service, role FROM utilisateurs ORDER BY nom, prenom");
$utilisateurs = $req->fetchAll();

// On compte les comptes et les administrateurs
$nb_comptes = 0;
$nb_admins = 0;
foreach ($utilisateurs as $u) {
    $nb_comptes = $nb_comptes + 1;
    if ($u["role"] == "admin") {
        $nb_admins = $nb_admins + 1;
    }
}
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Gestion des utilisateurs</h1>
    <p>Les comptes du personnel</p>
  </div>
  <main class="section">
    <p>Nombre de comptes : <?php echo $nb_comptes; ?> (dont <?php echo $nb_admins; ?> administrateur(s)).</p>
    <p><a class="bouton" href="ajouter.php">Ajouter un compte</a></p>
    <table>
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Service</th>
        <th>Rôle</th>
        <th>Action</th>
      </tr>
      <?php foreach ($utilisateurs as $u) { ?>
        <tr>
          <td><?php echo htmlspecialchars($u["prenom"]); ?></td>
          <td><?php echo htmlspecialchars($u["nom"]); ?></td>
          <td><?php echo htmlspecialchars($u["service"]); ?></td>
          <td><?php echo htmlspecialchars($u["role"]); ?></td>
          <td>
            <?php if ($u["id"] != $_SESSION["id"]) { ?>
              <a class="bouton-supprimer" href="supprimer.php?id=<?php echo $u["id"]; ?>">Supprimer</a>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </table>
  </main>
<?php include "inc/pied.php"; ?>
