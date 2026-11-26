<?php
// Cette page est réservée à l'administrateur.
include "inc/verif-connecte.php";

if ($_SESSION["role"] != "admin") {
    header("Location: espace.php");
    exit;
}
