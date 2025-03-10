<?php
session_start();

// login check
if (!isset($_SESSION['user_data'])) {
    header("Location: user-login-form.php");
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
    <link rel="stylesheet" href="public/styles/nav.css">
    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/footer.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: block;

        }

        main {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 250px;
            background: #121315;
            color: white;
            height: 100vh;
            padding: 20px;
            margin-top: 75px;
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
            margin-top: 75px;
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
            padding-top: 25px;
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

        /* dashborad cards */
        .dash-cards {
            min-width: 500px;
            max-width: 700px;
            background-color: #efefef;
            ;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding-bottom: 10px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .dash-cards>div {
            display: flex;
            justify-content: space-evenly;
        }

        .dash-cards>h3 {
            text-align: center;
            line-height: 2;
            font-size: 1.6em;
            padding: 10px 0 15px 0;
        }

        .dash-cards .img-containner {
            width: 30%;

        }

        .dash-cards .info-containner {
            width: 64%;
            padding: 1% 0 1% 3%;
            font-size: 1.2em;
        }

        .dash-cards img {
            border: 2px solid #ffffff;
            width: 100%;
            border-radius: 5px;
        }

        .dash-cards p {
            display: inline-block;

        }

        .dash-cards ul li {
            border-top: 1px solid #9acdef;
            display: flex;
            align-items: center;
            padding-top: 15px;
        }

        .cards-ul li label {
            width: 120px;
            display: inline-block;
        }

        footer {
            display: block !important;
        }
    </style>


</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <main>
        <div class="sidebar">
            <h2>&nbsp;&nbsp;&nbsp;</h2>
            <ul>
                <li class="selected" onclick="showTab('home')"><i class="fa-solid fa-house-user"> </i> Dashboard</li>
                <li class="" onclick="showTab('tickets')"><i class="fa-solid fa-ticket"> </i> Tickets</li>
                <li class="" onclick="showTab('settings')"><i class="fa-solid fa-gear"> </i> Settings</li>
                <li class="" onclick="showTab('logout')"><i class="fa-solid fa-arrow-right-from-bracket"> </i> Logout
                </li>
            </ul>
        </div>
        <div class="content">
            <!-- Dashboard contain area -->
            <div id="home" class="tab active">
                <div class="header">Welcome to the Dashboard</div>
                <br>

                <!-- <?php foreach ($userData as $data) {
                    echo "$data <br>";
                } ?> -->

                <div class="dash-cards">
                    <h3>User Info</h3>
                    <div>
                        <div class="img-containner">
                            <img src="https://picsum.photos/75/75" alt="">
                        </div>
                        <div class="info-containner">
                            <ul class="cards-ul">
                                <li>
                                    <label for="">Full Name:</label>
                                    <p><?php echo $userData['fname'] . " " . $userData['lname'] ?></p>
                                </li>
                                <li>
                                    <label for="">Tel Number:</label>
                                    <p><?php echo $userData['phone'] ?></p>
                                </li>
                                <li>
                                    <label for="">Email:</label>
                                    <p><?php echo $userData['email'] ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>



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
                        <form action="signupin-action.php" method="POST">
                            <input id="leave" name="leave" type="submit" value="Log Out"></input>
                        </form>
                        <button onclick="showTab('home')" id="cancel" name="cancel">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include("footer.php");
        ?>
    </footer>
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

        <?php
        if (isset($_GET['logout'])) {
            echo "showTab('logout');";
        }
        ?>
    </script>
</body>

</html>