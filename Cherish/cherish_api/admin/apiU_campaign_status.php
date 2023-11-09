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

//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way or a false credential)
session_start();
if( 
    (substr($_SESSION['identifier'], 0,3) =="CAG")&&
    !empty($_POST['campaignIdParam'])&&
    !empty($_POST['statusParam'])
){
    //if none data are missing, the data will be sanitize
    $campaignIdReady = htmlspecialchars(strip_tags($_POST['campaignIdParam']));
    $campaignStatusReady = htmlspecialchars(strip_tags($_POST['statusParam']));
    
    $ngo->campaignID = $campaignIdReady;
    $ngo->campaignStatus = $campaignStatusReady;

    //Call the function to update campaign status. The function is define in the obj file.
    if($ngo->updateCampaignStatus()){
        //make a redirection here when successfully updated.
        header("Location: ../../main/donationCampaign.php?campaignid=$campaignIdReady&updateStatus=success");
    }
    //Unable to update campaign status
    else{
        header("Location: ../../main/donationCampaign.php?campaignid=$campaignIdReady&updateStatus=anp");      
    }
}
// Data Missing or false credential
else{
    header("Location: ../../main/donationCampaign.php?campaignid=$_POST[campaignIdParam]&updateStatus=anp");      
}
?>