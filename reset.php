<?php require 'inc/html_head.inc.php'; ?>

<?php

        $bdd = connexionBDD();

        $reset = 'UPDATE quest SET quest_finished = 0';
        $reset = $bdd->query($reset);

        $reset2 = 'UPDATE act SET tp_a = 0, tp_b = 0, tp_c = 0, tp_d = 0, tp_e = 0, tp_f = 0, tp_g = 0, tp_h = 0';
        $reset2 = $bdd->query($reset2);
        
        $_SESSION['user_act'] = 1;
        deconnexionBDD($bdd);
        header('Location: index.php');
        
?>

<?php require 'inc/html_end.inc.php'; ?>