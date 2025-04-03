<?php
session_start();
if (!isset($_SESSION['admin_data'])) {
    header("Location: adminlf.php?msg=0");
    exit();
} else {
    if (isset($_GET['msg'])) {
        echo '<script>setTimeout(function() {';
        echo 'alert("' . $_GET["msg"] . '");';
        echo '}, 200);</script>';
    }

    require_once("connection.php");

    $usersQuery = $pdo->prepare("SELECT * FROM users");
    $usersQuery->execute();
    $users = $usersQuery->fetchAll(PDO::FETCH_ASSOC);

    $ticketsQuery = $pdo->prepare("SELECT * FROM tickets");
    $ticketsQuery->execute();
    $tickets = $ticketsQuery->fetchAll(PDO::FETCH_ASSOC);

    $eventsQuery = $pdo->prepare("SELECT events.*, address.*
    FROM events
    JOIN address ON events.location_id = address.location_id
");
    $eventsQuery->execute();
    $events = $eventsQuery->fetchAll(PDO::FETCH_ASSOC);


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Simple Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        ul,
        li,
        ol {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            transition: all 0.3s;
        }

        .btnBar {
            width: 100%;
            min-height: 75px;
            display: flex;
            justify-content: flex-start;
            align-content: center;
            gap: 15px;
            padding: 7px 0 15px 7px;
        }

        .btnBar button {
            width: 100%;
            max-width: 300px;
            height: 40px;
            margin-top: 10px;
            border-radius: 4px;
            border: 3px solid #b8860b;
            background-color: #b8860b;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-family: "Roboto", serif;
            transition: all 0.3s;
        }

        .btnBar button:hover {
            width: 100%;
            height: 40px;
            margin-top: 10px;
            border-radius: 4px;
            border-color: #B8860B;
            background-color: #b8860b00;
            color: #B8860B;
            cursor: pointer;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            min-height: 100vh;
            width: 250px;
            background: #121315;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            font-size: 20px;
        }

        .sidebar>ul li {
            padding: 10px;
            cursor: pointer;
            size: 24px;
            transition: 0.6s all;
            padding-left: 0;
            margin-bottom: 5px;
        }

        .sidebar ul li:hover {
            background: rgb(41, 60, 78);
            padding-left: 10px;
        }



        .content {
            flex: 1;
            padding: 20px;
            height: fit-content;
            background-color: #ffffff;
        }

        .header {
            background: rgb(32, 32, 32);
            background: linear-gradient(90deg, rgba(32, 32, 32, 0) 5%, rgba(32, 32, 32, 1) 41%, rgba(32, 32, 32, 1) 60%, rgba(32, 32, 32, 0) 95%);
            color: rgb(255, 255, 255);
            border-bottom: none;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            border-radius: 8px;
            font-family: 'DM Serif Display';
            letter-spacing: 2px;
            font-weight: 600;
        }

        .tab {
            display: none;
        }

        .active {
            display: block;
        }

        .selected {
            color: #e3b04b;
            margin-left: 25px;

        }

        .selected:hover {
            padding-left: 0 !important;
        }

        .sidebar ul li .fa-solid {
            pointer-events: none;

        }


        .message-box {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            width: 500px;
            height: 200px;
            border: 1px solid #000000;
            font-size: 24px;
            text-align: center;
            padding-top: 25px 10px;
            border-radius: 8px;
            background-color: #202020;
            margin: 150px auto;
            color: #ffffff;
            font-family: "Poppins", "Roboto", sans-serif;
            box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 48px;
        }

        .message-box>div {
            margin-top: 30px;
            display: flex;
            justify-content: space-around;
            width: 100%;
            transition: all 0.3s;
        }

        .message-box form {
            display: flex;
            width: 100%;
            justify-content: space-evenly;
        }

        #leave,
        #cancel {
            width: 45%;
            max-width: 300px;
            height: 40px;
            margin-top: 10px;
            border-radius: 4px;
            border: 3px solid #b8860b;
            background-color: #b8860b;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-family: "Roboto", serif;
            transition: all 0.4s;
        }

        #leave:hover,
        #cancel:hover {
            width: 45%;
            height: 40px;
            margin-top: 10px;
            border-radius: 4px;
            border-color: #B8860B;
            background-color: #b8860b00;
            color: #B8860B;
            cursor: pointer;
            transition: all 0.3s;
        }


        #leave:hover .fa-person-walking-arrow-right {
            padding-left: 10px;
        }

        #cancel:hover .fa-arrow-left {
            padding-right: 10px;
        }


        .tabContainer {
            width: 100%;
            min-height: fit-content;
            padding: 5px 15px 10px 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            gap: 5px;
            background-color: rgb(40, 40, 40);
            border-radius: 8px;
            margin-top: 50px;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }

        .tabContainer input['text'] {
            height: 48px;
            padding: 6px 12px;
        }

        .containerBudy {
            width: 100%;
            min-height: fit-content;
            padding-bottom: 8px;

        }


        .admin-ul {
            display: flex;
            width: 100%;
            height: 50px;
            justify-content: space-between;
            text-align: center;
            padding: 10px 0 0 5px;
            align-content: center;
            align-items: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .admin-ul li {
            list-style-type: none;
            min-height: 30px;
        }

        .admin-ul li:first-child {
            width: 5%;
            min-width: 50px;
            height: ;
        }

        .admin-ul li:nth-child(2) {
            width: 20%;
            min-width: 120px;
        }

        .admin-ul li:nth-child(3) {
            width: 20%;
            min-width: 120px;
        }

        .admin-ul li:nth-child(4) {
            width: 15%;
            min-width: 70px;
        }

        .admin-ul li:nth-child(5) {
            width: 15%;
            min-width: 120px;
        }

        .admin-ul li:nth-child(6) {
            width: 15%;
            min-width: 120px;
        }

        .admin-ul li:nth-child(7) {
            width: 5%;
            min-width: 120px;
        }

        .admin-ul li:nth-child(8) {
            width: 5%;
            min-width: 120px;
        }

        .budyHeader .admin-ul {

            background-color: #B8860B;
            font-weight: 600;
            padding-top: 10px;
        }

        .budyHeader .admin-ul li {
            color: #ffffff;
            cursor: default;
        }

        .budyRow {
            display: flex;
            justify-content: space-between;
            transition: 0.3s all;
            border-left: 8px solid #B8860B;
            margin-top: 2px;
            margin-bottom: 2px;
            padding-left: 15px;
            border-radius: 2px;
        }

        .budyRow:hover {
            background-color: rgb(255, 255, 255);
            border-radius: 3px;
            border-left: 4px solid rgb(244, 194, 65);
            box-shadow: rgba(50, 50, 93, 0.1) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.12) 0px 18px 36px -18px inset;
            /* box-shadow: rgba(0, 0, 0, 0.15) 0px -50px 36px -28px inset; */
        }

        .budyRow li {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            height: fit-content;
        }


        .budyRow:nth-child(even) {
            background-color: rgb(250, 250, 250);
        }

        .budyRow:nth-child(odd) {
            background-color: rgb(247, 247, 247);
        }



        .budyRow:hover+.budyRow: {
            background-color: rgb(123, 14, 14);
        }

        .addPaddingTop5px {}

        .newAdminForm,
        .newUserForm,
        .newEventForm {
            width: 840px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: none;
            margin: 10px auto;
        }

        .ul-container {
            list-style-type: none;
        }

        #formNewEvent,
        #form-new-user,
        #formNewAdmin,
        #form-user-update,
        #form-update-admin {
            display: flex;
            flex-wrap: wrap;
            gap: 2%;
            width: 100%;
        }

        #form-user-update {
            justify-content: space-between;
            padding: 5px;
        }

        .ul-container li {
            width: 47%;
            min-height: fit-content;
        }

        .ul-container label {
            display: inline-block;
            width: 120px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin: 15px 0 10px 5px;
            font-family: 'Lato';
        }

        .ul-container input,
        .ul-container select,
        .ul-container textarea {
            width: 100%;
            height: 48px;
            padding: 6px 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            outline: none;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .ul-container textarea {
            transition: none;
        }

        #addNewEvent,
        .cancelUpdate {
            width: 100%;
            height: 48px;
            margin-top: 25px;
            margin-bottom: 5px;
            border-radius: 4px;
            border: 3px solid #b8860b;
            background-color: #b8860b;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-family: "Roboto", serif;
            transition: all 0.4s;
        }

        #addNewEvent:hover,
        .cancelUpdate:hover {
            border-color: #B8860B;
            background-color: #b8860b00;
            color: #B8860B;
            cursor: pointer;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }

        .ul-container input:hover {
            border-color: #fcc32c;
        }

        .ul-container input:focus {
            border-color: #fcb711;
        }

        #newEImg {
            min-height: 160px;
        }

        #newEeditor {
            height: 116px;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }





        .upBTN,
        .delBTN {
            width: 70px;
            height: 30px;
            border: 1px solid rgb(145, 202, 240);
            background-color: rgb(207, 215, 224);
            border-radius: 2px;
            transition: all 200ms;
            margin-bottom: 10px;
            font-size: 16px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .upBTN:hover {
            border: 1px solid #e3b04b;
            background-color: rgba(227, 176, 75, 0.55);
            cursor: pointer;
            color: rgb(255, 255, 255);
            box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
        }

        .delBTN:hover {
            border: 1px solid rgb(255, 84, 84);
            background-color: rgb(225, 84, 74);
            cursor: pointer;
            color: rgb(255, 255, 255);
            box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
        }

        .messageBox,
        .messageBoxUser {
            width: 400px;
            height: fit-content;
            border-radius: 8px;
            background-color: rgb(247, 247, 247);
            text-align: center;
            padding: 10px;
            margin: 15px auto;
            display: none;
        }

        .conformBTN {
            display: flex;
            justify-content: space-evenly;
        }

        .conformBTN form {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            gap: 20px;
            margin-top: 0;
            padding-top: 0;
        }


        .qustion {
            margin-bottom: 25px;
        }

        /* update admin form */
        .updateAdminForm,
        .updateUserForm {
            display: none;
            width: 800px;
            background-color: #ffffff;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 10px auto;
            box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;
        }






        /* ********** Event Tab Styles */

        .time-select {
            width: 75px;
        }

        .width-adj li:first-child {}

        .newEventForm h4 {
            line-height: 0.75;
            margin-bottom: 0;
        }

        .required-fields {
            color: red;
        }

        .eventDetailsSec {
            display: none;
            width: 840px;
            border-radius: 8px;
            gap: 15px;
            justify-content: space-between;
            align-items: center;
            padding: 24px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
            background-color: #ffffff;
        }

        .eventDetailsSec label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin: 15px 0 10px 5px;
            font-family: 'Lato';
        }

        .eventDetailsSec ul {
            width: 100%;
        }

        .eventDetailsSec li {
            width: 49%;
            height: min-content;
            padding: 5px;
        }

        #event-detail-liID {
            width: 10%;
        }

        #event-detail-liTitle {
            width: 88%;
        }

        #li-UpEeditor {
            width: 100%;
        }

        .event-detail-second-col li:first-child {
            visibility: hidden;
        }

        .eventDetailsSec input,
        .eventDetailsSec select,
        .eventDetailsSec textarea {
            width: 100%;
            height: 48px;
            padding: 6px 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            outline: none;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .eventDetailsSec input:focus,
        .eventDetailsSec textarea:focus {
            background-color: rgb(239, 250, 255);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
        }

        .eventDetailsSec textarea {
            transition: none;
        }

        .event-detail-ul {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .event-detail-ul img {
            width: 100%;
            height: auto;
            border: 2px solid #ffe39d;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-top: 15px;
        }

        #event-update-submit {
            display: none;
            margin-top: -10px;
        }


        .act-input {
            border: 2px solid #ffebb5 !important;
        }

        .hidden-lis {
            visibility: hidden;
            height: 1px;
        }
    </style>

</head>

<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li id="Dashli" class="selected" onclick="showTab('home')"><i class="fa-solid fa-house-user"> </i> Home</li>
            <li id="ticketli" class="" onclick="showTab('tickets')"><i class="fa-solid fa-ticket"> </i> Tickets</li>
            <li id="eventli" class="" onclick="showTab('events')"><i class="fa-solid fa-calendar-xmark"></i> Events</li>
            <li id="userli" class="" onclick="showTab('users')"><i class="fa-solid fa-users"></i> Users</li>
            <li id="adminli" class="" onclick="showTab('admins')"><i class="fa-solid fa-book-open-reader"></i> Admins
            </li>
            <li id="settingli" class="" onclick="showTab('settings')"><i class="fa-solid fa-gear"> </i> Settings</li>
            <li id="logoutli" class="" onclick="showTab('logout')"><i class="fa-solid fa-arrow-right-from-bracket"> </i>
                Logout</li>
        </ul>
    </div>
    <div class="content">
        <!-- ************************************************Home Tab Cantain -->
        <div id="home" class="tab active">
            <div class="header">Welcome to the Dashboard</div>
            <p> </p>

        </div>
        <!-- ************************************************Tickets Tab Cantain -->
        <div id="tickets" class="tab">
            <div class="header">Tickets</div>
            <p> </p>
        </div>
        <!-- ************************************ event Tab Cantain ************ event Tab Cantain -->
        <!-- ************************************ event Tab Cantain ************ event Tab Cantain -->
        <div id="events" class="tab">
            <div class="header">Events</div>
            <p> </p>
            <div class="tabContainer">
                <div class="btnBar">
                    <button onclick="tugglelist(4)">Events List</button><button onclick="tugglelist(5)">Add New
                        Event</button>
                </div>
                <div class="containerBudy">
                    <div class="budyHeader">
                        <ul class="admin-ul width-adj">
                            <li>ID</li>
                            <li>Event Name</li>
                            <li>Date</li>
                            <li>Details / Update</li>
                            <li>Delete</li>
                        </ul>
                    </div>
                    <!-- A row for each record -->
                    <?php foreach ($events as $index => $event) {
                        echo "" .
                            "<div class='budyRow'>
                            <ul class='admin-ul'>
                            <li> " . $event['id_event'] . " </li>
                            <li>" . $event['name'] . "</li>
                            <li>" . $event['date'] . "</li>
                            <li><form action='admin.php' method='POST'>
                            <input type='hidden' name='updateEvent' value='" . $index . "'>
                            <button class='upBTN' type='submit'>
                            <i class='fa-solid fa-pen-to-square'></i>
                            </button>
                            </form>
                            </li>
                            <li><form action='admin.php' method='POST'><input type='hidden' id='deleteEvent" . $event['id_event'] . "' name='deleteEvent' value='" . $event['id_event'] . "'><button class='delBTN' type='submit'>
                            <i class='fa-regular fa-trash-can'></i></button></form></li>
                            </ul>
                            </div>";
                    }
                    ?>
                </div>
                <!-- Add New Event From -->
                <div class="newEventForm">
                    <h3>Add New Event</h3>
                    <ul class="ul-container">
                        <form action="config.php" method="POST" enctype="multipart/form-data" id="formNewEvent">
                            <li id="liID"><label for="newEname">Event Name<i class="required-fields">*</i></label>
                                <input type="text" name="newEname" id="newEname" placeholder="Event Name" required>
                            </li>
                            <li><label for="newEDate">Date<i class="required-fields">*</i></label>
                                <input name="newEDate" type="date" id="newEDate" placeholder="New Event Date" required>
                            </li>
                            <li><label for="newEStartTime">Start Time<i class="required-fields">*</i></label>
                                <input type="time" id="newEStartTime" name="newEStartTime" min="07:00" max="23:59"
                                    required />
                            </li>
                            <li><label for="newEprice">Base Price<i class="required-fields">*</i></label>
                                <input type="number" step="0.01" id="newEprice" name="newEprice" placeholder="0.00"
                                    title="Enter a valid Price (e.g., 100 or 99.99)" required>
                            </li>
                            <li>
                                <label for="newEImg">Image</label>
                                <input type="file" name="newEImg" id="newEImg" accept="image/jpeg,image/png,image/gif"
                                    required>
                            </li>
                            <li><label for="newEeditor">Details</label>
                                <div id="newEeditor"></div>
                                <input type="hidden" name="neweditorDelta" id="neweditorDelta">
                            </li>
                            <!-- <li><h4>Address:</h4></li> -->
                            <li><label for="newEstreet">Street<i class="required-fields">*</i></label>
                                <input name="newEstreet" type="text" id="newEstreet" placeholder="Street" required>
                            </li>
                            <li><label for="newEUnit">Unit</label>
                                <input name="newEUnit" type="text" id="newEUnit" placeholder="Unit, Apt, Floor">
                            </li>
                            <li><label for="newECity">City<i class="required-fields">*</i></label>
                                <input name="newECity" type="text" id="newECity" placeholder="City" required>
                            </li>
                            <li><label for="newEState">State:<i class="required-fields">*</i></label>
                                <select name="newEState" id="newEState" required>
                                    <option value="">-- Select a state --</option>
                                </select>
                            </li>
                            <li><label for="newEZip">ZIP Code<i class="required-fields">*</i></label>
                                <input type="text" id="newEZip" name="newEZip" pattern="^\d{5}$"
                                    title="Enter a valid ZIP Code (e.g., 12345 or 12345-6789)" required>
                            </li>
                            <li></li>
                            <!-- <li><input id="addNewEvent" name="addNewEvent" type="submit" value="Add New Event"></li> -->
                            <li><button type="button" class="cancelUpdate" onclick="closeUpdateField(5)">Cancel</button>
                            <li><button type="submit" id="addNewEvent" name="addNewEvent" value="Add New Event">Add New
                                    Event</button></li>
                            </li>
                        </form>
                    </ul>
                </div>

                <!-- Event Detail window / update -->
                <section class="eventDetailsSec">
                    <h3>Event Details:</h3>
                    <form action="config.php" method="POST" enctype="multipart/form-data" id="eventDetailsUpdateForm">
                        <ul class="event-detail-ul">
                            <li id="event-detail-liID"><label for="upEID">ID:</label>
                                <input type="upEID" name="upEID" id="upEID" required readonly>
                            </li>
                            <li id="event-detail-liTitle"><label for="upEname">Title:</label>
                                <input class="update-event" type="text" name="upEname" id="upEname" required>
                            </li>
                            <li><label for="upEDate">Date:</label>
                                <input class="update-event" name="upEDate" type="date" id="upEDate"
                                    placeholder="up Event Date" required>
                            </li>
                            <li><label for="upEStartTime">Time:</label>
                                <input class="update-event" type="time" id="upEStartTime" name="upEStartTime"
                                    min="07:00" max="23:59" required />
                            </li>
                            <li><label for="upEprice">Base Price<i class="required-fields">*</i></label>
                                <input type="number" step="0.01" id="upEprice" name="upEprice" placeholder="0.00"
                                    title="Enter a valid Price (e.g., 100 or 99.99)" required>
                            </li>

                            </li>
                            <li><label for="upEstreet">Street<i class="required-fields">*</i></label>
                                <input name="location_id" type="number" id="location_id" hidden>
                                <input class="update-event" name="upEstreet" type="text" id="upEstreet"
                                    placeholder="Street" required>
                            </li>
                            <li><label for="upEUnit">Unit</label>
                                <input class="update-event" name="upEUnit" type="text" id="upEUnit"
                                    placeholder="Unit, Apt, Floor">
                            </li>
                            <li><label for="upECity">City<i class="required-fields">*</i></label>
                                <input class="update-event" name="upECity" type="text" id="upECity" placeholder="City"
                                    required>
                            </li>
                            <li><label for="upEState">State:<i class="required-fields">*</i></label>
                                <select class="update-event" name="upEState" id="upEState" required>
                                    <option id="First-option" value=""></option>
                                </select>
                            </li>
                            <li><label for="upEZip">ZIP Code<i class="required-fields">*</i></label>
                                <input class="update-event" type="text" id="upEZip" name="upEZip" pattern="^\d{5}$"
                                    title="Enter a valid ZIP Code (e.g., 12345 or 12345-6789)" required>
                            </li>
                            <li id="li-UpEeditor"><label for="upEeditor">Details</label>
                                <div id="upEeditor"></div>
                                <input type="hidden" name="upeditorDelta" id="upeditorDelta">
                            </li>
                            <li><img id="upEImg" src="" alt=""></li>
                            <li id="upSelectEImgLI"><label for="upSelectEImg">Select new image:</label><input
                                    type="file" name="upSelectEImg" id="upSelectEImg"
                                    accept="image/jpeg,image/png,image/gif"></li>
                            <li>
                                <button class="cancelUpdate" type="button" onclick="closeUpdateField(6)">close</button>
                            </li>
                            <li id="li-event-edit-btn">
                                <button class="cancelUpdate" type="button" onclick="disableInputs(false)">Edit
                                    Event</button>
                            </li>
                            <li>
                                <!-- submit button to send update information to config.php -->
                                <!-- <input type="submit"  name="event-update-submit" value="Submit"> -->
                                <button class="cancelUpdate" id="event-update-submit" type="submit"
                                    name="event-update-submit" style="margin-top:25px">Submit</button>
                            </li>
                        </ul>
                    </form>
                </section>

                <!-- Delete Event Message Box -->
                <div class="messageBoxUser">
                    <div class="qustion">
                        <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="conformBTN">
                        <form action="config.php" method="POST">
                            <input class="hidden-lis" type='hidden' name='delEventID'
                                value='<?php echo $_POST['deleteEvent']; ?>'>
                            <button class="cancelUpdate" type="submit">Remove Record</button>
                            <!-- cancel button -->
                            <button type='button' class="cancelUpdate" id="delEventCancel">Cancle</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- ************************************************ user Tab Cantain -->
        <div id="users" class="tab">
            <div class="header">Users</div>
            <p> </p>
            <div class="tabContainer">
                <div class="btnBar">
                    <button onclick="tugglelist(2)">Users List</button> <button onclick="tugglelist(3)">Add New
                        User</button>
                </div>
                <div class="containerBudy">
                    <div class="budyHeader">
                        <ul class="admin-ul">
                            <li>ID</li>
                            <li>Name</li>
                            <li>E-mail</li>
                            <li>Phone</li>
                            <li>Creation Date</li>
                            <li>Privilege Level</li>
                            <li>Up Date</li>
                            <li>Delete</li>
                        </ul>
                    </div>
                    <!-- A row for each record -->
                    <?php foreach ($users as $index => $user) {
                        if ($user['privilege_level'] == 0) {

                            echo "" .
                                "<div class='budyRow'>
                            <ul class='admin-ul'>
                            <li> " . $user['id_user'] . " </li>
                            <li>" . $user['fname'] . " " . $user['lname'] . "</li>
                            <li>" . $user['email'] . "</li>
                            <li>" . $user['phone'] . "</li>
                            <li>" . $user['create_at'] . "</li>
                            <li>" . $user['privilege_level'] . "</li>
                            <li><form action='admin.php' method='POST'><input type='hidden' name='updateUser' value='" . $index . "'><button class='upBTN' type='submit'>
                            <i class='fa-solid fa-pen-to-square'></i></button></form></li>
                            <li><form action='admin.php' method='POST'><input type='hidden' name='deleteUser' value='" . $user['id_user'] . "'><button class='delBTN' type='submit'>
                            <i class='fa-solid fa-trash-can'></i></button></form></li>
                            </ul>
                            </div>";
                        }
                    }
                    ?>
                </div>
                <!-- Add New User From -->
                <div class="newUserForm">
                    <h3>Add New User</h3>
                    <ul class="ul-container">
                        <form action="config.php" method="POST" id="form-new-user">
                            <li><label for="fnameUser">First Name </label>
                                <input type="text" name="fnameUser" id="fnameUser" placeholder="First Name" required>
                            </li>
                            <li><label for="lnameUser">Last Name </label>
                                <input name="lnameUser" type="text" id="lnameUser" placeholder="Last Name" required>
                            </li>
                            <li><label for="prefixUser">Prefix</label>
                                <select name="prefixUser" id="prefixUser" placeholder="Prefix" disabled>
                                    <option value="option">Disabled</option>
                                </select>
                            </li>
                            <li><label for="emailUser">E-mail</label>
                                <input name="emailUser" type="email" id="emailUser" placeholder="E-Mail" required>
                            </li>
                            <li><label for="passUser">Password</label>
                                <input name="passUser" type="password" id="passUser" placeholder="Password" required>
                            </li>
                            <li><label for="repeatUser">Confirm-pass</label>
                                <input name="repeatUser" type="password" id="repeatUser" placeholder="Repeat" required>
                            </li>
                            <li><label for="phoneUser">Phone#</label>
                                <input name="phoneUser" type="tel" id="phoneUser" placeholder="Tel Number">
                            </li>
                            <li> <label for="privilegeUser">Access Level</label><select name="privilegeUser"
                                    id="privilegeUser">
                                    <option value="0">User</option>
                                </select></li>
                            <!-- <li><input name="addNewUser" type="submit" value="addNewUser"></li> -->
                            <li><button type="button" class="cancelUpdate" onclick="closeUpdateField(4)">Cancel</button>
                            </li>
                            <li><button class="cancelUpdate" id="addNewUser" name="addNewUser" type="submit"
                                    value="addNewUser">Add New User</button></li>
                        </form>
                    </ul>
                </div>
                <!-- Delete Message Box -->
                <div class="messageBoxUser">
                    <div class="qustion">
                        <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="conformBTN">
                        <form action="config.php" method="POST">
                            <input type='hidden' name='delUserID' value='<?php echo $_POST['deleteUser']; ?>'>
                            <input class="cancelUpdate" type="submit" value="Remove">
                            <!-- cancel button -->
                            <button class="cancelUpdate" type="button" id="delUserCancel">Cancle</button>
                        </form>
                    </div>
                </div>
                <!-- Update User Field -->
                <div class="updateUserForm">
                    <h3>Update User Information</h3>
                    <ul class="ul-container">
                        <form action="config.php" method="POST" id="form-user-update">
                            <input class="hidden-lis" type="text" name="userIDUpdate" id="userIDUpdate" value='' hidden>
                            <li><label for="fnameUpdateUser">First Name </label><input type="text"
                                    name="fnameUpdateUser" id="fnameUpdateUser" placeholder="First Name" required></li>
                            <li><label for="lnameUpdateUser">Last Name </label><input name="lnameUpdateUser" type="text"
                                    id="lnameUpdateUser" placeholder="Last Name" required></li>
                            <li><label for="prefixUpdate">Prefix</label><select name="prefixUpdateUser"
                                    id="prefixUpdateUser" placeholder="Prefix" disabled>
                                    <option value="option">Disabled</option>
                                </select>
                            </li>
                            <li><label for="emailUpdateUser">E-mail</label><input name="emailUpdateUser" type="email"
                                    id="emailUpdateUser" placeholder="E-Mail" disabled></li>
                            <li><label for="phoneUpdateUser">Phone#</label><input name="phoneUpdateUser" type="tel"
                                    id="phoneUpdateUser" placeholder="Tel Number"></li>
                            <li> <label for="privilegeUpdateUser">Access Level</label><select name="privilegeUpdateUser"
                                    id="privilegeUpdateUser">
                                    <option value="2">suspend</option>
                                    <option value="0">User</option>
                                </select></li>
                            <li><button type="button" class="cancelUpdate" onclick="closeUpdateField(3)">Cancel</button>
                            </li>
                            <li><button name="updateUserSubmit" type="submit" class="cancelUpdate">Update</button></li>
                        </form>
                    </ul>
                </div>
            </div><!-- .tabContainer end-->
        </div>
        <!-- ************************************************ Tab : Admins -->
        <div id="admins" class="tab">
            <div class="header">Admins</div>
            <p> </p>
            <div class="tabContainer">
                <div class="btnBar">
                    <button onclick="tugglelist(0)">Accounts List</button> <button onclick="tugglelist(1)">Add New
                        Admin</button>
                </div>
                <div class="containerBudy listofadmins">
                    <div class="budyHeader">
                        <ul class="admin-ul">
                            <li>ID</li>
                            <li>Name</li>
                            <li>E-mail</li>
                            <li>Phone</li>
                            <li>Creation Date</li>
                            <li>Privilege Level</li>
                            <li>Up Date</li>
                            <li>Delete</li>
                        </ul>
                    </div>
                    <!-- A row for each record -->
                    <?php foreach ($users as $index => $user) {
                        if ($user['privilege_level'] != 0) {

                            echo "" .
                                "<div class='budyRow'>
                            <ul class='admin-ul'>
                            <li> " . $user['id_user'] . " </li>
                            <li>" . $user['fname'] . " " . $user['lname'] . "</li>
                            <li>" . $user['email'] . "</li>
                            <li>" . $user['phone'] . "</li>
                            <li>" . $user['create_at'] . "</li>
                            <li>" . $user['privilege_level'] . "</li>
                            <li><form action='admin.php' method='POST'><input type='hidden' name='updateAdmin' value='" . $index . "'><button class='upBTN' type='submit'>
                            <i class='fa-solid fa-pen-to-square'></i></button></form></li>
                            <li><form action='admin.php' method='POST'><input type='hidden' name='deleteAdmin' value='" . $user['id_user'] . "'><button class='delBTN' type='submit'>
                            <i class='fa-solid fa-trash-can'></i></button></form></li>
                            </ul>
                            </div>";
                        }
                    }
                    ?>
                </div>
                <!-- Add New Admin From -->
                <div class="newAdminForm">
                    <h3>Add New Administrator</h3>
                    <ul class="ul-container">
                        <form action="config.php" method="POST" id="formNewAdmin">
                            <li><label for="fnameAdmin">First Name </label><input type="text" name="fnameAdmin"
                                    id="fnameAdmin" placeholder="First Name" required></li>
                            <li><label for="lnameAdmin">Last Name </label><input name="lnameAdmin" type="text"
                                    id="lnameAdmin" placeholder="Last Name" required></li>
                            <li><label for="prefixAdmin">Prefix</label><select name="prefixAdmin" id="prefixAdmin"
                                    placeholder="Prefix" disabled>
                                    <option value="option">Disabled</option>
                                </select>
                            </li>
                            <li><label for="emailAdmin">E-mail</label><input name="emailAdmin" type="email"
                                    id="emailAdmin" placeholder="E-Mail" required></li>
                            <li><label for="passAdmin">Password</label><input name="passAdmin" type="password"
                                    id="passAdmin" placeholder="Password" required></li>
                            <li><label for="repeatAdmin">Confirm-pass</label><input name="repeatAdmin" type="password"
                                    id="repeatAdmin" placeholder="Repeat" required></li>
                            <li><label for="phoneAdmin">Phone#</label><input name="phoneAdmin" type="tel"
                                    id="phoneAdmin" placeholder="Tel Number"></li>
                            <li> <label for="privilegeAdmin">Access Level</label><select name="privilegeAdmin"
                                    id="privilegeAdmin">
                                    <option value="4">Limited</option>
                                    <option value="5">Root</option>
                                    <option value="3">Read Only</option>
                                    <option value="2">suspend</option>
                                </select></li>
                            <!-- <li><input name="addNewAdmin" type="submit" value="addNewAdmin"></li> -->
                            <li><button type="button" class="cancelUpdate" onclick="closeUpdateField(2)">Cancel</button>
                            </li>
                            <li><button class="cancelUpdate" name="addNewAdmin" type="submit" value="addNewAdmin">Add
                                    New Admin</button></li>
                        </form>
                    </ul>

                </div>

                <!-- Delete Message Box -->
                <div class="messageBox">
                    <div class="qustion">
                        <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="conformBTN">
                        <form action="config.php" method="POST">
                            <input type='hidden' name='delAdminUserID' value='<?php echo $_POST['deleteAdmin']; ?>'>
                            <input class="cancelUpdate" type="submit" value="Remove">
                            <button class="cancelUpdate" type="button">Cancle</button>
                        </form>
                    </div>
                </div>
                <!-- Update admin Field -->
                <div class="updateAdminForm">
                    <h3>Update Administrator</h3>
                    <ul class="ul-container">
                        <form action="config.php" method="POST" id="form-update-admin">
                            <input class="hidden-lis" type="text" name="adminIDUpdate" id="adminIDUpdate" value=''
                                hidden>
                            <li><label for="fnameUpdate">First Name </label>
                                <input type="text" name="fnameUpdate" id="fnameUpdate" placeholder="First Name"
                                    required>
                            </li>
                            <li><label for="lnameUpdate">Last Name </label>
                                <input name="lnameUpdate" type="text" id="lnameUpdate" placeholder="Last Name" required>
                            </li>
                            <li><label for="prefixUpdate">Prefix</label><select name="prefixUpdate" id="prefixUpdate"
                                    placeholder="Prefix" disabled>
                                    <option value="option">Disabled</option>
                                </select>
                            </li>
                            <li><label for="emailUpdate">E-mail</label>
                                <input name="emailUpdate" type="email" id="emailUpdate" placeholder="E-Mail" disabled>
                            </li>
                            <li><label for="phoneUpdate">Phone#</label>
                                <input name="phoneUpdate" type="tel" id="phoneUpdate" placeholder="Tel Number">
                            </li>
                            <li> <label for="privilegeUpdate">Access Level</label><select name="privilegeUpdate"
                                    id="privilegeUpdate">
                                    <option value="4">Limited</option>
                                    <option value="5">Root</option>
                                    <option value="3">Read Only</option>
                                    <option value="2">suspend</option>

                                </select></li>
                            <!-- <li><input class="cancelUpdate" name="updateAdminSubmit" type="submit" value="Update Admin"></li> -->
                            <li><button type="button" class="cancelUpdate" onclick="closeUpdateField(1)">Cancel</button>
                            </li>
                            <li><button class="cancelUpdate" id="updateAdminSubmit" type="submit">Update Admin</button>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ************************************************************  Tab : Settings -->
        <div id="settings" class="tab">
            <div class="header">Settings</div>
            <p> </p>
        </div>
        <!-- ************************************************************  Tab : Logout -->
        <div id="logout" class="tab">
            <div class="header">Exit</div>
            <div class="message-box">
                <p>Are you sure you want to log out?</p>
                <div>
                    <form action="signupin-action.php" method="POST">
                        <button type="button" onclick="showTab('home')" id="cancel" name="cancel"><i
                                class="fa-solid fa-arrow-left"></i> Back</button>
                        <button id="leave" name="leave" type="submit" value="Log Out"> Leave <i
                                class="fa-solid fa-person-walking-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- .tabContainer end-->

    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            if (tabId == "home") {
                document.querySelector(".sidebar ul li:last-child").classList.remove("selected");
                document.querySelector(".sidebar ul li:first-child").classList.add("selected");
            }
        }
        let dashItems = document.querySelectorAll(".sidebar ul li");
        dashItems.forEach(item => {
            item.addEventListener("click", function (e) {
                dashItems.forEach(i => i.classList.remove("selected"));
                e.target.classList.add("selected");
            });
        });


        // Add new user/admin Button - Display Fucntion
        function tugglelist(key) {
            if (key == 1) {
                document.querySelector(".newAdminForm").style.display = "block";
                document.querySelector(".listofadmins").style.display = "none";
                document.querySelector('#admins .messageBox').style.display = 'none';
                document.querySelector('#admins .updateAdminForm').style.display = 'none';
            } else if (key == 0) {
                document.querySelector(".newAdminForm").style.display = "none";
                document.querySelector(".listofadmins").style.display = "block";
                document.querySelector('#admins .messageBox').style.display = 'none';
                document.querySelector('#admins .updateAdminForm').style.display = 'none';
            } else if (key == 3) {
                document.querySelector(".newUserForm").style.display = "block";
                document.querySelector("#users .containerBudy").style.display = "none";
                document.querySelector('#users .messageBoxUser').style.display = 'none';
            } else if (key == 2) {
                document.querySelector(".newUserForm").style.display = "none";
                document.querySelector('#users .messageBoxUser').style.display = 'none';
                document.querySelector("#users .containerBudy").style.display = "block";
            } else if (key == 5) {
                document.querySelector(".newEventForm").style.display = "block";
                document.querySelector("#events .containerBudy").style.display = "none";
                document.querySelector('#events .eventDetailsSec').style.display = 'none';
                editorEvent();
            } else if (key == 4) {
                document.querySelector("#events .containerBudy").style.display = "block";
                document.querySelector(".newEventForm").style.display = "none";
                document.querySelector('#events .eventDetailsSec').style.display = 'none';
            }
        }

        // Cancel Button on Update/new forms - Display Fucntion
        function closeUpdateField(key) {
            if (key == 1) {
                document.querySelector('#admins .updateAdminForm').style.display = 'none';
                document.querySelector('#admins .containerBudy').style.display = 'block';
            } else if (key == 2) {
                document.querySelector('#admins .newAdminForm').style.display = 'none';
                document.querySelector('#admins .containerBudy').style.display = 'block';
            } else if (key == 4) {
                document.querySelector('#users .newUserForm').style.display = 'none';
                document.querySelector('#users .containerBudy').style.display = 'block';
            } else if (key == 3) {
                document.querySelector('#users .updateUserForm').style.display = 'none';
                document.querySelector('#users .containerBudy').style.display = 'block';
            } else if (key == 5) {
                document.querySelector('#events .newEventForm').style.display = 'none';
                document.querySelector('#events .containerBudy').style.display = 'block';
            } else if (key == 6) {
                document.querySelector('#events .eventDetailsSec').style.display = 'none';
                document.querySelector('#events .containerBudy').style.display = 'block';
            }
        }

        // Cancel Button on Confirm message - admin remove - Display Fucntion
        document.querySelector('#admins .conformBTN button').addEventListener("click", () => {
            document.querySelector('#admins .messageBox').style.display = 'none';
            document.querySelector('#admins .containerBudy').style.display = 'block';
        });

        // Cancel Button on Confirm message - User remove - Display Fucntion
        document.querySelector('#delUserCancel').addEventListener("click", () => {
            document.querySelector('#users .messageBoxUser').style.display = 'none';
            document.querySelector('#users .containerBudy').style.display = 'block';
        });

        // Cancel Button on Confirm message - User remove - Display Fucntion
        document.querySelector('#delEventCancel').addEventListener("click", () => {
            document.querySelector('#events .messageBoxUser').style.display = 'none';
            document.querySelector('#events .containerBudy').style.display = 'block';
        });


        function handleSuccessMessages() {
            const params = new URLSearchParams(window.location.search);

            if (params.get("successAdd") == 1) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("New record successfully added."); }, 500)
                };
            } else if (params.get("successAdd") == 0) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                tugglelist(1);
                window.onload = function () {
                    setTimeout(() => {
                        alert(`Email: "${params.get("EmailAddress")}" is already associated with another account. Please enter a different email address.`);
                    }, 500)
                };
            } else if (params.get("successAdd") == 2) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                tugglelist(1);
                window.onload = function () {
                    setTimeout(() => {
                        alert(`Password and Confirm Password are NOT matched.`);
                    }, 500)
                };
            }

            if (params.get("successDel")) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => {
                        alert("Record successfully removed.");
                    }, 500)
                };
            }

            if (params.get("successUpAdmin")) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("Admin record successfully updated."); }, 500)
                };
            }

            if (params.get("successUpUser")) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("User record successfully updated."); }, 500)
                };
            }

            if (params.get("successDelUser")) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => {
                        if (params.get("successDelUser") == 1) {
                            alert("Record successfully removed.");
                        } else {
                            alert("Query Failed: User not removed.");
                        }
                    }, 500)
                };
            }

            if (params.get("successDelEvent")) {
                showTab('events');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#eventli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => {
                        if (params.get("successDelEvent") == 1) {
                            alert("Event successfully removed.");
                        } else {
                            alert("Query Failed: Event not removed.");
                        }
                    }, 500)
                };
            }

            if (params.get("successUserAdd") == 1) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("User record successfully added."); }, 500)
                };
            } else if (params.get("successUserAdd") == 2) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                tugglelist(3);
                window.onload = function () {
                    setTimeout(() => { alert(`Password and Confirm Password are NOT matched.`); }, 500)
                };
            } else if (params.get("successUserAdd") == 0) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                tugglelist(3);
                window.onload = function () {
                    setTimeout(() => {
                        alert(`Email: "${params.get("EmailAddress")}" is already associated with another account. Please enter a different email address.`);
                    }, 500)
                };
            }


            if (params.get("successEventAdd")) {
                showTab('events');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#eventli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => {
                        alert("New Event successfully added.");
                    }, 500)
                };
            }

            if (params.get("successEventUpdate")) {
                let para = params.get("successEventUpdate");
                showTab('events');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#eventli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => {
                        if (para == 1) {
                            alert("Event successfully Updated.");
                        } else if (para == 2) {
                            alert("Update Failed: Image type not valid.");
                        } else if (para == 3) {
                            alert("Update Failed: File is too big, select a file smaller than 5MB.");
                        }
                    }, 500)
                };
            }
        }

        handleSuccessMessages();

        // create select input for states
        const states = [
            "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia",
            "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland",
            "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey",
            "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina",
            "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"
        ];
        function addStates(element) {
            const select = document.getElementById(element);
            states.forEach(state => {
                const option = document.createElement("option");
                option.value = state;
                option.textContent = state;
                select.appendChild(option);
            });
        }
        addStates("newEState");
        // add State in event update form
        addStates("upEState");

        // active/deactive event update Form to wirte in the form
        function disableInputs(value) {
            let inputs = document.querySelectorAll(".update-event");
            inputs.forEach(input => {
                input.disabled = value;
            });
            if (value == false) {
                document.querySelector("#upSelectEImgLI").style.visibility = "visible";
                inputs.forEach(input => {
                    input.classList.add("act-input");
                    document.querySelector('.eventDetailsSec h3:first-child').innerHTML = "Update Form";
                    document.querySelector('#li-event-edit-btn').style.display = "none";
                    document.querySelector('#event-update-submit').style.display = "block";
                });
            }
            // ----------------------  copy from editor to a hidden Input form @ "event-update-submit" in "eventDetailsUpdateForm"
            document.getElementById("event-update-submit").addEventListener("mouseenter", function () {
                document.getElementById('upeditorDelta').value = JSON.stringify(quill2.getContents());
            });
        }

        // function update image on event update form
        function initImagePreview(inputId, imgId) {
            const inputElement = document.getElementById(inputId);
            const imgElement = document.getElementById(imgId);

            if (!inputElement || !imgElement) {
                console.error("Id or pic not valid");
                return;
            }
            inputElement.addEventListener("change", function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imgElement.src = e.target.result;
                        imgElement.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        initImagePreview("upSelectEImg", "upEImg");

        <?php


        if (isset($_POST['deleteAdmin'])) {
            // Confirm Message before Remove Action - ADMIN - Display Function
            echo "showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                document.querySelector('#admins .messageBox').style.display = 'block';
                document.querySelector('#admins .containerBudy').style.display = 'none';";
        } elseif (isset($_POST['updateAdmin'])) {
            // Display and fill out ADMIN update form - Display Function
            $userIndex = isset($_POST['updateAdmin']) ? $_POST['updateAdmin'] : "undefined";
            echo "showTab('admins');
                    dashItems.forEach(item => { item.classList.remove('selected'); });
                    document.querySelector('#adminli').className = 'selected';
                    document.querySelector('#admins .updateAdminForm').style.display = 'block';
                    document.querySelector('#admins .containerBudy').style.display = 'none';
                    document.querySelector('.updateAdminForm #adminIDUpdate').value = '" . $users[$userIndex]['id_user'] . "';
                    document.querySelector('.updateAdminForm #fnameUpdate').value = '" . $users[$userIndex]['fname'] . "';
                    document.querySelector('.updateAdminForm #lnameUpdate').value = '" . $users[$userIndex]['lname'] . "';
                    document.querySelector('.updateAdminForm #emailUpdate').value = '" . $users[$userIndex]['email'] . "';
                    document.querySelector('.updateAdminForm #phoneUpdate').value = '" . $users[$userIndex]['phone'] . "';
                    document.querySelector('.updateAdminForm #privilegeUpdate').value = '" . $users[$userIndex]['privilege_level'] . "';
                    ";
        } elseif (isset($_POST['updateUser'])) {
            // Display and fill out USER update form - Display Function
            $userIndex = isset($_POST['updateUser']) ? $_POST['updateUser'] : "undefined";
            echo "showTab('users');
                    dashItems.forEach(item => { item.classList.remove('selected'); });
                    document.querySelector('#userli').className = 'selected';
                    document.querySelector('.updateUserForm').style.display = 'block';
                    document.querySelector('#users .containerBudy').style.display = 'none';
                    document.querySelector('.updateUserForm #userIDUpdate').value = '" . $users[$userIndex]['id_user'] . "';
                    document.querySelector('#fnameUpdateUser').value = '" . $users[$userIndex]['fname'] . "';
                    document.querySelector('#lnameUpdateUser').value = '" . $users[$userIndex]['lname'] . "';
                    document.querySelector('#emailUpdateUser').value = '" . $users[$userIndex]['email'] . "';
                    document.querySelector('#phoneUpdateUser').value = '" . $users[$userIndex]['phone'] . "';
                    document.querySelector('#privilegeUpdateUser').value = '" . $users[$userIndex]['privilege_level'] . "';
                    ";
        } elseif (isset($_POST['updateEvent'])) {
            // Display and fill out USER update form - Display Function
            $eventIndex = isset($_POST['updateEvent']) ? $_POST['updateEvent'] : "undefined";
            if ($events[$eventIndex]['img'] == null || $events[$eventIndex]['img'] == '') {
                $upDetImg = "public/upload/notset.jpg";
            } else {
                $upDetImg = $events[$eventIndex]['img'];
            }
            echo "const quill2 = new Quill('#upEeditor', {theme: 'snow'});";
            // fill out event update form from datebase data
            echo "showTab('events');
                    dashItems.forEach(item => { item.classList.remove('selected'); });
                    document.querySelector('#eventli').className = 'selected';
                    document.querySelector('.eventDetailsSec').style.display = 'block';
                    document.querySelector('#events .containerBudy').style.display = 'none';
                    document.querySelector('#events .containerBudy').style.display = 'none';
                    document.querySelector('#upEImg').src = '" . $upDetImg . "';
                    document.querySelector('#upEID').value = '" . $events[$eventIndex]['id_event'] . "';
                    document.querySelector('#upEname').value = '" . $events[$eventIndex]['name'] . "';
                    document.querySelector('#upEDate').value = '" . $events[$eventIndex]['date'] . "';
                    document.querySelector('#upEStartTime').value = '" . $events[$eventIndex]['start_time'] . "';
                    document.querySelector('#upEprice').value = '" . $events[$eventIndex]['base_price'] . "';
                    document.querySelector('#upEstreet').value = '" . $events[$eventIndex]['street'] . "';
                    document.querySelector('#location_id').value = '" . $events[$eventIndex]['location_id'] . "';
                    document.querySelector('#upEUnit').value = '" . $events[$eventIndex]['unit'] . "';
                    document.querySelector('#upECity').value = '" . $events[$eventIndex]['city'] . "';
                    document.querySelector('#First-option').value = '" . $events[$eventIndex]['state'] . "';
                    document.querySelector('#First-option').innerHTML= '" . $events[$eventIndex]['state'] . "';
                    document.querySelector('#upEZip').value = '" . $events[$eventIndex]['zip_code'] . "';
                    disableInputs(true);
                    ";
            // since Quill only accept Obj to insert - if it be null it would not fill the editor 
            if (!empty($events[$eventIndex]['description'])) {
                echo "let desJSON = " . $events[$eventIndex]['description'] . ";";
                echo "if (typeof desJSON === 'object') {";
                echo "quill2.setContents(desJSON);";
                echo "};";
            }

        } elseif (isset($_POST['deleteUser'])) {
            // Confirm Message before Remove Action - USER - Display Function
            echo "showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                document.querySelector('#users .messageBoxUser').style.display = 'block';
                document.querySelector('#users .containerBudy').style.display = 'none';";
        }

        if (isset($_POST['deleteEvent'])) {
            // Confirm Message before Remove Action - Event - Display Function
            echo "showTab('events');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#eventli').className = 'selected';
                document.querySelector('#events .messageBoxUser').style.display = 'block';
                document.querySelector('#events .containerBudy').style.display = 'none';";
        }
        ?>

        const quill = new Quill('#newEeditor', {
            theme: 'snow'
        });

        window.addEventListener('popstate', function (event) {
            let emailError = sessionStorage.getItem('emailError');
            if (emailError) {
                // نمایش پیام خطا
                alert(emailError);
                // پاک کردن پیام پس از نمایش
                sessionStorage.removeItem('emailError');
            }
        });




    </script>
</body>

</html>