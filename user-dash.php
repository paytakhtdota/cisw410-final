<?php
session_start();

// login check
if (!isset($_SESSION['user_data'])) {
    header("Location: user-login-form.php");
    exit();
} else {
    $tempData = $_SESSION['user_data'];
    require_once("connection.php");
    $quiry = $pdo->prepare("SELECT * FROM users WHERE id_user=:id_user");
    $quiry->execute([":id_user" => $tempData['id_user']]);
    $userData = $quiry->fetch(PDO::FETCH_ASSOC);

    $search = "";
    if (isset($_POST['search-submit'])) {
        $searchTerm = trim($_POST['searchBar-event']);
        $search = preg_replace('/[%&*)($@#!+=]/', '', $searchTerm);
    }

    // query events
    $rowCountQuery = $pdo->prepare("SELECT COUNT(id_event) as count FROM events WHERE name LIKE :search");
    $rowCountQuery->bindValue(':search', '%' . $search . '%');
    $rowCountQuery->execute();
    $rowCount = $rowCountQuery->fetch();
    $totalRows = $rowCount['count'];
    echo '<script>console.log(' . $totalRows . ')</script>';


    if (isset($_GET['pageNumber'])) {
        $pgs = (int) $_GET['pageNumber'];
        $start = ($pgs - 1) * 10;
        $eventsQuery = $pdo->prepare("SELECT * FROM events WHERE name LIKE :search ORDER BY date LIMIT :start, 10");
        $eventsQuery->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $eventsQuery->bindValue(':start', $start, PDO::PARAM_INT);
        $eventsQuery->execute();
        $events = $eventsQuery->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $eventsQuery = $pdo->prepare("SELECT * FROM events WHERE name LIKE :search ORDER BY date LIMIT 10");
        $eventsQuery->bindValue(':search', '%' . $search . '%');
        $eventsQuery->execute();
        $events = $eventsQuery->fetchAll(PDO::FETCH_ASSOC);
    }
}

function pagenationNumber($rows)
{
    for ($i = 1; $i <= ceil($rows / 10); $i++) {
        echo "<li><a class='page-number' href='user-dash.php?pageNumber=" . $i . "'>" . $i . "</a></li>";
    }
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
            box-sizing: border-box;
        }

        main {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            max-width: 250px;
            background: #121315;
            color: white;
            padding: 20px;
            margin-top: 75px;
            flex-grow: 1;
            max-width: 300px;
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
            background-color: #202020;
            border-radius: 8px;
            padding: 20px;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
            border-top: rgb(222, 222, 222) solid 2px;
        }

        .dash-cards>div {
            display: flex;
            justify-content: space-evenly;
        }

        .dash-cards h3 {
            display: block;
            font-family: 'DM Serif Display';
            letter-spacing: 1px;
            text-align: center;
            line-height: 0.8;
            margin-bottom: 10px;
            font-size: 1.5em;
            color: #B8860B;
            padding-bottom: 15px;
        }

        .dash-cards .img-containner {
            width: 40%;
            min-width: 230px;
        }

        .dash-cards .info-containner {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 64%;
            padding: 1% 0 0 3%;
            font-size: 1.2em;
            min-width: 260px;
        }

        .dash-cards img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 5px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
        }

        .dash-cards p {
            display: block;
            font-family: "DM Serif Display", serif, "Poppins", sans-serif;
            letter-spacing: 1px;
            font-weight: 400;
            font-size: 19px;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .dash-cards ul li {}

        .cards-ul li label {
            font-family: "Arial", "Poppins", sans-serif;
            display: block;
            color: #efae0a;
            font-size: 16px;
            margin: 0;
            padding-bottom: 10px;
            line-height: 0.3;
        }

        footer {
            display: block !important;
        }

        /* button */

        .button-1 {
            width: 100%;
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

        .button-1:hover {
            width: 100%;
            height: 40px;
            margin-top: 10px;
            border-radius: 4px;
            border-color: #B8860B;
            background-color: #b8860b00;
            color: #B8860B;
            cursor: pointer;
        }

        #updatePhotoBTN {
            margin-bottom: 7px;
        }

        .container-small {
            width: fit-content;
            height: fit-content;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
            padding: 10px 10px 15px 10px;
            margin: 20px auto;
            border-radius: 8px;
            background-color: #f9f9f9;
            display: none;
            border-top: rgb(222, 222, 222) solid 2px;
        }

        .container-small img {
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            width: 250px;
            height: 250px;
            margin: 25px calc(50% - 125px);
        }

        input[type='file'] {
            width: 100%;
            background-color: #fff5dc;
            padding: 5px;
            margin-top: 5px;
        }

        input:focus {
            background-color: rgb(223, 235, 255);
        }

        #updatePhoto {
            margin-bottom: 10px;
        }

        .updateUserForm {
            display: none;
            width: 480px;
            padding: 15px 10px 15px 10px;
            border-radius: 8px;
            margin: 10px auto;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
            border-top: rgb(222, 222, 222) solid 2px;
        }

        .userul input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            outline: none;
        }

        /* Events tab style **************** Events tab style ********/
        #tab-container-event {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            justify-content: flex-start;
            max-width: 1720px;
            margin: 0 auto;
        }

        .searchbar-div {
            min-height: 70px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
            padding-top: 20px;
            padding-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            overflow: hidden;
        }

        .searchbar-div form {
            width: 70%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #searchBar-event,
        #searchBar-event:hover {
            margin: 0;
            padding: 6px 12px;
            min-width: 50%;
            flex-grow: 1;
            height: 50px;
            font-size: 1.4em;
            border: 2px solid #B8860B;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            border-right: none;
            transition: all 0.3s;
        }

        #searchBar-event:focus {
            outline: none;
            border: 2px solid #B8860B;
            border-right: none;
        }

        #search-submit {
            width: 130px;
            margin: 0;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            height: 50px;
            border: 2px solid #B8860B;
            background-color: #B8860B;
            color: #ffffff;
            font-family: "Roboto", sans-serif;
            font-size: 18px;
            outline: none;
            border-left: none;
            transition: all 0.3s;
        }

        #search-submit:hover {
            color: #000000;
            background-color: #f1be3b;
            border-left: none;
            cursor: pointer;
        }

        .event-card {
            width: 320px;
            padding: 15px;
            height: 600px;
            background-color: #202020;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
            margin-bottom: 20px;
            transition: all 0.5s;
        }

        .event-card:hover {
            box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
        }

        #event-card-img {
            width: 289px;
            height: 289px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .labels-details {
            display: block;
            font-size: 16px;
            font-style: normal;
            color: hsl(43, 92.00%, 48.80%);
        }

        .event-details {
            flex-grow: 1;
        }

        .ul-details {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .ul-details li {}

        .ul-details button {
            width: 100%;
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

        .ul-details button:hover {
            width: 100%;
            height: 40px;
            margin-top: 10px;
            border-radius: 4px;
            border-color: #B8860B;
            background-color: #b8860b00;
            color: #B8860B;
            cursor: pointer;
        }

        .note-details {
            font-family: "DM Serif Display", serif;
            font-style: normal;
            font-size: 18px;
            color: white;
            word-wrap: break-word;
            overflow-wrap: break-word;
            letter-spacing: 1px;
        }

        .pagination-sention {
            display: flex;
            height: 75px;
            width: 100%;
            justify-content: center;
            margin-top: 50px;
            font-family: "Poppins";
        }

        .pagination-ul {
            display: flex;
            height: 71px;
            width: 100%;
            justify-content: center;
            gap: 20px;
        }


        .page-number,
        .page-number:visited {
            display: flex;
            width: 40px;
            height: 40px;
            border: 1px solid #20202075;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            font-size: 20px;
            color: #656565;
            transition: all 0.2s;
        }

        .page-number:hover {
            border: 1px solid #ffb700;
            color: #B8860B;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
            scale: 1.06;
        }

        .page-number-selected {
            display: flex;
            width: 40px;
            height: 40px;
            border: 1px solid #B8860B;
            background-color: #B8860B;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            font-size: 20px;
            color: rgb(255, 255, 255);
            box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .dialog-box-container {
            display: none;
            box-sizing: border-box;
            position: fixed;
            left: 0;
            top: 0;
            min-width: 100%;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: grayscale(100%);
            z-index: 999;
        }
    </style>
    <script>
        function selectedPage(pageNum) {
            console.log("page number >>>> " + pageNum);
            const selectedPageli = document.querySelector(`.pagination-ul li:nth-child(${pageNum}) a`);
            if (selectedPageli) {
                selectedPageli.classList.replace("page-number", "page-number-selected");
            }
        }

        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
        }

    </script>

</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <main>
        <div class="sidebar">
            <h2>&nbsp;&nbsp;&nbsp;</h2>
            <ul>
                <li id="homeli" class="selected" onclick="showTab('home')"><i class="fa-solid fa-house-user"> </i>
                    Dashboard</li>
                <li id="ticketsli" class="" onclick="showTab('tickets')"><i class="fa-solid fa-ticket"> </i> Tickets
                </li>
                <li id="eventsli" class="" onclick="showTab('events')"><i class="fa-solid fa-calendar-week"></i> Events
                </li>
                <li id="settingsli" class="" onclick="showTab('settings')"><i class="fa-solid fa-gear"> </i> Settings
                </li>
                <li id="logoutli" class="" onclick="showTab('logout')"><i class="fa-solid fa-arrow-right-from-bracket">
                    </i> Logout
                </li>
            </ul>
        </div>
        <div class="content">
            <!-- Dashboard contain area -->
            <div id="home" class="tab active">
                <div class="header">Welcome to the Dashboard</div>
                <br>

                <?php foreach ($userData as $data) {
                    echo "<script> console.log('" . $data . "');</script>";
                } ?>


                <div class="dash-cards">

                    <div>
                        <div class="img-containner">
                            <img src="<?php echo $userData['img_path'] ?>" alt="Profile Photo">
                            <button class="button-1" onclick="toggleList(1)">Update Image</button>
                        </div>
                        <div class="info-containner">
                            <h3>User Info</h3>
                            <ul class="cards-ul">
                                <li>
                                    <label for="">Full Name:</label>
                                </li>
                                <li>
                                    <p><?php echo $userData['fname'] . " " . $userData['lname'] ?></p>
                                </li>
                                <li>
                                    <label for="">Tel Number:</label>
                                </li>
                                <li>
                                    <p><?php echo $userData['phone'] ?></p>
                                </li>
                                <li><label for="">Email:</label>
                                </li>
                                <li>
                                    <p><?php echo $userData['email'] ?></p>
                                </li>
                                <li>

                                </li>
                            </ul>
                            <button class="button-1" onclick="toggleList(4)">Edit Info</button>
                        </div>

                    </div>
                </div>

                <!-- Update Profile Photo Form -->
                <div class="container-small" id="img-card">
                    <img id="photoPreview" src="<?php echo $userData['img_path'] ?>" alt="Profile Photo">
                    <form action="user-dashAction.php" method="POST" enctype="multipart/form-data"
                        name="photoUploadForm">
                        <input type="text" name="userIDUpdate2" id="userIDUpdate2"
                            value='<?php echo $userData['id_user'] ?>' hidden>
                        <label for="updatePhoto">Select your Photo:</label>
                        <input id="updatePhoto" type="file" name="updatePhoto"
                            accept="image/jpeg,image/png,image/gif,image/jpg">
                        <button id="updatePhotoBTN" class="button-1" type="submit" name="updatePhotoBTN"
                            value="updatePhotoBTN">Upload</button>
                        <button class="button-1 cancelBTN" type="button" onclick="toggleList(2)">Cancel</button>
                    </form>
                </div>

                <!-- Update User Data Form -->
                <div class="updateUserForm">
                    <h3>Update User Information</h3>
                    <ul class="userul">
                        <form action="user-dashAction.php" method="POST">
                            <li><input type="text" name="userIDUpdate" id="userIDUpdate"
                                    value='<?php echo $userData['id_user'] ?>' hidden></li>
                            <li><label for="fnameUpdateUser">First Name </label>
                                <input type="text" name="fnameUpdateUser" id="fnameUpdateUser" placeholder="First Name"
                                    value="<?php echo $userData['fname'] ?>" required>
                            </li>
                            <li><label for="lnameUpdateUser">Last Name </label>
                                <input name="lnameUpdateUser" type="text" id="lnameUpdateUser" placeholder="Last Name"
                                    value="<?php echo $userData['lname'] ?>" required>
                            </li>
                            <li>
                                <input name="emailUpdateUser" type="email" id="emailUpdateUser" placeholder="E-Mail"
                                    value="<?php echo $userData['email'] ?>" hidden>
                            </li>
                            <li><label for="phoneUpdateUser">Phone</label>
                                <input name="phoneUpdateUser" type="tel" id="phoneUpdateUser" placeholder="Tel Number"
                                    value="<?php echo $userData['phone'] ?>">
                            </li>
                            <li><button class="button-1" name="updateUserSubmit" type="submit">Update Info</button></li>
                        </form>
                        <li><button class="button-1 cancelBTN" onclick="toggleList(3)">Cancel</button></li>
                    </ul>
                </div>


            </div>
            <div id="tickets" class="tab">
                <div class="header">Tickets</div>
                <p>tickets content is displayed here.</p>
            </div>
            <!-- ********list of events************list of events**********list of events************** list of events -->
            <div id="events" class="tab">
                <div class="header">Up coming events</div>
                <div class="searchbar-div">
                    <form action="user-dash.php" method="POST">
                        <input id="searchBar-event" name="searchBar-event" placeholder="Search for a Event Title"
                            type="text">
                        <input type="submit" name="search-submit" id="search-submit" value="Search">
                    </form>
                </div>

                <div class="tab-container" id="tab-container-event">

                    <!-- <div class="event-card">
                        <img id="event-card-img" src="url from database" alt="">
                        <div class="event-details">
                            <ul class="ul-details">
                                <li><i class="labels-details">Event Title:</i><i id="event-title"
                                        class="note-details">here context from database</i></li>
                                <li><i class="labels-details">Date and Time:</i><i id="event-title"
                                        class="note-details">here context from database</i></li>
                                <li><a href="eventdetails.php?event_id=1"><button>More Info</button></a></li>
                            </ul>
                        </div>
                    </div> -->

                </div>
                <section class="pagination-sention">
                    <ul class="pagination-ul">
                        <?php
                        pagenationNumber($totalRows);
                        if (!isset($_GET['pageNumber'])) {
                            echo '<script>';
                            echo 'selectedPage(1);';
                            echo '</script>';
                        } else {
                            $pageNumber = $_GET['pageNumber'];
                            echo '<script>';
                            echo "showTab('events');";
                            echo 'selectedPage(' . $pageNumber . ');';
                            echo '</script>';
                        }
                        ?>
                    </ul>
                </section>

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

        function selectSidebarEle() {
            let dashItems = document.querySelectorAll(".sidebar ul li");
            dashItems.forEach(item => {
                item.addEventListener("click", function (e) {
                    dashItems.forEach(i => i.classList.remove("selected"));
                    e.target.classList.add("selected");
                });
            });
        }

        selectSidebarEle();
        function toggleList(key) {
            if (key == 1) {
                document.querySelector("#home .dash-cards").style.display = "none";
                document.querySelector("#home #img-card").style.display = "block";
            }
            if (key == 2) {
                document.querySelector("#home .dash-cards").style.display = "block";
                document.querySelector("#home #img-card").style.display = "none";
            }
            if (key == 3) {
                document.querySelector("#home .dash-cards").style.display = "block";
                document.querySelector("#home .updateUserForm").style.display = "none";
            }
            if (key == 4) {
                document.querySelector("#home .dash-cards").style.display = "none";
                document.querySelector("#home .updateUserForm").style.display = "block";
            }
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

        initImagePreview("updatePhoto", "photoPreview");

        <?php

        ?>

        function handleSuccessMessages() {
            const params = new URLSearchParams(window.location.search);

            if (params.get("successUpUser") == 1) {
                showTab('home');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#homeli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("Information successfully Updated."); }, 500)
                };
            } else if (params.get("successUpUser") == 2) {
                showTab('home');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#homeli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("Update Failed: Database error."); }, 500)
                };
            } else if (params.get("successUpUser") == 3) {
                showTab('home');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#homeli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("Update Failed: File type not valid. (Only .png , .jpg , gif)"); }, 500)
                };
            } else if (params.get("successUpUser") == 4) {
                showTab('home');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#homeli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("File size is too big, select file smaller than 3MB"); }, 500)
                };
            } else if (params.get("successUpUser") == 5) {
                showTab('home');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#homeli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("Profile photo successfully updated."); }, 500)
                };
            } else if (params.get("successUpUser") == 6) {
                showTab('home');
                dashItems.forEach(item => { item.classList.remove('selected'); });
                document.querySelector('#homeli').className = 'selected';
                window.onload = function () {
                    setTimeout(() => { alert("Select a Image before submit."); }, 500)
                };
            }

        }

        handleSuccessMessages();

        // functio to add event cards
        function createEventCard(event) {

            const eventCard = document.createElement("div");
            eventCard.classList.add("event-card");

            const eventImg = document.createElement("img");
            eventImg.id = "event-card-img";
            eventImg.src = event.imageUrl;
            eventImg.alt = "Event Image";

            const eventDetails = document.createElement("div");
            eventDetails.classList.add("event-details");

            const ulDetails = document.createElement("ul");
            ulDetails.classList.add("ul-details");

            const titleLi = document.createElement("li");
            titleLi.innerHTML = `<i class="labels-details">Event Title:</i> <i class="note-details">${event.title}</i>`;

            const dateLi = document.createElement("li");
            dateLi.innerHTML = `<i class="labels-details">Date and Time:</i> <i class="note-details">${event.dateTime}</i>`;

            const moreInfoLi = document.createElement("li");
            const moreInfoLink = document.createElement("a");
            moreInfoLink.href = `eventdetails.php?event_id=${event.id}`;

            const moreInfoButton = document.createElement("button");
            moreInfoButton.style.marginBottom = "-7px";
            moreInfoButton.textContent = "More Info";

            const bookNowLi = document.createElement("li");
            const bookNowLink = document.createElement("a");
            bookNowLink.href = `seatselection.php?event_id=${event.id}`;

            const bookNowButton = document.createElement("button");
            bookNowButton.style.marginTop = "-7px";
            bookNowButton.textContent = "Book Now";

            moreInfoLink.appendChild(moreInfoButton);
            moreInfoLi.appendChild(moreInfoLink);

            bookNowLink.appendChild(bookNowButton);
            bookNowLi.appendChild(bookNowLink);

            ulDetails.appendChild(titleLi);
            ulDetails.appendChild(dateLi);
            ulDetails.appendChild(moreInfoLi);
            ulDetails.appendChild(bookNowLi);

            eventDetails.appendChild(ulDetails);
            eventCard.appendChild(eventImg);
            eventCard.appendChild(eventDetails);

            document.getElementById('tab-container-event').appendChild(eventCard);
        }

        let eventData = {
            id: 1,
            imageUrl: "url from database",
            title: "here context from database",
            dateTime: "here context from database"
        };


        <?php
        foreach ($events as $index => $event) {
            $date = new DateTime($event['date']);
            $time = new DateTime($event['start_time']);
            echo "eventData = {
                id: " . $event['id_event'] . ",
                imageUrl: '" . $event['img'] . "',
                title: '" . $event['name'] . "',
                dateTime: '" . $date->format('F jS') . " at " . $time->format('g:i a') . "'
                };";
            echo "createEventCard(eventData);";
        }

        if (isset($_GET['logout'])) {
            echo "showTab('logout');";
        }

        if (isset($_GET['tickets'])) {
            echo "showTab('tickets');";
            echo 'let dashItems = document.querySelectorAll(".sidebar ul li");';
            echo 'dashItems.forEach(i => i.classList.remove("selected"));';
            echo 'document.getElementById("ticketsli").classList.add("selected");';
        }

        if (isset($_POST['search-submit'])) {
            echo "showTab('events');";
            echo 'dashItems.forEach(i => i.classList.remove("selected"));';
            echo 'document.getElementById("eventsli").classList.add("selected");';
        }
        ?>

    </script>

</body>
<?php
?>

</html>