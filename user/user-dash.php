<?php
session_start();

// بررسی اینکه آیا کاربر لاگین کرده یا نه
if (!isset($_SESSION['user_data'])) {
    header("Location: ../user-login-form.php");
    exit();
} else {
    $userData = $_SESSION['user_data'];
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
    <style>
        * {
            box-sizing: border-box;
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

        .sidebar ul li {
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

        #leave , #cancel{
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

        #leave:hover  , #cancel:hover {
            color: rgb(255, 255, 255);
            background-color: #3498db;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li class="selected" onclick="showTab('home')"><i class="fa-solid fa-house-user"> </i> Home</li>
            <li class="" onclick="showTab('tickets')"><i class="fa-solid fa-ticket"> </i> Tickets</li>
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
        <div id="settings" class="tab">
            <div class="header">Settings</div>
            <p>Settings content is displayed here.</p>
        </div>
        <div id="logout" class="tab">
            <div class="header">Exit</div>
            <div class="message-box">
                <p>Are you sure you want to log out?</p>
                <div>
                    <form action="../admin/signupin-action.php" method="POST" >
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
            if(tabId == "home"){
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

    </script>
</body>

</html>