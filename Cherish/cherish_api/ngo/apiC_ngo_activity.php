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
include_once '../objects/obj_ngo_activity.php';
  
$database = new Database();
$db = $database->getConnection();
  
$ngo = new Ngo_activity($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data missing along the way or false credential)
session_start();
if( 
    !empty($_POST['activityName'])&&
    !empty($_POST['activityInfo'])&&
    !empty($_POST['participationLimit'])&&
    $_FILES['activityBannerUpload']['size'] > 0
){
    //if none data are missing, the data will be sanitize
    $activityNameReady = htmlspecialchars(strip_tags($_POST['activityName']));
    $activityInfoReady = htmlspecialchars(strip_tags($_POST['activityInfo']));
    $activityDateReady = $_POST['activityDate'];
    $closingDateReady = $_POST['activityClosingDate'];
    $startTimeReady = htmlspecialchars(strip_tags($_POST['startTime']));
    $startAMPM_ready = $_POST['startAMPM'];
    $endTimeReady = htmlspecialchars(strip_tags($_POST['endTime']));
    $endAMPM_ready = $_POST['endAMPM'];
    $addressLineReady  = htmlspecialchars(strip_tags($_POST['addressLine']));
    $postCodeReady  = htmlspecialchars(strip_tags($_POST['postalCode']));
    $cityReady  = htmlspecialchars(strip_tags($_POST['city']));
    $stateReady  = htmlspecialchars(strip_tags($_POST['state']));
    $participationLimitReady = htmlspecialchars(strip_tags($_POST['participationLimit']));
    
    //getting the images information   
    $image_name = $_FILES['activityBannerUpload']['name'];
    $tmp_name = $_FILES['activityBannerUpload']['tmp_name'];
    $error = $_FILES['activityBannerUpload']['error'];

    // set the value to the object properties to be used 
    $ngo->activityName = $activityNameReady;
    $ngo->activityID = uniqid();
    $ngo->activityInfo = $activityInfoReady;
    $ngo->addressLine = $addressLineReady;
    $ngo->postCode = $postCodeReady;
    $ngo->city = $cityReady;
    $ngo->state = $stateReady;
    $ngo->activityDate = $activityDateReady;
    $ngo->closingDate = $closingDateReady;
    $ngo->activityTime = $startTimeReady.$startAMPM_ready."-".$endTimeReady.$endAMPM_ready;
    $ngo->participationLimit = $participationLimitReady;
    $ngo->currentParticipation = 0;
    $ngo->activityStatus = "new";
    $ngo->activityBanner = $image_name;
    $ngo->activityBanner_tmp = $tmp_name;
    $ngo->activityBanner_error = $error;
    $ngo->ouid = $_SESSION['identifier'];

    //Call the function createActivity. The function is define in the obj file.
    if($ngo->createActivity()){
        //make a redirection here when successfully created the activity.
        header("Location: ../../ngo/profile.php?action=activityCreated");
    }
    //Unable to create activity
    else{
        header("Location: ../../ngo/profile.php?action=anp");
    }
}
  
// Data missing or false credential
else{
    header("Location: ../../ngo/profile.php?action=anp");
}
?>