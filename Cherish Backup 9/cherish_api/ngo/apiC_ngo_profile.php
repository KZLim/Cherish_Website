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
  
$database = new Database();
$db = $database->getConnection();
  
$ngo = new Ngo_profile($db);
  
//this line of code is used for api testing through postman. Disabled when not in testing.
//$data = json_decode(file_get_contents("php://input"));

//check whether the profile images is empty 
if(true){

    //the data passed using hidden and post method in the second step of the reigstration process. These data come from the first step.
    $uidParamData = $_POST['uidparam'];
    $emailParamData = $_POST['emailparam'];

    $ngoNameReady = htmlspecialchars(strip_tags($_POST['ngoName']));
    $registrationNumberReady = htmlspecialchars(strip_tags($_POST['regNumber']));
    $addressLineReady = htmlspecialchars(strip_tags($_POST['addressLine']));
    $postCodeReady= htmlspecialchars(strip_tags($_POST['postalCode']));
    $cityReady = htmlspecialchars(strip_tags($_POST['city']));
    $stateReady = htmlspecialchars(strip_tags($_POST['state']));
    $bioReady = htmlspecialchars(strip_tags($_POST['bio']));
    $urlReady = htmlspecialchars(strip_tags($_POST['url']));
    $categoryReady = htmlspecialchars(strip_tags($_POST['category']));


    //getting the images information   
    $image_name = $_FILES['ngoPicUpload']['name'];
    $tmp_name = $_FILES['ngoPicUpload']['tmp_name'];
    $error = $_FILES['ngoPicUpload']['error'];

    //getting the images information   
    $banner_name = $_FILES['bannerUpload']['name'];
    $banner_tmp = $_FILES['bannerUpload']['tmp_name'];
    $banner_error = $_FILES['bannerUpload']['error'];

    // set the value to the object properties
    $ngo->ngoEmail = $emailParamData;
    $ngo->ouid = $uidParamData;
    $ngo->ngoName = $ngoNameReady;
    $ngo->registrationNumber = $registrationNumberReady;
    $ngo->addressLine = $addressLineReady;
    $ngo->postalCode = $postCodeReady;
    $ngo->city = $cityReady;
    $ngo->state = $stateReady;
    $ngo->profilePath = $image_name;
    $ngo->tmpPath = $tmp_name;
    $ngo->errorCount = $error;
    $ngo->bannerPath = $banner_name;
    $ngo->bannerTmpPath = $banner_tmp;
    $ngo->bannerErrorCount = $banner_error;
    $ngo->bio = $bioReady;
    $ngo->websiteURL = $urlReady;
    $ngo->category = $categoryReady;
    $ngo->status = "listed";

    /*echo"$emailParamData <br/>";
    echo"$uidParamData <br/>";
    echo"$ngoNameReady <br/>";
    echo"$registrationNumberReady <br/>";
    echo"$addressLineReady <br/>";
    echo"$postCodeReady <br/>";
    echo"$cityReady <br/>";
    echo"$stateReady <br/>";
    echo"$image_name <br/>";
    echo"$tmp_name <br/>";
    echo"$error <br/>";
    echo"$banner_name <br/>";
    echo"$banner_tmp <br/>";
    echo"$banner_error <br/>";
    echo"$bioReady <br/>";
    echo"$urlReady <br/>";
    echo"$categoryReady";*/

    ///Call the function createProfile to setup profile for the user. The function is define in the obj file.
    //this is step 2 of the registration process
    if($ngo->createProfile()){
        //make a redirection here when successfully created the profile.
        //header("Location:../../ngo/signin.php");
        header("Location:https://www.google.com");

    }
    //unable to setup profile 
    else{
  
        echo"Error! There was a problem while setting up the profile.";
      
    }
}
  
// data requested to create the profile incomplete
else{

    echo"Data Error. Unable to setup profile at the moment";


}
?>