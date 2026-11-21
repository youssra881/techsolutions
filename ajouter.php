<?php
session_start();
include "inc/verif-admin.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "utilisateurs";
$titre = "Ajouter un compte";

$erreur = "";

// Le formulaire a été envoyé ?
if (isset($_POST["identifiant"])) {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $service = $_POST["service"];
    $identifiant = $_POST["identifiant"];
    $motdepasse = $_POST["motdepasse"];
    $role = $_POST["role"];

    if ($prenom == "" || $nom == "" || $service == "" || $identifiant == "" || $motdepasse == "") {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        // On vérifie que l'identifiant n'existe pas déjà
        $req = $pdo->prepare("SELECT id FROM utilisateurs WHERE identifiant = ?");
        $req->execute([$identifiant]);
        if ($req->fetch()) {
            $erreur = "Cet identifiant est déjà utilisé.";
        } else {
            // On ne stocke jamais le mot de passe en clair : on le "hache"
            $hash = password_hash($motdepasse, PASSWORD_DEFAULT);
            $req = $pdo->prepare("INSERT INTO utilisateurs (identifiant, mot_de_passe, prenom, nom, service, role) VALUES (?, ?, ?, ?, ?, ?)");
            $req->execute([$identifiant, $hash, $prenom, $nom, $service, $role]);
            header("Location: utilisateurs.php");
            exit;
        }
    }
}
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Ajouter un compte</h1>
    <p>Un nouveau salarié rejoint l’entreprise.</p>
  </div>
  <main class="section">
    <?php if ($erreur != "") { ?>
      <p class="erreur"><?php echo $erreur; ?></p>
    <?php } ?>
    <form class="carte" action="ajouter.php" method="post">
      <label for="prenom">Prénom</label>
      <input id="prenom" name="prenom" type="text" required>
      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" required>
      <label for="service">Service</label>
      <input id="service" name="service" type="text" required>
      <label for="identifiant">Identifiant</label>
      <input id="identifiant" name="identifiant" type="text" required>
      <label for="motdepasse">Mot de passe de départ</label>
      <input id="motdepasse" name="motdepasse" type="password" required>
      <label for="role">Rôle</label>
      <select id="role" name="role">
        <option value="salarie">Salarié</option>
        <option value="admin">Administrateur</option>
      </select>
      <button class="bouton" type="submit">Créer le compte</button>
    </form>
    <p><a href="utilisateurs.php">Retour à la liste des comptes</a></p>
  </main>
<?php include "inc/pied.php"; ?>
