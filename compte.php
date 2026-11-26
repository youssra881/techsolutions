<?php
session_start();
include "inc/verif-client.php";   // page réservée aux clients connectés
include "inc/infos.php";
include "inc/bdd.php";
$page = "compte";
$titre = "Mon compte";

$succes = "";
$erreur = "";

// Supprimer mon compte (droit à l'effacement)
if (isset($_POST["supprimer"])) {
    // On supprime aussi les messages envoyés avec mon e-mail
    $req = $pdo->prepare("SELECT email FROM clients WHERE id = ?");
    $req->execute([$_SESSION["client_id"]]);
    $moi = $req->fetch();
    $req = $pdo->prepare("DELETE FROM messages WHERE email = ?");
    $req->execute([$moi["email"]]);
    // Le WHERE est obligatoire : sans lui, on supprimerait tous les clients !
    $req = $pdo->prepare("DELETE FROM clients WHERE id = ?");
    $req->execute([$_SESSION["client_id"]]);
    session_destroy();
    header("Location: index.php");
    exit;
}

// Modifier mes informations (droit de rectification)
if (isset($_POST["modifier"])) {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $entreprise = $_POST["entreprise"];
    $telephone = $_POST["telephone"];
    if ($prenom == "" || $nom == "") {
        $erreur = "Le prénom et le nom sont obligatoires.";
    } else {
        $req = $pdo->prepare("UPDATE clients SET prenom = ?, nom = ?, entreprise = ?, telephone = ? WHERE id = ?");
        $req->execute([$prenom, $nom, $entreprise, $telephone, $_SESSION["client_id"]]);
        $_SESSION["client_prenom"] = $prenom;
        $succes = "Vos informations ont été modifiées.";
    }
}

// On lit mes données dans la base pour remplir le formulaire
$req = $pdo->prepare("SELECT email, prenom, nom, entreprise, telephone FROM clients WHERE id = ?");
$req->execute([$_SESSION["client_id"]]);
$moi = $req->fetch();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Mon compte</h1>
    <p>Vous pouvez consulter et modifier vos données (RGPD : droit d’accès et de rectification).</p>
  </div>
  <main>
    <?php if ($succes != "") { ?><p class="succes"><?php echo $succes; ?></p><?php } ?>
    <?php if ($erreur != "") { ?><p class="erreur"><?php echo $erreur; ?></p><?php } ?>

    <p>Adresse e-mail : <strong><?php echo htmlspecialchars($moi["email"]); ?></strong> (non modifiable)</p>

    <form class="carte" action="compte.php" method="post">
      <h2>Mes informations</h2>
      <label for="prenom">Prénom</label>
      <input id="prenom" name="prenom" type="text" value="<?php echo htmlspecialchars($moi["prenom"]); ?>" required>
      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" value="<?php echo htmlspecialchars($moi["nom"]); ?>" required>
      <label for="entreprise">Entreprise</label>
      <input id="entreprise" name="entreprise" type="text" value="<?php echo htmlspecialchars($moi["entreprise"]); ?>">
      <label for="telephone">Téléphone</label>
      <input id="telephone" name="telephone" type="text" value="<?php echo htmlspecialchars($moi["telephone"]); ?>">
      <button class="bouton" type="submit" name="modifier" value="oui">Enregistrer</button>
    </form>

    <form class="carte" action="compte.php" method="post">
      <h2>Supprimer mon compte</h2>
      <p>Votre compte et vos messages seront effacés. C’est définitif.</p>
      <button class="bouton-supprimer" type="submit" name="supprimer" value="oui">Supprimer mon compte</button>
    </form>
  </main>
<?php include "inc/pied.php"; ?>
