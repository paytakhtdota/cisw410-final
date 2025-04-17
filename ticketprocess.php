<?php
session_start();
include("func.php");

if (!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit();
} else {
    echo_msg();
}


function InsertTicket($guestName, $idUser, $idEvent, $idSeat, $seatName)
{
    include("connection.php");
    try {
        $upQuery = $pdo->prepare("INSERT INTO tickets(guest_name, id_seat, id_event, id_user, seat_name) VALUES (:guest_name,:id_seat,:id_event,:id_user,:seat_name)");
        if (
            $upQuery->execute([
                ":guest_name" => $guestName,
                ":id_seat" => $idSeat,
                ":id_event" => $idEvent,
                ":seat_name" => $seatName,
                ":id_user" => $idUser
            ])
        ) {
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
            $seatName = isset($seatData['seat_name']) ? $seatData['seat_name'] : '';

            InsertTicket($guestName, $idUser, $idEvent, $idSeat, $seatName);


        }
        $url = "user-dash.php?tickets=true&msg=" . urlencode("Ticket has added successfully!");
        header("Location: " . $url);
        exit();
    } else {
        redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
    }
} else {
    redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delTicket'])) {
        include("connection.php");
        $idTicket = $_POST['delTicket'];
        try {
            $upQuery = $pdo->prepare("DELETE FROM tickets WHERE id_ticket=:id_ticket");
            if (
                $upQuery->execute([":id_ticket" => $idTicket])
            ) {
                $url = "user-dash.php?tickets=true&msg=" . urlencode("Ticket has deleted successfully");
                header("Location: " . $url);
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
}