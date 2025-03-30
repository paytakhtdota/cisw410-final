<?php

function addNewAdmin($data_aa)
{
    $error = array();

    foreach ($data_aa as $index => $input) {
        if (!(isset($input) || $input == '') && ($index != "prefixNA" || $index != "phoneNA")) {
            $error[] = "You need to enter a $index";
        } elseif ($data_aa['passwordNA'] != $data_aa['confirmNA']) {
            if ($data_aa['privilegeNA'] == 0) {
                header("Location: admin.php?successUserAdd=2");
                exit();
            } else {
                header("Location: admin.php?successAdd=2");
                exit();
            }
        }
    }

    if (empty($error)) {

        $data_aa['fnameNA'] = ucfirst(strtolower($data_aa['fnameNA']));
        $data_aa['lnameNA'] = ucfirst(strtolower($data_aa['lnameNA']));
        $data_aa['emailNA'] = strtolower($data_aa['emailNA']);

        require_once("connection.php");

        $emailCheck = $pdo->prepare("SELECT email FROM users WHERE email = :emailNA");
        $emailCheck->execute([":emailNA" => $data_aa['emailNA']]);
        if ($emailCheck->rowCount() > 0) {
            if ($data_aa['privilegeNA'] == 0) {
                header("Location: admin.php?successUserAdd=0&EmailAddress=" . $data_aa['emailNA']);
                exit();
            } else {
                header("Location: admin.php?successAdd=0&EmailAddress=" . $data_aa['emailNA']);
                exit();
            }


        } else {
            $data_aa['passwordNA'] = password_hash($data_aa['passwordNA'], PASSWORD_DEFAULT);
            unset($data_aa['confirmNA']);
            // to excute querty
            $query = $pdo->prepare("INSERT INTO users(fname, lname, email, password, phone, privilege_level) VALUES (:fnameNA,:lnameNA,:emailNA,:passwordNA,:phoneNA, :privilegeNA)");
            $query->execute($data_aa);
            if ($data_aa['privilegeNA'] == 0) {
                header("Location: admin.php?successUserAdd=1");
                exit();
            } else {
                header("Location: admin.php?successAdd=1");
                exit();
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


// update admin users
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

// Add new event
function addNewEvent($newEventArray)
{
    $error = array();

    foreach ($newEventArray as $index => $input) {
        if (!isset($input) || $input == '') {
            if ($index != "newEUnit") {
                if ($index != "newEDes") {
                    $error[] = "You need to enter a $index";
                }
            }
        }
    }

    if (empty($error)) {

        require_once("connection.php");

        $uploadDir = "public/upload/";
        $fileName = uniqid() . basename($_FILES["newEImg"]["name"]);
        $filePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($fileType, $allowedTypes)) {
            die("File Extention is not Valid");
        }

        if ($_FILES["newEImg"]["size"] > 5 * 1024 * 1024) {
            die("File size is too big");
        }

        if (move_uploaded_file($_FILES["newEImg"]["tmp_name"], $filePath)) {
            //save in database

            // to excute querty
            try {

                $query1 = $pdo->prepare("INSERT INTO address(state, city, street, unit, zip_code) VALUES (:newEState,:newECity,:newEstreet,:newEUnit,:newEZip)");
                $query1->execute([
                    ':newEState' => $newEventArray['newEState'],
                    ':newECity' => $newEventArray['newECity'],
                    ':newEstreet' => $newEventArray['newEstreet'],
                    ':newEUnit' => $newEventArray['newEUnit'],
                    ':newEZip' => $newEventArray['newEZip']
                ]);
                $location_id = $pdo->lastInsertId();

                $query2 = $pdo->prepare("INSERT INTO events(name, date, start_time, img, location_id, description, base_price) VALUES (:newEname, :newEDate, :newEStartTime, :newEImg, :location_id, :newEDes, :newEprice)");

                $query2->execute([
                    ':newEname' => $newEventArray['newEname'],
                    ':newEDate' => $newEventArray['newEDate'],
                    ':newEprice' => $newEventArray['newEprice'],
                    ':newEStartTime' => $newEventArray['newEStartTime'],
                    ':newEImg' => $filePath,
                    ':location_id' => $location_id,
                    ':newEDes' => $newEventArray['newEDes']
                ]);

                header("Location: admin.php?successEventAdd=1");

            } catch (PDOException $e) {
                die('Query Faild:' . $e->getMessage());
            }
        } else {
            echo "upload failed";
        }



    } else {
        // redirect to fix error(s)
        echo 'Error on the form' . $error[0];
    }
}


function updateEvents($updateEventArray)
{
    $error = array();

    foreach ($updateEventArray as $index => $input) {
        if (!isset($input) || $input == '') {
            if (($index != "upEUnit") && ($index != "upEDes")) {
                $error[] = "You need to enter a $index";
            }
        }
    }

    if (empty($error)) {
        require_once("connection.php");
        if ($_FILES["upSelectEImg"]["error"] === UPLOAD_ERR_NO_FILE) {
            try {

                $query1 = $pdo->prepare("UPDATE address SET state=:upEState, city=:upECity, street=:upEstreet, unit=:upEUnit, zip_code=:upEZip WHERE location_id=:location_id");
                $query1->execute([
                    ':location_id' => $updateEventArray['location_id'],
                    ':upEState' => $updateEventArray['upEState'],
                    ':upECity' => $updateEventArray['upECity'],
                    ':upEstreet' => $updateEventArray['upEstreet'],
                    ':upEUnit' => $updateEventArray['upEUnit'],
                    ':upEZip' => $updateEventArray['upEZip']
                ]);

                $query2 = $pdo->prepare("UPDATE events SET name=:upEname, date=:upEDate, base_price=:upEprice, start_time=:upEStartTime, description=:upEDes WHERE id_event=:upEID");

                $query2->execute([
                    ':upEID' => $updateEventArray['upEID'],
                    ':upEname' => $updateEventArray['upEname'],
                    ':upEDate' => $updateEventArray['upEDate'],
                    ':upEprice' => $updateEventArray['upEprice'],
                    ':upEStartTime' => $updateEventArray['upEStartTime'],
                    ':upEDes' => $updateEventArray['upEDes']
                ]);

                header("Location: admin.php?successEventUpdate=1");
                exit();

            } catch (PDOException $e) {
                die('Query Faild:' . $e->getMessage());
            }
        } else {

            $uploadDir = "public/upload/";
            $fileName = uniqid() . basename($_FILES["upSelectEImg"]["name"]);
            $filePath = $uploadDir . $fileName;
            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            $allowedTypes = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($fileType, $allowedTypes)) {
                header("Location: admin.php?successEventUpdate=2");
                exit();
            }

            if ($_FILES["upSelectEImg"]["size"] > 3 * 1024 * 1024) {
                header("Location: admin.php?successEventUpdate=3");
                exit();
            }

            if (move_uploaded_file($_FILES["upSelectEImg"]["tmp_name"], $filePath)) {
                //save in database

                // to excute querty
                try {
                    $query1 = $pdo->prepare("UPDATE address SET state=:upEState, city=:upECity, street=:upEstreet, unit=:upEUnit, zip_code=:upEZip WHERE location_id=:location_id");
                    $query1->execute([
                        ':location_id' => $updateEventArray['location_id'],
                        ':upEState' => $updateEventArray['upEState'],
                        ':upECity' => $updateEventArray['upECity'],
                        ':upEstreet' => $updateEventArray['upEstreet'],
                        ':upEUnit' => $updateEventArray['upEUnit'],
                        ':upEZip' => $updateEventArray['upEZip']
                    ]);

                    $query2 = $pdo->prepare("UPDATE events SET name=:upEname, date=:upEDate, start_time=:upEStartTime, img=:upEImg, description=:upEDes WHERE id_event=:upEID");

                    $query2->execute([
                        ':upEID' => $updateEventArray['upEID'],
                        ':upEname' => $updateEventArray['upEname'],
                        ':upEDate' => $updateEventArray['upEDate'],
                        ':upEStartTime' => $updateEventArray['upEStartTime'],
                        ':upEImg' => $filePath,
                        ':upEDes' => $updateEventArray['upEDes']
                    ]);

                    header("Location: admin.php?successEventUpdate=1");
                    exit();

                } catch (PDOException $e) {
                    die('Query Faild:' . $e->getMessage());
                }
            } else {
                echo "upload failed";
            }
        }

    } else {
        // redirect to fix error(s)
        echo 'Error on the form' . $error[0];
    }
}


function delEvent($value)
{
    require_once("connection.php");
    try {

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $delQuery = $pdo->prepare("DELETE FROM events WHERE id_event = :eventID");
        if ($delQuery->execute([":eventID" => intval($value)])) {
            header("Location: admin.php?successDelEvent=1");
            exit();
        } else {
            header("Location: admin.php?successdelEvent=0");
            exit();
        }

    } catch (PDOException $e) {
        // header("Location: admin.php?erorr=". $e->getMessage()); 
        echo "fail" . $e->getMessage();
    }
}




if (isset($_POST['emailAdmin'])) {
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
} elseif (isset($_POST['adminIDUpdate'])) {
    $updateAdmin['fname'] = ($_POST['fnameUpdate']);
    $updateAdmin['lname'] = ($_POST['lnameUpdate']);
    $updateAdmin['phone'] = ($_POST['phoneUpdate']);
    $updateAdmin['priv'] = ($_POST['privilegeUpdate']);
    $updateAdmin['id'] = ($_POST['adminIDUpdate']);
    updateActionAdmin($updateAdmin);
} elseif (isset($_POST['userIDUpdate'])) {
    $updateUser['fname'] = ($_POST['fnameUpdateUser']);
    $updateUser['lname'] = ($_POST['lnameUpdateUser']);
    $updateUser['phone'] = ($_POST['phoneUpdateUser']);
    $updateUser['priv'] = ($_POST['privilegeUpdateUser']);
    $updateUser['id'] = ($_POST['userIDUpdate']);
    updateActionUser($updateUser);
} elseif (isset($_POST['emailUser'])) {
    $newUser['fnameNA'] = ($_POST['fnameUser']);
    $newUser['lnameNA'] = ($_POST['lnameUser']);
    $newUser['emailNA'] = ($_POST['emailUser']);
    $newUser['passwordNA'] = ($_POST['passUser']);
    $newUser['confirmNA'] = ($_POST['repeatUser']);
    $newUser['phoneNA'] = ($_POST['phoneUser']);
    $newUser['privilegeNA'] = ($_POST['privilegeUser']);
    addNewAdmin($newUser);
} elseif (isset($_POST['newEname'])) {
    $newEvent['newEname'] = ($_POST['newEname']);
    $newEvent['newEDate'] = ($_POST['newEDate']);
    $newEvent['newEStartTime'] = ($_POST['newEStartTime']);
    $newEvent['newEprice'] = ($_POST['newEprice']);
    $newEvent['newEstreet'] = ($_POST['newEstreet']);
    $newEvent['newEUnit'] = ($_POST['newEUnit']);
    $newEvent['newECity'] = ($_POST['newECity']);
    $newEvent['newEState'] = ($_POST['newEState']);
    $newEvent['newEZip'] = ($_POST['newEZip']);
    $newEvent['newEDes'] = ($_POST['neweditorDelta']);
    addNewEvent($newEvent);
} elseif (isset($_POST['delUserID'])) {
    delUser($_POST['delUserID']);
} elseif (isset($_POST['upEID'])) {
    $updateEvent['upEID'] = ($_POST['upEID']);
    $updateEvent['upEname'] = ($_POST['upEname']);
    $updateEvent['upEDate'] = ($_POST['upEDate']);
    $updateEvent['upEprice'] = ($_POST['upEprice']);
    $updateEvent['upEStartTime'] = ($_POST['upEStartTime']);
    $updateEvent['upEDes'] = ($_POST['upeditorDelta']);
    $updateEvent['upEstreet'] = ($_POST['upEstreet']);
    $updateEvent['upEUnit'] = ($_POST['upEUnit']);
    $updateEvent['upECity'] = ($_POST['upECity']);
    $updateEvent['upEState'] = ($_POST['upEState']);
    $updateEvent['upEZip'] = ($_POST['upEZip']);
    updateEvents($updateEvent);
} elseif (isset($_POST['delEventID'])) {
    delEvent($_POST['delEventID']);
} else {
    echo "Error";
}