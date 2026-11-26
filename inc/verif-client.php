<?php
// Cette page est réservée aux clients connectés.
// Sinon, on renvoie le visiteur vers la connexion client.
if (!isset($_SESSION["client_id"])) {
    header("Location: client.php");
    exit;
}
