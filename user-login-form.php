<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="public/styles/login-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cisw 410 final - admin login form</title>
    <link rel="stylesheet" href="public/styles/nav.css">
    <style>
        #layout-adj {
            background-image: url("public/images/login-bg.jpg");
            background-size: cover;
            min-height: min-content;
        }

        .left-side>a {
            padding-top: 4px;
        }
    </style>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div id="layout-adj">
        <section class="ftco-section">
            <!-- forms container -->
            <div class="container">
                <div class="row justify-content-center">
                    <!-- sign-in container -->
                    <div id="singin-form-container" class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="img" style="background-image: url(public/images/bg-1.jpg);">
                            </div>
                            <div class="login-wrap p-4 p-md-5">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h3 class="mb-4">Sign In</h3>
                                    </div>
                                    <div class="w-100">
                                        <p class="social-media d-flex justify-content-end">

                                        </p>
                                    </div>
                                </div>
                                <!-- sign-in form -->
                                <form action="signupin-action.php" class="signin-form" method="POST">

                                    <div class="form-group mb-3">
                                        <label class="label" for="username">E-mail</label>
                                        <input type="text" name="username-signin" id="username" class="form-control"
                                            placeholder="Username" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="password">Password</label>
                                        <input id="password" name="password-signin" type="password" class="form-control"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                    </div>
                                    <div class="form-group d-md-flex">
                                        <div class="w-50 text-left">
                                            <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                                <input type="checkbox" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="w-50 text-md-right">
                                            <a href="#">Forgot Password</a>
                                        </div>
                                    </div>
                                </form>
                                <p class="text-center">Not a member? <a data-toggle="tab" id="signup-link"
                                        href="#signup">Sign Up</a></p>

                            </div>
                        </div>
                    </div>
                    <!-- sign-up container -->
                    <div id="singup-form-container" class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="login-wrap p-4 p-md-5">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h3 class="mb-4">Create Account</h3>
                                    </div>
                                    <div class="w-100">
                                        <p class="social-media d-flex justify-content-end">
                                            <a href="#"
                                                class="social-icon d-flex align-items-center justify-content-center"><span
                                                    class="fa fa-facebook"></span></a>
                                            <a href="#"
                                                class="social-icon d-flex align-items-center justify-content-center"><span
                                                    class="fa fa-twitter"></span></a>
                                        </p>
                                    </div>
                                </div>
                                <!-- sign-up form -->
                                <form action="signupin-action.php" class="signin-form" method="POST">
                                    <div class="form-group mb-6">

                                        <label class="label" for="fname-singup">First Name:</label>
                                        <input id="fname-singup" name="fname-singup" type="text" class="form-control"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="form-group mb-6">
                                        <label class="label" for="lname-singup">Last Name:</label>
                                        <input id="lname-singup" name="lname-singup" type="text" class="form-control"
                                            placeholder="Last Name" required>
                                    </div>
                                    <div class="form-group mb-6">
                                        <label class="label" for="email-signup">E-mail:</label>
                                        <input id="email-signup" name="email-signup" type="email" class="form-control"
                                            placeholder="Email" required>
                                    </div>
                                    <div class="form-group mb-6">
                                        <label class="label" for="phone-signup">Phone:</label>
                                        <input id="phone-signup" name="phone-signup" type="tel" class="form-control"
                                            placeholder="Phone" required>
                                    </div>
                                    <div class="form-group mb-6">
                                        <label class="label" for="password-signup">Password:</label>
                                        <input id="password-signup" name="password-signup" type="password"
                                            class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group mb-6">
                                        <label class="label" for="confirm-signup">Confirm password:</label>
                                        <input id="confirm-signup" name="confirm-signup" type="password"
                                            class="form-control" placeholder="Repeat password" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="form-control btn btn-primary rounded submit px-3">Submit</button>
                                    </div>
                                </form>

                                <p class="text-center">Have an accoune? <a data-toggle="tab" id="signin-link"
                                        href="#signin">Sign In</a>
                                </p>
                            </div>
                            <div class="img" style="background-image: url(public/images/bg-1.jpg);">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <?php
        // redirected from sugnupin-action.php - sign up success
        if (isset($_GET['signin']) && isset($_GET['regestred'])) {
            echo '<script>';
            echo 'document.getElementById("singin-form-container").style.display="block";document.getElementById("singup-form-container").style.display="none";';
            echo 'setTimeout(function() {
            alert("You are successfully regestered. Now Log in to your account.");
            }, 500);';
            echo '</script>';
            // redirected from sugnupin-action.php - sign up failed - Email Exist
        } elseif (isset($_GET['signup']) && isset($_GET['emailexit'])) {
            echo '<script>document.getElementById("singin-form-container").style.display="none";document.getElementById("singup-form-container").style.display="block";setTimeout(function() {
                alert("The email you used for sign up for account already exist. Please use login page to log in to your account or use different email for sign up.");
                }, 500);
                </script>';
            // redirected from sugnupin-action.php - sign in failed - Email email or passwords is wrong
        } elseif (isset($_GET['signin']) && isset($_GET['emailorpass'])) {
            echo '<script>
            document.getElementById("singin-form-container").style.display="block";document.getElementById("singup-form-container").style.display="none";
            setTimeout(function() {
            alert("Email or Password is wrong, Try again.");
            }, 500);
            </script>';
            // redirected from sugnupin-action.php - select which from to display.
        } elseif (isset($_GET['signup'])) {
            echo '<script>document.getElementById("singin-form-container").style.display="none";document.getElementById("singup-form-container").style.display="block";</script>';
        } elseif (isset($_GET['signin'])) {
            echo '<script>document.getElementById("singin-form-container").style.display="block";document.getElementById("singup-form-container").style.display="none";</script>';
        }
        ?>

    </div>
    <footer>
        <?php
        include("footer.php");
        ?>
    </footer>
    <script>
        document.getElementById("signup-link").addEventListener("click", function () {
            document.getElementById("singin-form-container").style.display = "none"; document.getElementById("singup-form-container").style.display = "block";
        });
        document.getElementById("signin-link").addEventListener("click", function () {
            document.getElementById("singin-form-container").style.display = "block"; document.getElementById("singup-form-container").style.display = "none";
        });
    </script>
</body>

</html>