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
include_once '../objects/obj_ngo_profile.php';
  
$database = new Database();
$db = $database->getConnection();
  
$ngo = new Ngo_profile($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

session_start();
//this if statement is a secondary check (a backend check, it check for any data missing along the way or false credential)
if( 
    !empty($_SESSION['identifier'])&&  
    !empty($_POST['addressLine'])&&
    !empty($_POST['city'])&&
    !empty($_POST['state'])&&
    !empty($_POST['postalCode'])&&
    !empty($_POST['password'])
){
    //if none data are missing, the data will be sanitize
    $addressLineGiven = htmlspecialchars(strip_tags($_POST['addressLine']));
    $cityGiven = htmlspecialchars(strip_tags($_POST['city']));
    $stateGiven = htmlspecialchars(strip_tags($_POST['state']));
    $postCodeGiven = htmlspecialchars(strip_tags($_POST['postalCode']));
    $passwordGiven = htmlspecialchars(strip_tags($_POST['password']));

    //set the value to the object properties
    $ngo->ouid = $_SESSION['identifier'];
    $ngo->addressLine = $addressLineGiven;  
    $ngo->city = $cityGiven;      
    $ngo->state = $stateGiven; 
    $ngo->postalCode = $postCodeGiven; 
    $ngo->password = $passwordGiven;
    
    //Call the function to update address. The function is define in the obj file.
    if($ngo->updateAddress()){
        //make a redirection here when successfully updated the address
        header("Location:../../ngo/accountSetting.php?actionCondition=addressModifiedTrue");

    }
    //Unable to update the address
    else{
        header("Location:../../ngo/accountSetting.php?actionCondition=anperr");
    }
}
  
// Data missing or false credential
else{
    header("Location:../../ngo/accountSetting.php?actionCondition=anperr");
}
?>