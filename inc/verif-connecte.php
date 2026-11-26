<?php
// Cette page est réservée aux personnes connectées.
// Sinon, on renvoie le visiteur vers la page de connexion.
if (!isset($_SESSION["id"])) {
    header("Location: connexion.php");
    exit;
}
