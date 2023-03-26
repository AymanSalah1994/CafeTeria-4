<?php
$name           = $_POST["name"];
$email          = $_POST["email"];
$ext            = $_POST["ext"];
$userID         = $_POST["userid"];
$profilePicture = "";
$errorString    = "";
$olds           = [];
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


// IMAGE UPLOAD
// File will Be optional , If Set then Delete Old One and Save the New one 
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
            global $userID;
            global $profilePicture;
            // Move the Image to a Folder 
            // Save the Image 
            // TODO Allowed Extensions
            // Sometimes the Folder Just Needs Permissions , Be aware 
            $extension      = explode(".", $_FILES["file"]["name"])[1]; // Get Image Extension
            $profilePicture = "users/" . $userID . "." . $extension; // The Path
            move_uploaded_file($_FILES["file"]["tmp_name"], $profilePicture);
            // NO NEED TO DELETE THE IMAGE in our Code Here , 
            // Since the New uploaded File will be same Name 
            // The new Uploaded Image will Override it 
        }
    }
    //  else {
    // NO NEED for else Part , Uplaod in Update is Optional 
    //     // Else Here in Case Size is 0 , Nothing uploaded !
    //     $errorString .= "file";
    //     $errorString .= ",";
    // }
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
    // validatingPassowrd(); // Third thing The Passwords  
    fileHandler(); // Should be last Thing to Check 
    // ONCE all Validated Check To see if Something Went Wrong 
    if ($errorString) {
        $xyz = json_encode($olds);
        $lc  = "Location: 8_update.php?errors={$errorString}&olds={$xyz}";
        header($lc);
        exit();
    }
    // If Nothing Went Wrong the Script Will Continue Working Below And Add the Data 
}


function PdoUpdateSQL($name_, $email_, $ext_, $userID_)
{
    try {
        $pdoConnection = new PDO("mysql:host=localhost;dbname=pdoTest", "ayman", "1994");
        $updateQuery   = "UPDATE `pdoTest`.`users` SET name=?, email=?, ext=?  WHERE Id=?";
        $stmt          = $pdoConnection->prepare($updateQuery);
        $stmt->execute([$name_, $email_, $ext_, $userID_]);
        // $result = $stmt->errorInfo();
        // var_dump($result) ; 
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

validationForForm();
PdoUpdateSQL($name, $email, $ext, $userID);

?>