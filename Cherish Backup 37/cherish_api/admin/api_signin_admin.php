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
include_once '../objects/obj_admin_account.php';
  
$database = new Database();
$db = $database->getConnection();
  
$admin = new Admin_account($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
if( 
    !empty($_POST['adminID'])&&
    !empty($_POST['password'])
    
){
    //if none data are missing, the data will be sanitize
    $adminIdGiven = htmlspecialchars(strip_tags($_POST['adminID']));
    $passwordGiven = htmlspecialchars(strip_tags($_POST['password']));


    // set the value to the object properties to be used 
    $admin->adminID = $adminIdGiven;
    $admin->password = $passwordGiven;    
    

    //Call the function validateSignIn to sign in. The function is define in the obj file.
    if($admin->adminSignIn()){
        //make a redirection here when successfully sign in
        header("Location:../../admin/adminDashboard.php");
    }
    //Account found but Invalid Credential
    else{
        header("Location:../../admin/signin.php?actionDone=invcred");
    }
}
  
// Data Missing or Account Not Found
else{
    header("Location:../../admin/signin.php?actionDone=anp");
}
?>