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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['ticket']) && is_array($_POST['ticket'])) {
        foreach ($_POST['ticket'] as $seatId => $seatData) {

            $guestName = isset($seatData['guest_name']) ? $seatData['guest_name'] : '';
            $idUser = isset($seatData['id_user']) ? $seatData['id_user'] : '';
            $idEvent = isset($seatData['id_event']) ? $seatData['id_event'] : '';
            $idSeat = isset($seatData['id_seat']) ? $seatData['id_seat'] : '';

            echo "</br>";
            echo "Array index: $seatId<br>";
            echo "Guest Name: $guestName<br>";
            echo "User ID: $idUser<br>";
            echo "Event ID: $idEvent<br>";
            echo "Seat ID: $idSeat<br>";
        }
    } else {
        redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
    }
} else {
    redirectToErrorPage("Sorry! It seems something wrong; Plese try again later!");
}