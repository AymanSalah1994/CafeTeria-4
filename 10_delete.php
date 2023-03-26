<?php
// Delete and then Go back to the Users table 

$userID = $_GET["id"];

function PdoDeleteSQL($userID_)
{
    try {
        $pdoConnection = new PDO("mysql:host=localhost;dbname=pdoTest", "ayman", "1994");
        // First Phase to Delete the Image ; 
        $selectQuery = "SELECT * FROM users Where id = ? ";
        $stmt        = $pdoConnection->prepare($selectQuery);
        $stmt->execute([$userID_]);
        $finalALlData  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $userDataAssoc = $finalALlData[0];
        deleteImage($userDataAssoc["image"]);
        // Second Phase To delete the User Himself
        $deleteQuery = "DELETE FROM  `pdoTest`.`users`  WHERE Id=?";
        $stmt2       = $pdoConnection->prepare($deleteQuery);
        $stmt2->execute([$userID_]);
        closePdoConnection($pdoConnection);
        header('Location: 7_usersTable.php');
    } catch (Exception $pex) {
        echo "Something Went Wrong !";
        echo $pex;
    }
}

function closePdoConnection($pdo_Object)
{
    unset($pdo_Object);
}

function deleteImage($filePath)
{
    // TODO
    unlink($filePath);
}


PdoDeleteSQL($userID);