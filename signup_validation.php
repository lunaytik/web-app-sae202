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
            $_SESSION['alreadySignup'] = "<h2>Ce nom d'utilisateur est déjà utilisé</h2>";
            header('Location: signup.php');
        } else {
            signup($bdd, $username, $mdp, $nom, $prenom, $tp);
            deconnexionBDD($bdd);
            header('Location: signup.php');
        }
    } else {
        header('Location: signup.php');
    }
?>

<?php require 'inc/html_end.inc.php'; ?>

