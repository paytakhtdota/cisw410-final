<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles\main.css">
    <link rel="stylesheet" href="styles\nav.css">
    <link rel="stylesheet" href="styles\slider.css">
    <link rel="stylesheet" href="styles\timer.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cisw 410 final</title>
</head>

<body>
    <?php
    include("include/navbar.php");
    include("include/slider.php");
    ?>
    <div id="layout-adj"></div>
    <div id="countdown-timer" style="">
        <h2>Next Perfermence start in:</h2>
        <h3>33 D : 23 Hrs : 03 Mins</h3>

    </div>
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

        function updateCounter(){
            const perfermenceTime = new Date(2025,3,30,18,0,0)
            const now = new Date();
            let differenceTime = perfermenceTime-now;

            let day = Math.floor(differenceTime / (1000 * 60 * 60 * 24));
            let hours = Math.floor((differenceTime % (1000 * 60 * 60 * 24))/ (1000*60*60));
            let mins = Math.floor((differenceTime % (1000 * 60 * 60))/ (1000*60));
            let secs = Math.floor((differenceTime % (1000 * 60))/ 1000);

            document.querySelector("#countdown-timer > h3").innerHTML = `${day}D : ${hours}Hrs : ${mins}Mins : ${secs}Sec`;
            
            if (differenceTime <= 0){
                clearInterval(timerInterval);
                document.querySelector("#countdown-timer > h3").innerHTML = "00:00:00";
            }
        }

        const timerInterval = setInterval(updateCounter, 1000);
    </script>
</body>

</html>