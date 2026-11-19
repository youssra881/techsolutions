<?php
require "../../inc/bdd.php";

$messageEnvoye = false;
$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($nom === "" || $email === "" || $message === "") {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Veuillez saisir une adresse e-mail valide.";
    } elseif (strlen($nom) > 100 || strlen($email) > 150 || strlen($message) > 2000) {
        $erreur = "Les informations saisies sont trop longues.";
    } else {
        $requete = $pdo->prepare(
            "INSERT INTO messages (nom, email, message) VALUES (?, ?, ?)"
        );
        $requete->execute([$nom, $email, $message]);
        $messageEnvoye = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact | TechSolutions</title>
  <link rel="stylesheet" href="../../css/css.css">
</head>
<body>
  <div class="navigation">
    <a href="../../index.php">
      <img src="../../images/logo.png" alt="TechSolutions" class="logo">
    </a>
    <a href="../../services.php">Services</a>
    <a href="actualites.html">Actualités</a>
    <a href="../../entreprise.php">Entreprise</a>
    <a href="contact.php">Contact</a>
    <a href="../compte/connexion.php">Connexion</a>
  </div>
  <div class="entete">
    <h1>Nous contacter</h1>
    <p>Une question, un projet ou une demande de devis ? Contactez-nous : nous vous répondrons dans les meilleurs délais.</p>
  </div>
  <div class="section">
    <p>12 rue des Innovateurs, 19100 Brive-la-Gaillarde</p>
    <p>Votre interlocutrice : Mme Anna LISE, directrice des opérations.</p>
    <p>E-mail :
      <a href="mailto:contact@techsolutions.fr">contact@techsolutions.fr</a>
    </p>
    <?php if ($messageEnvoye) { ?>
      <p class="slogan">Votre message a bien été envoyé. Merci pour votre message.</p>
    <?php } ?>

    <?php if ($erreur !== "") { ?>
      <p class="erreur"><?php echo htmlspecialchars($erreur); ?></p>
    <?php } ?>

    <form class="carte" action="contact.php" method="post">
      <label for="nom">Nom</label>
      <input id="nom" name="nom" type="text" maxlength="100" required value="<?php echo htmlspecialchars($_POST["nom"] ?? ""); ?>">
      <label for="email">Adresse e-mail</label>
      <input id="email" name="email" type="email" maxlength="150" required value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>">
      <label for="message">Votre question ou demande de devis</label>
      <textarea id="message" name="message" rows="4" maxlength="2000" required><?php echo htmlspecialchars($_POST["message"] ?? ""); ?></textarea>
      <button class="bouton" type="submit">Envoyer un message</button>
    </form>
  </div>
  <div class="pied">
    <p>© 2026 TechSolutions ·
      <a href="../../index.php">Retour à l’accueil</a>
    </p>
  </div>
</body>
</html>
