<?php require 'inc/html_head.inc.php'; ?>

<?php if(isset($_SESSION['notSignup'])) { echo $_SESSION['notSignup']; $_SESSION['notSignup'] = null; } ?>
<?php if(isset($_SESSION['wrongPassword'])) { echo $_SESSION['wrongPassword']; $_SESSION['wrongPassword'] = null; } ?>
<?php if(isset($_SESSION['connected'])) { echo $_SESSION['connected']; $_SESSION['connected'] = null; } ?>


<form action="login_validation.php" method="POST">
    <div>
        <label for="username" id="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="mdp" id="mdp">Mot de passe</label>
        <input type="text" name="mdp" id="mdp" required>
    </div>
    <input type="submit" value="Valider">
</form>


<?php require 'inc/html_end.inc.php'; ?>

