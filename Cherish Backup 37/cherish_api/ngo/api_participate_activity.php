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
include_once '../objects/obj_participant_record.php';
  
$database = new Database();
$db = $database->getConnection();
  
$participant = new Participant_record($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data missing along the way or false credential)
SESSION_START();
if( 
    !empty($_SESSION['identifier'])&&
    !empty($_POST['activityIdParam'])
){
    //if none data are missing, the data will be sanitize
    $activityIdReady = $_POST['activityIdParam'];

    // set the value to the object properties to be used 
    $participant->activityID = $activityIdReady;    
    $participant->uid = $_SESSION['identifier'];
    
    //Call the function volunteerInActivity to record participation. The function is define in the obj file.
    if($participant->volunteerInActivity()){
        //make a redirection here when successfully participate
        header("Location:../../main/volunteerActivity.php?activityid=$activityIdReady&action=joined");
    }
    //unable to participate
    else{
        header("Location:../../main/volunteerActivity.php?activityid=$activityIdReady&action=xjoined");      
    }
} 
// Data Missing or false credential
else{
    header("Location:../../main/volunteerActivity.php?activityid=$activityIdReady&action=anp");      
}
?>