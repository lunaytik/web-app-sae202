<?php require 'inc/html_head.inc.php'; ?>

<?php
    if (!empty($_POST)) {

        $username = htmlspecialchars($_POST['username']);
        $username = mb_strtolower($username);

        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $nom = htmlspecialchars($_POST['nom']);
        $nom = ucfirst(mb_strtolower($nom));

        $prenom = htmlspecialchars($_POST['prenom']);
        $prenom = ucfirst(mb_strtolower($prenom));

        $tp = htmlspecialchars($_POST['tp']);

        $bdd = connexionBDD();

        $verifUser = $bdd->prepare('SELECT user_name FROM utilisateurs WHERE user_name = ?');
        $verifUser->execute(array($username));

        if ($verifUser->rowCount() > 0) {
            $_SESSION['alreadySignup'] = '<h3 class="info info-xl info-error sml-txt">Ce nom d\'utilisateur est déjà utilisé</h3>';
            header('Location: signup.php');
        } else {
            signup($bdd, $username, $mdp, $nom, $prenom, $tp);
            $_SESSION['user_name'] = $username;
            $_SESSION['user_nom'] = $nom;
            $_SESSION['user_prenom'] = $prenom;
            $_SESSION['user_tp'] = $tp;
            $_SESSION['logged'] = true;
            $_SESSION['logged_in'] = '<h3 class="info info-xl info-success">Inscription réussie ! Connecté !</h3>';
            deconnexionBDD($bdd);
            header('Location: index.php');
        }
    } else {
        header('Location: signup.php');
    }
?>

<?php require 'inc/html_end.inc.php'; ?>

