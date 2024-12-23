<?php
require "connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = MD5($_POST['password']);
    $search = mysqli_query($conn, "SELECT * FROM user WHERE Email = '$email'");
    if (mysqli_num_rows($search) == 1) {
        echo ('<script> alert("Email already exist.Try anther email")</script>');
    } else {
        if ($conn->query("INSERT INTO `user`(`Name`, `Number`, `Email`, `Password`) VALUES ('$name','$number','$email','$password')")) {
            echo ('<script>alert("Sing up successesfull.Please Log in.")</script>');
        } else {
            echo ('<script> alert("There is an error !!")</script>');
        }
    }
}
?>
<html>

<head>
    <title>Singh Up</title>
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"-->
    <link rel="stylesheet" href="in.css">
    <link rel="icon" href="rent-it-high-resolution-logo.png" type="image/icon type">
    <script src="https://kit.fontawesome.com/446beef736.js" crossorigin="anonymous"></script>
    <script>
        function matchpass() {
    var password1 = document.SignUP.password.value;
    var password2 = document.SignUP.cpassword.value;
    var otp1 = document.SignUP.otp.value;
    var otp2 = document.SignUP.otp1.value;
    var num = document.getElementById('num').value;
    console.log(typeof(num));
    console.log("OTP 1:", otp1);
    console.log("OTP 2:", otp2);

    if (otp1 == otp2) {
        if (password1 == password2) {
            const n=/^[1-9][0-9]{9}$/;
            if(n.test(num)){
                return true;
            }else{
                alert("enter Vaild Number.");
                return false;
            }

        } else {
            alert("Password must be the same!");
            return false;
        }
    } else {
        alert("Incorrect OTP. Please try again.");
        return false;
    }
}

        function sendr() {
            var xhr = new XMLHttpRequest();
            //     var data = 

            xhr.open("POST", "otprequest.php?email=" + document.getElementById('mail').value, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from the PHP script
                    var x = xhr.responseText;
                    console.log(x);
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.id = 'otp1';
                    input.name='otp1';
                    input.value =x;

                    // Append the input field to the form
                    document.getElementById('fm').appendChild(input);
                    alert("OTP send");

                }
            };
            xhr.send();
            document.getElementById('sen').disabled = true;
        }

        function checkotp() {
            console.log("scdcc");

        }
    </script>
</head>

<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form action="SignUP.php" method="post" name="SignUP" id="fm" class="login" onsubmit="return matchpass()">
                    <img src="rent-it-high-resolution-logo.png" width="30%" alt="">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" name="name" class="login__input" placeholder="Enter Name" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fa-solid fa-at"></i>
                        <input type="email" id="mail" name="email" class="login__input" placeholder="Enter Email" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fa-solid fa-phone"></i>
                        <input type="number" name="number" id="num" class="login__input" placeholder="Your number" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" name="password" class="login__input" placeholder="Password" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fa-solid fa-check"></i>
                        <input type="password" name="cpassword" class="login__input" placeholder="Confirm Password" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fa-solid fa-check"></i>
                        <input type="number" name="otp" id="otp" class="login__input" placeholder="Enter OTP" required>
                    </div>
                    <input type="button" name="rotp" id="sen" value="send OTP" onclick="sendr()">
                    <button class="button login__submit">
                        <span class="button__text">SignUP</span>
                    </button>

                </form>
                <h5>Already have an Account <a href="index.php"><b>Log In</b></a> </h5>
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