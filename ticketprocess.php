<?php
session_start();
include("func.php");

if (!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit();
} else {
    echo_msg();
}


function InsertTicket($guestName, $idUser, $idEvent, $idSeat)
{
    include("connection.php");
    try {
        $upQuery = $pdo->prepare("INSERT INTO tickets(guest_name, id_seat, id_event, id_user) VALUES (:guest_name,:id_seat,:id_event,:id_user)");
        if (
            $upQuery->execute([
                ":guest_name" => $guestName,
                ":id_seat" => $idSeat,
                ":id_event" => $idEvent,
                ":id_user" => $idUser
            ])
        ) {
            header("Location: user-dash.php?tickets=true");
            exit();
        } else {
            $msg = "fail: to insert date into database";
            redirectToErrorPage($msg);
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

            InsertTicket($guestName, $idUser, $idEvent, $idSeat);
        }
        // header("Location: user-dash.php");

    } else {
        redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
    }
} else {
    redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
}