<?php require 'inc/html_head.inc.php'; ?>

<?php
    if (!empty($_POST)) {

        $username = htmlspecialchars($_POST['username']);
        $mdp = htmlspecialchars($_POST['mdp']);

        $bdd = connexionBDD();

        $verifUser = $bdd->prepare('SELECT user_name FROM utilisateurs WHERE user_name = ?');
        $verifUser->execute(array($username));

        if ($verifUser->rowCount() == 0) {
            $_SESSION['notSignup'] = "<h2>Cet utilisateur n'est pas enregistré <a href='signup.php'>s'inscrire ici !</a></h2>";
            header('Location: login.php');
        } else {
            login($bdd, $username, $mdp);
            deconnexionBDD($bdd);
        }
    } else {
        header('Location: login.php');
    }
?>

<?php require 'inc/html_end.inc.php'; ?>

