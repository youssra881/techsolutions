<?php
session_start();
include "inc/verif-admin.php";   // page réservée à l'administrateur
include "inc/infos.php";
include "inc/bdd.php";
$page = "admin";
$titre = "Administration";

// Quelques chiffres pour savoir où on en est
$nb_messages = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
$nb_clients = $pdo->query("SELECT COUNT(*) FROM clients")->fetchColumn();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Administration</h1>
    <p>Modifier les informations visibles sur le site et gérer les comptes.</p>
  </div>
  <main>
    <section class="carte">
      <h2>Contenu du site</h2>
      <ul>
        <li><a href="gerer-textes.php">Textes</a> : titre et présentation de l’accueil, présentation de l’entreprise</li>
        <li><a href="gerer-services.php">Services</a> : ajouter, modifier, supprimer</li>
        <li><a href="gerer-actualites.php">Actualités</a> : publier, modifier, supprimer</li>
      </ul>
    </section>
    <section class="carte">
      <h2>Demandes et comptes</h2>
      <ul>
        <li><a href="messages.php">Messages</a> : questions et demandes de devis (<?php echo $nb_messages; ?>)</li>
        <li><a href="gerer-clients.php">Clients</a> : comptes clients (<?php echo $nb_clients; ?>)</li>
        <li><a href="utilisateurs.php">Utilisateurs</a> : comptes des salariés</li>
      </ul>
    </section>
  </main>
<?php include "inc/pied.php"; ?>
