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
include_once '../objects/obj_ngo_campaign.php';
  
$database = new Database();
$db = $database->getConnection();
  
$ngo = new Ngo_campaign($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
session_start();
if( 
    !empty($_POST['campaignName'])&&
    !empty($_POST['campaignInfo'])&&
    !empty($_POST['raiseGoal'])&&
    $_FILES['campaignBannerUpload']['size'] > 0
){
    //if none data are missing, the data will be sanitize
    $campaignNameReady = htmlspecialchars(strip_tags($_POST['campaignName']));
    $campaignInfoReady = htmlspecialchars(strip_tags($_POST['campaignInfo']));
    $raiseGoalReady = htmlspecialchars(strip_tags($_POST['raiseGoal']));
    $dateReady = $_POST['closingDate'];

    //getting the images information   
    $image_name = $_FILES['campaignBannerUpload']['name'];
    $tmp_name = $_FILES['campaignBannerUpload']['tmp_name'];
    $error = $_FILES['campaignBannerUpload']['error'];

    // set the value to the object properties to be used 
    $ngo->campaignName = $campaignNameReady;
    $ngo->ouid = $_SESSION['identifier'];
    $ngo->campaignID = uniqid();
    $ngo->campaignInfo = $campaignInfoReady;
    $ngo->raiseGoal = $raiseGoalReady;
    $ngo->progress = 0;
    $ngo->closingDate = $dateReady;
    $ngo->campaignStatus = "listed";
    $ngo->campaignBanner = $image_name;
    $ngo->campaignBanner_tmp = $tmp_name;
    $ngo->campaignBanner_error = $error;

    //Call the function createAccount to create an account. The function is define in the obj file.
    if($ngo->createCampaign()){
        //make a redirection here when successfully created the profile.
        header("Location: https://www.google.com");
    }
    //unable to create account
    else{
        
       echo"ngo error.";
      
    }
}
  
// data requested to create an account is incomplete 
else{

    echo"ngo error 2";

}
?>