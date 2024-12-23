<?php
    require_once "connection.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $user = $_POST['email'];
        $password = MD5($_POST['pass']);
        $result= mysqli_query($conn,"SELECT * FROM user WHERE Email = '$user' AND Password = '$password'");
        if(mysqli_num_rows($result) == 1){
            $b=$result->fetch_assoc();
            $login = true;
                session_start();
                $_SESSION['loggedin'] = True; 
                $_SESSION['username'] = $user;
                $_SESSION['id'] = $b['id'];
            header("location:land.php");
        }else{
            echo('<script> alert("Invalid Email or Password.Try again ")</script>');
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rent it!</title>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"-->
        <link rel="stylesheet" href="in.css" >
        <script src="https://kit.fontawesome.com/446beef736.js" crossorigin="anonymous"></script>
        <link rel="icon" href="rent-it-high-resolution-logo.png" type="image/icon type">
    </head>
    
    <body>
        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <form class="login" method="post" action="index.php">
                        <img src="rent-it-high-resolution-logo.png" width="30%" alt="">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input type="text" name="email" class="login__input" placeholder="User name / Email">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password" name="pass" class="login__input" placeholder="Password">
                        </div>
                        <button class="button login__submit">
                            <span class="button__text">Log IN</span>
                        </button>
                        
                    </form>
                    <h5>Not have an Account <a href="SignUP.php"><b>Sign UP</b></a> </h5>
                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>
            </div>
        </div>
    </body>
</html>