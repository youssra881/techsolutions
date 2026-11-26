<?php
session_start();
include "inc/verif-admin.php";   // page réservée à l'administrateur
include "inc/infos.php";
include "inc/bdd.php";
$page = "clients";
$titre = "Clients";

// Si on a cliqué sur "Supprimer", on supprime ce client et ses messages
if (isset($_POST["supprimer"])) {
    $req = $pdo->prepare("SELECT email FROM clients WHERE id = ?");
    $req->execute([$_POST["supprimer"]]);
    $client = $req->fetch();
    $req = $pdo->prepare("DELETE FROM messages WHERE email = ?");
    $req->execute([$client["email"]]);
    $req = $pdo->prepare("DELETE FROM clients WHERE id = ?");
    $req->execute([$_POST["supprimer"]]);
}

$req = $pdo->query("SELECT id, prenom, nom, entreprise, email FROM clients ORDER BY nom, prenom");
$clients = $req->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Clients</h1>
    <p>Les comptes clients (nombre : <?php echo count($clients); ?>).</p>
  </div>
  <main>
    <table>
      <tr><th>Prénom</th><th>Nom</th><th>Entreprise</th><th>E-mail</th><th>Action</th></tr>
      <?php foreach ($clients as $c) { ?>
        <tr>
          <td><?php echo htmlspecialchars($c["prenom"]); ?></td>
          <td><?php echo htmlspecialchars($c["nom"]); ?></td>
          <td><?php echo htmlspecialchars($c["entreprise"]); ?></td>
          <td><?php echo htmlspecialchars($c["email"]); ?></td>
          <td>
            <form action="clients.php" method="post">
              <button class="bouton-supprimer" type="submit" name="supprimer" value="<?php echo $c["id"]; ?>">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>
  </main>
<?php include "inc/pied.php"; ?>
