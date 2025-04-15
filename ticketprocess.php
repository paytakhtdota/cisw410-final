<?php
session_start();
include("func.php");
if (!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit();
} else {
    echo_msg();
    echo "OK!";
}


function InsertTicket($guestName,$idUser,$idEvent,$idSeat){
    require_once("connection.php");
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $upQuery = $pdo->prepare("INSERT INTO address(guest_name, id_seat, id_event, id_user) VALUES (:guest_name,:id_seat,:id_event,:id_user)");
        if (
            $upQuery->execute([
                ":guest_name" => $guestName,
                ":id_seat" => $idSeat,
                ":id_event" => $idEvent,
                ":id_user" => $idUser
            ])
        ) {
            echo "<script>Ticket added Successfuly!</script>";
        } else {
            echo "<script>Ticket insert failed!</script>";
        }

    } catch (PDOException $e) {
        $msg = "fail: " . $e->getMessage();
        redirectToErrorPage($msg);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['ticket']) && is_array($_POST['ticket'])) {
        foreach ($_POST['ticket'] as $seatId => $seatData) {

            $guestName = isset($seatData['guest_name']) ? $seatData['guest_name'] : '';
            $idUser = isset($seatData['id_user']) ? $seatData['id_user'] : '';
            $idEvent = isset($seatData['id_event']) ? $seatData['id_event'] : '';
            $idSeat = isset($seatData['id_seat']) ? $seatData['id_seat'] : '';

            InsertTicket($guestName,$idUser,$idEvent,$idSeat);            
        }
    } else {
        redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
    }
} else {
    redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
}