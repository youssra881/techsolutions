<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] != "admin") {
    header("Location: pages/compte/connexion.php");
    exit;
}

$id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;

if ($id > 0 && $id != $_SESSION["id"]) {
    require "inc/bdd.php";
    $requete = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $requete->execute([$id]);
}

header("Location: utilisateurs.php");
exit;
