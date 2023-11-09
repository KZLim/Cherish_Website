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
    !empty($_POST['emailPart'])&&
    !empty($_POST['domainPart'])&&
    !empty($_POST['icNumber'])&&
    !empty($_POST['password'])&&
    !empty($_POST['confirmPassword'])
    
){
    //if none data are missing, the data will be sanitize
    $emailPartGiven = htmlspecialchars(strip_tags($_POST['emailPart']));
    $domainPartGiven = htmlspecialchars(strip_tags($_POST['domainPart']));
    $icNumberGiven = htmlspecialchars(strip_tags($_POST['icNumber']));
    $passwordGiven = htmlspecialchars(strip_tags($_POST['password']));

    // set the value to the object properties to be used 
    $user->emailAddress = $emailPartGiven.'@'.$domainPartGiven;
    $user->icNumber = $icNumberGiven;
    $user->password = $passwordGiven;    
    

    //Call the function create to sign in. The function is define in the obj file.
    if($user->resetPassword()){
        //make a redirection here when successfully sign in
        header("Location:https://google.com");

    }
    //unable to sign in
    else{
  
       echo"error";
      
    }
}
  
// sign in credential incomplete 
else{

    echo"data missing";

}
?>