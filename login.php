<?php require 'inc/html_head.inc.php'; ?>

<?php if(isset($_SESSION['notSignup'])) { echo $_SESSION['notSignup']; $_SESSION['notSignup'] = null; } ?>
<?php if(isset($_SESSION['wrongPassword'])) { echo $_SESSION['wrongPassword']; $_SESSION['wrongPassword'] = null; } ?>
<?php if(isset($_SESSION['connected'])) { echo $_SESSION['connected']; $_SESSION['connected'] = null; } ?>


<form id="form-login" action="login_validation.php" method="POST">
    <div class="form-item">
        <label for="username" id="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required>
        <a class="login-txt" href="signup.php">Pas encore inscrit ?</a>
    </div>
    <div class="form-item">
        <label for="mdp" id="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" required>
        <a class="login-txt no-usable" href="#">Problème de mot de passe ? <br /> Voir avec un des organisateurs</a>
    </div>
    <input class="form-btn" type="submit" value="Valider">
</form>


<?php require 'inc/html_end.inc.php'; ?>

