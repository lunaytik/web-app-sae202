<?php require 'inc/html_head.inc.php'; ?>

<?php

if (isset($_SESSION['logged'])) {
    echo '<a href="profile.php">Profil</a><br />';
    echo '<a href="logout.php">Déconnexion</a>';
} else {
    echo '<a href="login.php">Connexion</a><br />';
    echo '<a href="signup.php">Inscription</a>';
}



if (isset($_SESSION['logged'])) {
    $bdd = connexionBDD();
    echo '<br />';
    echo '<a href="reset.php">RESET</a>';
    echo '<br />';
    echo '<br />';
    echo '<br />';

    $count_act_req = 'SELECT COUNT(DISTINCT quest_act) as act_count FROM quest';
    try {
        $count_act = $bdd->query($count_act_req);
        $count_act = $count_act->fetch();
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    for ($num = 1; $num <= $count_act['act_count']; $num++) {
        showAct($bdd, $num);
    }

    if (isset($_SESSION['rep_info'])) {
        echo $_SESSION['rep_info'];
        unset($_SESSION['rep_info']);
    }
    
    showSteps($bdd, 1);

    deconnexionBDD($bdd);
}

?>

<?php require 'inc/html_end.inc.php'; ?>
