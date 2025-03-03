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
            background: #3498db;
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

            background-color: rgb(161, 203, 231);
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

        .newAdminForm {
            width: 420px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: none;
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

        .newAdminul input[type="submit"] {
            margin-top: 15px;
            font-weight: 600;
        }

        .newAdminul input[type="submit"]:hover {
            background-color: #3498db45;
            border-color: #3498db;
            cursor: pointer;
        }

        .newAdminul input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .newAdminul input:hover {
            border-color: #555;
        }

        #upBTN,#delBTN{
            width: 40px;
            height: 20px;
            border: 1px solid rgb(145, 202, 240);
            background-color:rgb(207, 215, 224);
            border-radius: 2px;
            transition: all 200ms;
            }

            #delBTN:hover{
                border: 1px solid #007bff;
            background-color:#007bff;
            cursor: pointer;
            color:rgb(255, 255, 255);
            }

            #upBTN:hover{
                border: 1px solid rgb(255, 84, 84);
            background-color:rgb(225, 84, 74);
            cursor: pointer;
            color:rgb(255, 255, 255);
            }
        
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li class="selected" onclick="showTab('home')"><i class="fa-solid fa-house-user"> </i> Home</li>
            <li class="" onclick="showTab('tickets')"><i class="fa-solid fa-ticket"> </i> Tickets</li>
            <li class="" onclick="showTab('events')"><i class="fa-solid fa-calendar-xmark"></i> Events</li>
            <li class="" onclick="showTab('users')"><i class="fa-solid fa-users"></i> Users</li>
            <li class="" onclick="showTab('admins')"><i class="fa-solid fa-book-open-reader"></i> Admins</li>
            <li class="" onclick="showTab('settings')"><i class="fa-solid fa-gear"> </i> Settings</li>
            <li class="" onclick="showTab('logout')"><i class="fa-solid fa-arrow-right-from-bracket"> </i> Logout</li>
        </ul>
    </div>
    <div class="content">
        <div id="home" class="tab active">
            <div class="header">Welcome to the Dashboard</div>
            <p>Home content is displayed here.</p>
            <?php foreach ($userData as $data) {
                echo "$data <br>";
            } ?>
        </div>

        <div id="tickets" class="tab">
            <div class="header">Tickets</div>
            <p>tickets content is displayed here.</p>
        </div>

        <div id="events" class="tab">
            <div class="header">Events</div>
            <p>tickets content is displayed here.</p>
        </div>

        <div id="users" class="tab">
            <div class="header">Users</div>
            <p>tickets content is displayed here.</p>
        </div>

        <div id="admins" class="tab">
            <div class="header">Admins</div>
            <p>tickets content is displayed here.</p>
            <div class="tabContainer">
                <div class="btnBar">
                    <button onclick="tugglelist(0)">Accounts List</button> <button onclick="tugglelist(1)">Add New
                        Admin</button>

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
                    <?php foreach ($users as $user) {
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
                            <li><form action='config.php' method='POST'><input type='hidden' name='deleteAdmin' value=''><button id='delBTN' type='submit'>
                            <i class='fa-solid fa-pen-to-square'></i></button></form></li>
                            <li><form action='config.php' method='POST'><input type='hidden' name='deleteAdmin' value=''><button id='upBTN' type='submit'>
                            <i class='fa-solid fa-trash-can'></i></button></form></li>
                            </ul>
                            </div>";
                        }
                    }
                    ?>
                </div>
                <div class="newAdminForm">
                    <h3>Add New Administrator</h3>
                    <form action="config.php" method="POST">
                        <ul class="newAdminul">
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
                                    <option value="2">suspended</option>

                                </select></li>
                            <li><input name="addNewAdmin" type="submit" value="addNewAdmin"></li>
                        </ul>
                    </form>

                </div>
            </div>
        </div>

        <div id="settings" class="tab">
            <div class="header">Settings</div>
            <p>Settings content is displayed here.</p>
        </div>

        <div id="logout" class="tab">
            <div class="header">Exit</div>
            <div class="message-box">
                <p>Are you sure you want to log out?</p>
                <div>
                    <form action="../admin/signupin-action.php" method="POST">
                        <input id="leave" name="leave" type="submit" value="Log Out"></input>
                    </form>
                    <button onclick="showTab('home')" id="cancel" name="cancel">Back</button>
                </div>
            </div>
        </div>
    </div>

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
        console.log(dashItems);
        dashItems.forEach(item => {
            item.addEventListener("click", function (e) {
                dashItems.forEach(i => i.classList.remove("selected"));
                e.target.classList.add("selected");
            });
        });

        function tugglelist(key) {
            if (key) {
                document.querySelector(".newAdminForm").style.display = "block";
                document.querySelector(".containerBudy").style.display = "none";
            } else {
                document.querySelector(".newAdminForm").style.display = "none";
                document.querySelector(".containerBudy").style.display = "block";
            }
        }

        const params = new URLSearchParams(window.location.search);
        let success = params.get("success");
        if (success) {
            showTab('admins');
            setTimeout(function () {
                alert("New record successfully added.");
            }, 500);
        }


        // نمایش مقدار در صفحه
        document.getElementById("output").textContent = "مقدار دریافت شده: " + message;

    </script>
</body>

</html>