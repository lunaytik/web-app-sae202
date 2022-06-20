<?php require 'inc/html_head.inc.php'; ?>

<?php if(isset($_SESSION['alreadySignup'])) { echo $_SESSION['alreadySignup']; $_SESSION['alreadySignup'] = null; } ?>
<?php if(isset($_SESSION['logged_in'])) { echo $_SESSION['logged_in']; $_SESSION['logged_in'] = null; } ?>

<form id="form-signup" action="signup_validation.php" method="POST">
    <div class="form-item">
        <label for="username" id="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div class="form-item">
        <label for="mdp" id="mdp">Mot de passe</label>
        <input type="text" name="mdp" id="mdp" required>
    </div class="form-item">
    <div class="form-item">
        <label for="prenom" id="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" required>
    </div>
    <div class="form-item">
        <label for="nom" id="nom">Nom</label>
        <input type="text" name="nom" id="nom" required>
    </div>
    <div class="form-item item-row">
        <label for="tp" id="tp">Votre TP :</label>
        <select name="tp" id="tp" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
            <option value="H">H</option>
        </select>
    </div>
    <input  class="form-btn" type="submit" value="Valider">
</form>

<?php require 'inc/html_end.inc.php'; ?>

