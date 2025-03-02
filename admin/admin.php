<?php
require_once ("connection.php");


if (isset($_POST['email']) && isset($_POST['password'])) {
    $credit[]= trim($_POST['email']);
    $credit[]= trim($_POST['password']);

    signinAction();
} elseif (isset($_POST['email-signup']) && trim($_POST['email-signup']) != '') {
    singupAction();
} elseif (isset($_POST['leave'])){
    session_destroy();
    header("Location: ../index.php");
    exit();
} else {
    echo 'something is wrong';
}

