<nav>
    <div class="left-side">
        <a href="#"><img id="mylogo" src="public/images/logo2.png" alt="logo"></a>
        <a href="index.php">Home</a>
        <a href="eventslist.php">Events</a>
        <a href="contact.php">Contact</a>
        <a href="adminlf.php">Admin Panel</a>
    </div>
    <div class="right-side">
        <button id="searchBTN" ><i class="fa-solid fa-magnifying-glass"></i></button>
        <?php
        if (!isset($_SESSION['user_data'])) {
            echo '<a class="signin-up" href="user-login-form.php?signup=true">Sign Up</a>
        <a class="signin-up" href="user-login-form.php?signin=true">Log In</a>';
        } else {
            echo '<a class="signin-up" href="user-dash.php">Dashboard</a>
        <a class="signin-up" href="user-dash.php?logout=1">Sign Out</a>';
        }
        ?>
    </div>
    <script>
        const myLogo = document.getElementById("mylogo");
        myLogo.addEventListener("mouseenter", function () {
            myLogo.src = "public/images/logo4.png";
        });
        myLogo.addEventListener("mouseleave", function () {
            myLogo.src = "public/images/logo2.png";
        });

    </script>
</nav>