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

//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
if( 
    //!empty($_SESSION['uid'])&&  //check session value 
    //!empty($_FILES['profilePicUpload'])
    true
){
    //getting the images information   
    $image_name = $_FILES['profilePicUpload']['name'];
    $tmp_name = $_FILES['profilePicUpload']['tmp_name'];
    $error = $_FILES['profilePicUpload']['error'];

     // set the value to the object properties
    $user->uid = "64eb37ae8940e";
    $user->profilePicName =$image_name;
    $user->tmpPath = $tmp_name;
    $user->errorCount = $error;
   
    
    //Call the function updatePhoto to update profile picture. The function is define in the obj file.
    if($user->updatePhoto()){
        //make a redirection here when successfully updated the profile picture
        //header("Location:https://google.com");
        echo"pro pic changed";

    }
    //unable to update the profile picture
    else{
  
       echo"error";
      
    }
}
  
// data requested to update the profile picture incomplete
else{

    echo"data missing";

}
?>