<?php
try {
    $pdoConnection = new PDO("mysql:host=localhost;dbname=pdoTest", "ayman", "1994");
    // echo "Connected and OK ";
    $selectQuery = "SELECT * FROM users Where id = ? ";
    $stmt        = $pdoConnection->prepare($selectQuery);
    $stmt->execute([$_GET["id"]]);
    $finalALlData  = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $userDataAssoc = $finalALlData[0];
    unset($pdoConnection);
    // var_dump($userDataAssoc);
} catch (Exception $pex) {
    echo "Something Went Wrong !";
    echo $pex;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Update User</title>
</head>
<!-- name,email,password,passwordConfirm,roomNumber,ext , file , -->
<?php $stringOfErro = $_GET['errors']; 
$oldy = json_decode($_GET["olds"]) ; 
?>

<body>
    <?php
    require_once("./components/navBar.php");
    ?>
    <h1>Update User</h1>
    <div class="container">
        <form action="9_updateHandler.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" value=<?php
                echo $userDataAssoc["name"];
                if ($oldy->name)
					{
						echo  $oldy->name ; 
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
                <input name="email" type="email" class="form-control" value=<?php
                echo $userDataAssoc["email"];
                ?> 
                <?php 
					if ($oldy->email)
					{
						echo $oldy->email ; 
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

            <br />
            <div class="form-group">
                <label for="exampleFormControlInput1">Ext</label>
                <input class="form-control" name="ext" value="<?php
                echo $userDataAssoc["ext"];
                ?> "
                />
            </div>
            <br />
            <div class="form-group">
                <label for="exampleFormControlInput1">Profile Picture</label>
                <input type="file" name="file" class="form-control" />
            </div>
            <br />
            <br />
            <input type="text" name="userid" style="display:none" class="form-control" value=<?php
            echo $userDataAssoc["Id"];
            ?> />
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    Update Form
                </button>
            </div>
        </form>
    </div>
    <br><br><br>
</body>

</html>