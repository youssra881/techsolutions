<?php
session_start();
include "inc/infos.php";
$page = "services";
$titre = "Services";

// Les tarifs et la TVA sont écrits ici, une seule fois
$essentiel = 60;
$serenite = 150;
$premium = 290;
$tva = 20;

// On lit les techniciens dans la base de données
include "inc/bdd.php";
$req = $pdo->query("SELECT prenom, nom FROM utilisateurs WHERE service = 'Technique' ORDER BY nom, prenom");
$techniciens = $req->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Nos services</h1>
    <p>Voici les principaux services proposés par TechSolutions aux entreprises.</p>
  </div>
  <main class="section">
    <article class="carte">
      <h2>Développement logiciel et interfaces web</h2>
      <p>Nous créons et faisons évoluer des logiciels adaptés aux besoins de nos clients. Nous concevons aussi des interfaces web simples à utiliser.</p>
    </article>
    <article class="carte">
      <h2>Systèmes, réseaux et sécurité</h2>
      <p>Nous installons et entretenons les ordinateurs, les serveurs et les réseaux. Nous mettons aussi en place des mesures pour protéger les équipements et les données.</p>
    </article>
    <article class="carte">
      <h2>Support client</h2>
      <p>Nous répondons aux demandes d’assistance et aidons les clients à résoudre leurs problèmes informatiques.</p>
    </article>
    <section class="carte">
      <h2>Nos techniciens</h2>
      <ul>
        <?php foreach ($techniciens as $technicien) { ?>
          <li><?php echo htmlspecialchars($technicien["prenom"] . " " . $technicien["nom"]); ?></li>
        <?php } ?>
      </ul>
    </section>
    <section class="carte">
      <h2>Nos formules</h2>
      <table>
        <thead>
          <tr>
            <th>Formule</th>
            <th>Tarif HT</th>
            <th>Tarif TTC</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Essentiel</td>
            <td><?php echo $essentiel; ?> euros</td>
            <td><?php echo $essentiel * (100 + $tva) / 100; ?> euros</td>
          </tr>
          <tr>
            <td>Sérénité</td>
            <td><?php echo $serenite; ?> euros</td>
            <td><?php echo $serenite * (100 + $tva) / 100; ?> euros</td>
          </tr>
          <tr>
            <td>Premium</td>
            <td><?php echo $premium; ?> euros</td>
            <td><?php echo $premium * (100 + $tva) / 100; ?> euros</td>
          </tr>
        </tbody>
      </table>
      <p>TVA au taux de <?php echo $tva; ?> %.</p>
      <p>Une année de formule Sérénité coûte <?php echo $serenite * 12 * (100 + $tva) / 100; ?> euros TTC.</p>
    </section>
  </main>
<?php include "inc/pied.php"; ?>
