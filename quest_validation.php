<?php require 'inc/html_head.inc.php'; ?>

<?php
    if (!empty($_POST)) {

        $quest_name = htmlspecialchars($_POST['quest_name']);
        $quest_name = ucfirst(mb_strtolower($quest_name));

        $quest_text = htmlspecialchars($_POST['quest_text']);
        $quest_text = ucfirst(mb_strtolower($quest_text));

        $quest_content = htmlspecialchars($_POST['quest_content']);

        $quest_rep = htmlspecialchars($_POST['quest_rep']);
        $quest_rep = mb_strtolower($quest_rep);
        
        $quest_act = htmlspecialchars($_POST['quest_act']);

        $quest_step = htmlspecialchars($_POST['quest_step']);

        $quest_type = htmlspecialchars($_POST['quest_type']);

        $_quest_tp = htmlspecialchars($_POST['_quest_tp']);

        $_act_id = htmlspecialchars($_POST['_act_id']);



        $bdd = connexionBDD();

        addQuest($bdd, $quest_name, $quest_text, $quest_content, $quest_rep, $quest_act, $quest_step, $quest_type, $_quest_tp, $_act_id);


        deconnexionBDD($bdd);
       header('Location: quest.php');
    }
?>

<?php require 'inc/html_end.inc.php'; ?>