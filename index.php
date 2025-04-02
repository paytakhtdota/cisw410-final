<?php
session_start();
require_once("connection.php");
$eventsQuery = $pdo->prepare("SELECT * FROM events LIMIT 7");
$eventsQuery->execute();
$events = $eventsQuery->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/nav.css">
    <link rel="stylesheet" href="public/styles/slider.css">
    <link rel="stylesheet" href="public/styles/footer.css">
    <link rel="stylesheet" href="public/styles/indexpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cisw 410 final</title>
</head>

<body>
    <?php
    include("navbar.php");
    include("slider.php");
    ?>
    <div id="layout-adj"></div>
    <div id="countdown-timer" style="">
        <h2>Music Festival in:</h2>
        <h3>33 D : 23 Hrs : 03 Mins</h3>

    </div>
    <h2 class="incomingH2"> UPCOMING EVENTS:</h2>
    <section class="eventsList" id="eventsList">


    </section>



    <footer>
        <?php include("footer.php");
        ?>
    </footer>
    <!-- scripts -->
    <script>
        const eventContainer = document.getElementById('eventsList');
        let newEventCard;
        // call fucntion to create events cards
        function createEventCard(eventTitle, eventDate, eventTime, imageUrl, linkUrl) {
            const anchor = document.createElement(`a`);
            anchor.href = linkUrl;
            anchor.id = ``;

            const eventCard = document.createElement(`div`);
            eventCard.classList.add(`eventCard`);

            const img = document.createElement(`img`);
            img.src = imageUrl;
            img.alt = eventTitle;

            const eventContext = document.createElement(`div`);
            eventContext.classList.add(`eventContext`);

            const h3 = document.createElement(`h3`);
            h3.textContent = eventTitle;

            const h4 = document.createElement(`h4`);
            h4.textContent = `Date: ${eventDate} @ ${eventTime}`;

            eventContext.appendChild(h3);
            eventContext.appendChild(h4);
            eventCard.appendChild(img);
            eventCard.appendChild(eventContext);
            anchor.appendChild(eventCard);

            return anchor;
        }



        // change pic of slider every 10s 
        document.addEventListener("DOMContentLoaded", function () {
            const radios = document.querySelectorAll('input[name="css-fadeshow"]');
            let index = 0;
            function changeSlide() {
                radios[index].checked = true;
                index = (index + 1) % radios.length;
            }

            setInterval(changeSlide, 10000);
            changeSlide();
        });

        function updateCounter() {
            const perfermenceTime = new Date(2025, 3, 30, 18, 0, 0)
            const now = new Date();
            let differenceTime = perfermenceTime - now;

            let day = Math.floor(differenceTime / (1000 * 60 * 60 * 24));
            let hours = Math.floor((differenceTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let mins = Math.floor((differenceTime % (1000 * 60 * 60)) / (1000 * 60));
            let secs = Math.floor((differenceTime % (1000 * 60)) / 1000);

            document.querySelector("#countdown-timer > h3").innerHTML = `${day}D : ${hours}Hrs : ${mins}Mins : ${secs}Sec`;

            if (differenceTime <= 0) {
                clearInterval(timerInterval);
                document.querySelector("#countdown-timer > h3").innerHTML = "00:00:00";
            }
        }

      
        const timerInterval = setInterval(updateCounter, 1000);



        <?php foreach ($events as $index => $event) {
            $date = new DateTime($event['date']);
            $time = new DateTime($event['start_time']);
            echo "newEventCard = createEventCard('" . $event['name'] . "', '" . $date->format("F jS") . "', '" . $time->format("g:i a") . "', '" . $event['img'] . "', 'eventdetails.php?event_id=" . $event['id_event'] . "');";
            echo "eventContainer.appendChild(newEventCard);";
        }
        ?>
    </script>

</body>

</html>