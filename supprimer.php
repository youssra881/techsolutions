<?php
session_start();
require "inc/bdd.php";

// Protection côté serveur.
if (!isset($_SESSION["id"])) {
    header("Location: pages/compte/connexion.php");
    exit;
}

if ($_SESSION["role"] != "admin") {
    header("Location: espace.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: utilisateurs.php");
    exit;
}

$id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;

// On ne supprime pas le compte administrateur actuellement connecté.
if ($id > 0 && $id != $_SESSION["id"]) {
    $requete = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $requete->execute([$id]);
}

header("Location: utilisateurs.php");
exit;
