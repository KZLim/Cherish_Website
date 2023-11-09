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
include_once '../objects/obj_donor_record.php';
  
$database = new Database();
$db = $database->getConnection();
  
$donation = new Donor_record($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//this if statement is a secondary check (a backend check, it check for any data missing along the way or false credential)
SESSION_START();
if( 
    !empty($_SESSION['identifier'])&&
    !empty($_POST['donateAmount'])&&
    !empty($_POST['campaignIdParam'])
){
    //if none data are missing, the data will be sanitize
    $donateAmountReady = htmlspecialchars(strip_tags($_POST['donateAmount']));
    $campaignIdReady = $_POST['campaignIdParam'];


    // set the value to the object properties to be used 
    $donation->amount = $donateAmountReady;
    $donation->campaignID = $campaignIdReady;    
    $donation->uid = $_SESSION['identifier'];
    

    //Call the function donateToCampaing to donate. The function is define in the obj file.
    if($donation->donateToCampaign()){
        //make a redirection here when successfully donated
        header("Location:../../main/donationCampaign.php?campaignid=$campaignIdReady&status=donationok");
    }
    //Unable to donate
    else{
        header("Location:../../main/donationCampaign.php?campaignid=$campaignIdReady&status=donationxok");
    }
}
  
// Data missing or false credential 
else{
    header("Location:../../main/donationCampaign.php?campaignid=$campaignIdReady&status=anp");
}
?>