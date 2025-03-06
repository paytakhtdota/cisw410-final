<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/nav.css">
    <link rel="stylesheet" href="public/styles/slider.css">
    <link rel="stylesheet" href="public/styles/timer.css">
    <link rel="stylesheet" href="public/styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <footer>
        <?php include("footer.php");
        ?>
    </footer>
    <!-- scripts -->
    <script>
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
    </script>
</body>

</html>