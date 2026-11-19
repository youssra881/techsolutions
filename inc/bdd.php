<?php
// 1. PDO permet à PHP de parler à MySQL.
// 2. $pdo est la connexion utilisée sur toutes les pages du site.
$pdo = new PDO(
    "mysql:host=localhost;dbname=techsolutions;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

// Les résultats seront rangés avec les noms des colonnes :
// exemple -> $utilisateur["prenom"]