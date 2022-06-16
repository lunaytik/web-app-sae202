<?php require 'inc/html_head.inc.php'; ?>

<?php

if (isset($_SESSION['logged'])) {
    echo '<a href="profile.php"><i class="fa-solid fa-user"></i><span>Profil</span></a><br />'."\n";
    echo '<a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Déconnexion</span></a><br />'."\n";
} else {
    echo '<a href="login.php">Connexion</a><br />'."\n";
    echo '<a href="signup.php">Inscription</a><br />'."\n";
}



if (isset($_SESSION['logged'])) {
    $bdd = connexionBDD();
    echo '<a href="reset.php"><i class="fa-solid fa-arrow-rotate-left"></i> <span>RESET</span></a><br />'."\n";

    if (isset($_SESSION['act_error'])) {
        echo $_SESSION['act_error'];
        unset($_SESSION['act_error']);
    }

    if (isset($_SESSION['user_act'])) {
        echo '<a class="user_btn" href="questions.php">Retourner où vous en étiez <i class="fa-solid fa-angles-right"></i></a>'."\n";
    }


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

   echo '<style>#link'.$count_act['act_count'].' { display:none }</style>';

    deconnexionBDD($bdd);
}



?>




<?php require 'inc/html_end.inc.php'; ?>
