<?php require 'inc/html_head.inc.php'; ?>


<?php

if(isset($_SESSION['logged_in'])) { echo $_SESSION['logged_in']; $_SESSION['logged_in'] = null; }


if (isset($_SESSION['logged'])) {
    echo '<nav class="logged-menu">' . "\n";
    echo '<ul>' . "\n";
    echo '<li><a href="profile.php"><i class="fa-solid fa-user"></i><span>Profil</span></a></li>' . "\n";
    echo '<li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Déconnexion</span></a></li>' . "\n";
    echo '<li><a href="reset.php"><i class="fa-solid fa-arrow-rotate-left"></i> <span>RESET (Dispo uniquement phase de test)</span></a></li>' . "\n";
    echo '<li><a href="indices.php"><i class="fa-solid fa-file-circle-question"></i> <span>Réponses</span></a></li>' . "\n";
    echo '</ul>' . "\n";
    echo '</nav>' . "\n";
} else {
    echo '<h2 class="login-title">Découvrez qui est le coupable de ce crime au travers de cette expérience guidée !</h2>' . "\n";
    echo '<h3 class="login-subtitle">Menez votre propre enquête !</h3>' . "\n";


    echo '<nav class="login-menu">' . "\n";
    echo '<ul>' . "\n";
    echo '<li><a href="login.php">Connexion</a></li>' . "\n";
    echo '<li><a href="signup.php">Inscription</a></li>' . "\n";
    echo '</ul>' . "\n";
    echo '</nav>' . "\n";
}

if (isset($_SESSION['logged'])) {
    $bdd = connexionBDD();

    if (isset($_SESSION['act_error'])) {
        echo $_SESSION['act_error'];
        unset($_SESSION['act_error']);
    }

    if (isset($_SESSION['user_act'])) {
        echo '<a class="user-btn" href="questions.php">Se rendre où vous en étiez <i class="fa-solid fa-angles-right"></i></a>' . "\n";
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

    echo '<style>#link' . $count_act['act_count'] . ' { display:none }</style>';

    deconnexionBDD($bdd);
}
?>

<?php require 'inc/html_end.inc.php'; ?>
