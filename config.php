<?php

function addNewAdmin()
{
    $error = array();
    $data_aa = array();

    $data_aa['fnameNA'] = trim($_POST['fnameAdmin']);
    $data_aa['lnameNA'] = trim($_POST['lnameAdmin']);
    $data_aa['emailNA'] = trim($_POST['emailAdmin']);
    $data_aa['passwordNA'] = trim($_POST['passAdmin']);
    $data_aa['confirmNA'] = trim($_POST['repeatAdmin']);
    $data_aa['phoneNA'] = trim($_POST['phoneAdmin']);
    $data_aa['privilegeNA'] = (int) trim($_POST['privilegeAdmin']);

    foreach ($data_aa as $index => $input) {
        if (!(isset($input) || $input == '') && ($index != "prefixNA" || $index != "phoneNA")) {
            $error[] = "You need to enter a $index";
        } elseif ($data_aa['passwordNA'] != $data_aa['confirmNA']) {
            $error[] = 'Passwords are not matchs';
        }
    }

    if (empty($error) && $data_aa['passwordNA'] == $data_aa['confirmNA']) {

        $data_aa['fnameNA'] = ucfirst(strtolower($data_aa['fnameNA']));
        $data_aa['lnameNA'] = ucfirst(strtolower($data_aa['lnameNA']));
        $data_aa['emailNA'] = strtolower($data_aa['emailNA']);

        require_once("connection.php");

        $emailCheck = $pdo->prepare("SELECT email FROM users WHERE email = :emailNA");
        $emailCheck->execute([":emailNA" => $data_aa['emailNA']]);
        if ($emailCheck->rowCount() > 0) {
            echo "Email exist, already!";
        } else {
            $data_aa['passwordNA'] = password_hash($data_aa['passwordNA'], PASSWORD_DEFAULT);
            unset($data_aa['confirmNA']);
            // to excute querty
            $query = $pdo->prepare("INSERT INTO users(fname, lname, email, password, phone, privilege_level) VALUES (:fnameNA,:lnameNA,:emailNA,:passwordNA,:phoneNA, :privilegeNA)");
            $query->execute($data_aa);
        
            header("Location: admin.php?success=1");

        }


    } else {
        // redirect to fix error(s)
        echo 'Error on the form' . $error[0];
    }
}


if(isset($_POST['addNewAdmin'])) {
    addNewAdmin() ;
}else{
    echo "Error";
}