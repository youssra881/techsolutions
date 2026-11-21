<?php
session_start();
include "inc/verif-connecte.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "donnees";
$titre = "Mes données";

$succes = "";
$erreur = "";

// Formulaire "Mes informations"
if (isset($_POST["modifier"])) {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $service = $_POST["service"];
    if ($prenom == "" || $nom == "" || $service == "") {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $req = $pdo->prepare("UPDATE utilisateurs SET prenom = ?, nom = ?, service = ? WHERE id = ?");
        $req->execute([$prenom, $nom, $service, $_SESSION["id"]]);
        $_SESSION["prenom"] = $prenom;
        $_SESSION["nom"] = $nom;
        $_SESSION["service"] = $service;
        $succes = "Vos informations ont été modifiées.";
    }
}

// Formulaire "Changer mon mot de passe"
if (isset($_POST["changer"])) {
    $req = $pdo->prepare("SELECT mot_de_passe FROM utilisateurs WHERE id = ?");
    $req->execute([$_SESSION["id"]]);
    $ligne = $req->fetch();
    if (!password_verify($_POST["ancien"], $ligne["mot_de_passe"])) {
        $erreur = "L’ancien mot de passe est incorrect.";
    } else {
        $hash = password_hash($_POST["nouveau"], PASSWORD_DEFAULT);
        $req = $pdo->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?");
        $req->execute([$hash, $_SESSION["id"]]);
        $succes = "Votre mot de passe a été changé.";
    }
}

// On lit mes données dans la base pour remplir le formulaire
$req = $pdo->prepare("SELECT identifiant, prenom, nom, service, role FROM utilisateurs WHERE id = ?");
$req->execute([$_SESSION["id"]]);
$moi = $req->fetch();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Mes données</h1>
    <p>Vous pouvez consulter et modifier vos données (RGPD : droit d’accès et de rectification).</p>
  </div>
  <main class="section">
    <?php if ($succes != "") { ?><p class="succes"><?php echo $succes; ?></p><?php } ?>
    <?php if ($erreur != "") { ?><p class="erreur"><?php echo $erreur; ?></p><?php } ?>

    <p>Identifiant : <strong><?php echo htmlspecialchars($moi["identifiant"]); ?></strong> (non modifiable) - Rôle : <?php echo htmlspecialchars($moi["role"]); ?></p>

    <form class="carte" action="donnees.php" method="post">
      <h2>Mes informations</h2>
      <label for="prenom">Prénom</label>
      <input id="prenom" name="prenom" type="text" value="<?php echo htmlspecialchars($moi["prenom"]); ?>" required>
      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" value="<?php echo htmlspecialchars($moi["nom"]); ?>" required>
      <label for="service">Service</label>
      <input id="service" name="service" type="text" value="<?php echo htmlspecialchars($moi["service"]); ?>" required>
      <button class="bouton" type="submit" name="modifier" value="oui">Enregistrer</button>
    </form>

    <form class="carte" action="donnees.php" method="post">
      <h2>Changer mon mot de passe</h2>
      <label for="ancien">Ancien mot de passe</label>
      <input id="ancien" name="ancien" type="password" required>
      <label for="nouveau">Nouveau mot de passe (8 caractères minimum)</label>
      <input id="nouveau" name="nouveau" type="password" minlength="8" required>
      <button class="bouton" type="submit" name="changer" value="oui">Changer le mot de passe</button>
    </form>
  </main>
<?php include "inc/pied.php"; ?>
