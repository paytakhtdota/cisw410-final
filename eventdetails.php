<?php
session_start();
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
    if($event['id_event'] != $eventId) {
        header("Location: error.php");
    }
} else {
    header("Location: error.php");
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
    <title>Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <style>
        .mainEventContain {
            background-color: #202020;
        }

        .featureImage {
            width: 100%;
            height: 50vh;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("public/images/details-bg.png");
            background-size: cover;
        }

        .mainEventContain h1 {
            text-align: center;
            font-size: 42px;
            color: #B8860B;
            font-family: "DM Serif Display", serif;
            letter-spacing: 2px;
            text-shadow: 1px 1px 0px #FFFFFF;
        }


        .detailContainer {
            display: flex;
            padding: 20px 10px 20px 10px;
            background-color: #202020;
            min-width: 899px;
            max-width: 100%;
            margin-top: 35px;
            justify-content: center;
            gap: 35px;
            flex-wrap: wrap;
            word-wrap: break-word;
            overflow-wrap: break-word;
            font-size: 2rem;
            text-align: left;
            color: #ffffff;
        }

        .eventImg {
            max-width: 450px;
            min-width: 250px;
            max-height: 450px;
            min-height: 250px;
            background-color: aliceblue;
            display: block;
            border-radius: 4px;
        }

        .detailContainer1 {
            max-width: 60%;
            min-width: 400px;
            margin-bottom: 75px;
        }


        .labels-details {
            display: block;
            font-size: 16px;
            font-style: normal;
            color: hsl(43, 92.00%, 48.80%);
        }

        .note-details {
            font-style: normal;
            font-size: 32px;
        }

        .ul-details {
            font-style: normal;
            font-size: 24px;
            font-family: "Poppins", Helvetica, sans-serif;
            color: rgba(255, 255, 255, 0.9);
        }

        #book-now {
            width: 100%;
            height: 50px;
            margin-top: 10px;
            border-radius: 4px;
            border: 3px solid #b8860b;
            background-color: #b8860b;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-family: "Roboto", serif;
            transition: all 0.4s;
        }

        #book-now:hover {
            width: 100%;
            height: 50px;
            margin-top: 10px;
            border-radius: 4px;
            border-color: #B8860B;
            background-color: #b8860b00;
            color: #B8860B;
            cursor: pointer;
        }

        .spacer3 {
            height: 75px;
        }

        #editor{
            font-size: 22px;
            font-family: "Poppins", Helvetica, sans-serif;
            color: rgba(255, 255, 255, 0.9);
            max-width: 800px;
            border-color: none ;
        }
    </style>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div class="spacer3"></div>
    <main class="mainEventContain">
        <div class="featureImage">
            <h1><?php echo $event['name'] ?></h1>
        </div>

        <div class="detailContainer">
            <div>
                <img class="eventImg" src="<?php echo $event['img'] ?>" alt="">
                <a href="seatselection.php?event_id=<?php echo $event['id_event'] ?>"><button id="book-now">Book Now</button></a>
            </div>

            <div class="detailContainer1">
                <ul class="ul-details">
                    <li><i class="labels-details">Event Title:</i><i id="event-title" class="note-details">
                            <?php echo $event['name'] ?>
                        </i></li>
                    <li><i class="labels-details">Date and Time:</i><i id="event-title" class="note-details">
                            <?php
                            $date = new DateTime($event['date']);
                            $time = new DateTime($event['start_time']);
                            echo $date->format("F jS") . " start at " . $time->format('g:i a');
                            ?>
                        </i></li>
                    <li><i class="labels-details">Address:</i><i id="event-title" class="note-details">
                            <?php
                            $unit_add = '';
                            if (!empty($event['unit'])) {
                                $unit_add = $event['unit'] . ", ";
                            }
                            echo $event['street'] . ", " . $unit_add . $event['city'] . ", " . $event['state'] . " - " . $event['zip_code'];
                            ?>
                        </i></li>
                    <li></li>
                    <li><i class="labels-details">More Details:</i>
                        <div id="editor"></div>
                    </li>
                </ul>
            </div>
            <div class="detailContainer2">

            </div>
        </div>
    </main>

    <footer>
        <script>

            const options = {
                readOnly: true,
                modules: {
                    toolbar: null
                },
                theme: 'bubble'
            };
            const quill = new Quill('#editor', options);
            const Delta = Quill.import('delta');
            <?php 
            if (!empty($event['description'])) {
                echo "let desJSON = " . $event['description'] . ";";
                echo "if (typeof desJSON === 'object') {";
                echo "quill.setContents(desJSON);";
                echo "};";
            }
            ?>
            
        </script>
        <?php include("footer.php");
        ?>
    </footer>
</body>

</html>