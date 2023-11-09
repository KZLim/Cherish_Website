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
//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
if( 
    !empty($_SESSION['identifier'])&& 
    $_FILES['profilePicUpload']['size'] > 0
){
    //getting the images information   
    $image_name = $_FILES['profilePicUpload']['name'];
    $tmp_name = $_FILES['profilePicUpload']['tmp_name'];
    $error = $_FILES['profilePicUpload']['error'];

     // set the value to the object properties
    $ngo->ouid = $_SESSION['identifier'];
    $ngo->profilePath =$image_name;
    $ngo->tmpPath = $tmp_name;
    $ngo->errorCount = $error;
   
    
    //Call the function updatePhoto to update profile picture. The function is define in the obj file.
    if($ngo->updatePhoto()){
        //make a redirection here when successfully updated the profile picture
        //header("Location:https://google.com");
        header("Location:../../ngo/accountSetting.php?actionCondition=pictureModifiedTrue");

    }
    //unable to update the profile picture
    else{
  
       //echo"Image Upload Error, please try again.";
       header("Location:../../ngo/accountSetting.php?actionCondition=anperr"); //anperr stands for action not performed error
       
    }
}
  
// data requested to update the profile picture incomplete
else{

    //echo"Data Error. Unable to update profile at the moment";
    header("Location:../../ngo/accountSetting.php?actionCondition=pppempty");   //pppempty stands for profile pic provided empty 

}
?>