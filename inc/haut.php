<?php // haut.php : le début de chaque page (head + menu). La page doit définir $titre avant. ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $titre; ?> | TechSolutions</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include "inc/menu.php"; ?>
