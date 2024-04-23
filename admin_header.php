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
					
				</div>
				<div class="col">
				
				</div>
					<div class="col">
						<!-- Profile dropdown -->
						<div class="dropdown">
							<a style="font-size: 22px" href="#" id="profileDropdown" data-toggle="dropdown">
								<span class="fa fa-user-circle-o">Профил</span>
							</a>
							<div class="dropdown-menu" aria-labelledby="profileDropdown">
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