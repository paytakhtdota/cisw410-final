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
    <title>Error Page</title>
    <style>
        body {
            background-color: #f1f1f0;
        }

        #screen {
            min-height: 100vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            padding-top: 110px;
            box-sizing: border-box;
        }

        #screen h2 {
            line-height: 0.5;
            padding-bottom: 25px;
            font-family: "Poppins";
        }

        h2 a {
            color: rgb(64, 153, 255);
            transition: all 0.2s;
            margin-bottom: 60px;
        }

        h2 a:visited {
            color: rgb(64, 153, 255);
        }

        h2 a:hover {
            color: #b8860b;
        }

        #section-1 {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            width: 800px;
            height: 600px;
            background-image: url("public/images/error.gif");
            background-size: cover;
            background-position: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div id="screen">
        <div id="section-1">
            <h2>Please return to <a href="index.php">Home Page</a></h2>
        </div>

        <footer>
            <?php
            include("footer.php");
            ?>
        </footer>
    </div>
</body>

</html>

<?php
if (isset($_GET["msg"])) {
    echo "setTimeout(function(){
                alert('" . htmlspecialchars(urldecode($_GET["msg"])) . "');},200);";
}
?>