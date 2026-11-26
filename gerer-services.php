<?php
session_start();
include "inc/verif-admin.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "admin";
$titre = "Gérer les services";

$erreur = "";
// Le formulaire sert à ajouter (id = 0) ou à modifier (id > 0)
$formulaire = ["id" => 0, "titre" => "", "description" => "", "ordre" => 0];

// Supprimer un service
if (isset($_POST["supprimer"])) {
    $req = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $req->execute([$_POST["supprimer"]]);
    header("Location: gerer-services.php");
    exit;
}

// Enregistrer (ajout ou modification)
if (isset($_POST["enregistrer"])) {
    $formulaire = [
        "id" => (int) $_POST["id"],
        "titre" => trim($_POST["titre"]),
        "description" => trim($_POST["description"]),
        "ordre" => (int) $_POST["ordre"]
    ];
    if ($formulaire["titre"] == "" || $formulaire["description"] == "") {
        $erreur = "Veuillez remplir le titre et la description.";
    } else {
        if ($formulaire["id"] > 0) {
            $req = $pdo->prepare("UPDATE services SET titre = ?, description = ?, ordre = ? WHERE id = ?");
            $req->execute([$formulaire["titre"], $formulaire["description"], $formulaire["ordre"], $formulaire["id"]]);
        } else {
            $req = $pdo->prepare("INSERT INTO services (titre, description, ordre) VALUES (?, ?, ?)");
            $req->execute([$formulaire["titre"], $formulaire["description"], $formulaire["ordre"]]);
        }
        header("Location: gerer-services.php");
        exit;
    }
}

// Clic sur « Modifier » : on remplit le formulaire avec le service choisi
if (isset($_GET["modifier"])) {
    $req = $pdo->prepare("SELECT id, titre, description, ordre FROM services WHERE id = ?");
    $req->execute([$_GET["modifier"]]);
    $ligne = $req->fetch();
    if ($ligne) {
        $formulaire = $ligne;
    }
}

$services = $pdo->query("SELECT id, titre, ordre FROM services ORDER BY ordre, id")->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Gérer les services</h1>
    <p>Les services affichés sur l’accueil et sur la page « Services ».</p>
  </div>
  <main>
    <table>
      <tr><th>Ordre</th><th>Titre</th><th>Actions</th></tr>
      <?php foreach ($services as $s) { ?>
        <tr>
          <td><?php echo $s["ordre"]; ?></td>
          <td><?php echo htmlspecialchars($s["titre"]); ?></td>
          <td>
            <a href="gerer-services.php?modifier=<?php echo $s["id"]; ?>">Modifier</a>
            <form action="gerer-services.php" method="post">
              <button class="bouton-supprimer" type="submit" name="supprimer" value="<?php echo $s["id"]; ?>">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>

    <?php if ($erreur != "") { ?><p class="erreur"><?php echo $erreur; ?></p><?php } ?>
    <form class="carte" action="gerer-services.php" method="post">
      <h2><?php echo $formulaire["id"] > 0 ? "Modifier le service" : "Ajouter un service"; ?></h2>
      <input type="hidden" name="id" value="<?php echo $formulaire["id"]; ?>">
      <label for="titre">Titre</label>
      <input id="titre" name="titre" type="text" value="<?php echo htmlspecialchars($formulaire["titre"]); ?>" required>
      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($formulaire["description"]); ?></textarea>
      <label for="ordre">Ordre d’affichage (1 = en premier)</label>
      <input id="ordre" name="ordre" type="number" value="<?php echo $formulaire["ordre"]; ?>">
      <button class="bouton" type="submit" name="enregistrer" value="oui">Enregistrer</button>
    </form>
    <p><a href="admin.php">Retour à l’administration</a></p>
  </main>
<?php include "inc/pied.php"; ?>
