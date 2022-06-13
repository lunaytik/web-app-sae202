<?php require 'functions.inc.php' ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <title>MMI2049</title>
</head>

<body>
    <div id="container">
        <header>
            <?php echo '<h1>MMI2049</h1>'; ?>
            <?php if (!empty($_SESSION['user_name'])) {
                echo "<h1>CONNECTED AGENT " . $_SESSION['user_name'] . "</h1>";
            } ?>
        </header>