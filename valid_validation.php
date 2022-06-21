<?php require 'inc/html_head.inc.php'; ?>

<?php
if (!empty($_POST)) {
    $quest_id = htmlspecialchars($_POST['quest_id']);

    $bdd = connexionBDD();

    verifQuest2($bdd, $quest_id);

    deconnexionBDD($bdd);
    
    header('Location: questions.php');
}
?>

<?php require 'inc/html_end.inc.php'; ?>