<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header("Location: user-login-form.php");
    exit();
} else {

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

        if (!$event) {
            header("Location: error.php");
            exit();
        }

        $seatResQuery = $pdo->prepare("SELECT * FROM tickets WHERE id_event = :event_id");
        $seatResQuery->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $seatResQuery->execute();
        $reservedSeats = $seatResQuery->fetchAll(PDO::FETCH_ASSOC);


    } else {
        header("Location: error.php");
    }
}

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

        .row-label {
            color: #ffffff;
        }

        #stage {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            /* background-color:rgb(199, 199, 199); */
            width: 1100px;
            height: 140px;
            margin: 0 auto 65px auto;
            border: 2px solid #B8860B;
            border-top: none;
            border-bottom: 6px solid #B8860B;
            border-bottom-right-radius: 15px;
            border-bottom-left-radius: 15px;
            text-align: center;
            line-height: 1.8;
            font-size: 3em;
            font-family: "Poppins";
            font-weight: 600;
            color: #B8860B;
        }

        .seats-container {}

        .seat-row {
            display: flex;
            gap: 40px;
            align-items: center;
            justify-content: space-between;
            width: 1120px;
            margin: 20px auto;
        }

        .seat-group-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;

        }

        .seat-group {
            display: flex;
        }

        .seat {
            width: 55px;
            height: 28px;
            border-radius: 10px;
            margin: 3px;
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-family: ;
            border: 1px solid rgb(255, 255, 255);
            color: #ffffff;
        }

        .seat:hover {
            background-color: rgb(227, 199, 145);
            color: #000000;
            cursor: pointer;
        }

        .seat-selected {
            width: 55px;
            height: 28px;
            border-radius: 10px;
            margin: 3px;
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            border: 1px solid #B8860B;
            background-color: #B8860B;
            color: rgb(255, 255, 255);
        }

        .seat:hover,
        .seat-selected:hover {
            background-color: rgb(227, 199, 145);
            color: #000000;
            cursor: pointer;
        }



        .seat-reserved {
            width: 55px;
            height: 28px;
            border-radius: 10px;
            margin: 3px;
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            color: rgb(0, 0, 0);
            background-color: #575757;
            border: 1px solid rgb(118, 118, 118);

        }

        .seat-reserved:hover {
            cursor: not-allowed;
            color: rgb(0, 0, 0);
            background-color: #575757;
            border: 1px solid rgb(118, 118, 118);
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
            width: 1150px;
            border-radius: 10px;
            margin: 10px auto 10px auto;
            /* margin-top: 60px;
            margin-bottom: 30px;*/
        }

        .selected-seats-info {
            font-family: "Poppins", sans-serif;
            margin-left: 35px;
            color: #B8860B;
        }

        .selected-seats-info li {
            height: fit-content;
            padding: 5px;

        }

        #seats-icon-list {
            min-height: 75px;
        }


        .selected-seats-info li span {
            display: inline-flex;
            height: 60px;
            align-items: flex-start;
            justify-content: flex-start;
            margin: 0 15px 0 0;
        }


        .selected-seats-info li span i {
            align-items: center;
            border: 2px solid #ffffff;
            font-style: normal;
            padding: 0 10px 0 7px;
            line-height: 1.2;
            margin: 5px 0 0 0;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .seat-name {
            font-weight: 600;
            color: #ffffff;
            font-size: 30px;
            line-height: 1;
        }

        .classic-icon {}

        .seat-icon {
            background-color: #ffffff;
            padding: 3px 3px 3px 5px;
            height: 40px;
            width: 43px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            margin: 5px 0 0 0;
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

        #total-price-display {
            font-family: "DM Serif Display", serif;
            font-size: 48px;
            color: #ffffff;
            margin-left: 15px;
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
                    <h4><?php
                    $date = new DateTime($event['date']);
                    $time = new DateTime($event['start_time']);
                    echo $date->format("F jS") . " start at " . $time->format('g:i a');
                    ?></h4>
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
        <div id="stage">
            STAGE
        </div>
        <div class="sample-icons">
            <ul class="seat-group sam-ico">
                <li class="sam-lab"> Available </li>
                <li class="seat" id="1200">1</li>
                <li class="sam-lab"> Select </li>
                <li class="seat-selected" id="1400">2</li>
                <li class="sam-lab"> Reserved </li>
                <li class="seat-reserved" id="1500">R</li>
            </ul>

        </div>
        <div class="seats-container">
            <div class="seat-row">
                <!-- <span class="row-label">VIP</span>
                <div class="seat-group-container">
                    <ul class="seat-group group1">
                        <li class="seat-selected" id="1">1</li>
                        <li class="seat-reserved" id="2">2</li>
                        <li class="seat-reserved" id="3">3</li>
                        <li class="seat" id="4">4</li>
                        <li class="seat" id="5">5</li>
                    </ul>
                    <ul class="seat-group group2">
                        <li class="seat" id="6">6</li>
                        <li class="seat" id="7">7</li>
                        <li class="seat" id="8">8</li>
                        <li class="seat" id="9">9</li>
                        <li class="seat" id="10">10</li>
                    </ul>
                    <ul class="seat-group group3">
                        <li class="seat" id="11">11</li>
                        <li class="seat" id="12">12</li>
                        <li class="seat" id="13">13</li>
                        <li class="seat" id="14">14</li>
                        <li class="seat" id="15">15</li>
                    </ul>
                </div>
                <span class="row-label">VIP</span> -->
            </div>
        </div>

    </div>

    <div class="selected-seats">
        <ul class="selected-seats-info">
            <li>Your Seats:</li>
            <li id="seats-icon-list">
                <!-- <span class="seat-name" id="spanC10" >
                    <img src="public/images/vip-icon.png" class="seat-icon" alt="">
                    <i>VIP-1</i>
                </span> -->

            </li>
            <li>Total Price:</li>
            <li id="total-price-display">0 $</li>

        </ul>

        <div class="BTN-container">
            <a onclick="window.history.back()"><button><i class="fa-solid fa-arrow-left"></i> Back</button></a>
            <a onclick="collectSeatID()"> <button>Next <i class="fa-solid fa-arrow-right"></i></button></a>
        </div>

    </div>
    <footer>
        <?php
        include("footer.php");
        ?>
    </footer>

    <script>
        let basePrice = parseFloat(<?php echo $event['base_price'] ?>);
        let vipPrice = 2 * basePrice;
        let TotalPrice = 0.00;
        function generateSeats() {
            const rows = "ABCDEF".split("").slice(0, 6);
            const totalSeats = 90;
            const seatsContainer = document.createElement("div");
            seatsContainer.classList.add("seats-container");

            let seatId = 1;

            rows.forEach(row => {
                const seatRow = document.createElement("div");
                seatRow.classList.add("seat-row");

                const rowLabelLeft = document.createElement("span");
                rowLabelLeft.classList.add("row-label");
                rowLabelLeft.textContent = row;
                if (row == "A") {
                    rowLabelLeft.textContent = "VIP";
                }

                const rowLabelRight = rowLabelLeft.cloneNode(true);


                const seatGroupContainer = document.createElement("div");
                seatGroupContainer.classList.add("seat-group-container");

                let gourpSeatNumber = -5;
                for (let group = 1; group <= 3; group++) {
                    const seatGroup = document.createElement("ul");
                    seatGroup.classList.add("seat-group", `group${group}`);
                    gourpSeatNumber += 5;
                    for (let i = 0; i < 5; i++) {
                        const seat = document.createElement("li");
                        seat.classList.add("seat");
                        seat.id = seatId;
                        seat.textContent = (i + 1 + gourpSeatNumber);
                        if (seatId <= 15) {
                            seat.setAttribute("data-name", "VIP-" + (i + 1 + gourpSeatNumber));
                        } else {
                            seat.setAttribute("data-name", row + (i + 1 + gourpSeatNumber));
                        }
                        seatGroup.appendChild(seat);
                        seatId++;
                    }
                    seatGroupContainer.appendChild(seatGroup);
                }

                seatRow.appendChild(rowLabelLeft);
                seatRow.appendChild(seatGroupContainer);
                seatRow.appendChild(rowLabelRight);
                seatsContainer.appendChild(seatRow);
            });

            document.getElementById("seat-main").appendChild(seatsContainer);
        }

        function addEventListenerToSeats() {
            const allSeats = document.querySelectorAll(".seat-group li.seat");

            allSeats.forEach((seat) => {
                seat.addEventListener("click", (e) => {
                    seat.classList.toggle("seat-selected");
                    seat.classList.toggle("seat");
                    createSeatElement(seat.id, seat.dataset.name);
                });
                if (seat.className.includes("seat-reserved")) {
                    seat.textContent = "R";
                }
            });
        }

        function createSeatElement(seatID, seatName) {
            const existingSpan = document.getElementById(`span${seatID}`);

            if (existingSpan) {
                existingSpan.remove();
                if (seatID >= 1 && seatID < 16) {
                    TotalPrice = TotalPrice - vipPrice;
                } else {
                    TotalPrice = TotalPrice - basePrice;
                }
            } else {
                const seatContainer = document.getElementById("seats-icon-list");

                const span = document.createElement("span");
                span.className = "seat-name";
                span.id = `span${seatID}`;

                const img = document.createElement("img");
                img.className = "seat-icon";
                img.alt = "seat-icon";

                const i = document.createElement("i");
                i.textContent = seatName;
                i.id = seatID;

                if (seatID >= 1 && seatID < 16) {
                    img.src = "public/images/vip-icon.png";
                    TotalPrice = TotalPrice + vipPrice;
                } else {
                    img.src = "public/images/classic-icon.png";
                    TotalPrice = TotalPrice + basePrice;

                }

                span.appendChild(img);
                span.appendChild(i);

                seatContainer.appendChild(span);
            }
            TotalPrice = Math.round(TotalPrice * 100) / 100;
            document.getElementById("total-price-display").textContent = ` ${(TotalPrice).toFixed(2)}$`;
        }

        function collectSeatID() {
            let seatsIDs = {};
            const selectedSeats = document.querySelectorAll(".seats-container li.seat-selected");

            if (selectedSeats.length === 0) {
                console.warn("No seat selected!");
                return;
            }

            selectedSeats.forEach(seat => {
                if (seat.id) {
                    seatsIDs[seat.id] = seat.getAttribute("data-name") || "Unknown";
                }
            });

            if (Object.keys(seatsIDs).length > 0) {

                const form = document.createElement("form");
                form.method = "POST";
                form.action = "confirmticket.php?event_id=<?php echo $event['id_event'] ?>";

                for (const [seatID, seatName] of Object.entries(seatsIDs)) {
                    const inputID = document.createElement("input");
                    inputID.type = "hidden";
                    inputID.name = `seats[${seatID}]`;
                    inputID.value = seatName;
                    form.appendChild(inputID);
                }

                document.body.appendChild(form);
                form.submit();
            } else {
                console.warn("No valid seat IDs to send.");
            }
        }

        function reservedSeats(seat) {
            document.getElementById(`${seat}`).classList.replace("seat", "seat-reserved");
        }

        generateSeats();
        <?php

        foreach ($reservedSeats as $ticket) {
            echo "reservedSeats(" . $ticket['id_seat'] . ");";
        }

        ?>

        addEventListenerToSeats();

    </script>
</body>

</html>