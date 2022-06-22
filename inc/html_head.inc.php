<?php require 'functions.inc.php' ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nexus</title>
</head>

<body>
    <div id="container">
        <header>
            <?php echo '<a class="home-link" href="index.php"><h1 class="app-title"><span>NEXU</span>S</h1></a>'."\n"; ?>
            <?php if (!empty($_SESSION['user_name'])) {
                echo '<h1 class="agent-name">Agent ' . $_SESSION['user_name'] . '</h1>'."\n";
            } ?>
        </header>