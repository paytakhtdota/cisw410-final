<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["Login"] == "Log in") {
  if (isset($_POST["password"]) && isset($_POST["email"])) {
    $email = trim($_POST["email"]);
    $pass = trim($_POST["password"]);

    require_once("connection.php");

    $quiry = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $quiry->execute([":email" => $email]);
    if ($quiry->rowCount() > 0) {
      $adminData = $quiry->fetch(PDO::FETCH_ASSOC);
      if (password_verify($pass, $adminData['password']) && (3 <= $adminData['privilege_level'])) {
        session_start();
        $_SESSION['admin_data'] = $adminData;
        header('Location: admin.php?msg=login');
        exit();
      } else {
        $msg = urlencode("Invalid E-mail or password");
        header("Location: adminlf.php?msg=" . $msg);
        exit();
      }

    } else {
      $msg = urlencode("Invalid E-mail or password");
      header("Location: adminlf.php?msg=" . $msg);
      exit();

    }
  }
}

if (isset($_GET['msg'])) {
  echo '<script>setTimeout(function() {';
  echo 'alert("' . $_GET["msg"] . '");';
  echo '}, 200);</script>';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cisw 410 final: user loging</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      padding: 0;
      margin: 0;
      background-color: #000000;
      background: url('public/images/login-bg2.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      width: 100%;
      height: 100vh;
    }

    input {
      padding: 5px 5px 0 25px;
      font-size: 18px;
      border-radius: 6px;
      height: 45px;
      color: rgb(37, 37, 37);
    }

    .login-form {
      min-height: 10rem;
      margin: auto;
      min-width: 50%;
      border-radius: 10px;
      padding: 35px 10px 20px 20px;
    }

    .login-text {
      color: white;
      font-size: 1.5rem;
      margin: 0 auto;
      max-width: 50%;
      padding: .5rem;
      text-align: center;
      opacity: 0.8;
    }

    .fa-stack-1x {
      color: black;
    }

    .login-username,
    .login-password {
      background: white;
      color: black;
      display: block;
      margin: 1rem;
      padding: .5rem;
      transition: 250ms ease-in;
      width: calc(100% - 3rem);
    }

    .login-username:focus,
    .login-password:focus {
      background: rgb(249, 232, 193);
      transition: 250ms ease-in;
      border: none;
      outline: none;
    }

    .login-forgot-pass,
    .back-home {
      display: flex;
      margin: 0 auto;
      color: rgb(193, 193, 193);
      font-size: 125%;
      opacity: 0.8;
      padding: 10px 5px 25px 5px;
      text-align: center;
      text-decoration: none;
      max-width: fit-content;
      transition: all 0.3s ease-out;
    }

    .login-forgot-pass:hover,
    .back-home:hover {
      cursor: pointer;
      color: rgb(255, 255, 255);
      opacity: 1;
    }

    .login-submit {
      border: 1px solid #B8860B;
      background: transparent;
      color: #B8860B;
      display: block;
      margin: 2rem auto;
      min-width: 150px;
      min-height: 35px;
      padding: .25rem;
      transition: 250ms ease-in;

    }

    .login-submit:hover,
    .login-submit:focus {
      background: #B8860B;
      color: white;
      transition: 250ms ease-in;
      cursor: pointer;
      border: 1px solid #B8860B;
    }

    #layout-adj {
      display: flex;
      align-items: center;
      height: 95vh;
      justify-content: center;
      background-color: #00000085;
      width: 100%;
    }

    #form-container {
      width: 400px;
      max-height: fit-content;
      background-color: #00000045;
      backdrop-filter: blur(10px);
      border-radius: 10px;
    }

    .login-form label {
      display: block;
      color: white;
      font-family: "Poppins", "Roboto", sans-serif;
      margin-left: 20px;
      margin-top: 35px;
    }

    .fa-stack {
      color: #B8860B;
    }

    .fa-arrow-left {
      margin: 3px 5px 0 5px;
      font-size: 18px;
      transition: all 0.3s ease-out;
    }

    .back-home:hover>.fa-arrow-left {
      margin: 3px 10px 0 0;
    }
  </style>
</head>

<body>
  <div id="layout-adj">
    <div id="form-container">
      <form class="login-form" action="adminlf.php" method="POST">
        <p class="login-text">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-lock fa-stack-1x"></i>
          </span>

        </p>
        <label for="email">E-mail</label>
        <input name="email" type="email" class="login-username" autofocus="true" required="true" placeholder="Email" />
        <label for="password">Password</label>
        <input name="password" type="password" class="login-password" required="true" placeholder="Password" />
        <input type="submit" name="Login" value="Log in" class="login-submit" />
      </form>
      <a href="#" class="login-forgot-pass">Forgot password?</a>
      <a href="index.php" class="back-home"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
    </div>

  </div>

  <script>
    setTimeout
  </script>

</body>

</html>