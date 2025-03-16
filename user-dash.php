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
            background-color: #f9f9f9;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 10px;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
            border-top: rgb(222, 222, 222) solid 2px;
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

        /* button */

        .button-1 {
            background-color: linear-gradient(#B8860B88, #B8860Bcc);
            background-image: linear-gradient(#B8860B88, #B8860Bcc);
            border: 1px solid #2A8387;
            border-radius: 4px;
            box-shadow: rgba(0, 0, 0, 0.12) 0 1px 1px;
            color: #FFFFFF;
            cursor: pointer;
            display: block;
            font-family: -apple-system, ".SFNSDisplay-Regular", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 17px;
            line-height: 100%;
            margin: 0;
            outline: 0;
            padding: 11px 15px 12px;
            text-align: center;
            transition: all 0.5s;
            transition: box-shadow .05s ease-in-out, opacity .05s ease-in-out;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: 100%;
        }

        .button-1:hover {
            box-shadow: rgba(255, 255, 255, 0.3) 0 0 2px inset, rgba(0, 0, 0, 0.4) 0 1px 2px;
            text-decoration: none;
            transition-duration: .15s, .15s;
            background-color: linear-gradient(#B8860Baa, #B8860B);
            background-image: linear-gradient(#B8860Baa, #B8860B);
        }

        .button-1:active {
            box-shadow: rgba(0, 0, 0, 0.15) 0 2px 4px inset, rgba(0, 0, 0, 0.4) 0 1px 1px;
        }

        .button-1:disabled {
            cursor: not-allowed;
            opacity: .6;
        }

        .button-1:disabled:active {
            pointer-events: none;
        }

        .button-1:disabled:hover {
            box-shadow: none;
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
            ;
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
            display: block;
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
                                <li>
                                    <button class="button-1" onclick="toggleList(4)">Edit Info</button>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Update Profile Photo Form -->
                <div class="container-small" id="img-card">
                    <img id="photoPreview" src="<?php echo $userData['img_path'] ?>" alt="Profile Photo">
                    <form action="user-dashAction.php" method="POST" enctype="multipart/form-data" name="photoUploadForm">
                    <input type="text" name="userIDUpdate" id="userIDUpdate2" value='<?php echo $userData['id_user'] ?>' hidden>
                        <label for="updatePhoto">Select your Photo:</label>
                        <input id="updatePhoto" type="file" name="updatePhoto" accept="image/jpeg,image/png,image/gif,image/jpg">
                        <button id="updatePhotoBTN" class="button-1" type="submit" name="updatePhotoBTN" value="updatePhotoBTN">Upload</button>
                        <button class="button-1 cancelBTN" type="button" onclick="toggleList(2)">Cancel</button>
                    </form>
                </div>

                <!-- Update User Data Form -->
                <div class="updateUserForm">
                    <h3>Update User Information</h3>
                    <ul class="userul">
                        <form action="user-dashAction.php" method="POST">
                            <li><input type="text" name="userIDUpdate" id="userIDUpdate" value='<?php echo $userData['id_user'] ?>' hidden></li>
                            <li><label for="fnameUpdateUser">First Name </label>
                                <input type="text" name="fnameUpdateUser" id="fnameUpdateUser" placeholder="First Name"
                                    value="<?php echo $userData['fname'] ?>" required>
                            </li>
                            <li><label for="lnameUpdateUser">Last Name </label>
                                <input name="lnameUpdateUser" type="text" id="lnameUpdateUser" placeholder="Last Name"
                                    value="<?php echo $userData['lname'] ?>" required>
                            </li>
                            <li><label for="emailUpdateUser">E-mail</label>
                                <input name="emailUpdateUser" type="email" id="emailUpdateUser" placeholder="E-Mail"
                                     value="<?php echo $userData['email'] ?>" hidden>
                            </li>
                            <li><label for="phoneUpdateUser">Phone#</label>
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
        if (isset($_GET['logout'])) {
            echo "showTab('logout');";
        }
        ?>
    </script>
</body>

</html>