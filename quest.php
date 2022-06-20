<?php require 'inc/html_head.inc.php'; ?>

<?php if(isset($_SESSION['alreadySignup'])) { echo $_SESSION['alreadySignup']; $_SESSION['alreadySignup'] = null; } ?>

<form action="quest_validation.php" method="POST">

    <div>
        <label for="quest_name" id="username">quest_name</label>
        <input type="text" name="quest_name" id="quest_name" required>
    </div>
    <div>
        <label for="quest_text" id="quest_text">quest_text</label>
        <input type="text" name="quest_text" id="quest_text" required>
    </div>
    <div>
        <label for="quest_content" id="quest_content">quest_content</label>
        <input type="text" name="quest_content" id="quest_content" required>
    </div>
    <div>
        <label for="quest_rep" id="quest_rep">quest_rep</label>
        <input type="text" name="quest_rep" id="quest_rep" required>
    </div>
    <div>
        <label for="quest_act" id="quest_act">quest_act</label>
        <select name="quest_act" id="quest_act" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
    </div>
    <div>
        <label for="quest_step" id="quest_step">quest_step</label>
        <select name="quest_step" id="quest_step" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
    </div>
    <div>
        <label for="quest_type" id="quest_type">quest_type</label>
        <select name="quest_type" id="quest_type" required>
            <option value="1">FLAG</option>
            <option value="2">IMAGE</option>
            <option value="3">AUTRE</option>
        </select>
    </div>
    <div>
        <label for="_quest_tp" id="_quest_tp">_quest_tp</label>
        <select name="_quest_tp" id="_quest_tp" required>
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
    <div>
        <label for="_act_id" id="_act_id">_act_id</label>
        <select name="_act_id" id="_act_id" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
    </div>
    <input type="submit" value="Valider">
</form>

<?php require 'inc/html_end.inc.php'; ?>

