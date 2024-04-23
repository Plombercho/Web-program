<?php
session_start();
require 'dbConnection.php';

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
} else {
	header("Location: login.php");
	exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$insert_query = "INSERT INTO messages (user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)";
	$insert_result = mysqli_query($conn, $insert_query);

	if ($insert_result) {
		echo "Съобщението беше успешно изпратено.";
	} else {
		echo "Възникна грешка при изпращане на съобщението.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Contact</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
		rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">

	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="wrap">
		<?php
		require 'header.php';

		?>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
					aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span> Меню</button>
				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item"><a href="index.php" class="nav-link">Автосервиз</a></li>
						<?php
						if (isset($_SESSION['user_id'])) {
							?>
							<li class="nav-item active"><a href="contact.php" class="nav-link">Контакти</a></li>
							<li class="nav-item"><a href="car_accessories.php" class="nav-link">Аксесоари</a></li>
							<li class="nav-item"><a href="car_parts.php" class="nav-link">Части</a></li>
							<li class="nav-item"><a href="car_tools.php" class="nav-link">Инструменти</a></li>
							<?php
						} else {
							?>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END nav and header-->
		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper">
							<div class="row no-gutters">
								<div class="col-md-7 d-flex">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Пишете ни</h3>
										<form method="POST" action="send_message.php" class="contactForm">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" name="name" id="name"
															placeholder="Име" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="email" class="form-control" name="email" id="email"
															placeholder="Email" required>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" name="subject"
															id="subject" placeholder="Предмет" required>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<textarea name="message" class="form-control" id="message"
															cols="30" rows="7" placeholder="Съобщение" required></textarea>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" value="Изпрати съобщение"
															class="btn btn-primary">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-5 d-flex align-items-stretch">
									<div class="info-wrap bg-primary w-100 p-lg-5 p-4">
										<h3 class="mb-4 mt-md-4">Свържете се с нас</h3>
										<div class="dbox w-100 d-flex align-items-start">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="fa fa-map-marker"></span>
											</div>
											<div class="text pl-3">
												<p><span>Адрес:</span> Пловдив, България</p>
											</div>
										</div>
										<div class="dbox w-100 d-flex align-items-center">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="fa fa-phone"></span>
											</div>
											<div class="text pl-3">
												<p><span>Телефон:</span> <a href="tel://1234567920">+ 1235 2355 98</a>
												</p>
											</div>
										</div>
										<div class="dbox w-100 d-flex align-items-center">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="fa fa-paper-plane"></span>
											</div>
											<div class="text pl-3">
												<p><span>Email:</span> <a
														href="mailto:info@yoursite.com">info@yoursite.com</a></p>
											</div>
										</div>
										<div class="dbox w-100 d-flex align-items-center">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="fa fa-globe"></span>
											</div>
											<div class="text pl-3">
												<p><span>Уебсайт</span> <a href="#">yoursite.com</a></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d131640.32884658612!2d23.3219!3d42.6977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40aa84877a685d4b%3A0x993f69a6764f0ef4!2sПловдив%2C%20България!5e0!3m2!1sen!2sus!4v1618647197157!5m2!1sbg!2sus"
							width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
						</iframe>
					</div>
				</div>
			</div>
		</section>

		<?php
		require 'footer.php';
		?>

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
