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
include_once '../objects/obj_ngo_campaign.php';
include_once '../objects/obj_ngo_activity.php';

  
$database = new Database();
$db = $database->getConnection();
  
$ngo = new Ngo_profile($db);
$campaign = new Ngo_campaign($db);
$activity = new Ngo_activity($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data missing along the way or a false credential)
SESSION_START();
if( 
    (substr($_SESSION['identifier'], 0,3) =="CAG")&&
    !empty($_POST['providedOuid'])
   
){
    //if none data are missing, the data will be sanitize
    $providedOuidReady = htmlspecialchars(strip_tags($_POST['providedOuid']));

    // set the value to the object properties to be used 
    $ngo->status = "unlisted";
    $campaign->campaignStatus = "unlisted";
    $activity->activityStatus = "unlisted";
    $ngo->ouid = $providedOuidReady;
    $campaign->ouid = $providedOuidReady;
    $activity->ouid = $providedOuidReady;
  
    if($ngo->updateNgoStatus()){
        if($campaign->updateAllCampaignStatus()){
            if($activity->updateAllActivityStatus()){
                header("Location: ../../admin/ngoManagement.php?actionDone=unlisted");
            }
        }
    }
    else{
        header("Location: ../../admin/ngoManagement.php?actionDone=anp");
    }
}
else{
    header("Location: ../../admin/ngoManagement.php?actionDone=anp");
}
?>