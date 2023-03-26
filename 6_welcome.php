<!DOCTYPE html>
<html lang="en">
<?php
// Authorization For a Page !
session_start(); // It is Mandatory to use this Every Time you use Sessinos 
if (isset($_SESSION["Name"])) {
	$userName = $_SESSION["Name"];
} else {
	header("Location: 3_loginForm.php");
	exit();
}
?>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
	<title>Welcome Page</title>
</head>

<body>
	<?php
	require_once("./components/navBar.php");
	?>
	<div class="container">
		<div class="row">
			<img src="images/Welcome.jpg" alt="" style="height: 400px" />
			<form action="5_logOut.php" method="POST">
				<p>
					<?php echo "Welcome {$userName}"; ?>
				</p>
				<button type="submit" class="btn btn-danger">
					Log out
				</button>
			</form>
		</div>
	</div>
</body>

</html>