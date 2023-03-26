<?php
// session_destroy();
$userEmail = $_POST["email"];
$userPass  = $_POST["password"];
$userName  = "";

function PdoSelectSQL($email_, $password_)
{
    try {
        $pdoConnection = new PDO("mysql:host=localhost;dbname=pdoTest", "ayman", "1994");
        $selectQuery   = "SELECT * FROM  `pdoTest`.`users` WHERE email= ? AND password=?";
        $stmt          = $pdoConnection->prepare($selectQuery);
        $stmt->execute([$email_, $password_]);
        $finalResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($finalResult);
        if ($finalResult) {
            session_start(); // First things First 
            $_SESSION["Name"]  = $finalResult[0]["name"];
            $_SESSION["email"] = $finalResult[0]["email"];
            closePdoConnection($pdoConnection);
            header("Location: 6_welcome.php");
            exit();
        } else {
            header("Location: 3_loginForm.php?error=noVal");
            exit();
        }
    } catch (Exception $pex) {
        echo "Something Went Wrong !";
        echo $pex;
    }
}

function closePdoConnection($pdo_Object)
{
    unset($pdo_Object);
}

PdoSelectSQL($userEmail, $userPass);