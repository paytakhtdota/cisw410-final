<?php
require_once("connection.php");

$usersQuery = $pdo->prepare("SELECT * FROM users");
$usersQuery->execute();
$users = $usersQuery->fetchAll(PDO::FETCH_ASSOC);

$ticketsQuery = $pdo->prepare("SELECT * FROM tickets");
$ticketsQuery->execute();
$tickets = $ticketsQuery->fetchAll(PDO::FETCH_ASSOC);

$eventsQuery = $pdo->prepare("SELECT * FROM events");
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
    <style>
        * {
            box-sizing: border-box;
        }

        ul,
        li,
        ol {
            padding: 0;
            margin: 0;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;

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
            padding: 7px;
        }

        .btnBar>button:hover {
            scale: 1.1;
        }

        .admin-ul {
            display: flex;
            width: 100%;
            justify-content: flex-start;
            text-align: center;
            padding: 10px 0 0 5px;
            align-content: center;
            align-items: center;

        }

        .admin-ul li {
            list-style-type: none;
            min-height: 30px;
        }

        .admin-ul li:first-child {
            width: 5%;
            min-width: 50px;
            border-bottom: 1px solid #3498db;
        }

        .admin-ul li:nth-child(2) {
            width: 20%;
            min-width: 120px;
            border-bottom: 1px solid #3498db;
        }

        .admin-ul li:nth-child(3) {
            width: 20%;
            min-width: 120px;
            border-bottom: 1px solid #3498db;
        }

        .admin-ul li:nth-child(4) {
            width: 15%;
            min-width: 70px;
            border-bottom: 1px solid #3498db;
        }

        .admin-ul li:nth-child(5) {
            width: 15%;
            min-width: 120px;
            border-bottom: 1px solid #3498db;
        }

        .admin-ul li:nth-child(6) {
            width: 15%;
            min-width: 120px;
            border-bottom: 1px solid #3498db;
        }

        .admin-ul li:nth-child(7) {
            width: 5%;
            min-width: 120px;
            border-bottom: 1px solid #3498db;
        }

        .admin-ul li:nth-child(8) {
            width: 5%;
            min-width: 120px;
            border-bottom: 1px solid #3498db;
        }

        .budyHeader .admin-ul {

            background-color: rgba(227, 176, 75, 0.62);
            font-weight: 600;
            padding-top: 10px;
        }

        .budyRow:nth-child(even) {
            background-color: rgb(250, 250, 250);
        }

        .budyRow:nth-child(odd) {
            background-color: rgb(247, 247, 247);
        }

        .addPaddingTop5px {}

        .newAdminForm,
        .newUserForm {
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
        .newAdminul select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            outline: none;
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
            width: 40px;
            height: 20px;
            border: 1px solid rgb(145, 202, 240);
            background-color: rgb(207, 215, 224);
            border-radius: 2px;
            transition: all 200ms;
        }

        .upBTN:hover {
            border: 1px solid #e3b04b;
            background-color: rgba(227, 176, 75, 0.55);
            cursor: pointer;
            color: rgb(255, 255, 255);
        }

        .delBTN:hover {
            border: 1px solid rgb(255, 84, 84);
            background-color: rgb(225, 84, 74);
            cursor: pointer;
            color: rgb(255, 255, 255);
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
                            <li><label for="fnameUpdate">First Name </label><input type="text" name="fnameUpdateUser"
                                    id="fnameUpdate" placeholder="First Name" required></li>
                            <li><label for="lnameUpdate">Last Name </label><input name="lnameUpdateUser" type="text"
                                    id="lnameUpdate" placeholder="Last Name" required></li>
                            <li><label for="prefixUpdate">Prefix</label><select name="prefixUpdateUser"
                                    id="prefixUpdate" placeholder="Prefix" disabled>
                                    <option value="option">option</option>
                                </select>
                            </li>
                            <li><label for="emailUpdate">E-mail</label><input name="emailUpdateUser" type="email"
                                    id="emailUpdate" placeholder="E-Mail" disabled></li>
                            <li><label for="phoneUpdate">Phone#</label><input name="phoneUpdateUser" type="tel"
                                    id="phoneUpdate" placeholder="Tel Number"></li>
                            <li> <label for="privilegeUpdate">Access Level</label><select name="privilegeUpdateUser"
                                    id="privilegeUpdate">
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
        <!-- ************************************************************  Tab : Settings -->
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
                    alert("New record successfully added.");
                };
            }

            if (params.get("successDel")) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                window.onload = function () {
                    alert("Record successfully removed.");
                };
            }

            if (params.get("successUpAdmin")) {
                showTab('admins');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#adminli').className = 'selected';
                window.onload = function () {
                    alert("Admin record successfully updated.");
                };
            }

            if (params.get("successUpUser")) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                window.onload = function () {
                    alert("User record successfully updated.");
                };
            }

            if (params.get("successDelUser")) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                window.onload = function () {
                    alert("Record successfully removed.");
                };
            }

            if (params.get("successUserAdd")) {
                showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                window.onload = function () {
                    alert("User record successfully added.");
                };
            }
        }

        handleSuccessMessages();


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
                    document.querySelector('.containerBudy').style.display = 'none';
                    document.querySelector('.updateUserForm #userIDUpdate').value = '" . $users[$userIndex]['id_user'] . "';
                    document.querySelector('#fnameUpdate').value = '" . $users[$userIndex]['fname'] . "';
                    document.querySelector('#lnameUpdate').value = '" . $users[$userIndex]['lname'] . "';
                    document.querySelector('#emailUpdate').value = '" . $users[$userIndex]['email'] . "';
                    document.querySelector('#phoneUpdate').value = '" . $users[$userIndex]['phone'] . "';
                    document.querySelector('#privilegeUpdate').value = '" . $users[$userIndex]['privilege_level'] . "';
                    ";
        } elseif (isset($_POST['deleteUser'])) {
            // Confirm Message before Remove Action - USER - Display Function
            echo "showTab('users');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#userli').className = 'selected';
                document.querySelector('.messageBoxUser').style.display = 'block';
                document.querySelector('#users .containerBudy').style.display = 'none';";
        }
        ?>
    </script>
</body>

</html>