<?php require 'inc/html_head.inc.php'; ?>

<?php
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
?>

<?php require 'inc/html_end.inc.php'; ?>

