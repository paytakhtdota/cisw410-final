<?php

function addNewAdmin($data_aa)
{
    $error = array();

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
            if ($data_aa['privilegeNA'] == 0) {
                header("Location: admin.php?successUserAdd=1");
            } else {
                header("Location: admin.php?successAdd=1");
            }

        }
    } else {
        // redirect to fix error(s)
        echo 'Error on the form' . $error[0];
    }
}

function deladmin($adminid)
{
    require_once("connection.php");
    try {

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $delQuery = $pdo->prepare("DELETE FROM users WHERE id_user = :adminid");
        if ($delQuery->execute([":adminid" => intval($adminid)])) {
            header("Location: admin.php?successDel=1");
            echo "success";
        } else {
            header("Location: admin.php?successdel=0");
            echo "fail";
        }

    } catch (PDOException $e) {
        // header("Location: admin.php?erorr=". $e->getMessage()); 
        echo "fail" . $e->getMessage();
    }
}

function delUser($userID)
{
    require_once("connection.php");
    try {

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $delQuery = $pdo->prepare("DELETE FROM users WHERE id_user = :adminid");
        if ($delQuery->execute([":adminid" => intval($userID)])) {
            header("Location: admin.php?successDelUser=1");
            echo "success";
        } else {
            header("Location: admin.php?successdelUser=0");
            echo "fail";
        }

    } catch (PDOException $e) {
        // header("Location: admin.php?erorr=". $e->getMessage()); 
        echo "fail" . $e->getMessage();
    }
}

function updateActionAdmin($data)
{
    require_once("connection.php");
    try {

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $upQuery = $pdo->prepare("UPDATE users SET fname=:fname, lname=:lname, phone=:phone, privilege_level=:privilege WHERE id_user=:id");
        if (
            $upQuery->execute([
                ":fname" => $data['fname'],
                ":lname" => $data['lname'],
                ":phone" => $data['phone'],
                ":privilege" => $data['priv'],
                ":id" => $data['id']
            ])
        ) {
            header("Location: admin.php?successUpAdmin=1");
            exit;
        } else {
            header("Location: admin.php?successUpAdmin=0");
            exit;
        }

    } catch (PDOException $e) {
        // header("Location: admin.php?erorr=". $e->getMessage()); 
        echo "fail" . $e->getMessage();
    }
}

function updateActionUser($data)
{
    require_once("connection.php");
    try {

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $upQuery = $pdo->prepare("UPDATE users SET fname=:fname, lname=:lname, phone=:phone, privilege_level=:privilege WHERE id_user=:id");
        if (
            $upQuery->execute([
                ":fname" => $data['fname'],
                ":lname" => $data['lname'],
                ":phone" => $data['phone'],
                ":privilege" => $data['priv'],
                ":id" => $data['id']
            ])
        ) {
            header("Location: admin.php?successUpUser=1");
            exit;
        } else {
            header("Location: admin.php?successUpUser=0");
            exit;
        }

    } catch (PDOException $e) {
        // header("Location: admin.php?erorr=". $e->getMessage()); 
        echo "fail" . $e->getMessage();
    }
}


if (isset($_POST['addNewAdmin'])) {
    $data_aa['fnameNA'] = trim($_POST['fnameAdmin']);
    $data_aa['lnameNA'] = trim($_POST['lnameAdmin']);
    $data_aa['emailNA'] = trim($_POST['emailAdmin']);
    $data_aa['passwordNA'] = trim($_POST['passAdmin']);
    $data_aa['confirmNA'] = trim($_POST['repeatAdmin']);
    $data_aa['phoneNA'] = trim($_POST['phoneAdmin']);
    $data_aa['privilegeNA'] = (int) trim($_POST['privilegeAdmin']);
    addNewAdmin($data_aa);
} elseif (isset($_POST['delAdminUserID'])) {
    deladmin($_POST['delAdminUserID']);
} elseif (isset($_POST['updateAdminSubmit'])) {
    $updateAdmin['fname'] = ($_POST['fnameUpdate']);
    $updateAdmin['lname'] = ($_POST['lnameUpdate']);
    $updateAdmin['phone'] = ($_POST['phoneUpdate']);
    $updateAdmin['priv'] = ($_POST['privilegeUpdate']);
    $updateAdmin['id'] = ($_POST['adminIDUpdate']);
    updateActionAdmin($updateAdmin);
} elseif (isset($_POST['updateUserSubmit'])) {
    $updateUser['fname'] = ($_POST['fnameUpdateUser']);
    $updateUser['lname'] = ($_POST['lnameUpdateUser']);
    $updateUser['phone'] = ($_POST['phoneUpdateUser']);
    $updateUser['priv'] = ($_POST['privilegeUpdateUser']);
    $updateUser['id'] = ($_POST['userIDUpdate']);
    updateActionUser($updateUser);
} elseif (isset($_POST['addNewUser'])) {
    $newUser['fnameNA'] = ($_POST['fnameUser']);
    $newUser['lnameNA'] = ($_POST['lnameUser']);
    $newUser['emailNA'] = ($_POST['emailUser']);
    $newUser['passwordNA'] = ($_POST['passUser']);
    $newUser['confirmNA'] = ($_POST['repeatUser']);
    $newUser['phoneNA'] = ($_POST['phoneUser']);
    $newUser['privilegeNA'] = ($_POST['privilegeUser']);
    addNewAdmin($newUser);
} elseif (isset($_POST['delUserID'])) {
    delUser($_POST['delUserID']);
} else {
    echo "Error";
}