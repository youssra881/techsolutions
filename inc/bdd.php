<?php
// Connexion à la base de données MySQL (XAMPP : utilisateur root, sans mot de passe)
// $pdo sera utilisé dans toutes les pages qui lisent la base.
$pdo = new PDO(
    "mysql:host=localhost;dbname=techsolutions2;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);
