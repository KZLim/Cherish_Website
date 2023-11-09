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

session_start();
//this if statement is a secondary check (a backend check, it check for any data empty or missing along the way)
if(
    true
){

    //campaign info
    $infoGiven = htmlspecialchars(strip_tags($_POST['campaignInfo']));
    $ngo->campaignInfo = $infoGiven;

    //campaign banner
    $image_name = $_FILES['campaignBannerUpload']['name'];
    $tmp_name = $_FILES['campaignBannerUpload']['tmp_name'];
    $error = $_FILES['campaignBannerUpload']['error'];
    $ngo->campaignBanner = $image_name;
    $ngo->campaignBanner_tmp = $tmp_name;
    $ngo->campaignBanner_error = $error;

    //closing date
    $dateReady = $_POST['campaignClosingDate'];
    $ngo->closingDate = $dateReady;
    
    //set ouid and campaign id 
    $ngo->ouid = $_SESSION['identifier'];
    $ngo->campaignID = $_POST['campaignIdParam'];

    //Call the function updateBio to update user's bio. The function is define in the obj file.
    if($ngo->updateCampaign()){
        //make a redirection here when successfully updated the user's bio.
        header("Location:https://www.google.com");
       

    }
    //unable to setup profile 
    else{
  
       //echo"Something went wrong while updating the bio, please try again.";
      //header("Location:../../ngo/accountSetting.php?actionCondition=anperr"); //anperr stands for action not performed error

    }
}
  
// data requested to update user's bio incomplete
else{

    //echo"Data Error. Unable to update the profile bio at the moment.";
    //header("Location:../../ngo/accountSetting.php?actionCondition=bioempty");
}
?>