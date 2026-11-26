<?php
session_start();
include "inc/verif-admin.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "admin";
$titre = "Gérer les actualités";

$erreur = "";
// Le formulaire sert à publier (id = 0) ou à modifier (id > 0)
$formulaire = ["id" => 0, "categorie" => "", "titre" => "", "resume" => "", "source_nom" => "", "source_url" => "", "date_maj" => date("Y-m-d")];

// Supprimer un article
if (isset($_POST["supprimer"])) {
    $req = $pdo->prepare("DELETE FROM actualites WHERE id = ?");
    $req->execute([$_POST["supprimer"]]);
    header("Location: gerer-actualites.php");
    exit;
}

// Enregistrer (publication ou modification)
if (isset($_POST["enregistrer"])) {
    $formulaire = [
        "id" => (int) $_POST["id"],
        "categorie" => trim($_POST["categorie"]),
        "titre" => trim($_POST["titre"]),
        "resume" => trim($_POST["resume"]),
        "source_nom" => trim($_POST["source_nom"]),
        "source_url" => trim($_POST["source_url"]),
        "date_maj" => $_POST["date_maj"]
    ];
    $f = $formulaire;

    if ($f["categorie"] == "" || $f["titre"] == "" || $f["resume"] == "") {
        $erreur = "Veuillez remplir la catégorie, le titre et le résumé.";
    } elseif (!date_create_from_format("Y-m-d", $f["date_maj"])) {
        $erreur = "La date n’est pas valide.";
    } elseif ($f["source_url"] != "" && !preg_match("#^https?://#", $f["source_url"])) {
        // On refuse tout lien qui ne commence pas par http:// ou https://
        $erreur = "Le lien de la source doit commencer par http:// ou https://.";
    } else {
        if ($f["id"] > 0) {
            $req = $pdo->prepare("UPDATE actualites SET categorie = ?, titre = ?, resume = ?, source_nom = ?, source_url = ?, date_maj = ? WHERE id = ?");
            $req->execute([$f["categorie"], $f["titre"], $f["resume"], $f["source_nom"], $f["source_url"], $f["date_maj"], $f["id"]]);
        } else {
            $req = $pdo->prepare("INSERT INTO actualites (categorie, titre, resume, source_nom, source_url, date_maj) VALUES (?, ?, ?, ?, ?, ?)");
            $req->execute([$f["categorie"], $f["titre"], $f["resume"], $f["source_nom"], $f["source_url"], $f["date_maj"]]);
        }
        header("Location: gerer-actualites.php");
        exit;
    }
}

// Clic sur « Modifier » : on remplit le formulaire avec l'article choisi
if (isset($_GET["modifier"])) {
    $req = $pdo->prepare("SELECT id, categorie, titre, resume, source_nom, source_url, date_maj FROM actualites WHERE id = ?");
    $req->execute([$_GET["modifier"]]);
    $ligne = $req->fetch();
    if ($ligne) {
        $formulaire = $ligne;
    }
}

$actualites = $pdo->query("SELECT id, titre, date_maj FROM actualites ORDER BY date_maj DESC, id DESC")->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Gérer les actualités</h1>
    <p>Les articles de la section « Actualités ».</p>
  </div>
  <main>
    <table>
      <tr><th>Date</th><th>Titre</th><th>Actions</th></tr>
      <?php foreach ($actualites as $a) { ?>
        <tr>
          <td><?php echo date("d/m/Y", strtotime($a["date_maj"])); ?></td>
          <td><?php echo htmlspecialchars($a["titre"]); ?></td>
          <td>
            <a href="gerer-actualites.php?modifier=<?php echo $a["id"]; ?>">Modifier</a>
            <form action="gerer-actualites.php" method="post">
              <button class="bouton-supprimer" type="submit" name="supprimer" value="<?php echo $a["id"]; ?>">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>

    <?php if ($erreur != "") { ?><p class="erreur"><?php echo $erreur; ?></p><?php } ?>
    <form class="carte" action="gerer-actualites.php" method="post">
      <h2><?php echo $formulaire["id"] > 0 ? "Modifier l’article" : "Publier un article"; ?></h2>
      <input type="hidden" name="id" value="<?php echo $formulaire["id"]; ?>">
      <label for="categorie">Catégorie</label>
      <input id="categorie" name="categorie" type="text" value="<?php echo htmlspecialchars($formulaire["categorie"]); ?>" required>
      <label for="titre">Titre</label>
      <input id="titre" name="titre" type="text" value="<?php echo htmlspecialchars($formulaire["titre"]); ?>" required>
      <label for="resume">Résumé</label>
      <textarea id="resume" name="resume" rows="4" required><?php echo htmlspecialchars($formulaire["resume"]); ?></textarea>
      <label for="source_nom">Nom de la source (facultatif)</label>
      <input id="source_nom" name="source_nom" type="text" value="<?php echo htmlspecialchars($formulaire["source_nom"]); ?>">
      <label for="source_url">Lien de la source (facultatif)</label>
      <input id="source_url" name="source_url" type="url" value="<?php echo htmlspecialchars($formulaire["source_url"]); ?>">
      <label for="date_maj">Date</label>
      <input id="date_maj" name="date_maj" type="date" value="<?php echo htmlspecialchars($formulaire["date_maj"]); ?>" required>
      <button class="bouton" type="submit" name="enregistrer" value="oui">Enregistrer</button>
    </form>
    <p><a href="admin.php">Retour à l’administration</a></p>
  </main>
<?php include "inc/pied.php"; ?>
