<?php require 'inc/html_head.inc.php'; ?>

<?php

        $nextAct = $_GET['act'];
        $tp = mb_strtolower($_SESSION['user_tp']);

        $bdd = connexionBDD();

        $req = 'SELECT _act_id FROM quest WHERE quest_act ='. $_SESSION['user_act'] .' AND _quest_tp ="'. $_SESSION['user_tp'] .'"';
        $act = $bdd->query($req);
        $act = $act->fetch();

        $valid = 'UPDATE act SET tp_'.$tp.' = 1 WHERE act_id ='.$act['_act_id'].'';
        $valid = $bdd->query($valid);
        
        deconnexionBDD($bdd);
        header('Location: questions.php?act='.$nextAct.'');
        
?>

<?php require 'inc/html_end.inc.php'; ?>