<style>
	.dropdown-menu {
		display: none;
		position: absolute;
		right: 0;
	}

	.dropdown-menu.show {
		display: block;
	}
</style>

<div class="container">
	<div class="row justify-content-between">
		<div class="col-md-3 d-flex align-items-center">
			<a class="navbar-brand" href="index.php">Автосервиз DriverHub<span>.</span></a>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col">
					<div class="top-wrap d-flex">
						<div class="icon d-flex align-items-center justify-content-center"><span
								class="fa fa-location-arrow"></span></div>
						<div class="text"><span>Адрес</span><span>Пловдив, България</span></div>
					</div>
				</div>
				<div class="col">
					<div class="top-wrap d-flex">
						<div class="icon d-flex align-items-center justify-content-center"><span
								class="fa fa-location-arrow"></span></div>
						<div class="text"><span>Телефон</span><span>123 456 7890</span></div>
					</div>
				</div>
				<div class="col-md-3 d-flex justify-content-end align-items-center">
					<div class="social-media">
						<p class="md-5 d-flex">
							<a href="https://www.facebook.com" class="d-flex align-items-center justify-content-center"><span
									class="fa fa-facebook"></span></a>
							<a href="https://twitter.com/?lang=en" class="d-flex align-items-center justify-content-center"><span
									class="fa fa-twitter"></span></a>
							<a href="https://instagram.com" class="d-flex align-items-center justify-content-center"><span
									class="fa fa-instagram"></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span
									class="fa fa-dribbble"></span></a>
						</p>
					</div>
					<div class="col">
						<div class="dropdown">
							<a style="font-size: 22px" href="#" id="profileDropdown" data-toggle="dropdown">
								<span class="fa fa-user-circle-o">Профил</span>
							</a>
							<div class="dropdown-menu" aria-labelledby="profileDropdown">
								<p>Име:
									<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>
								</p>
								<p>Имейл:
									<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>
								</p>
								<a href="settings.php" class="fa fa-cogs dropdown-item">Настройки</a>
								<a href="logout.php" class="fa fa-sign-out dropdown-item">Излизане</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const profileDropdown = document.getElementById('profileDropdown');
		profileDropdown.addEventListener('click', function (event) {
			event.preventDefault();
			event.stopPropagation();
			// Toggle dropdown menu
			profileDropdown.nextElementSibling.classList.toggle('show');
		});

		// Close dropdown when clicking outside
		document.addEventListener('click', function (event) {
			if (!profileDropdown.nextElementSibling.contains(event.target)) {
				profileDropdown.nextElementSibling.classList.remove('show');
			}
		});
	});
</script>
