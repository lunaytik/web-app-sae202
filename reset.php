<?php require 'inc/html_head.inc.php'; ?>

<?php

        $bdd = connexionBDD();

        $reset = 'UPDATE quest SET quest_finished = 0';
        $reset = $bdd->query($reset);
        deconnexionBDD($bdd);
        header('Location: index.php');
        
?>

<?php require 'inc/html_end.inc.php'; ?>