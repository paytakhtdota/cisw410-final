<nav>
    <div class="left-side">
        <a href="#"><img id="mylogo" src="public/images/logo2.png" alt="logo"></a>
        <a href="index.php">Home</a>
        <a href="#">Reservation</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
    </div>
    <div class="right-side">
        <a class="signin-up" href="/final/user-login-form.php?signup=true">Sign Up</a>
        <a class="signin-up" href="/final/user-login-form.php?signin=true">Log In</a>
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