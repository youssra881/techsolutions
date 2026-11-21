<?php
session_start();
include "inc/verif-admin.php";
include "inc/infos.php";
include "inc/bdd.php";
$page = "utilisateurs";
$titre = "Supprimer un compte";

// Le numéro du compte arrive dans l'adresse : supprimer.php?id=3
$id = $_GET["id"];

// On ne peut pas supprimer son propre compte
if ($id == $_SESSION["id"]) {
    header("Location: utilisateurs.php");
    exit;
}

// Si on a cliqué sur "Oui, supprimer", on supprime
if (isset($_POST["confirmer"])) {
    // Le WHERE est obligatoire : sans lui, on supprimerait tout le monde !
    $req = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $req->execute([$id]);
    header("Location: utilisateurs.php");
    exit;
}

// Sinon, on cherche la personne pour demander confirmation
$req = $pdo->prepare("SELECT prenom, nom FROM utilisateurs WHERE id = ?");
$req->execute([$id]);
$utilisateur = $req->fetch();
if (!$utilisateur) {
    header("Location: utilisateurs.php");
    exit;
}
?>
<?php include "inc/haut.php"; ?>
  <main class="section">
    <h1>Supprimer un compte</h1>
    <p>Voulez-vous vraiment supprimer le compte de <?php echo htmlspecialchars($utilisateur["prenom"] . " " . $utilisateur["nom"]); ?> ?</p>
    <form action="supprimer.php?id=<?php echo $id; ?>" method="post">
      <button class="bouton-supprimer" type="submit" name="confirmer" value="oui">Oui, supprimer</button>
      <a href="utilisateurs.php">Non, revenir à la liste</a>
    </form>
  </main>
<?php include "inc/pied.php"; ?>
