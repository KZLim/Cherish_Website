
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

session_start();
//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
if( 
    !empty($_SESSION['identifier'])&& 
    !empty($_POST['phoneNumber'])&&
    !empty($_POST['password'])
){
    //if none data are missing, the data will be sanitize
    $phoneNumberGiven = htmlspecialchars(strip_tags($_POST['phoneNumber']));
    $passwordGiven = htmlspecialchars(strip_tags($_POST['password']));

    //set the value to the object properties
    $user->uid = $_SESSION['identifier'];
    $user->phoneNumber = $phoneNumberGiven;  
    $user->password = $passwordGiven;       
   
    
    //Call the function updatePhone to update phone number. The function is define in the obj file.
    if($user->updatePhone()){
        //make a redirection here when successfully updated the phone number
        header("Location:../../users/accountSetting.php?actionCondition=phoneModifiedTrue");
    }
    //unable to update the phone number
    else{
  
       echo"Password provided incorrect, please try again.";
      
    }
}
  
// data requested to update the phone number incomplete
else{

    echo"Data Error. Unable to update phone number at the moment.";

}
?>