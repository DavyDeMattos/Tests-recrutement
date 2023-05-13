<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Recrutement</title>
    <!-- Getting bootstrap (and reboot.css) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="container">
    
<header>

<?php /*d(get_defined_vars()); 
      d($_SESSION);*/?>
  <?php
  // On inclut des sous-vues => "partials"
  include __DIR__ . '/../partials/nav.tpl.php';
  ?>

<h1 class="text-center">Gestion de voitures</h1>


</header>