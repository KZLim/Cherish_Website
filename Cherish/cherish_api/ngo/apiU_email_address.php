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
//this if statement is a secondary check (a backend check, it check for any data missing along the way or false credential)
if( 
    !empty($_SESSION['identifier'])&& 
    !empty($_POST['emailPart'])&&
    !empty($_POST['domainPart'])&&
    !empty($_POST['password'])
){
    //if none data are missing, the data will be sanitize
    $emailPartGiven = htmlspecialchars(strip_tags($_POST['emailPart']));
    $domainPartGiven = htmlspecialchars(strip_tags($_POST['domainPart']));
    $passwordGiven = htmlspecialchars(strip_tags($_POST['password']));

    //set the value to the object properties
    $ngo->ouid = $_SESSION['identifier'];
    $ngo->email = $emailPartGiven.'@'.$domainPartGiven;  //set new email address to obj email address property
    $ngo->password = $passwordGiven;  //set the password given to the password property for validation purpose
   
    
    //Call the function updateEmail to update email. The function is define in the obj file.
    if($ngo->updateEmail()){
        //make a redirection here when successfully updated the email
        header("Location:../../ngo/accountSetting.php?actionCondition=emailModifiedTrue");
    }
    //unable to update the email
    else{
        header("Location:../../ngo/accountSetting.php?actionCondition=anperr");      
    }
}
  
// Data missing or false credential
else{
    header("Location:../../ngo/accountSetting.php?actionCondition=anperr");      
}
?>