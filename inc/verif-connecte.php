<?php
if (!isset($_SESSION["id"])) {
    header("Location: pages/compte/connexion.php");
    exit;
}
