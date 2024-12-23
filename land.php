<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
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
    <script src="https://kit.fontawesome.com/446beef736.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "nav.php"; ?>
    <!-- Home Section -->
    <section class="home_section">
        <div class="section-header">
            <div class="section-title" style="font-size:50px; color:white">
                Find Best Cars
            </div>
            <hr class="separator">
            <div class="section-tagline">
                for you'r comfortable and joyful raides.
            </div>
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="our-services" id="services">
        <div class="container">
            <div class="section-header">
                <div class="section-title">
                    What Services we offer to our clients
                </div>
                <hr class="separator">
                <div class="section-tagline">
                    Who are in extremely love with eco friendly system.
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature">
                        <h4>
                            <span>
                                <i class="far fa-user"></i>
                            </span>
                            Expert Technicians
                        </h4>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature">
                        <h4>
                            <span>
                                <i class="fas fa-certificate"></i>
                            </span>
                            Professional Service
                        </h4>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature">
                        <h4>
                            <span>
                                <i class="fas fa-phone-alt"></i>
                            </span>
                            Great Support
                        </h4>
                        <p>
                            Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="reservation_section" style="padding:50px 0px" id="reserve">
        <div class="conrainer">
            <div class="row m-5" style="align-items: center;">
                <div class="text_header col-md-6" style="text-align: center;">
                    <span>
                        Find your car
                    </span>
                </div>
                <div class="col-md-6">
                    <form method="POST" action="reserve.php" class="car-reservation-form" id="reservation_form" v-on:submit="checkForm">
                        <input type="hidden" name="user" value=<?php echo $_SESSION['username'] ?>>
                        <div class="">
                            <div class="form-group ">
                                <label for="pickup_location">Pickup Location</label>
                                <input type="text" class="form-control" name="pickup_location" placeholder="pickup location" required>

                            </div>
                            <div class="form-group">
                                <label for="return_location">Postal Code</label>
                                <input type="number" class="form-control" name="return_location" placeholder="pin code" v-model='return_location' required>

                            </div>
                            <div class="form-group">
                                <label for="pickup_date">Pickup Date</label>
                                <input id="pickup_date" type="date" min="<?php echo date('Y-m-d', strtotime("+1 day")) ?>" name="pickup_date" class="form-control" v-model='pickup_date' required>

                            </div>
                            <div class="form-group">
                                <label for="return_date">Return Date</label>
                                <input id="return_date" type="date" min="<?php echo date('Y-m-d', strtotime("+2 day")) ?>" name="return_date" class="form-control" v-model='return_date' required>

                            </div>
                            <div class="imp">
                                <p ><i><b>Importent:You should have vaild ID and Driving Licence.</b></i></p>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn sbmt-bttn" name="reserve_car">Book Instantly</button>

                            
                            <!-- Button trigger modal -->
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <?php
    include "footer.php";
    ?>