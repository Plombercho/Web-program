<?php
session_start();
require 'dbConnection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Settings</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- icon shows with this url-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="wrap">
        <?php
        require 'header.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <h1>Change Password</h1>
                    <form method="post" action="setting_script.php">
                        <div class="form-group">
                            <input type="password" class="form-control" name="oldPassword" placeholder="Old Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="newPassword" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="retype"
                                placeholder="Re-type new password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Change">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br><br><br>
        <?php
        require 'footer.php';
        ?>
    </div>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
</body>

</html>