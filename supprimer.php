<?php
session_start();
require "inc/verif-admin.php";
require "inc/bdd.php";

$id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;

if ($id > 0 && $id != $_SESSION["id"]) {
    $requete = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $requete->execute([$id]);
}

header("Location: utilisateurs.php");
exit;
