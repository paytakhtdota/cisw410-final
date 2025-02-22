<?php
if (isset($_POST['email-signup']) && trim($_POST['email-signup']) != '') {

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