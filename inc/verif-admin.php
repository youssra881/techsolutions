<?php
require_once "inc/verif-connecte.php";

if ($_SESSION["role"] != "admin") {
    header("Location: espace.php");
    exit;
}
