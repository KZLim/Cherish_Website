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
include_once '../objects/obj_user_profile.php';
  
$database = new Database();
$db = $database->getConnection();
  
$user = new Users_profile($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//check whether the profile images is empty 
if(!empty($_FILES['profilePicUpload'])){

    //the data passed using hidden and post method in the second step of the reigstration process. These data come from the first step.
    $uidParamData = $_POST['uidparam'];
    $nameParamData = $_POST['nameparam'];

    //getting the images information   
    $image_name = $_FILES['profilePicUpload']['name'];
    $tmp_name = $_FILES['profilePicUpload']['tmp_name'];
    $error = $_FILES['profilePicUpload']['error'];

    // set the value to the object properties
    $user->uid = $uidParamData;
    $user->name = $nameParamData;
    $user->bio = $_POST['bio'];
    $user->profilePicName =$image_name;
    $user->tmpPath = $tmp_name;
    $user->errorCount = $error;

    //Call the function create to setup an profile for the user. The function is define in the obj file.
    //this is step 2 of the registration process
    if($user->createProfile()){
        //make a redirection here when successfully created the profile.
        header("Location:../../users/refisterProcess.php");
    }
    //unable to setup profile 
    else{
  
       
      
    }
}
  
// profile data incomplete 
else{



}
?>