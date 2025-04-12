<?php
session_start();

include_once("func.php");
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
            $userData = $quiry->fetch(PDO::FETCH_ASSOC);
            if (password_verify($data_si['passwordSI'], $userData['password'])) {
                $_SESSION['user_data'] = $userData;
                header('Location: user-dash.php');
                exit();
            } else {
                header("Location: user-login-form.php?signin=true&emailorpass=true");
                exit();
            }

        } else {
            header("Location: user-login-form.php?signin=true&emailorpass=true");
            exit();

        }


    } else {
        // redirect to fix error(s)
        header('Location: error.php');
        exit();
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
            header("Location: user-login-form.php?signup=true&emailexit=true");
            echo '<script>alert ("The email you entered is already registered in our system. Please use the login page to access your account or enter a different email to sign up.")</script>';
        } else {
            $data_su['passwordSU'] = password_hash($data_su['passwordSU'], PASSWORD_DEFAULT);
            unset($data_su['confirmSU']);
            // to excute querty
            require_once("connection.php");
            $query = $pdo->prepare("INSERT INTO users(fname, lname, email, password, phone) VALUES (:fNameSU,:lNameSU,:emailSU,:passwordSU,:phoneSU)");
            $query->execute($data_su);
            header("Location: user-login-form.php?signin=true&regestred=true");
            echo '<script>alert ("You are successfully regestered. Now Log in to your account.")</script>';

        }


    } else {
        // redirect to fix error(s) 
        $message = urlencode("Password and Confirm-Pass are not match!");
        $url = "user-login-form.php?signup=true&msg=" . $message;
        header("Location: " . $url);
        exit();
    }
}




if (isset($_POST['username-signin']) && trim($_POST['username-signin']) != '') {
    signinAction();
} elseif (isset($_POST['email-signup']) && trim($_POST['email-signup']) != '') {
    singupAction();
} elseif (isset($_POST['leave'])) {
    logout();
} else {
    header('Location: error.php');
        exit();
}
