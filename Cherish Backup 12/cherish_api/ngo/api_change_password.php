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

session_start();
//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
if( 
    !empty($_SESSION['identifier'])&&
    !empty($_POST['oldPassword'])&&
    !empty($_POST['newPassword'])&&
    !empty($_POST['confirmPassword'])
    
){
    //if none data are missing, the data will be sanitize
    $oldPasswordGiven = htmlspecialchars(strip_tags($_POST['oldPassword']));
    $newPasswordGiven = htmlspecialchars(strip_tags($_POST['newPassword']));

    // set the value to the object properties to be used 
    $ngo->ouid = $_SESSION['identifier'];
    $ngo->oldPassword = $oldPasswordGiven;
    $ngo->password = $newPasswordGiven;    
    

    //Call the function resetPassword to sign in. The function is define in the obj file.
    if($ngo->changePassword()){
        //make a redirection here when successfully reset password
        header("Location:../../ngo/accountSetting.php?actionCondition=passwordModifiedTrue");

    }
    //unable to sign in
    else{
  
       echo"Unable to reset password, please try again.";
      
    }
}
  
// data requested to reset password incomplete.
else{

    echo"Data Error. Unable to reset password at the moment";

}
?>