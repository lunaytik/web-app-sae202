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

    $req = 'SELECT * FROM quest WHERE _quest_tp = "' . $_SESSION['user_tp'] . '" AND quest_act = ' . $num_act . ' ORDER BY quest_act, quest_step ASC';
    try {
        $request = $bdd->query($req);
        $count = $request->rowCount();
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    if ($count > 0) {
        echo '<h1>ACTE 1</h1>';
        foreach ($request as $questIndex => $questInfo) {
            echo '<div class="quest-card">';
            if ($questInfo['quest_finished'] == 0) {
                if ($firstQuest) {
                    echo '<h2>' . $questInfo['quest_name'] . '</h2>';
                    echo '<h3>' . $questInfo['quest_text'] . '</h3>';
                    echo '<img class="quest_img" src="images/' . $questInfo['quest_content'] . '" alt="">';
                    echo '<p>Locked</p>';
                } else {
                    echo '<h2>' . $questInfo['quest_name'] . '</h2>';
                    echo '<h3>' . $questInfo['quest_text'] . '</h3>';
                    echo '<img class="quest_img" src="images/' . $questInfo['quest_content'] . '" alt="">';
                    echo '<form method="POST" action="rep_validation.php">';
                    echo '<input type="hidden" name="quest_id" value="' . $questInfo['quest_id'] . '">';
                    echo '<input type="text" name="quest_rep" id="quest_rep" required placeholder="*****" autocomplete="off"><br />';
                    echo '<input class="quest_btn" type="submit" value="Valider">';
                    echo '</form>';
                }
                $firstQuest = true;
            } else {
                echo '<h2>' . $questInfo['quest_name'] . '</h2>';
                echo '<h3>' . $questInfo['quest_text'] . '</h3>';
                echo '<img class="quest_img" src="images/' . $questInfo['quest_content'] . '" alt="">';
                echo '<p>Already Finished :)</p>';
            }
            echo '</div>';
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
            header('Location: index.php');
        }
    } else {
        $_SESSION['rep_info'] = '<h3>Cet quête n\'existe pas</h3>';
        header('Location: index.php');
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
        echo '<div class="act-card">';
        if ($count != $count_finished) {
            if ($inProgress) {
                echo '<h1>ACT ' . $num_act . '</h1>';
                echo '<div>';
                echo '<h2>Étapes finies ' . $count_finished . '/' . $count . '</h2>';
                echo 'Locked';
                echo '</div>';
            } else {
                echo '<h1>ACT ' . $num_act . '</h1>';
                echo '<div>';
                echo '<h2>Étapes finies ' . $count_finished . '/' . $count . '</h2>';
                echo round($count_finished / $count * 100) . '% <br />';
                echo '<progress value="' . round($count_finished / $count * 100) . '" max="100">  </progress><br />';
                echo 'In progress... <br />';
                echo '<a href="acte' . $num_act . '.php">GO</a>';
                echo '</div>';
                $inProgress = true;
            }
        } else {
            echo '<h1>ACT ' . $num_act . '</h1>';
            echo '<div>';
            echo '<h2>Étapes finies ' . $count_finished . '/' . $count . '</h2>';
            echo 'Finished <br />';
            echo 'showHint();';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "Il n'y a pas de questions dans cet acte. <br />
        C'est une erreur, contactez des étudiants de S3";
    }
}
