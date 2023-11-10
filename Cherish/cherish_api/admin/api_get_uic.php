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
include_once '../objects/obj_access_log.php';
  
$database = new Database();
$db = $database->getConnection();
  
$log = new Access_log($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way or a false credential)
SESSION_START();
if( 
    (substr($_SESSION['identifier'], 0,3) =="CAG")&&
    !empty($_POST['providedUid'])&&
    !empty($_POST['reason'])
    
){
    //if none of the data are missing, the data will be sanitize
    $providedUIDReady = htmlspecialchars(strip_tags($_POST['providedUid']));
    $reasonReady = htmlspecialchars(strip_tags($_POST['reason']));

    date_default_timezone_set('Asia/Kuala_Lumpur');

    // set the value to the object properties to be used 
    $log->adminID = $_SESSION['identifier'];
    $log->actionPerformed = "Has requested IC of ".$providedUIDReady;
    $log->dateAccessed = date('Y-m-d');
    $log->timeAccessed =  date("h:i:sa");
    $log->reason = $reasonReady;
    $log->uid = $providedUIDReady;

    //Call the function retrieve IC Actual Value.
    if($log->adminGetUIC()){
        //make a redirection here when successfully validated and retrieved
        header("Location:../../admin/dataReveal.php?icv=$log->icValue");
    }
    //unable to retrieve. Function call unsuccess.
    else{
        header("Location:../../admin/dataReveal.php?icv=null");
    }
}
// Data missing otw, or validation is a false 
else{
    header("Location:../../admin/dataReveal.php?icv=null");
}
?>