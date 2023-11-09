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

    $emailAddressReady = $emailPartReady."@".$domainPartReady;
    $genderReady = "";

    if(((int)(substr($icNumberReady, -1)))% 2 == 0){
        $genderReady = "Female";
    }
    else{
        $genderReady = "Male";
    }

    // set the value to the object variable to be used in the query
    $user->icNumber = $icNumberReady;
    $user->uid = uniqid();
    $user->name = $usernameReady;
    $user->password = $passwordReady;
    $user->emailAddress = $emailAddressReady;
    $user->phoneNumber = $phoneNumberReady;
    $user->gender = $genderReady;
    $user->addressLine = $addressLineReady;
    $user->city = $cityReady;
    $user->state = $stateReady;
    $user->postalCode = $postCodeReady;

    //Call the function create to create an account. The function is define in the obj file.
    if($user->create()){
        //make a redirection here when successfully created the profile.
        header("Location: https://www.google.com");
    }
  
    //unable to create account
    else{
  
       
      
    }
}
  
// user data incomplete 
else{



}
?>