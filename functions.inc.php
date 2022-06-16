<?php

require 'inc/wouhouclafete.php';

session_start();

function connexionBDD()
{
    $bdd = null;
    try {
        $bdd = new PDO('mysql:host=127.0.0.1; port=3306; dbname=web-app-sae202; charset=UTF8;', UTILISATEUR, MOTDEPASSE);
        $bdd->query('SET NAMES utf8;');
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }
    return $bdd;
}

function deconnexionBDD()
{
    $bdd = null;
}

function signup($bdd, $username, $mdp, $nom, $prenom, $tp)
{
    $req = 'INSERT INTO utilisateurs (user_name, user_mdp, user_nom, user_prenom, user_statut, user_tp)
                VALUES ("' . $username . '" , "' . $mdp . '" , "' . $nom . '", "' . $prenom . '", 1, "' . $tp . '")';
    try {
        $request = $bdd->query($req);
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }
}


function login($bdd, $username, $mdp)
{
    $req = 'SELECT * FROM utilisateurs where user_name = "' . $username . '"';
    try {
        $request = $bdd->query($req);
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    $user = $request->fetch();

    if (password_verify($mdp, $user['user_mdp'])) {
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_nom'] = $user['user_nom'];
        $_SESSION['user_prenom'] = $user['user_prenom'];
        $_SESSION['user_tp'] = $user['user_tp'];
        $_SESSION['logged'] = true;
        header('Location: index.php');
    } else {
        $_SESSION['wrongPassword'] = "<h2>Mot de passe incorrect</h2>";
        header('Location: login.php');
    }
}

function showOwnInfos()
{
    echo "<h2>Profil</h2>";
    echo "<ul>";
    echo "<li>Nom d'utilisateur : " . $_SESSION['user_name'] . "</li>";
    echo "<li>Prénom : " . $_SESSION['user_prenom'] . "</li>";
    echo "<li>Nom : " . $_SESSION['user_nom'] . "</li>";
    echo "<li>TP " . $_SESSION['user_tp'] . "</li>";
    echo "</ul>";
}

function showTPMembers($bdd, $utilisateurTP)
{
    $req = 'SELECT * FROM utilisateurs where user_tp = "' . $utilisateurTP . '" ORDER BY user_nom ASC';
    try {
        $request = $bdd->query($req);
        $count = $request->rowCount();
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    if ($count > 0) {
        echo '<h2>Les personnes dans le TP</h2>';
        echo '<ul>';
        foreach ($request as $userIndex => $userInfo) {
            echo '<li>' . $userInfo['user_prenom'] . ' ' . $userInfo['user_nom'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo "Ce TP est vide";
    }
}

function addQuest($bdd, $quest_name, $quest_text, $quest_content, $quest_rep, $quest_act, $quest_step, $quest_type, $_quest_tp)
{
    $req = 'INSERT INTO quest(quest_name, quest_text, quest_content, quest_rep, quest_act, quest_step, quest_type, quest_finished, _quest_tp)
                VALUES ("' . $quest_name . '" , "' . $quest_text . '" , "' . $quest_content . '", "' . $quest_rep . '" ,  ' . $quest_act . ', ' . $quest_step . ', ' . $quest_type . ', 0,"' . $_quest_tp . '")';
    try {
        $request = $bdd->query($req);
        //echo $req;
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }
}


function showSteps($bdd, $num_act)
{
    $firstQuest = false;
    $count_quest_finished = 0;

    $req = 'SELECT * FROM quest WHERE _quest_tp = "' . $_SESSION['user_tp'] . '" AND quest_act = ' . $num_act . ' ORDER BY quest_act, quest_step ASC';
    try {
        $request = $bdd->query($req);
        $count = $request->rowCount();
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    if ($count > 0) {
        echo '<h1 class="quest-big-title">ACT '.$num_act.'</h1>';
        foreach ($request as $questIndex => $questInfo) {
            echo '<div class="quest-card-sh">'."\n";
            echo '<div class="quest-card" id="'.$questInfo['quest_id'].'">'."\n";
            if ($questInfo['quest_finished'] == 0) {
                if ($firstQuest) {
                    echo '<h2 class="braille-txt">' . $questInfo['quest_name'] . '</h2>'."\n";
                    echo '<h3 class="braille-txt">' . $questInfo['quest_text'] . '</h3>'."\n";
                    echo '<img class="quest-img" src="images/glitch.jpg" alt="">'."\n";
                    //echo '<p>Locked</p>'."\n";
                    echo '<div class="quest-lock-container">'."\n";
                    echo '<div class="quest-lock quest-locked"> <i class="fa-solid fa-lock"></i> </div>'."\n";
                    echo '</div>'."\n";
                } else {
                    echo '<h2>' . $questInfo['quest_name'] . '</h2>'."\n";
                    echo '<h3>' . $questInfo['quest_text'] . '</h3>'."\n";
                    echo '<img class="quest-img" src="images/' . $questInfo['quest_content'] . '" alt="">'."\n";
                    echo '<form method="POST" action="rep_validation.php">'."\n";
                    echo '<input type="hidden" name="quest_id" value="' . $questInfo['quest_id'] . '">'."\n";
                    echo '<div class="quest_form">'."\n";
                    echo '<input class="quest-rep" type="text" name="quest_rep" id="quest_rep" required placeholder="L\'indice" autocomplete="off">'."\n";
                    echo '<input class="quest-btn" type="submit" value="Valider">'."\n";
                    echo '</div>'."\n";
                    echo '</form>'."\n";
                }
                $firstQuest = true;
            } else {
                $count_quest_finished++;
                echo '<h2>' . $questInfo['quest_name'] . '</h2>'."\n";
                echo '<h3>' . $questInfo['quest_text'] . '</h3>'."\n";
                echo '<img class="quest-img" src="images/' . $questInfo['quest_content'] . '" alt="">'."\n";
                //echo '<p>Already Finished :)</p>'."\n";
                echo '<div class="quest-lock quest-finished"> <i class="fa-solid fa-check"></i> </div>'."\n";
            }
            echo '</div>'."\n";
            echo '</div>'."\n";

            if ($count_quest_finished == $count) {
                //echo "<p>Vous avez fini cette merde passer au suivant !</p>"."\n";
                $nextAct = $_SESSION['user_act'] + 1;
                echo '<a class="user-btn" href="questions.php?act='.$nextAct.'">PASSER A L\'ACT SUIVANT</a>'."\n";
            }
        }
    } else {
        echo "Il n'y a pas de questions pour votre TP. <br />
        C'est une erreur, contactez des étudiants de S3";
    }
}

function verifQuest($bdd, $quest_id, $quest_rep)
{
    $quest_rep = mb_strtolower($quest_rep);

    $req = 'SELECT * FROM quest WHERE quest_id = ' . $quest_id . '';
    try {
        $request = $bdd->query($req);
        $quest = $request->fetch();
        var_dump($quest);
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    if (isset($quest)) {
        if ($quest_rep == $quest['quest_rep']) {
            echo "OK";
            $finished = 'UPDATE quest SET quest_finished = 1 WHERE quest_id = ' . $quest_id . '';
            $finished = $bdd->query($finished);
            $_SESSION['rep_info'] = '<h3>Bonne réponse !</h3>';
        } else {
            $_SESSION['rep_info'] = '<h3>Ce n\'est pas la bonne réponse</h3>';
            header('Location: questions.php');
        }
    } else {
        $_SESSION['rep_info'] = '<h3>Cette question n\'existe pas</h3>';
        header('Location: questions.php');
    }
}



$inProgress = false;

function showAct($bdd, $num_act)
{
    global $inProgress;

    $req = 'SELECT * FROM quest WHERE _quest_tp = "' . $_SESSION['user_tp'] . '" AND quest_act = ' . $num_act . '';
    try {
        $request = $bdd->query($req);
        $count = $request->rowCount();
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    $req_finished = 'SELECT * FROM quest WHERE _quest_tp = "' . $_SESSION['user_tp'] . '" AND quest_act = ' . $num_act . ' AND quest_finished = 1';
    try {
        $total_finished = $bdd->query($req_finished);
        $count_finished = $total_finished->rowCount();
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }
    if ($count > 0) {
        echo '<div class="act-card">'."\n";
        if ($count != $count_finished) {
            if ($inProgress) {
                echo '<div id="link'.$num_act.'" class="act-link act-bg-locked"></div>'."\n";
                echo '<div class="act-lock act-locked"> <i class="fa-solid fa-lock"></i> </div>'."\n";
                echo '<div class="act-infos">'."\n";
                echo '<h1 class="act-title">ACT ' . $num_act . '</h1>'."\n";
                echo '<h4 class="act-txt act-locked">Locked</h4>'."\n";
                echo '<h2 class="act-step"> <i class="fa-regular fa-flag"></i> Étapes finies ' . $count_finished . '/' . $count . '</h2>'."\n";
                echo '</div>'."\n";
            } else {
                echo '<div id="link'.$num_act.'" class="act-link act-bg-unlocked"></div>'."\n";
                echo '<div class="act-lock act-unlocked"> <i class="fa-solid fa-unlock"></i> </div>'."\n";
                echo '<div class="act-infos">';
                echo '<h1 class="act-title">ACT ' . $num_act . '</h1>'."\n";
                echo '<h4 class="act-txt act-unlocked">Unlocked</h4>'."\n";
                echo '<h2 class="act-step"> <i class="fa-regular fa-flag"></i> Étapes finies ' . $count_finished . '/' . $count . '</h2>'."\n";
                echo '<h3 class="act-prog">'.round($count_finished / $count * 100) . '% </h3>'."\n";
                //echo '<progress value="' . round($count_finished / $count * 100) . '" max="100">'.round($count_finished / $count * 100).'%</progress>';
                echo '<a class="act-btn" href="questions.php?act='.$num_act.'"><div>GO</div> <i class="fa-solid fa-angles-right"></i></a>'."\n";
                echo '</div>'."\n";
                $inProgress = true;
            }
        } else {
            echo '<div id="link'.$num_act.'" class="act-link act-bg-unlocked"></div>'."\n";
            echo '<div class="act-lock act-unlocked"> <i class="fa-solid fa-check"></i> </div>'."\n";
            echo '<div class="act-infos">'."\n";
            echo '<h1 class="act-title">ACT ' . $num_act . '</h1>'."\n";
            echo '<h4 class="act-txt act-unlocked">Finished</h4>'."\n";
            echo '<h2 class="act-step"> <i class="fa-regular fa-flag"></i> Étapes finies ' . $count_finished . '/' . $count . '</h2>'."\n";
            //echo '<h4>showHint();</h4>'."\n";
            echo '</div>'."\n";
        }
        echo '</div>'."\n";
    } else {
        echo "Il n'y a pas de questions dans cet acte. <br />
        C'est une erreur, contactez des étudiants de S3";
    }
}
