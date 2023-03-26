<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
	<title>Add User Form - Lab 4</title>
</head>
<!-- name,email,password,passwordConfirm,roomNumber,ext , file , -->
<?php $stringOfErro = $_GET['errors']; 
	$oldy = json_decode($_GET["olds"]) ; 
	// var_dump($oldy) ; 
?>

<body>
	<?php
	require_once("./components/navBar.php");
	?>
	<h1>Add User</h1>
	<div class="container">
		<form action="./2_formHandler.php" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Name</label>
				<input name="name" type="text" class="form-control" 
				<?php 
					if ($oldy->name)
					{
						echo "value = {$oldy->name}" ; 
					}
				?>
				/>
				<?php
				if (str_contains($stringOfErro, 'name')) {
					echo "<label class=\"bg-danger\">Name Required</label>";
				}
				?>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input name="email" type="email" class="form-control"
				<?php 
					if ($oldy->email)
					{
						echo "value = {$oldy->email}" ; 
					}
				?>
				/>
				<?php
				if (str_contains($stringOfErro, 'emailNotValidOne')) {
					echo "<label class=\"bg-danger\">Email Is Not Valid</label>";
				} else if (str_contains($stringOfErro, 'email')) {
					echo "<label class=\"bg-danger\">Email Required</label>";
				}
				// ORDER is Important Because of str_contains() function 
				?>
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Password</label>
				<input type="password" class="form-control" name="password" />
				<?php
				if (str_contains($stringOfErro, 'password')) {
					echo "<label class=\"bg-danger\">Password Required</label>";
				} else if (str_contains($stringOfErro, 'bonus')) {
					echo "<label class=\"bg-danger\">Password 8 characters Only No Special Chars</label>";
				}
				?>
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1">Confirm Password</label>
				<input type="password" class="form-control" name="passwordConfirm" />
				<?php
				if (str_contains($stringOfErro, 'passwordConfirm')) {
					echo "<label class=\"bg-danger\">Confirmation Password Required</label>";
				}
				?>
			</div>
			<div class="form-group">
				<label>Room Number</label>
				<select class="form-control" name="roomNumber">
					<option value="Application 1">Application 1</option>
					<option value="Application 2">Application 2</option>
					<option value="Cloud">Cloud</option>
				</select>
			</div>
			<br />
			<div class="form-group">
				<label for="exampleFormControlInput1">Ext</label>
				<input class="form-control" name="ext" />
			</div>
			<br />
			<div class="form-group">
				<label for="exampleFormControlInput1">Profile Picture</label>
				<input type="file" name="file" class="form-control" />
			</div>
			<br />
			<br />
			<div class="form-group">
				<button class="btn btn-danger" type="reset">
					Reset form
				</button>
				<button class="btn btn-primary" type="submit">
					Submit Form
				</button>
			</div>
		</form>
	</div>
	<br><br><br>
</body>

</html>