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
    <title>MY Bookings</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="icon" href="rent-it-high-resolution-logo.png" type="image/icon type">
    <style>
        .table {
            background: whitesmoke !important;
            display: flex;
            justify-content: center;
            margin: 20px;
        }
    </style>
</head>

<body>
    <?php
    include "nav.php";
    include "connection.php";
    ?>
    
    <section class="reservation_section mb-2" style="padding:70px">
    <div class="container">
        <div class="section-header">
            <div class="section-title" style="font-size:50px; color:white">
                My Bookings
            </div>
            </div>
            <hr class="separator">
            <div class="table container">
                <?php
                $user = $_SESSION['id'];
                $result = mysqli_query($conn, "SELECT * FROM resarvation WHERE user_id =$user");
                if (mysqli_num_rows($result) == 0) {
                    echo "<h3>Sorry ! no booking yet</h3>";
                } else {
                ?>
                    <table style="width:100%">
                        <tr>
                            <th style="width:10%">Date</th>
                            <th>Car</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th style="width:30%">Remark</th>
                            <th style="width:10%">Action</th>
                        </tr>
                        <?php
                        while ($b = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $b['date']; ?></td>
                                <td><?php echo $b['carID']; ?></td>
                                <td><?php echo $b['location_pin'] ?></td>
                                <td><?php echo $b['status'] ?></td>
                                <td><?php echo $b['remark'] ?></td>
                                <td>action</td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
            </div>
        <?php
                }
        ?>
        </div>
    </section>

    <?php
    include "footer.php"
    ?>