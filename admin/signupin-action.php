<?php
session_start();
function signinAction()
{
    $error = array();
    $data_si = array();

    $data_si['emailSI'] = trim($_POST['username-signin']);
    $data_si['passwordSI'] = trim($_POST['password-signin']);


    foreach ($data_si as $index => $input) {
        if (!isset($input) || $input == '') {
            $error[] = "You need to enter a $index";
        }
    }

    if (empty($error)) {

        $data_si['emailSI'] = strtolower($data_si['emailSI']);

        require_once("connection.php");

        $quiry = $pdo->prepare("SELECT * FROM users WHERE email = :emailSI");
        $quiry->execute([":emailSI" => $data_si['emailSI']]);
        if ($quiry->rowCount() > 0) {
            echo 'record exist';
            $userData = $quiry->fetch(PDO::FETCH_ASSOC);
            if (password_verify($data_si['passwordSI'], $userData['password'])) {
                $_SESSION['user_data'] = $userData;

                header('Location: ../user/user-dash.php');
                exit();
            }else{
                echo'password not match';
            }

        } else {
            echo "Account Not Found!";

        }


    } else {
        // redirect to fix error(s)
        echo 'Fill all fields';
    }
}

function singupAction()
{
    $error = array();
    $data_su = array();

    $data_su['fNameSU'] = trim($_POST['fname-singup']);
    $data_su['lNameSU'] = trim($_POST['lname-singup']);
    $data_su['emailSU'] = trim($_POST['email-signup']);
    $data_su['phoneSU'] = trim($_POST['phone-signup']);
    $data_su['passwordSU'] = trim($_POST['password-signup']);
    $data_su['confirmSU'] = trim($_POST['confirm-signup']);

    foreach ($data_su as $index => $input) {
        if (!isset($input) || $input == '') {
            $error[] = "You need to enter a $index";
        }
    }

    if (empty($error) && $data_su['passwordSU'] == $data_su['confirmSU']) {

        $data_su['fNameSU'] = ucfirst(strtolower($data_su['fNameSU']));
        $data_su['lNameSU'] = ucfirst(strtolower($data_su['lNameSU']));
        $data_su['emailSU'] = strtolower($data_su['emailSU']);

        require_once("connection.php");

        $emailCheck = $pdo->prepare("SELECT email FROM users WHERE email = :emailSU");
        $emailCheck->execute([":emailSU" => $data_su['emailSU']]);
        if ($emailCheck->rowCount() > 0) {
            echo "Email exist, already!";
        } else {
            $data_su['passwordSU'] = password_hash($data_su['passwordSU'], PASSWORD_DEFAULT);
            unset($data_su['confirmSU']);
            // to excute querty
            require_once("connection.php");
            $query = $pdo->prepare("INSERT INTO users(fname, lname, email, password, phone) VALUES (:fNameSU,:lNameSU,:emailSU,:passwordSU,:phoneSU)");
            $query->execute($data_su);
            echo 'Form inserted Successfully';

        }


    } else {
        // redirect to fix error(s)
        echo 'Error on the form';
    }
}


if  (isset($_POST['username-signin']) && trim($_POST['username-signin']) != ''){
    signinAction();
} elseif (isset($_POST['email-signup']) && trim($_POST['email-signup']) != ''){
    singupAction();
} else {
    echo 'something is wrong';
}
