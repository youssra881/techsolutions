<?php
session_start();
include "inc/infos.php";
include "inc/bdd.php";
$page = "actualites";
$titre = "Actualités";

// Les articles sont lus dans la base, du plus récent au plus ancien
$req = $pdo->query("SELECT titre, resume, source, lien, date_pub FROM actualites ORDER BY date_pub DESC");
$actualites = $req->fetchAll();
?>
<?php include "inc/haut.php"; ?>
  <div class="entete">
    <h1>Actualités</h1>
    <p>Actualités et informations sur le secteur informatique.</p>
  </div>
  <main>
    <?php foreach ($actualites as $a) { ?>
      <article class="carte">
        <h2><?php echo htmlspecialchars($a["titre"]); ?></h2>
        <p><?php echo htmlspecialchars($a["resume"]); ?></p>
        <p class="petit">Publié le <?php echo $a["date_pub"]; ?></p>
        <?php if ($a["lien"] != "") { ?>
          <a href="<?php echo htmlspecialchars($a["lien"]); ?>">Source : <?php echo htmlspecialchars($a["source"]); ?></a>
        <?php } ?>
      </article>
    <?php } ?>
  </main>
<?php include "inc/pied.php"; ?>
