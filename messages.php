<?php
session_start();
include "inc/verif-admin.php";   // page réservée à l'administrateur
include "inc/infos.php";
include "inc/bdd.php";
$page = "messages";
$titre = "Messages reçus";

// Si on a cliqué sur "Supprimer", on supprime ce message
if (isset($_POST["supprimer"])) {
    $req = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $req->execute([$_POST["supprimer"]]);
}

// On récupère tous les messages, du plus récent au plus ancien
$req = $pdo->query("SELECT id, nom, email, message, date_envoi FROM messages ORDER BY id DESC");
$messages = $req->fetchAll();

// On compte les messages
$nb_messages = 0;
foreach ($messages as $m) {
    $nb_messages = $nb_messages + 1;
}
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Messages reçus</h1>
    <p>Les messages envoyés depuis le formulaire de contact.</p>
  </div>
  <main class="section">
    <?php if ($nb_messages == 0) { ?>
      <p>Aucun message pour le moment.</p>
    <?php } else { ?>
      <table>
        <tr><th>Date</th><th>Nom</th><th>E-mail</th><th>Message</th><th>Action</th></tr>
        <?php foreach ($messages as $m) { ?>
          <tr>
            <td><?php echo htmlspecialchars($m["date_envoi"]); ?></td>
            <td><?php echo htmlspecialchars($m["nom"]); ?></td>
            <td><?php echo htmlspecialchars($m["email"]); ?></td>
            <td><?php echo htmlspecialchars($m["message"]); ?></td>
            <td>
              <form action="messages.php" method="post">
                <button class="bouton-supprimer" type="submit" name="supprimer" value="<?php echo $m["id"]; ?>">Supprimer</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </table>
    <?php } ?>
  </main>
<?php include "inc/pied.php"; ?>
