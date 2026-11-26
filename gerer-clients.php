<?php
session_start();
include "inc/verif-admin.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "admin";
$titre = "Gérer les clients";

// Supprimer un client (droit à l'effacement) : son compte et ses messages
if (isset($_POST["supprimer"])) {
    $req = $pdo->prepare("SELECT email FROM clients WHERE id = ?");
    $req->execute([$_POST["supprimer"]]);
    $client = $req->fetch();
    if ($client) {
        $req = $pdo->prepare("DELETE FROM messages WHERE email = ?");
        $req->execute([$client["email"]]);
        $req = $pdo->prepare("DELETE FROM clients WHERE id = ?");
        $req->execute([$_POST["supprimer"]]);
    }
    header("Location: gerer-clients.php");
    exit;
}

$clients = $pdo->query("SELECT id, prenom, nom, entreprise, email, date_inscription FROM clients ORDER BY nom, prenom")->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Gérer les clients</h1>
    <p>Les comptes clients (<?php echo count($clients); ?>). Supprimer un compte efface aussi ses messages.</p>
  </div>
  <main>
    <?php if (count($clients) == 0) { ?>
      <p>Aucun compte client pour le moment.</p>
    <?php } else { ?>
      <table>
        <tr><th>Nom</th><th>Entreprise</th><th>E-mail</th><th>Inscrit le</th><th>Action</th></tr>
        <?php foreach ($clients as $c) { ?>
          <tr>
            <td><?php echo htmlspecialchars($c["prenom"] . " " . $c["nom"]); ?></td>
            <td><?php echo htmlspecialchars($c["entreprise"]); ?></td>
            <td><?php echo htmlspecialchars($c["email"]); ?></td>
            <td><?php echo date("d/m/Y", strtotime($c["date_inscription"])); ?></td>
            <td>
              <form action="gerer-clients.php" method="post" onsubmit="return confirm('Supprimer ce compte et ses messages ?');">
                <button class="bouton-supprimer" type="submit" name="supprimer" value="<?php echo $c["id"]; ?>">Supprimer</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </table>
    <?php } ?>
    <p><a href="admin.php">Retour à l’administration</a></p>
  </main>
<?php include "inc/pied.php"; ?>
