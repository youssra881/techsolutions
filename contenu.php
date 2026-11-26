<?php
session_start();
include "inc/verif-admin.php";   // page réservée à l'administrateur
include "inc/infos.php";
include "inc/bdd.php";
$page = "contenu";
$titre = "Contenu du site";

$succes = "";
$erreur = "";

// Formulaire 1 : modifier les textes de l'accueil et de l'entreprise
if (isset($_POST["enregistrer"])) {
    $req = $pdo->prepare("UPDATE pages SET contenu = ? WHERE nom = 'accueil'");
    $req->execute([$_POST["accueil"]]);
    $req = $pdo->prepare("UPDATE pages SET contenu = ? WHERE nom = 'entreprise'");
    $req->execute([$_POST["entreprise"]]);
    $succes = "Les textes ont été enregistrés.";
}

// Formulaire 2 : publier une actualité
if (isset($_POST["publier"])) {
    if ($_POST["titre"] == "" || $_POST["resume"] == "") {
        $erreur = "Veuillez remplir le titre et le résumé.";
    } else {
        // CURDATE() est la date du jour (donnée par MySQL)
        $req = $pdo->prepare("INSERT INTO actualites (titre, resume, source, lien, date_pub) VALUES (?, ?, ?, '', CURDATE())");
        $req->execute([$_POST["titre"], $_POST["resume"], $_POST["source"]]);
        $succes = "L’actualité a été publiée.";
    }
}

// Bouton « Supprimer » d'une actualité
if (isset($_POST["supprimer"])) {
    $req = $pdo->prepare("DELETE FROM actualites WHERE id = ?");
    $req->execute([$_POST["supprimer"]]);
}

// On lit les textes et les actualités pour les afficher
$req = $pdo->query("SELECT contenu FROM pages WHERE nom = 'accueil'");
$accueil = $req->fetch();
$req = $pdo->query("SELECT contenu FROM pages WHERE nom = 'entreprise'");
$entreprise_texte = $req->fetch();
$req = $pdo->query("SELECT id, titre, date_pub FROM actualites ORDER BY date_pub DESC");
$actualites = $req->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Contenu du site</h1>
    <p>Modifier les textes et les actualités visibles sur le site.</p>
  </div>
  <main>
    <?php if ($succes != "") { ?><p class="succes"><?php echo $succes; ?></p><?php } ?>
    <?php if ($erreur != "") { ?><p class="erreur"><?php echo $erreur; ?></p><?php } ?>

    <form class="carte" action="contenu.php" method="post">
      <h2>Les textes des pages</h2>
      <label for="accueil">Texte de l’accueil</label>
      <textarea id="accueil" name="accueil" rows="4" required><?php echo htmlspecialchars($accueil["contenu"]); ?></textarea>
      <label for="entreprise">Texte de la page Entreprise</label>
      <textarea id="entreprise" name="entreprise" rows="4" required><?php echo htmlspecialchars($entreprise_texte["contenu"]); ?></textarea>
      <button class="bouton" type="submit" name="enregistrer" value="oui">Enregistrer</button>
    </form>

    <form class="carte" action="contenu.php" method="post">
      <h2>Publier une actualité</h2>
      <label for="titre">Titre</label>
      <input id="titre" name="titre" type="text" required>
      <label for="resume">Résumé</label>
      <textarea id="resume" name="resume" rows="3" required></textarea>
      <label for="source">Source (facultatif)</label>
      <input id="source" name="source" type="text">
      <button class="bouton" type="submit" name="publier" value="oui">Publier</button>
    </form>

    <h2>Les actualités publiées</h2>
    <table>
      <tr><th>Date</th><th>Titre</th><th>Action</th></tr>
      <?php foreach ($actualites as $a) { ?>
        <tr>
          <td><?php echo $a["date_pub"]; ?></td>
          <td><?php echo htmlspecialchars($a["titre"]); ?></td>
          <td>
            <form action="contenu.php" method="post">
              <button class="bouton-supprimer" type="submit" name="supprimer" value="<?php echo $a["id"]; ?>">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>
  </main>
<?php include "inc/pied.php"; ?>
