<?php require 'inc/html_head.inc.php'; ?>

<?php

    $bdd = connexionBDD();

    if (isset($_SESSION['rep_info'])) {
        echo $_SESSION['rep_info'];
        unset($_SESSION['rep_info']);
    }

    if (!empty($_GET['act'])) {
        $_SESSION['user_act'] = (int)$_GET['act'];
    }

    if (empty($_SESSION['user_act'])) {
        $_SESSION['act_error'] = '<h3>Il y a un problème avec l\'act. Essayez d\'y accéder de nouveau</h3>';
        header('Location: index.php');
    } else {
        $_SESSION['user_act'];
        showSteps($bdd, $_SESSION['user_act']);
    }
    deconnexionBDD($bdd);

?>

<?php require 'inc/html_end.inc.php'; ?>

