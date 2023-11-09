<?php
/**
//Headers that are required for testing in postman
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
*/

//include the database connection file for db connection to happen
include_once '../config/database.php';
  
//include the object file so that we can set the data into its repsective properties.
include_once '../objects/obj_user_account.php';
  
$database = new Database();
$db = $database->getConnection();
  
$user = new Users_account($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
if( 
    !empty($_POST['icNumber'])&&
    !empty($_POST['username'])&&
    !empty($_POST['emailPart'])&&
    !empty($_POST['domainPart'])&&
    !empty($_POST['phoneNumber'])&&
    !empty($_POST['addressLine'])&&
    !empty($_POST['city'])&&
    !empty($_POST['state'])&&
    !empty($_POST['postalCode'])&&
    !empty($_POST['password'])
){
    //if none data are missing, the data will be sanitize
    $icNumberReady = htmlspecialchars(strip_tags($_POST['icNumber']));
    $usernameReady = htmlspecialchars(strip_tags($_POST['username']));
    $emailPartReady = htmlspecialchars(strip_tags($_POST['emailPart']));
    $domainPartReady = htmlspecialchars(strip_tags($_POST['domainPart']));
    $phoneNumberReady = htmlspecialchars(strip_tags($_POST['phoneNumber']));
    $addressLineReady = htmlspecialchars(strip_tags($_POST['addressLine']));
    $cityReady = htmlspecialchars(strip_tags($_POST['city']));
    $stateReady = htmlspecialchars(strip_tags($_POST['state']));
    $postCodeReady = htmlspecialchars(strip_tags($_POST['postalCode']));
    $passwordReady = htmlspecialchars(strip_tags($_POST['password']));

    $emailAddressReady = $emailPartReady."@".$domainPartReady;  //concat the email and domain field together
    $genderReady = "";   //decalre and initialize a gender variable for the incoming data

    //if statement to detect whether the user is a male or female through ic last digit (odd or even)
    if(((int)(substr($icNumberReady, -1)))% 2 == 0){
        $genderReady = "Female";
    }
    else{
        $genderReady = "Male";
    }

    // set the value to the object properties to be used 
    $user->icNumber = $icNumberReady;
    $user->uid = uniqid();    //uniqid() will generate a random 13digit id using reference to the timestamp of the computer
    $user->name = $usernameReady;
    $user->password = $passwordReady;
    $user->emailAddress = $emailAddressReady;
    $user->phoneNumber = $phoneNumberReady;
    $user->gender = $genderReady;
    $user->addressLine = $addressLineReady;
    $user->city = $cityReady;
    $user->state = $stateReady;
    $user->postalCode = $postCodeReady;

    //Call the function createAccount to create an account. The function is define in the obj file.
    if($user->createAccount()){
        //make a redirection here when successfully created the profile.
        header("Location: ../../users/profileSetup.php?uid=$user->uid&name=$usernameReady");
    }
    //unable to create account
    else{
  
       echo"Account Registration Error.";
      
    }
}
  
// data requested to create an account is incomplete 
else{

    echo"Data Error. Unable to create an account at the moment";

}
?>