<?php
session_start();
include "inc/infos.php";
include "inc/bdd.php";
$page = "client";
$titre = "Créer un compte client";

$erreur = "";

// Le formulaire a été envoyé ?
if (isset($_POST["email"])) {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $entreprise = $_POST["entreprise"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $motdepasse = $_POST["motdepasse"];

    if ($prenom == "" || $nom == "" || $email == "" || $motdepasse == "") {
        $erreur = "Veuillez remplir les champs obligatoires.";
    } elseif (!isset($_POST["accord"])) {
        // RGPD : on n'enregistre rien sans l'accord de la personne
        $erreur = "Vous devez accepter l’enregistrement de vos données.";
    } else {
        // On vérifie que l'e-mail n'existe pas déjà
        $req = $pdo->prepare("SELECT id FROM clients WHERE email = ?");
        $req->execute([$email]);
        if ($req->fetch()) {
            $erreur = "Un compte existe déjà avec cet e-mail.";
        } else {
            // On ne stocke jamais le mot de passe en clair : on le "hache"
            $hash = password_hash($motdepasse, PASSWORD_DEFAULT);
            $req = $pdo->prepare("INSERT INTO clients (email, mot_de_passe, prenom, nom, entreprise, telephone) VALUES (?, ?, ?, ?, ?, ?)");
            $req->execute([$email, $hash, $prenom, $nom, $entreprise, $telephone]);
            header("Location: client.php?cree=oui");
            exit;
        }
    }
}
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Créer un compte client</h1>
    <p>Un compte vous permet de modifier vos données à tout moment.</p>
  </div>
  <main>
    <?php if ($erreur != "") { ?>
      <p class="erreur"><?php echo $erreur; ?></p>
    <?php } ?>
    <form class="carte" action="inscription.php" method="post">
      <label for="prenom">Prénom</label>
      <input id="prenom" name="prenom" type="text" required>
      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" required>
      <label for="entreprise">Entreprise</label>
      <input id="entreprise" name="entreprise" type="text">
      <label for="telephone">Téléphone</label>
      <input id="telephone" name="telephone" type="text">
      <label for="email">Adresse e-mail (c’est votre identifiant)</label>
      <input id="email" name="email" type="email" required>
      <label for="motdepasse">Mot de passe (8 caractères minimum)</label>
      <input id="motdepasse" name="motdepasse" type="password" minlength="8" required>
      <label class="case">
        <input name="accord" type="checkbox" required>
        J’accepte que mes données soient enregistrées pour gérer mon compte (<a href="confidentialite.php">en savoir plus</a>).
      </label>
      <button class="bouton" type="submit">Créer mon compte</button>
    </form>
  </main>
<?php include "inc/pied.php"; ?>
