<?php
session_start();

if ($_SESSION['loggedin'] != true) {
  header("location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RentIt</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="main.css">
  <link rel="icon" href="rent-it-high-resolution-logo.png" type="image/icon type">
</head>
<script>
  formcheck = function() {
    
    var otp1 = document.getElementById('otp').value;
    
    var otp2 = document.getElementById('otp1').value;
    
    var pass = document.getElementById('password').value;
    
    var pass2 = document.getElementById('password2').value;
    
    var num = document.getElementById('num').value;
    
    var pin = document.getElementById('pin').value;
    console.log(otp1);
    console.log(otp2);
    
    if (otp1 == otp2) {
      if (pass == pass2) {
        const n=/^[1-9][0-9]{9}$/;
        if(n.test(num)){
          const p =/^[1-9][0-9]{5}$/;
          if(p.test(pin)){
            return true;
          }else{
            alert("Enter a valid Pin Code.");
            return false;
          }
        }else{
          alert("Enter a valid Number.");
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
    return false;
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
        input.name = 'otp1';
        input.value = x;

        // Append the input field to the form
        document.getElementById('fm').appendChild(input);
        alert("OTP send");

      }
    };
    xhr.send();
    document.getElementById('sen').disabled = true;
    document.getElementById('mail').readOnly = true;

  }
</script>

<body>



  <?php include "nav.php";
  include "connection.php" ?>

  <!-- Home Section -->
  <section class="home_section">
    <div class="section-header">
      <div class="section-title" style="font-size:50px; color:white">
        Earn By Your Car
      </div>
      <hr class="separator">
      <div class="section-tagline">
        By renting it out.
      </div>
    </div>
  </section>
  <?PHP
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $password = $_POST['password'];
    $number = $_POST['num'];
    $search = mysqli_query($conn, "SELECT * FROM admin WHERE Username = '$email'");
    if (mysqli_num_rows($search) == 1) {
      echo ('<script> alert("Email already exist.Try anther email")</script>');
    } else {
      if ($conn->query("INSERT INTO `admin`( `Username`, `name`, `number`,`city`, `pin`, `password`) VALUES ('$email','$name','$number','$city','$pin','$password')")) {
        echo "<div class = 'alert alert-success'>";
        echo "You can access you admin panel through this link : <a href ='/admin' >admin</a> . manege Your car and loction .";
        echo "</div>";
      } else {
        echo "<div class = 'alert alert-danger'>";
        echo 'user alredy exixt;';
        echo "</div>";
      }
    }
  }
  ?>
  <section class="our-services" id="services">
    <div class="container single-feature">
      <div class="section-header">
        <div class="section-title">
          Register Youself
        </div>
        <hr class="separator">
        <div class="section-tagline">
          start earning.
        </div>
        <form class="row g-3" method="POST" id="fm" action="earn.php" onsubmit="return formcheck()">
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="inputEmail4" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="email" id="inputPassword4">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="" required>
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password2" id="password2" placeholder="" required>
          </div>
          <div class="col-4">
            <label for="number" class="form-label">Number</label>
            <input type="number" class="form-control" name="num" id="num" placeholder="" required>
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" class="form-control" name="city" id="inputCity" required>
          </div>
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="number" class="form-control" name="pin" id="pin" required>
          </div>

          <div class=" col-12 mt-2">
            <label for="otp" class="form-label">OTP</label>
            <input type="number" name="otp" id="otp" class="login__input" placeholder="Enter OTP" required>
            <input type="button" name="rotp" id="sen" value="send OTP" onclick="sendr()">
          </div>
          <div class="imp col-12">
            <p><i><b>Importent:You should have vaild Car registration, Car Insurence and Polution Certificate.</b></i></p>
          </div>
          <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Sign in</button>
          </div>
        </form>

      </div>
  </section>
  <?php
  include "footer.php"
  ?>