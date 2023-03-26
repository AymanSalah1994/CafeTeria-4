<?php
// WE First Make the Connection , Get the Data , AND then LOOP using HTML 
// And We will Use the Variables we Get From Connection Here  ; 
try {
	$pdoConnection = new PDO("mysql:host=localhost;dbname=pdoTest", "ayman", "1994");
	$selectQuery   = "SELECT * FROM users";
	$stmt          = $pdoConnection->prepare($selectQuery);
	$stmt->execute();
	$finalALlData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $pex) {
	// Generic But Still not Good !!! Change this Exception 
	// TODO
	echo "Something Went Wrong !";
	echo $pex;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
	<title>Table Of Users</title>
</head>

<body>
	<?php
	require_once("./components/navBar.php");
	?>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Image Path TODO-Avatar </th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($finalALlData as $eachRow):
				echo "<tr>";
				echo "<td>{$eachRow["Id"]}</td>";
				echo "<td>{$eachRow["name"]}</td>";
				echo "<td>{$eachRow["email"]}</td>";
				echo "<td>{$eachRow["image"]}</td>";
				echo "<td>
				<a class='btn btn-primary' href='8_update.php?id={$eachRow["Id"]}'>Update</a>
				<a class='btn btn-danger' href='10_delete.php?id={$eachRow["Id"]}'>Delete</a>
				</td>";
				echo "</tr>";
			endforeach;
			?>
		</tbody>
	</table>
</body>

</html>