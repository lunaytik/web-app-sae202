<?php require 'inc/html_head.inc.php'; ?>

<?php
if (!empty($_POST)) {

    $quest_id = htmlspecialchars($_POST['quest_id']);

    $quest_rep = htmlspecialchars($_POST['quest_rep']);

    $bdd = connexionBDD();

    verifQuest($bdd, $quest_id, $quest_rep);

    deconnexionBDD($bdd);
    header('Location: questions.php');
}
?>

<?php require 'inc/html_end.inc.php'; ?>