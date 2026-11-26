<?php
session_start();
include "inc/verif-admin.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "admin";
$titre = "Textes du site";

// Les textes modifiables : clé dans la table « textes » => nom affiché
$libelles = [
    "accueil_titre" => "Titre de l’accueil",
    "accueil_texte" => "Texte de l’accueil",
    "entreprise_texte" => "Présentation de l’entreprise"
];

$succes = "";

if (isset($_POST["enregistrer"])) {
    foreach ($libelles as $cle => $libelle) {
        $valeur = trim($_POST[$cle] ?? "");
        if ($valeur != "") {
            $req = $pdo->prepare("UPDATE textes SET valeur = ? WHERE cle = ?");
            $req->execute([$valeur, $cle]);
        }
    }
    $succes = "Les textes ont été enregistrés.";
}

$textes = $pdo->query("SELECT cle, valeur FROM textes")->fetchAll(PDO::FETCH_KEY_PAIR);
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Textes du site</h1>
    <p>Ces textes s’affichent sur l’accueil et sur la page « Entreprise ».</p>
  </div>
  <main>
    <?php if ($succes != "") { ?><p class="succes"><?php echo $succes; ?></p><?php } ?>
    <form class="carte" action="gerer-textes.php" method="post">
      <?php foreach ($libelles as $cle => $libelle) { ?>
        <label for="<?php echo $cle; ?>"><?php echo $libelle; ?></label>
        <textarea id="<?php echo $cle; ?>" name="<?php echo $cle; ?>" rows="4" required><?php echo htmlspecialchars($textes[$cle]); ?></textarea>
      <?php } ?>
      <button class="bouton" type="submit" name="enregistrer" value="oui">Enregistrer</button>
    </form>
    <p><a href="admin.php">Retour à l’administration</a></p>
  </main>
<?php include "inc/pied.php"; ?>
