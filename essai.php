<?php
require "inc/bdd.php";

$requete = $pdo->query("SELECT prenom, nom FROM utilisateurs");
$utilisateurs = $requete->fetchAll();

echo "<pre>";
print_r($utilisateurs);
echo "</pre>";

echo "Le premier salarié est " . $utilisateurs[0]["prenom"] . " " . $utilisateurs[0]["nom"] . ".<br>";
echo "Le troisième salarié est " . $utilisateurs[2]["prenom"] . ".<br>";
echo "La dernière salariée est " . $utilisateurs[7]["prenom"] . " " . $utilisateurs[7]["nom"] . ".<br>";

echo "<h2>Liste des salariés</h2>";
foreach ($utilisateurs as $u) {
    echo $u["prenom"] . " " . $u["nom"] . "<br>";
}
