<?php
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

        .btnBar button {
            border-radius: 8px;
            border: 1px solid #fff8e5;
            height: 40px;
            width: 120px;
            background-color: #ffe39d;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }

        .btnBar button:hover {
            cursor: pointer;
            transition: all 0.3s;
            background-color: rgba(227, 176, 75, 0.62)
        }

        .sidebar {
            width: 250px;
            background: rgb(28, 44, 60);
            color: white;
            height: 100vh;
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
        }

        .header {
            background: #B8860B;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            border-radius: 8px;
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
            width: 400px;
            height: 140px;
            border: 1px solid #000000;
            font-size: 18px;
            text-align: center;
            padding-top: 25px 10px;
            border-radius: 8px;
            background-color: rgb(222, 222, 222);
            margin: 150px auto;
        }

        .message-box>div {
            margin-top: 30px;
            display: flex;
            justify-content: space-around;
        }

        #leave,
        #cancel {
            width: 100px;
            height: min-content;
            background-color: #fff;
            padding: 10px 15px 10px 15px;
            border-radius: 10px;
            text-decoration: none;
            color: #3498db;
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid #3498db;
        }

        #leave:hover,
        #cancel:hover {
            color: rgb(255, 255, 255);
            background-color: #3498db;
        }

        .tabContainer {
            width: 100%;
            min-height: 300px;
            padding: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            gap: 5px;
        }

        .containerBudy {
            width: 100%;
            min-height: 300px;
            padding: 0;
        }

        .btnBar {
            width: 100%;
            min-height: 50px;
            display: flex;
            justify-content: flex-start;
            align-content: center;
            gap: 15px;
            padding: 7px 0 15px 7px;
        }

        .btnBar>button:hover {
            scale: 1.1;
        }

        .admin-ul {
            display: flex;
            width: 100%;
            /* justify-content: flex-start; */
            justify-content: space-between;
            text-align: center;
            padding: 10px 0 0 5px;
            align-content: center;
            align-items: center;
            border-bottom: 1px solid #3498db;

        }

        .admin-ul li {
            list-style-type: none;
            min-height: 30px;
        }

        .admin-ul li:first-child {
            width: 5%;
            min-width: 50px;
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

            background-color: rgba(227, 176, 75, 0.62);
            font-weight: 600;
            padding-top: 10px;
        }

        .budyRow {
            display: flex;
            justify-content: space-between;
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

        .addPaddingTop5px {}

        .newAdminForm,
        .newUserForm,
        .newEventForm {
            width: 420px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: none;
            margin: 10px auto;
        }

        .newAdminul {
            list-style-type: none;
        }

        .newAdminul label {
            display: inline-block;
            width: 120px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin: 10px 0 0 5px;
        }

        .newAdminul input,
        .newAdminul select,
        .newAdminul textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            outline: none;
        }

        .newAdminul textarea {
            transition: none;
        }

        .newAdminul input[type="submit"],
        .cancelUpdate {
            margin-top: 15px;
            font-weight: 600;
        }

        .newAdminul input[type="submit"]:hover,
        .cancelUpdate:hover {
            background-color: rgba(184, 135, 11, 0.15);
            border-color: #B8860B;
            cursor: pointer;
        }


        .newAdminul input:focus {
            border-color: #B8860B;
            box-shadow: 0 0 5px #B8860B55;
        }

        .newAdminul input:hover {
            border-color: rgb(163, 119, 9);
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
            height: 150px;
            border: solid 1px #e3b04b;
            background-color: rgba(227, 176, 75, 0.06);
            text-align: center;
            padding: 15px 10px;
            margin: 15px auto;
            display: none;
        }

        .conformBTN {
            display: flex;
            justify-content: space-evenly;
        }

        .conformBTN input[type="submit"],
        .conformBTN button {
            width: 90px;
            height: 35px;
            font-size: 16px;
        }

        .qustion {
            margin-bottom: 25px;
        }

        /* update admin form */
        .updateAdminForm,
        .updateUserForm {
            display: none;
            width: 480px;
            border: 1px solid #cdcdcd;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 10px auto;
            box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;
        }


        .cancelUpdate {
            width: 100%;
            height: 38px;
            border-radius: 5px;
            border: 2px solid #cdcdcd;
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
            width: fit-content;
            min-width: 700px;
            border-radius: 8px;
            display: none;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
            padding: 2%;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }

        .eventDetailsSec label {
            font-weight: 600;
            display: inline-block;
            width: 100px;
        }

        .eventDetailsSec ul {
            width: 45%;
        }

        .eventDetailsSec li {
            height: min-content;
            padding: 5px;
        }

        .event-detail-second-col li:first-child {
            visibility: hidden;
        }

        .eventDetailsSec input,
        .eventDetailsSec select,
        .eventDetailsSec textarea {
            width: 100%;
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            outline: none;
        }

        .eventDetailsSec input:focus,
        .eventDetailsSec textarea:focus {
            background-color: rgb(239, 250, 255);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
        }

        .eventDetailsSec textarea {
            transition: none;
        }

        .event-detail-first-col img {
            width: 330px;
            height: 200px;
            border: 2px solid #ffe39d;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .eventDetailsSec button,
        .eventDetailsSec input[type='submit'] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            outline: none;
            font-weight: 600;
        }

        #event-update-submit {
            display: none;
            margin-top: -10px;
        }

        .eventDetailsSec button:hover,
        #event-update-submit:hover {
            border: 2px solid #ffe39d;
            cursor: pointer;
            background-color: rgb(254, 249, 238);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
        }


        .act-input {
            border: 2px solid #ffebb5 !important;
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
            <p>Home content is displayed here.</p>

        </div>
        <!-- ************************************************Tickets Tab Cantain -->
        <div id="tickets" class="tab">
            <div class="header">Tickets</div>
            <p>tickets content is displayed here.</p>
        </div>
        <!-- ************************************************event Tab Cantain -->
        <div id="events" class="tab">
            <div class="header">Events</div>
            <p>tickets content is displayed here.</p>
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
                            <li><form action='admin.php' method='POST'><input type='hidden' name='deleteEvent' value='" . $event['id_event'] . "'><button class='delBTN' type='submit'>
                            <i class='fa-regular fa-trash-can'></i></button></form></li>
                            </ul>
                            </div>";
                    }
                    ?>
                </div>
                <!-- Add New Event From -->
                <div class="newEventForm">
                    <h3>Add New Event</h3>
                    <ul class="newAdminul">
                        <form action="config.php" method="POST" enctype="multipart/form-data" id="formNewEvent">
                            <li><label for="newEname">Event Name<i class="required-fields">*</i></label>
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
                                <input type="number" id="newEprice" name="newEprice" placeholder="0.00"
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
                            <h4>Address:</h4>
                            <li><label for="newEstreet">Street<i class="required-fields">*</i></label>
                                <input name="newEstreet" type="text" id="newEstreet" placeholder="Street" required>
                            </li>
                            <li><label for="newEUnit">Unit</label>
                                <input name="newEUnit" type="text" id="newEUnit" placeholder="Street">
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
                            <li><input id="addNewEvent" name="addNewEvent" type="submit" value="Add New Event"></li>
                        </form>
                        <li><button class="cancelUpdate" onclick="closeUpdateField(5)">Cancel</button></li>
                    </ul>
                </div>

                <!-- Event Detail window -->
                <section class="eventDetailsSec">

                    <ul class="event-detail-first-col">
                        <li>
                            <h3>Event Details:</h3>
                        </li>
                        <li><img id="upEImg" src="" alt=""></li>
                        <form action="config.php" method="POST" enctype="multipart/form-data"
                            id="eventDetailsUpdateForm">
                            <li><label for="upEID">ID:</label>
                                <input type="upEID" name="upEID" id="upEID" required readonly>
                            </li>
                            <li><label for="upEname">Title:</label>
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
                                <input type="number" id="upEprice" name="upEprice" placeholder="0.00"
                                    title="Enter a valid Price (e.g., 100 or 99.99)" required>
                            </li>
                            <li>
                                <br>
                                <button id="event-edit-btn" type="button" onclick="disableInputs(false)">Edit
                                    Event</button>
                            </li>
                            <li>
                                <!-- submit button to send update information to config.php -->
                                <input type="submit" id="event-update-submit" name="event-update-submit" value="Submit">
                            </li>
                    </ul>
                    <ul class="event-detail-second-col">
                        <li><label for="upSelectEImg">New Image:</label><input type="file" name="upSelectEImg"
                                id="upSelectEImg" accept="image/jpeg,image/png,image/gif">
                        </li>
                        <li><label for="upEeditor">Details</label>
                            <div id="upEeditor"></div>
                            <input type="hidden" name="upeditorDelta" id="upeditorDelta">
                        </li>
                        <li><label>Address:</label>
                        </li>
                        <li><label for="upEstreet">Street<i class="required-fields">*</i></label>
                            <input name="location_id" type="number" id="location_id" hidden>
                            <input class="update-event" name="upEstreet" type="text" id="upEstreet" placeholder="Street"
                                required>
                        </li>
                        <li><label for="upEUnit">Unit</label>
                            <input class="update-event" name="upEUnit" type="text" id="upEUnit" placeholder="Street">
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
                        </form>
                        <li>
                            <br>
                            <button type="button" onclick="closeUpdateField(6)">close</button>
                        </li>
                    </ul>
                </section>

            </div>
        </div>
        <!-- ************************************************ user Tab Cantain -->
        <div id="users" class="tab">
            <div class="header">Users</div>
            <p>tickets content is displayed here.</p>
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
                    <ul class="newAdminul">
                        <form action="config.php" method="POST">
                            <li><label for="fnameUser">First Name </label>
                                <input type="text" name="fnameUser" id="fnameUser" placeholder="First Name" required>
                            </li>
                            <li><label for="lnameUser">Last Name </label>
                                <input name="lnameUser" type="text" id="lnameUser" placeholder="Last Name" required>
                            </li>
                            <li><label for="prefixUser">Prefix</label>
                                <select name="prefixUser" id="prefixUser" placeholder="Prefix" disabled>
                                    <option value="option">option</option>
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
                            <li><input name="addNewUser" type="submit" value="addNewUser"></li>
                        </form>
                        <li><button class="cancelUpdate" onclick="closeUpdateField(4)">Cancel</button></li>
                    </ul>
                </div>
                <!-- Delete Message Box -->
                <div class="messageBoxUser">
                    <div class="qustion">
                        <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="conformBTN">
                        <form action="config.php" method="POST"><input type='hidden' name='delUserID'
                                value='<?php echo $_POST['deleteUser']; ?>'><input type="submit" value="Remove"></form>
                        <!-- cancel button -->
                        <button id="delUserCancel">Cancle</button>
                    </div>
                </div>
                <!-- Update User Field -->
                <div class="updateUserForm">
                    <h3>Update User Information</h3>
                    <ul class="newAdminul">
                        <form action="config.php" method="POST">
                            <li><input type="text" name="userIDUpdate" id="userIDUpdate" value='' hidden></li>
                            <li><label for="fnameUpdateUser">First Name </label><input type="text"
                                    name="fnameUpdateUser" id="fnameUpdateUser" placeholder="First Name" required></li>
                            <li><label for="lnameUpdateUser">Last Name </label><input name="lnameUpdateUser" type="text"
                                    id="lnameUpdateUser" placeholder="Last Name" required></li>
                            <li><label for="prefixUpdate">Prefix</label><select name="prefixUpdateUser"
                                    id="prefixUpdateUser" placeholder="Prefix" disabled>
                                    <option value="option">option</option>
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
                            <li><input name="updateUserSubmit" type="submit" value="Update Admin"></li>
                        </form>
                        <li><button class="cancelUpdate" onclick="closeUpdateField(3)">Cancel</button></li>
                    </ul>
                </div>
            </div><!-- .tabContainer end-->
        </div>
        <!-- ************************************************ Tab : Admins -->
        <div id="admins" class="tab">
            <div class="header">Admins</div>
            <p>tickets content is displayed here.</p>
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
                    <ul class="newAdminul">
                        <form action="config.php" method="POST">
                            <li><label for="fnameAdmin">First Name </label><input type="text" name="fnameAdmin"
                                    id="fnameAdmin" placeholder="First Name" required></li>
                            <li><label for="lnameAdmin">Last Name </label><input name="lnameAdmin" type="text"
                                    id="lnameAdmin" placeholder="Last Name" required></li>
                            <li><label for="prefixAdmin">Prefix</label><select name="prefixAdmin" id="prefixAdmin"
                                    placeholder="Prefix" disabled>
                                    <option value="option">option</option>
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
                            <li><input name="addNewAdmin" type="submit" value="addNewAdmin"></li>
                        </form>
                        <li><button class="cancelUpdate" onclick="closeUpdateField(2)">Cancel</button></li>
                    </ul>

                </div>

                <!-- Delete Message Box -->
                <div class="messageBox">
                    <div class="qustion">
                        <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="conformBTN">
                        <form action="config.php" method="POST"><input type='hidden' name='delAdminUserID'
                                value='<?php echo $_POST['deleteAdmin']; ?>'><input type="submit" value="Remove"></form>
                        <button>Cancle</button>
                    </div>
                </div>
                <!-- Update admin Field -->
                <div class="updateAdminForm">
                    <h3>Update Administrator</h3>
                    <ul class="newAdminul">
                        <form action="config.php" method="POST">
                            <li><input type="text" name="adminIDUpdate" id="adminIDUpdate" value='' hidden></li>
                            <li><label for="fnameUpdate">First Name </label>
                                <input type="text" name="fnameUpdate" id="fnameUpdate" placeholder="First Name"
                                    required>
                            </li>
                            <li><label for="lnameUpdate">Last Name </label>
                                <input name="lnameUpdate" type="text" id="lnameUpdate" placeholder="Last Name" required>
                            </li>
                            <li><label for="prefixUpdate">Prefix</label><select name="prefixUpdate" id="prefixUpdate"
                                    placeholder="Prefix" disabled>
                                    <option value="option">option</option>
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
                            <li><input name="updateAdminSubmit" type="submit" value="Update Admin"></li>
                        </form>
                        <li><button class="cancelUpdate" onclick="closeUpdateField(1)">Cancel</button></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ************************************************************  Tab : Settings -->
        <div id="settings" class="tab">
            <div class="header">Settings</div>
            <p>Settings content is displayed here.</p>
        </div>
        <!-- ************************************************************  Tab : Logout -->
        <div id="logout" class="tab">
            <div class="header">Exit</div>
            <div class="message-box">
                <p>Are you sure you want to log out?</p>
                <div>
                    <form action="signupin-action.php" method="POST">
                        <input id="leave" name="leave" type="submit" value="Log Out"></input>
                    </form>
                    <button onclick="showTab('home')" id="cancel" name="cancel">Back</button>
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


        function handleSuccessMessages() {
            const params = new URLSearchParams(window.location.search);

            if (params.get("successAdd")) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("New record successfully added."); }, 500)
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
                        alert("Record successfully removed.");
                    }, 500)
                };
            }

            if (params.get("successUserAdd")) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("User record successfully added."); }, 500)
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
                document.querySelector(".event-detail-second-col li:first-child").style.visibility = "visible";
                inputs.forEach(input => {
                    input.classList.add("act-input");
                    document.querySelector('.event-detail-first-col h3:first-child').innerHTML = "Update Form";
                    document.querySelector('#event-edit-btn').style.display = "none";
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
                    document.querySelector('.updateAdminForm #IDUpdate').value = '" . $users[$userIndex]['id_user'] . "';
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
                    document.querySelector('.eventDetailsSec').style.display = 'flex';
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
                document.querySelector('.messageBoxUser').style.display = 'block';
                document.querySelector('#users .containerBudy').style.display = 'none';";
        }
        ?>

        const quill = new Quill('#newEeditor', {
            theme: 'snow'
        });

        function upEditorEvent() {

        }

        function editorEvent() {
            document.getElementById("addNewEvent").addEventListener("mouseenter", function () {
                document.getElementById('neweditorDelta').value = JSON.stringify(quill.getContents());
                console.log(JSON.stringify(quill.getContents()));
            });
        }

    </script>
</body>

</html>