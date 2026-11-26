<?php
// export.php : droit à la portabilité. Le client télécharge ses données au format JSON.
session_start();
include "inc/verif-client.php";
include "inc/bdd.php";

// Jamais le mot de passe : seulement les données personnelles
$req = $pdo->prepare("SELECT email, prenom, nom, entreprise, telephone, date_inscription FROM clients WHERE id = ?");
$req->execute([$_SESSION["client_id"]]);
$compte = $req->fetch();

// Les messages envoyés avec son adresse e-mail
$req = $pdo->prepare("SELECT sujet, message, date_envoi FROM messages WHERE email = ? ORDER BY id");
$req->execute([$compte["email"]]);
$messages = $req->fetchAll();

header("Content-Type: application/json; charset=utf-8");
header("Content-Disposition: attachment; filename=\"mes-donnees-techsolutions.json\"");
echo json_encode(["compte" => $compte, "messages" => $messages], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
