<?php
session_start();

if ($_SESSION['loggedin'] != true) {
	header("location: index.php");
	exit;
}
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Resarvation</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="https://kit.fontawesome.com/446beef736.js" crossorigin="anonymous"></script>
	<link rel="icon" href="rent-it-high-resolution-logo.png" type="image/icon type">
</head>
<?php
function sendmail($email){
	$mail = new PHPMailer(true); // Passing true enables exceptions

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'singh.73pankaj.00@gmail.com';
$mail->Password = 'pbiy kueu wkdu xech';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
	$mail->setFrom('singh.73pankaj.00@gmail.com', 'Rent IT');
	$mail->addAddress($email, 'Recipient Name');
	$mail->Subject = 'Booking Update.';
	$mail->Body = 'Your Booking request has been send to the Owner plaese wait for the confirmation.We will inform you once your booking confirm by the car Owner.';
	$mail->AltBody = 'Thank You.';
	try {
		 $mail->send();
		 echo('<script>console.log("send")</script>');
	 } catch (Exception $e) {
		 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	 }
}
?>
<body>
	<?php include "nav.php";
	require_once "connection.php";
	if (isset($_POST['reserve_car']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
		$_SESSION['pickup_location'] = $_POST['pickup_location'];
		$_SESSION['return_location'] = $_POST['return_location'];
		$_SESSION['pickup_date'] = $_POST['pickup_date'];
		$_SESSION['return_date'] = $_POST['return_date'];
	}
	?>

	<!-- BANNER SECTION -->
	<div class="reserve-banner-section">
		<h2>
			Reserve your car
		</h2>
	</div>

	<?php
	if (isset($_POST['submit_reservation']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$loction = $_SESSION['pickup_location'];
		$pin = $_SESSION['return_location'];
		$pickdate = $_SESSION['pickup_date'];
		$returndate  = $_SESSION['return_date'];
		$carid =  $_POST['selected_car'];
		$adminid = $_POST['admin_id'];
		$uid = $_SESSION['id'];
		$mail=$_SESSION['username'];
		try {
			$a = mysqli_query($conn, "UPDATE cars SET status = 'booked' WHERE cno='$carid'");
			$stmt = $conn->prepare("insert into resarvation(user_id,carID,admin_id,date,location_pin,status) values(?,?,?,?,?,?) ");
			$stmt->execute(array($uid, $carid, $adminid, $pickdate, $pin, "waiting"));
			echo "<div class = 'alert alert-success'>";
			echo 'Waiting For Owner Confirmation!!!';
			echo "</div>";
			sendmail($mail);
		} catch (Exception $e) {
			echo "<div class = 'alert alert-danger'>";
			echo 'Error occurred: ' . $e->getMessage();
			echo "</div>";
		}
	}
	?>

	<form action="reserve.php" method="POST" id="reservation_second_form" v-on:submit="checkForm">
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-md-3 reservation_cards">
				<p>
					<i class="fas fa-calendar-alt"></i>
					<span>Pickup Date : </span><?php echo $_SESSION['pickup_date']; ?>
				</p>
			</div>
			<div class="col-md-3 reservation_cards">
				<p>
					<i class="fas fa-calendar-alt"></i>
					<span>Return Date : </span><?php echo $_SESSION['return_date']; ?>
				</p>
			</div>
			<div class="col-md-3 reservation_cards">
				<p>
					<i class="fas fa-map-marked-alt"></i>
					<span>Pickup Location : </span><?php echo $_SESSION['pickup_location']; ?>
				</p>
			</div>
			<div class="col-md-3 reservation_cards">
				<p>
					<i class="fas fa-map-marked-alt"></i>
					<span>Postel code : </span><?php echo $_SESSION['return_location']; ?>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
				<div class="btn-group-toggle" data-toggle="buttons">
					<div class="invalid-feedback" style="display:block;margin: 10px 0px;font-size: 15px;" v-if="selected_car === null">
						Select your car
					</div>
					<div class="items_tab">
						<?php
						$pin = $_SESSION['return_location'];
						$available_cars = mysqli_query($conn, "SELECT * FROM cars WHERE location_pin = '$pin' AND status ='ready'");
						if (mysqli_num_rows($available_cars) == 0) {
							echo "<h4>Sorry !!No car Available in your area!!</h4>";
						} else {
						?>
							<div class="collection">
								<?php
								foreach ($available_cars as $car) {
									echo "<div class='card m-2'>";
									echo "<img class='card-img-top' src='carimages/" . $car['image'] . "'.'>";
									echo "<div class='card-body'>";
									echo "<h5 class='card-title'>" . $car['Car_name'] . "</h5>";
									$AID = $car['admin_id'];
									$result  = mysqli_query($conn, "SELECT * FROM locations WHERE pin = '$pin' AND admin_id = '$AID'");
									$b = $result->fetch_assoc();
									echo "<h6 class='card-subtitle mb-2 text-body-secondary'><b>Pickup Location :</b> " . $b['pickup'] . "," . $b['location_name'] . "</h6>";
									$r = mysqli_query($conn, "SELECT * FROM admin WHERE  sno = '$AID'");
									$a = $r->fetch_assoc();
									echo "<h6 class='card-subtitle mb-2 text-body-secondary'> <b>Owner:</b>" . $a['Username'] . "</h6>";
									echo "<h6 class='card-subtitle mb-2 text-body-secondary'><b> Number: </b>" . $a['number'] . "</h6>";
									echo "<h6 class='card-subtitle mb-2 text-body-secondary'><b> Rent-per-hour:</b>" . $car['rant_per_hour'] . "</h6>";
								?>
									<div class="select_item_bttn">

										<input type="hidden" name="admin_id" value="<?php echo $AID; ?>">
										<!-- <input type="hidden" class="radio_car_select" name="selected_car" v-model = 'selected_car' value="<-?php echo '$AID' ?>"> -->
										<!-- <input type="radio" class="radio_car_select" name="selected_car" v-model='selected_car' value="<-?php echo $car['cno'] ?>">Select -->


									</div><label class="btn btn-outline-success" for="<?php echo $car['cno'] ?>">
										<input type="radio" class="btn-check" name="selected_car" id="<?php echo $car['cno'] ?>" autocomplete="off" value="<?php echo $car['cno'] ?>">
										Select</label>
							<?php
									echo "</div>";
									echo "</div>";
								}
								echo "</div>";
							}
							?>
							</div>
					</div>
				</div>
				<?php
				$user = $_SESSION['username'];

				$data = mysqli_query($conn, "SELECT * FROM user WHERE Email = '$user'");
				while ($d = $data->fetch_assoc()) {
				?>

					<div class="col-md-5">
						<div class="client_details">
							<div class="form-group">
								<label for="full_name">Name</label>
								<input type="text" class="form-control" value=<?php echo $d['Name'] ?> name="full_name" v-model='full_name' disabled>

							</div>
							<div class="form-group">
								<label for="client_email">E-mail</label>
								<input type="email" class="form-control"  name="client_email" value="<?php echo $d['Email'] ?>" v-model='client_email' disabled>
							</div>
							<div class="form-group">
								<label for="client_phonenumber">Phone numbder</label>
								<input type="text" name="client_phonenumber" value=<?php echo $d['Number'] ?> class="form-control" v-model='client_phonenumber' disabled>

							</div>
						<?php } ?>

						<button type="submit" class="btn sbmt-bttn" name="submit_reservation">Book Instantly</button>
						</div>
					</div>
			</div>
	</form>
<?php 
include 'footer.php';
?>