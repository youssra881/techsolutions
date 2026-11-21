<?php
session_start();
include "inc/infos.php";
include "inc/bdd.php";
$page = "contact";
$titre = "Contact";

$message_ok = "";
$erreur = "";

// Le formulaire a été envoyé ?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if ($nom == "" || $email == "" || $message == "") {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        // On enregistre le message dans la table « messages »
        $req = $pdo->prepare("INSERT INTO messages (nom, email, message) VALUES (?, ?, ?)");
        $req->execute([$nom, $email, $message]);
        $message_ok = "Merci " . htmlspecialchars($nom) . ", votre message a bien été reçu.";
    }
}
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Nous contacter</h1>
    <p>Une question, un projet ou une demande de devis ? Contactez-nous : nous vous répondrons dans les meilleurs délais.</p>
  </div>
  <main class="section">
    <p><?php echo $adresse; ?></p>
    <p>Téléphone : <?php echo $telephone; ?></p>
    <p>Votre interlocutrice : Mme Anna LISE, directrice des opérations.</p>
    <p>E-mail : <a href="mailto:contact@techsolutions.fr">contact@techsolutions.fr</a></p>

    <?php if ($message_ok != "") { ?>
      <p class="succes"><?php echo $message_ok; ?></p>
    <?php } ?>
    <?php if ($erreur != "") { ?>
      <p class="erreur"><?php echo $erreur; ?></p>
    <?php } ?>

    <form class="carte" action="contact.php" method="post">
      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" required>
      <label for="email">Adresse e-mail</label>
      <input id="email" name="email" type="email" required>
      <label for="message">Votre question ou demande de devis</label>
      <textarea id="message" name="message" rows="4" required></textarea>
      <button class="bouton" type="submit">Envoyer un message</button>
    </form>
  </main>
<?php include "inc/pied.php"; ?>
