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
    !empty($_POST['bio'])&&
    !empty($_SESSION['identifier'])
){

    //if none data are missing, the data will be sanitize
    $bioGiven = htmlspecialchars(strip_tags($_POST['bio']));
    
    // set the value to the object properties
    $ngo->ouid = $_SESSION['identifier'];
    $ngo->bio = $bioGiven;

    //Call the function updateBio to update user's bio. The function is define in the obj file.
    if($ngo->updateBio()){
        //make a redirection here when successfully updated the user's bio.
        header("Location:../../ngo/accountSetting.php?actionCondition=bioModifiedTrue");
    }
    //Unable to update 
    else{
       header("Location:../../ngo/accountSetting.php?actionCondition=anperr"); //anperr stands for action not performed error
    }
}
// Data missing.
else{
    header("Location:../../ngo/accountSetting.php?actionCondition=bioempty");
}
?>