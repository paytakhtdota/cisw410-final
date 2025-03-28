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

*{
  box-sizing: border-box;
}
input {
  ::-webkit-input-placeholder {
     color: rgba(255,255,255,0.7);
  }
  ::-moz-placeholder {
     color: rgba(255, 255, 255, 0.7);  
  }
  :-ms-input-placeholder {  
     color: rgba(255,255,255,0.7);  
  }
  &:focus {
    outline: 0 transparent solid;
    ::-webkit-input-placeholder {
     color: rgba(0,0,0,0.7);
    }
    ::-moz-placeholder {
       color: rgba(0,0,0,0.7);  
    }
    :-ms-input-placeholder {  
       color: rgba(0,0,0,0.7);  
    }
  }
}

.login-form {
  //background: #222;
  //box-shadow: 0 0 1rem rgba(0,0,0,0.3);
  min-height: 10rem;
  margin: auto;
  max-width: 50%;
  padding: .5rem;
}
.login-text {
  //background: hsl(40,30,60);
  //border-bottom: .5rem solid white;
  color: white;
  font-size: 1.5rem;
  margin: 0 auto;
  max-width: 50%;
  padding: .5rem;
  text-align: center;
  opacity: 0.8;
  //text-shadow: 1px -1px 0 rgba(0,0,0,0.3);
  .fa-stack-1x {
    color: black;
  }
}

.login-username, .login-password {
  background: transparent;
  border: 0 solid;
  border-bottom: 1px solid #555555;
  color: white;
  display: block;
  margin: 1rem;
  padding: .5rem;
  transition: 250ms ease-in;
  width: calc(100% - 3rem);
}
.login-username:focus, .login-password:focus{
    background: white;
    color: black;
    transition: 250ms  ease-in;
  }

.login-forgot-pass {
  //border-bottom: 1px solid white;
  bottom: 0;
  color: white;
  cursor: pointer;
  display: block;
  font-size: 125%;
  left: 0;
  opacity: 0.6;
  padding: 0.5rem;
  position: absolute;
  text-align: center;
  margin-bottom:15px;
  //text-decoration: none;
  width: 100%;
  &:hover {
    opacity: 1;
  }
}
.login-submit {
  border: 1px solid white;
  background: transparent;
  color: white;
  display: block;
  margin: 2rem auto;
  min-width: 100px;
  min-height: 35px;
  padding: .25rem;
  transition: 250ms  ease-in;
 
}

.login-submit:hover, .login-submit:focus {
    background: white;
    color: black;
    transition: 250ms ease-in;
    cursor: pointer;
  }

[class*=underlay] {
  left: 0;
  min-height: 100%;
  min-width: 100%;
  position: fixed;
  top: 0;
}
.underlay-photo {
  background: url('public/images/login-bg2.jpg');
  background-size: cover;
  -webkit-filter: brightness(80%);
  z-index: -1;
}
.underlay-black {
  background: rgba(0,0,0,0.7);
  z-index: -1;
}


#layout-adj{
    display: flex;
    justify-content: center;
padding-top: 15%;

}

#form-container{
    width: 700px;
    height: 300px;
    padding-top: 30px;
    backdrop-filter: blur(10);
}

    </style>
</head>

<body>
    <div id="layout-adj">
        <div id="form-container">
        <form class="login-form" action="" method="POST">
            <p class="login-text">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-lock fa-stack-1x"></i>
                </span>
               
            </p>
            <input name="email" type="email" class="login-username" autofocus="true" required="true" placeholder="Email" />
            <input name="password" type="password" class="login-password" required="true" placeholder="Password" />
            <input type="submit" name="Login" value="Login" class="login-submit" />
        </form>
        </div>
        <a href="#" class="login-forgot-pass">forgot password?</a>
        <div class="underlay-photo"></div>
        <div class="underlay-black"></div>
    </div>

</body>

</html>