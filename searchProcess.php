<?php
session_start();

require_once("connection.php");
$start = 0;
$search_input = "";
if (isset($_POST["searchSubmit"])) {
    $searchTerm = trim($_POST['searchInput']);
    $search_input = preg_replace('/[%&*)($@#!+=]/', '', $searchTerm);
}



if (isset($_GET['pageNumber'])) {
    $pgs = (int) $_GET['pageNumber'];
    $totalRows = (int) $_GET['totalRes'];
    $search_input = urldecode($_GET['userSearchTirm']);
    $start = ($pgs - 1) * 10;
    $eventsQuery = $pdo->prepare("SELECT * FROM events WHERE name LIKE :search ORDER BY date LIMIT :start, 10");
    $eventsQuery->bindValue(':search', '%' . $search_input . '%', PDO::PARAM_STR);
    $eventsQuery->bindValue(':start', $start, PDO::PARAM_INT);
    $eventsQuery->execute();
    $events = $eventsQuery->fetchAll(PDO::FETCH_ASSOC);
    $showSection = true;

} else {
    // query 
    $rowCountQuery = $pdo->prepare("SELECT COUNT(id_event) as count FROM events WHERE name LIKE :search");
    $rowCountQuery->bindValue(':search', '%' . $search_input . '%');
    $rowCountQuery->execute();
    $rowCount = $rowCountQuery->fetch();
    $totalRows = $rowCount['count'];
    echo "<script>console.log('" . $totalRows . "');</script>";

    $showSection = 10<=$totalRows;
    $eventsQuery = $pdo->prepare("SELECT * FROM events WHERE name LIKE :search ORDER BY date LIMIT 10");
    $eventsQuery->bindValue(':search', '%' . $search_input . '%');
    $eventsQuery->execute();
    $events = $eventsQuery->fetchAll(PDO::FETCH_ASSOC);
}

function pagenationNumber($rows, $sTirm)
{
    $sTirm = urlencode($sTirm);
    for ($i = 1; $i <= ceil($rows / 10); $i++) {
        echo "<li><a class='page-number' href='searchProcess.php?pageNumber=" . $i . "&userSearchTirm=" . urlencode($sTirm) . "&totalRes=" . $rows . "'>" . $i . "</a></li>";

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
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #202020;
        }

        .results a,
        .results a:visited {
            color: #000000;
        }

        main {
            background-image: url("public/images/details-bg.png");
            margin-top: 74px;
            ;
            background-repeat: no-repeat;
            background-size: contain;
            flex-grow: 1;
        }

        main h3 {
            font-family: "DM Serif Display", serif;
            font-size: 32px;
            color: #ffffff;
            font-size: 36px;
            width: 1150px;
            margin: 0 auto;
            margin-top: 280px;
            padding-bottom: 10px;
        }

        .search-result-container {
            width: 1200px;
            margin: 0 auto;
        }

        .search-result-container>p {
            padding-left: 15px;
            font-family: "Lato", "Poppins", "Roboto";
            font-size: 20px;
            color: #ffffff;
            font-weight: 300;
            border-bottom: 1px solid #ffffff;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .results {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .result-li {
            height: 80px;
            width: 100%;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            padding-top: 5px;
            display: flex;
            justify-content: space-between;
            transition: all 0.2s ease;
            background-color: #ffffff;
            gap: 20px;
        }

        .result-li:hover {
            box-shadow: rgba(50, 50, 93, 0.1) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.2) 0px 18px 36px -18px inset;
            transition: all 0.2s linear;
            cursor: pointer;
        }

        .result-li img {
            width: 70px;
            height: 70px;
            transition: all 0.2s linear;
            margin-left: -20px;
        }

        .result-li-leble {
            height: 20px;
            padding-top: 2px;
            color: #B8860B;
            font-family: "Poppins", "Roboto";
        }

        .result-li-title {
            height: fit-content;
            padding-top: 1px;
            color: #000000;
            font-family: "DM Serif Display", serif;
            font-size: 24px;
        }

        .result-li-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80px;
            width: 100px;
            background-color: transparent;
            font-size: 40px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            padding-left: 5px;
            transition: all 0.2s linear;
        }

        .result-li:hover .result-li-arrow {
            padding-left: 25px;
            color: #B8860B;
        }

        .left-rebun {
            margin-top: -5px;
            width: 25px;
            height: 80px;
            border-left: 5px solid #B8860B;
            transition: all 0.3s;
        }

        .result-li:hover .left-rebun {
            border-left: 20px solid #B8860B;
        }

        .ul-titel-li {
            flex-grow: 1;
        }


        .pagination-sention {
            display: flex;
            height: 75px;
            width: 100%;
            justify-content: center;
            margin-top: 50px;
            font-family: "Poppins";
            margin-bottom: 50px;
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
            border: 1px solid #ffffff;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            font-size: 20px;
            color: rgb(255, 255, 255);
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
    </style>
    <script>
        function selectedPage(pageNum) {
            console.log("page number >>>> " + pageNum);
            const selectedPageli = document.querySelector(`.pagination-ul li:nth-child(${pageNum}) a`);
            if (selectedPageli) {
                selectedPageli.classList.replace("page-number", "page-number-selected");
            }
        }
    </script>

</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <main>
        <h3>Search Result</h3>

        <div class="search-result-container">
            <p>We have found <i class="bold"><?php echo $totalRows?></i> result(s) base on your search:</p>
            <ul class="results">
                <?php foreach ($events as $index => $event) {
                    $date = new DateTime($event['date']);
                    $time = new DateTime($event['start_time']);
                    echo '
                     <a href="eventdetails.php?event_id=' . $event['id_event'] . '">
                    <li class="result-li">
                        <div class="left-rebun">
                            <div>&nbsp;</div>
                        </div>
                        <img src="' . $event['img'] . '" alt="">
                        <ul class="ul-titel-li">
                            <li class="result-li-leble">Title:</li>
                            <li class="result-li-title">' . $event['name'] . '</li>
                        </ul>
                        <ul>
                            <li class="result-li-leble">Date:</li>
                            <li class="result-li-title">' . $date->format("F jS") . ', 2025</li>
                        </ul>
                        <ul>
                            <li class="result-li-leble">Start at:</li>
                            <li class="result-li-title">' . $time->format("g:i a") . '</li>
                        </ul>
                        <ul>
                            <li class="result-li-arrow"><i class="fa-solid fa-arrow-right"></i></li>
                        </ul>
                    </li>
                </a>
                    ';
                }
                ?>
                <!-- <a href="#">
                    <li class="result-li">
                        <div class="left-rebun">
                            <div>&nbsp;</div>
                        </div>
                        <img src="public/images/bg-1.jpg" alt="">
                        <ul>
                            <li class="result-li-leble">Title:</li>
                            <li class="result-li-title">Title of the events</li>
                        </ul>
                        <ul>
                            <li class="result-li-leble">Date:</li>
                            <li class="result-li-title">May 8th, 2025</li>
                        </ul>
                        <ul>
                            <li class="result-li-leble">Start at:</li>
                            <li class="result-li-title">8:00 PM</li>
                        </ul>
                        <ul>
                            <li class="result-li-arrow"><i class="fa-solid fa-arrow-right"></i></li>
                        </ul>
                    </li>
                </a> -->


            </ul>
        </div>
        <br>
        <section class="pagination-sention">
            <ul class="pagination-ul">
                <?php
                if ($showSection) {
                    pagenationNumber($totalRows, $search_input);
                    if (!isset($_GET['pageNumber'])) {
                        echo '<script> console.log("Hellooo");';
                        echo 'selectedPage(1);';
                        echo '</script>';
                    } else {
                        $pageNumber = $_GET['pageNumber'];
                        echo '<script>';
                        echo 'selectedPage(' . $pageNumber . ');';
                        echo '</script>';
                    }
                }
                ?>
            </ul>
        </section>

    </main>

    <footer>
        <?php
        include("footer.php");
        ?>
    </footer>

</body>

</html>