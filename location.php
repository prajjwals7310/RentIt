

<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // Passing true enables exceptions

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'singh.73pankaj.00@gmail.com';
$mail->Password = 'pbiy kueu wkdu xech';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// the message
// $mail->setFrom('singh.73pankaj.00@gmail.com', 'Your Name');
// $mail->addAddress('pankajparihar199@gmail.com', 'Recipient Name');
// $mail->Subject = 'Subject of the Email';
// $mail->Body = 'This is the HTML message body <b>in bold!</b>';
// $mail->AltBody = 'This is the plain text version of the email body';
// try {
//      $mail->send();
//      echo 'Message has been sent successfully';
//  } catch (Exception $e) {
//      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//  }
?>

         
<script>
     function sendr() {
    var xhr = new XMLHttpRequest();
//     var data = 
    
    xhr.open("POST", "otprequest.php?email="+document.getElementById('mail').value, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the PHP script
            var otp = xhr.responseText;
            var input = document.createElement('input');
            input.type = 'hidden';
            input.id = 'otp1';
            input.value = otp;

            // Append the input field to the form
            document.getElementById('f').appendChild(input);

        }
    };
    xhr.send();
}
function checkotp() {
     console.log("scdcc");
    var o1 = document.getElementById('otp').value;
    var o2 = document.getElementById('otp1').value;
    if (o1 == o2) {
        alert("Correct OTP!");
        return true;
    } else {
        alert("Incorrect OTP. Please try again.");
        return false;
    }
}
</script>
<!--   -->
<form method='POST' id="f" action="location.php" onsubmit="return checkotp()">
<input type="email" name="mail" id="mail">
<input type="number" name="otp" id="otp">
<input type="button" name="rotp" value="send OTP" onclick="sendr()">
<input type="submit"  name="submit" value="submit"" >
</form>

<!-- <--?php
       
    // Google Maps API Key 
     $GOOGLE_API_KEY = 'AIzaSyCLv_r5BZ_cJOQv3HOKyg0udSQ57KoIWQE'; 
     
     // Address from which the latitude and longitude will be retrieved 
          $address = 'White House, Pennsylvania Avenue Northwest, Washington, DC, United States'; 
     
     // Formatted address 
    $formatted_address = str_replace(' ', '+', $address); 
     
     // Get geo data from Google Maps API by address 
     $geocodeFromAddr = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$formatted_address}&key={$GOOGLE_API_KEY}"); 
     
     // Decode JSON data returned by API 
     $apiResponse = json_decode($geocodeFromAddr); 
     echo $geocodeFromAddr;
// Retrieve latitude and longitude from API data 
$latitude  = $apiResponse->results[0]->geometry->location->lat;  
 $longitude = $apiResponse->results[0]->geometry->location->lng;     echo $latitude." ".$longitude;
?>
 -->
