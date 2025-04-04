<?php

function updateUserInfo($dataArray)
{
    require_once("connection.php");
    $error = array();

    foreach ($dataArray as $index => $input) {
        if (!isset($input) || $input == '') {
            $error[] = $input . ": Input field can not be empty. Please fill out the field.";
        }
    }



    if (empty($error)) {
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $upQuery = $pdo->prepare("UPDATE users SET fname=:fnameUpdateUser, lname=:lnameUpdateUser, phone=:phoneUpdateUser WHERE id_user=:userIDUpdate");
            if (
                $upQuery->execute([
                    ":fnameUpdateUser" => $dataArray['fnameUpdateUser'],
                    ":lnameUpdateUser" => $dataArray['lnameUpdateUser'],
                    ":phoneUpdateUser" => $dataArray['phoneUpdateUser'],
                    ":userIDUpdate" => $dataArray['userIDUpdate']
                ])
            ) {
                header("Location: user-dash.php?successUpUser=1");
                exit;
            } else {
                header("Location: user-dash.php?successUpUser=2");
                exit;
            }
        } catch (PDOException $e) {
            return ["success" => false, "errors" => [$e->getMessage()]];
        }
    } else {
        foreach ($error as $index => $element) {
            var_dump($element . $index);
        }

    }
}

function updatePhoto()
{

    if ($_FILES["updatePhoto"]["error"] === UPLOAD_ERR_NO_FILE) {
        header("Location: user-dash.php?successUpUser=6");
        exit();
    }
    $uploadDir = "public/upload/";
    $fileName = uniqid() . basename($_FILES["updatePhoto"]["name"]);
    $filePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    echo "<script>console.log(" . $filePath . ");</script>";
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedTypes)) {
        header("Location: user-dash.php?successUpUser=3");
        exit();
    }

    if ($_FILES["updatePhoto"]["size"] > 3 * 1024 * 1024) {
        header("Location: user-dash.php?successUpUser=4");
        exit();
    }

    if (move_uploaded_file($_FILES["updatePhoto"]["tmp_name"], $filePath)) {
        //save in database
        require_once("connection.php");
        // to excute querty
        try {
            $query1 = $pdo->prepare("UPDATE users SET img_path=:updatePhoto WHERE id_user=:userIDUpdate2");
            $query1->execute([
                ':updatePhoto' => $filePath,
                ':userIDUpdate2' => $_POST['userIDUpdate2']
            ]);

            header("Location: user-dash.php?successUpUser=5");
            exit();

        } catch (PDOException $e) {
            
            exit();
            $message = urlencode($e->getMessage());
            $url = "error.php&msg=" . $message;
            header("Location: " . $url);
            exit();
        }
    } else {
        header("Location: user-dash.php?successUpUser=2");
        exit();
    }
}


if (isset($_POST['updateUserSubmit'])) {
    $data_up['userIDUpdate'] = trim($_POST['userIDUpdate']);
    $data_up['fnameUpdateUser'] = trim($_POST['fnameUpdateUser']);
    $data_up['lnameUpdateUser'] = trim($_POST['lnameUpdateUser']);
    $data_up['emailUpdateUser'] = trim($_POST['emailUpdateUser']);
    $data_up['phoneUpdateUser'] = trim($_POST['phoneUpdateUser']);
    updateUserInfo($data_up);
} else if (isset($_POST['updatePhotoBTN'])) {
    updatePhoto();
}
