<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
	<title>ITI Cafeteria</title>
</head>

<body>
	<?php
	require_once("./components/navBar.php");
	?>
	<div class="container">
		<form action="./4_loginHandler.php" method="POST">
			<img src="./images/Caf.png" class="img-responsive center-block d-block mx-auto" />
			<div class="mb-3">
				<label class="form-label">Email address</label>
				<input type="email" class="form-control" name="email" />
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Password</label>
				<input type="password" class="form-control" name="password" />
			</div>
			<div class="mb-3 form-check">
				<input type="checkbox" class="form-check-input" checked />
				<label class="form-check-label">Remember Me</label>
			</div>
			<button type="submit" class="btn btn-primary">Log In</button>
			<?php
			if ($_GET["error"]) {
				echo "<label class=\"form-check-label bg-danger\">Not Valid Credintials</label>";
			}
			?>
		</form>
	</div>
</body>

</html>