<?php require 'inc/html_head.inc.php'; ?>

<?php

    if (isset($_SESSION['user_name']) and !empty($_SESSION['user_tp'])) {
        showOwnInfos();

        $bdd = connexionBDD();

        showTPMembers($bdd, $_SESSION['user_tp']);

        deconnexionBDD($bdd);
    } else {
        $_SESSION['connected'] = "<h2>Vous devez être connecté pour accéder à cette page</h2>";
        header('Location: login.php');
    }
?>

<a href="index.php">Retour</a>

<?php require 'inc/html_end.inc.php'; ?>

