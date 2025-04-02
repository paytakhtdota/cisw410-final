<?php
session_start();
$seats = null;
if (!isset($_SESSION['user_data'])) {
    header("Location: user-login-form.php");
    exit();
} else {
    $userSession = $_SESSION['user_data'];

    $eventId = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
    if ($eventId > 0) {
        require_once("connection.php");
        $eventsQuery = $pdo->prepare("SELECT events.*, address.*
        FROM events
        JOIN address ON events.location_id = address.location_id
        WHERE events.id_event = :event_id
    ");
        $eventsQuery->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $eventsQuery->execute();
        $event = $eventsQuery->fetch(PDO::FETCH_ASSOC);
        if ($event['id_event'] != $eventId) {
            header("Location: error.php");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seats'])) {
            $seats = $_POST['seats'];
        }

    } else {
        header("Location: error.php");
    }
}


$date = new DateTime($event['date']);
$time = new DateTime($event['start_time']);
$dateForEcho = $date->format("F jS") . " start at " . $time->format('g:i a');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/nav.css">
    <link rel="stylesheet" href="public/styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection</title>
    <link rel="stylesheet" href="public/styles/main.css">
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #202020;
        }

        .seat-main {
            background-image: url("public/images/details-bg.png");
            background-repeat: no-repeat;
            background-size: contain;
        }

        /* style for event inforamtion */
        .event-information {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 25px;
            width: 1100px;
            height: 450px;
            margin: 0 auto;
            font-family: "Poppins";
            font-weight: 400;
            color: #B8860B;
            padding-bottom: 50px;
        }

        .event-information img {
            width: 250px;
            height: 250px;
            border-radius: 8px;
            margin-left: 50px;
        }

        .event-information-ul {
            height: 250px;
            padding: 0;
            margin: 0;
            flex-grow: 1;
            text-align: left;
            line-height: 1;
        }

        .event-information-ul li label {
            font-family: "Poppins";
            font-weight: 400;
            font-size: 16px;
            padding: 0;
            margin: 0;
        }

        .event-information-ul li h2 {
            font-size: 28px;
            line-height: 1.6;
            padding: 0;
            margin: 0;
            color: #ffffff;
            margin-bottom: 15px;
            font-family: "DM Serif Display", serif;
            word-wrap: normal;
            overflow: hidden;
        }

        .event-information-ul li h4 {
            font-size: 22px;
            line-height: 1.5;
            padding: 0;
            margin: 0;
            color: #ffffff;
            margin-bottom: 15px;
            font-family: "DM Serif Display", serif;
        }

        .event-information-ul li:last-child {
            display: flex;
        }

        .event-information-ul li:last-child span {
            display: inline-block;
            width: 250px;
        }

        .sample-icons {
            padding: 25px;
            margin: 0 auto;
            width: 750px;
        }

        .sam-ico {
            align-items: center;
        }

        .sam-lab {
            font-family: "Roboto", sans-serif;
            font-size: 20px;
            margin-left: 35px;
            padding: 8px;
            color: #ffffff;
        }

        /* ************** selected section ******************** selected section ******************** */

        .selected-seats {
            background-color: #292929;
            background: linear-gradient(0deg, rgba(41, 41, 41, 1) 10%, rgba(32, 32, 32, 1) 100%);
            min-height: 100px;
            width: 1100px;
            border-radius: 10px;
            margin: 25px auto 30px auto;
            /* margin-top: 60px;
            margin-bottom: 30px;*/
        }

        .BTN-container {
            display: flex;
            justify-content: space-between;
            padding: 3%;
        }

        .BTN-container a {
            width: 49%;
        }

        button {
            width: 100%;
            height: 50px;
            margin-top: 5px;
            border-radius: 4px;
            border: 3px solid #b8860b;
            background-color: #b8860b;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-family: "Roboto", serif;
            transition: all 0.4s;
        }

        button:hover {
            border-color: #B8860B;
            background-color: #b8860b00;
            color: #B8860B;
            cursor: pointer;
        }

        .selected-seats-info {
            font-family: "Poppins", sans-serif;
            margin-left: 35px;
            color: #B8860B;
            font-size: 24px;
            font-weight: 600;
        }

        .ticket-list {
            display: flex;
            flex-wrap: wrap;
            padding-top: 20px;
            gap: 16px;
            align-content: flex-start;

        }

        .ticket-card {
            display: flex;
            flex-direction: column;
            width: 330px;
            min-height: 450px;
            background-color: #ffffff;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .ticket-container {
            margin-bottom: 20px;
        }

        .ticket-title-container {
            width: 280px;
            min-height: 60px;
            margin: 0 auto;
            background-color: #B8860B;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .round-corners-container {
            display: flex;
            justify-content: space-between;
            min-width: 100%;
            min-height: 20px;
            height: 20px;
            background-color: #B8860B;
            border-bottom: #292929 dashed 4px;
        }

        .right-corner {
            min-width: 17px;
            width: 17px;
            min-height: 20px;
            height: 20px;
            border-top-left-radius: 30px;
            background-color: #292929;
        }

        .left-corner {
            min-width: 17px;
            width: 17px;
            min-height: 20px;
            height: 20px;
            border-top-right-radius: 30px;
            background-color: #292929;
        }

        .ticket-info-container {
            width: 280px;
            min-height: 60px;
            margin: 0 auto;
            padding-top: 15px;
            color: #202020;
            flex-grow: 1;
        }

        .ticket-info-container-ul {
            font-family: "Roboto", "Oswald";
            font-size: 20px;
            font-weight: 400;
        }

        .ticket-info-container-label {
            font-family: "Oswald", "Roboto";
            color: #B8860B;
            font-weight: 600;
            font-size: 18px;
        }

        .ticket-info-container-label>i {
            font-style: normal;
        }

        .ticket-info-container-information {
            margin-bottom: 8px;
            text-wrap: wrap;
        }

        .ticket-info-container-tail {
            display: flex;
            font-family: "Chivo", "Roboto";
            min-width: 100%;
            min-height: 60px;
            background-color: #B8860B;
            color: #ffffff;
            font-size: 18px;
            padding: 10px 10px 0 10px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .ticket-info-container-tail p {
            font-size: 32px;
        }

        .ticket-info-container-tail img {
            width: 40px;
            height: 42px;
            margin-right: 10px;
        }

        .link-style-btn {
            display: inline;
            width: fit-content;
            height: fit-content;
            float: right;
            color: rgb(255, 255, 255);
            border: 1px solid transparent;
            font-weight: 400;
            font-size: 15px;
            padding: 2px 3px;
            margin-top: -3px;
        }

        .link-style-btn:hover {
            text-decoration: underline;
            color: #B8860B;
            border: 1px solid;
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

        .dialog-box {
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 460px;
            min-height: fit-content;
            background-color: rgb(248, 248, 248);
            border-radius: 8px;
            font-family: "Poppins";
            padding-bottom: 15px;

        }

        .title-bar {
            width: 100%;
            height: 53px;
            font-size: 24px;
            padding: 7px 7px 5px 10px;
            background-color: #B8860B;
            line-height: 1.7;
            color: rgb(255, 255, 255);
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-family: "Poppins";
        }

        .fa-xmark {
            font-size: 24px;
            float: right;
            padding: 4px 7px;
            border: 2px solid white;
            border-radius: 5px;
        }

        .fa-xmark:hover {
            float: right;
            border: 2px solid #c10000;
            cursor: pointer;
            color: #c10000;
            background-color: antiquewhite;
        }

        .dialog-box p {
            margin: 25px 15px 3px 25px;
        }

        .dialog-box input {
            margin: 0 10px 10px 19px;
            padding: 6px 12px;
            font-size: 20px;
            width: 420px;
            height: 50px;
        }

        .dialog-box input {
            margin: 5px 10px 10px 19px;
            padding: 6px 12px;
            font-size: 20px;
            width: 420px;
            height: 50px;
            border-radius: 5px;
            border: 1px solid rgb(57, 57, 57);
        }

        .dialog-box input:focus {
            margin: 5px 10px 10px 19px;
            padding: 6px 12px;
            font-size: 20px;
            width: 420px;
            height: 50px;
            border-radius: 5px;
            outline: 1px solid rgb(255, 199, 56);
            border: #B8860B;
        }

        .dialog-box-btn-container {
            margin: 2px 19px;
            display: flex;
            gap: 20px
        }
    </style>
</head>

<body>
    <?php
    include("navbar.php");
    ?>

    <div class="seat-main" id="seat-main">
        <div class="event-information">
            <img src="<?php echo $event['img'] ?>" alt="">
            <ul class="event-information-ul">
                <li>
                    <label for="">Title:</label>
                    <h2><?php echo $event['name'] ?></h2>
                </li>
                <li>
                    <label for="">Date and Time:</label>
                    <h4><?php echo $dateForEcho; ?></h4>
                </li>
                <li>
                    <label for="Address">Address:</label>
                    <h4><?php
                    $unit_add = '';
                    if (!empty($event['unit'])) {
                        $unit_add = $event['unit'] . ", ";
                    }
                    echo $event['street'] . ", " . $unit_add . $event['city'] . ", " . $event['state'] . " - " . $event['zip_code'];
                    ?></h4>
                </li>
                <li>
                    <span>
                        <label for="Address">Classic Price:</label>
                        <h4><?php echo $event['base_price'] . "$" ?></h4>
                    </span>
                    <span>
                        <label for="Address">VIP Price:</label>
                        <h4><?php echo $event['base_price'] * 2 . "$" ?></h4>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="selected-seats">
        <ul class="selected-seats-info">
            <li>Your Ticket(s):</li>
            <li class="ticket-list" id="ticket-list-li">
                <!-- <div class="ticket-container">
                    <div class="ticket-card">
                        <div class="ticket-title-container">Music Festival</div>
                        <div class="ticket-info-container">
                            <ul class="ticket-info-container-ul">
                                <li class="ticket-info-container-label"><i>Guest Name</i><button
                                        class="link-style-btn">Edit <i class="fa-solid fa-pencil"></i></button></li>
                                <li class="ticket-info-container-information">First and Last Name First and Last Name
                                </li>
                                <li class="ticket-info-container-label">Date and Time:</li>
                                <li class="ticket-info-container-information"><?php echo $dateForEcho; ?></li>
                                <li class="ticket-info-container-label">Event:</li>
                                <li class="ticket-info-container-information"><?php echo $event['name'] ?></li>
                            </ul>

                        </div>
                        <div class="ticket-info-container-tail">
                            <img src="public/images/classic-icon-white.png" alt="seat-icon">
                            <p>VIP-1</p>
                        </div>
                    </div>
                    <div class="round-corners-container">
                        <span class="left-corner"></span>
                        <span class="right-corner"></span>
                    </div>
                </div> -->
            </li>
            <li></li>

        </ul>
        <div class="BTN-container">
            <a href="eventdetails.php?event_id=<?php echo $event['id_event'] ?>"><button><i
                        class="fa-solid fa-arrow-left"></i> Back</button></a>
            <a href=""> <button>Next <i class="fa-solid fa-arrow-right"></i></button></a>
        </div>
    </div>

    <section class="dialog-box-container" id="dialogBoxContain">
        <div class="dialog-box">
            <div class="title-bar">Edit guest name<i onclick='dialogBoxSwitch(2,this)' class="fa-solid fa-xmark"></i></div>
            <p>Name on the Ticket:</p>
            <input type="text" id="nameInPut">
            <div class="dialog-box-btn-container">
                <button onclick='dialogBoxSwitch(2,this)'>Cancel</button>
                <button id="updateNameBTN" onclick='dialogBoxSwitch(3,this)' data-id3="" >Update</button>
            </div>
        </div>
    </section>

    <footer>
        <?php
        include("footer.php");
        ?>
    </footer>

    <script>
        function createTicket(guestName, date, name, seatSelectedID, seatName) {

            const ticketListItem = document.getElementById("ticket-list-li");


            const ticketContainer = document.createElement("div");
            ticketContainer.className = "ticket-container";


            const ticketCard = document.createElement("div");
            ticketCard.className = "ticket-card";


            const ticketTitleContainer = document.createElement("div");
            ticketTitleContainer.className = "ticket-title-container";
            ticketTitleContainer.textContent = "Music Festival";


            const ticketInfoContainer = document.createElement("div");
            ticketInfoContainer.className = "ticket-info-container";

            const ticketInfoList = document.createElement("ul");
            ticketInfoList.className = "ticket-info-container-ul";

            const seatIcon = document.createElement("img");
            if (seatSelectedID <= 15) {
                seatIcon.src = "public/images/vip-icon-white.png";
            } else {
                seatIcon.src = "public/images/classic-icon-white.png";
            }
            seatIcon.alt = "Seat-Icon";

            const ticketDetails = [
                { label: `<i>Guest Name</i><button onclick='dialogBoxSwitch(1,this)' class='link-style-btn' data-id='${seatSelectedID}'>Edit <i class='fa-solid fa-pencil'></i></button>`, value: guestName },
                { label: "Date and Time:", value: date },
                { label: "Event:", value: name }
            ];
            let counter = 1;
            ticketDetails.forEach(detail => {
                const labelLi = document.createElement("li");
                labelLi.className = "ticket-info-container-label";
                labelLi.innerHTML = detail.label;
                
                const valueLi = document.createElement("li");
                valueLi.className = "ticket-info-container-information";
                valueLi.textContent = detail.value;
                if (counter == 1) {
                    valueLi.setAttribute("data-id2", `${seatSelectedID}`);
                    counter++;
                }


                ticketInfoList.appendChild(labelLi);
                ticketInfoList.appendChild(valueLi);
            });

            ticketInfoContainer.appendChild(ticketInfoList);

            const ticketTail = document.createElement("div");
            const seatNameP = document.createElement("p");
            seatNameP.textContent = seatName;
            ticketInfoContainer.id=seatName;
            ticketTail.className = "ticket-info-container-tail";

            ticketTail.appendChild(seatIcon);
            ticketTail.appendChild(seatNameP);

            ticketCard.appendChild(ticketTitleContainer);
            ticketCard.appendChild(ticketInfoContainer);
            ticketCard.appendChild(ticketTail);

            const roundCornersContainer = document.createElement("div");
            roundCornersContainer.className = "round-corners-container";

            const leftCorner = document.createElement("span");
            leftCorner.className = "left-corner";

            const rightCorner = document.createElement("span");
            rightCorner.className = "right-corner";

            roundCornersContainer.appendChild(leftCorner);
            roundCornersContainer.appendChild(rightCorner);

            ticketContainer.appendChild(ticketCard);
            ticketContainer.appendChild(roundCornersContainer);

            ticketListItem.appendChild(ticketContainer);
        }
        let dataIdValue;
        function dialogBoxSwitch(key, element) {
            const diaBox = document.getElementById("dialogBoxContain");
            dataIdValue = element.getAttribute("data-id");
            if (key == 1) {
                diaBox.style.display = "block";
                document.documentElement.style.overflow = "hidden";
                document.body.style.overflow = "hidden";
                document.getElementById('updateNameBTN').setAttribute("data-id", dataIdValue);
                document.getElementById('nameInPut').setAttribute("data-id", dataIdValue);
                console.log(dataIdValue);
            } else if (key == 2) {
                diaBox.style.display = "none";
                document.documentElement.style.overflow = "auto";
                document.body.style.overflow = "auto";
            } else if (key == 3) {
                let guestNameInput = document.getElementById("nameInPut").value;
                printName(dataIdValue,guestNameInput);
                document.getElementById("nameInPut").value = "";
                diaBox.style.display = "none";
                document.documentElement.style.overflow = "auto";
                document.body.style.overflow = "auto";
            }
        }

        function printName(elementID,guestName){
            let element = document.querySelector(`[data-id2='${elementID}']`);
            element.textContent = guestName;
        }

        <?php foreach ($seats as $seatID => $P) {
            echo "createTicket('" . $userSession['fname'] . " " . $userSession['lname'] . "', '" . $dateForEcho . "', '" . $event['name'] . "', '" . $seatID . "', '" . $P . "');";
        } ?>

    </script>
</body>

</html>