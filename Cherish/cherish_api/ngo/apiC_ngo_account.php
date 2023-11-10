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
include_once '../objects/obj_ngo_account.php';
  
$database = new Database();
$db = $database->getConnection();
  
$ngo = new Ngo_account($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data missing along the way or false credential)
if( 
    !empty($_POST['emailPart'])&&
    !empty($_POST['domainPart'])&&
    !empty($_POST['password'])
){
    //if none data are missing, the data will be sanitize
    $emailPartReady = htmlspecialchars(strip_tags($_POST['emailPart']));
    $domainPartReady = htmlspecialchars(strip_tags($_POST['domainPart']));
    $icNumberReady = htmlspecialchars(strip_tags($_POST['icNumber']));
    $passwordReady = htmlspecialchars(strip_tags($_POST['password']));

    $emailAddressReady = $emailPartReady."@".$domainPartReady;  //concat the email and domain field together

    // set the value to the object properties to be used 
    $ngo->ouid = uniqid('crt');    //uniqid() will generate a random 13digit id using reference to the timestamp of the computer
    $ngo->email = $emailAddressReady;
    $ngo->icNumber = $icNumberReady;
    $ngo->password = $passwordReady;

    //Call the function createAccount to create an account. The function is define in the obj file.
    if($ngo->createAccount()){
        //make a redirection here when successfully created the profile.
        header("Location: ../../ngo/profileSetup.php?ouid=$ngo->ouid&email=$ngo->email");
    }
    //unable to create account
    else{
        header("Location: ../../ngo/register.php?action=anp");      
    }
}
  
// Data missing
else{
    header("Location: ../../ngo/register.php?action=anp");      
}
?>