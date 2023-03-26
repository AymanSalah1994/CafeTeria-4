<?php
$name                 = $_POST["name"];
$email                = $_POST["email"];
$password             = $_POST["password"];
$passwordConfirmation = $_POST["passwordConfirm"];
$ext                  = $_POST["ext"];
$roomNubmer           = $_POST["roomNumber"];

$userGeneratedID = mt_rand(); // Keep It For Now 
$profilePicture  = "";
$errorString     = "";
$olds            = [];
// EMAIL 
function validatingEmail()
{
    global $olds;
    global $errorString;
    if ($_POST["email"] == "") {
        $errorString .= "email";
        $errorString .= ",";
    } else
    // Well Email is Filled But We Will Check it  
    {
        $olds["email"] = $_POST["email"];
        $finalResult   = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        if (!$finalResult) {
            $errorString .= "emailNotValidOne";
            $errorString .= ",";
        }
    }
} // Email Validation OK  ; 

//  PASSWORD 
function validatingPassowrd()
{
    global $errorString;
    if ($_POST["password"] == "") {
        $errorString .= "password";
        $errorString .= ",";
    }

    if ($_POST["passwordConfirm"] == "") {
        $errorString .= "passwordConfirm";
        $errorString .= ",";
    }

    if ($_POST["password"] !== $_POST["passwordConfirm"]) {
        $errorString .= "passNotIdentical";
        $errorString .= ",";
    }
    global $password;
    if ($password) {
        $passwordPatterBonus = "/^[a-z_0-9]{8}$/";
        if (!preg_match($passwordPatterBonus, $password)) {
            $errorString .= "bonus";
            $errorString .= ",";
        }
    }
} // Validation For PassWord   OK ; 

// IMAGE UPLOAD
function fileHandler()
{
    global $errorString;
    $comingType = $_FILES["file"]["type"];
    $mime       = explode("/", $comingType)[0];
    // First Of all Check the File IS Uplaoded , 
    if ($_FILES["file"]["size"] > 0) {
        // echo "There is a Real File ";
        if ($mime !== "image") {
            $errorString .= "MimeFileError";
            $errorString .= ",";
            return;
        } else {
            global $userGeneratedID;
            global $profilePicture;
            // Move the Image to a Folder 
            // Save the Image 
            // TODO Allowed Extensions
            // Sometimes the Folder Just Needs Permissions , Be aware 
            $extension      = explode(".", $_FILES["file"]["name"])[1]; // Get Image Extension
            $profilePicture = "users/" . $userGeneratedID . "." . $extension; // The Path
            move_uploaded_file($_FILES["file"]["tmp_name"], $profilePicture);
        }
    } else {
        // Else Here in Case Size is 0 , Nothing uploaded !
        $errorString .= "file";
        $errorString .= ",";
    }
}

function validationForForm()
{
    global $olds;
    global $errorString;
    if ($_POST["name"] == "") {
        $errorString .= "name";
        $errorString .= ",";
    } // First Check For the Name  ; 
    else {
        $olds["name"] = $_POST["name"];
    }
    validatingEmail(); // Second Thing the Email 
    validatingPassowrd(); // Third thing The Passwords  
    fileHandler(); // Should be last Thing to Check 
    // ONCE all Validated Check To see if Something Went Wrong 
    if ($errorString) {
        $xyz = json_encode($olds);
        $lc  = "Location: 1_AddUserForm.php?errors={$errorString}&olds={$xyz}";
        header($lc);
        exit();
    }
    // If Nothing Went Wrong the Script Will Continue Working Below And Add the Data 
}


function PdoInsertSQL($userGeneratedID_, $name_, $email_, $password_, $roomNubmer_, $ext_, $profilePicture_)
{
    try {
        $pdoConnection = new PDO("mysql:host=localhost;dbname=pdoTest", "ayman", "1994");
        echo "Connected and OK ";
        $insertQuery = "INSERT INTO `pdoTest`.`users` (Id, name , email , password ,RoomNumber , ext , image)
        VALUES (?, ?, ?, ?, ? , ? , ?) ";
        $stmt        = $pdoConnection->prepare($insertQuery);
        $stmt->execute([$userGeneratedID_, $name_, $email_, $password_, $roomNubmer_, $ext_, $profilePicture_]);
        // $result = $stmt->errorInfo();
        // $pdoConnection->exec("select * from users ");
        closePdoConnection($pdoConnection);
        header('Location: 3_loginForm.php');
    } catch (Exception $pex) {
        echo "Something Went Wrong !";
        echo $pex;
    }
}

function closePdoConnection($pdo_Object)
{
    unset($pdo_Object); // There is NO close in PDO so we Unset it 
}

validationForForm(); // First Validate  , IF something Wroing a Redirection will happen 
PdoInsertSQL($userGeneratedID, $name, $email, $password, $roomNubmer, $ext, $profilePicture);

?>