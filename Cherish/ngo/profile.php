<html>

    <head>
        <title>Profile | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="ngo_css/profile.css">
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <?php
            include '../main/header.php';
            error_reporting(E_ERROR | E_PARSE);
            $dbc = mysqli_connect("localhost","root","");
            mysqli_select_db($dbc,"cherish_db");

            if(!empty($_GET['profileid'])){
                $targetProfile = $_GET['profileid'];
            }
            else if(empty($_GET['profileid']) && substr($_SESSION['identifier'],0,3)=="crt"){
                $targetProfile = $_SESSION['identifier'];                
            }

            $query = "SELECT `ouid`, ngo_name, profile_path, banner_path FROM ngo_profile WHERE `ouid`= ?";

            $stmt = mysqli_prepare($dbc, $query);
                                                        
            mysqli_stmt_bind_param($stmt,"s",$targetProfile); 
            mysqli_stmt_execute($stmt);
                            
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            while ($row = mysqli_fetch_assoc($result)) {

                $ouid = $row['ouid'];
                $ngoName = $row['ngo_name'];
                $profilePicture = $row['profile_path'];     
                $bannerPicture = $row['banner_path'];  

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="padding: 0;">';
                            echo'<img src="../ngo_banner_images/';
                            echo$bannerPicture;
                            echo'"height="200px" width="100%">';
                        echo'</div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6" style="z-index: 5; position: absolute; top: 190px; left: 50%; transform: translateX(-50%); display: flex; align-items: center;">';
                            echo'<img src="../ngo_images/';
                            echo$profilePicture;
                            echo'"style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">';
                            echo'<h1 style="margin-top: 60px; margin-left: 10px;">'.$ngoName.'';
                        echo'</div>
                    </div>
                </div>

                <div style="background-color: white; height: 110px;">
                </div>';
            }

            echo'<div>
                <ul class="nav nav-tabs justify-content-center" id="profileTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#ngoDetails">NGO Details</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#donationCampaign">Donation Campaign</a>
                    </li>
                                        
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#volunteerCampaign">Volunteer Activity</a>
                    </li>';

                    if(!empty($_SESSION['identifier'])){
                        if(substr($_SESSION['identifier'],0,3)=="crt" && $_SESSION['identifier'] == $ouid){
                            echo'<li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#unlistedCampaign">Unlisted campaign</a>
                            </li>';
                            echo'<li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#unlistedActivity">Unlisted activity</a>
                            </li>';
                        }
                    }
                echo'</ul>
            </div>

            <div class="tab-content" style="overflow: auto; height: 600px;" >
                <div class="tab-pane fade show active" id="ngoDetails">
                    <br/>
                    <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                            Basic Details
                        </span>
                    </div>
                    <br/>';

                    $query2 = "SELECT * FROM ngo_profile WHERE `ouid`= ?";

                    $stmt2 = mysqli_prepare($dbc, $query2);
                                                        
                    mysqli_stmt_bind_param($stmt2,"s",$targetProfile); 
                    mysqli_stmt_execute($stmt2);
                                    
                    $result2 = mysqli_stmt_get_result($stmt2);
                    mysqli_stmt_close($stmt2);

                    $ngoStatusCheck  = "";
        
                    while ($row = mysqli_fetch_assoc($result2)) {

                        $ngoEmail = $row['ngo_email'];
                        $registerNumber = $row['register_number'];
                        $ngoContact = $row['ngo_contact'];
                        $addressLine = $row['address_line'];
                        $city = $row['city'];
                        $state = $row['state'];
                        $postalCode = $row['postal_code'];
                        $ngoBio = $row['ngo_bio'];
                        $ngoURL = $row['ngo_url'];
                        $ngoCategory = $row['ngo_category'];
                        $ngoStatusCheck = $row['ngo_status'];

                        echo'<table class="table table-bordered" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
                            <tbody>
                                <tr>
                                    <th scope="row">Registered Name</th>
                                    <td>'.$ngoName.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>'.$ngoBio.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Organization Registration Number</th>
                                    <td>'.$registerNumber.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Office Adrress</th>
                                    <td>'.$addressLine.','.$postalCode.','.$city.','.$state.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">NGO Category</th>
                                    <td>'.$ngoCategory.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">OUID</th>
                                    <td>'.$ouid.'</td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                Contact Detail
                            </span>
                        </div>
                        <br/>
                        <table class="table table-bordered" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
                            <tbody>
                                <tr>
                                    <th scope="row">Email Address</th>
                                    <td>'.$ngoEmail.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email Address</th>
                                    <td>'.$ngoContact.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">NGO\'s Website</th>
                                    <td>'.$ngoURL.'</td>
                                </tr>
                            </tbody>
                        </table>';
                    }
                echo' </div>

                <div class="tab-pane fade" id="donationCampaign">
                    <br/>';
                    if(empty($_GET['profileid']) || $_SESSION['identifier']==$_GET['profileid']){
                        if($ngoStatusCheck == 'listed'){
                            echo'<div class="text-end" style="margin-right: 10px;">
                                    <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#addDonationCampaign">
                                        Launch New Donation
                                    </button>
                                </div>';
                        }
                    }

                    echo'<button id="jumpActive" class="btn btn-primary btn-reg-signin"><a href="#activeSection" style="color: white;">Active</a></button>
                    <button id="jumpPast" class="btn btn-primary btn-reg-signin"><a href="#pastSection" style="color: white;">Past</a></button>

                    <div class="modal fade" id="addDonationCampaign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create a donation campaign</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="campaignForm" action="../cherish_api/ngo/apiC_ngo_campaign.php" method="POST" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Campaign Name</span>
                                            <input type="text" name="campaignName" class="form-control" placeholder="Enter campaign name" aria-label="Enter campaign name" aria-describedby="basic-addon1" required>
                                        </div>
                                        <div class="input-group mb-3" style="width: 100%;">
                                            <span class="input-group-text">Campaign Info</span>
                                            <textarea name="campaignInfo" class="form-control" aria-label="With textarea" required></textarea>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Raise Goal</span>
                                            <input type="number" name="raiseGoal" id="raiseGoal" oninput="checkPostCodeLength(this, 6)" class="form-control" placeholder="Enter raising goal (RM)" aria-label="Enter raising goal (RM)" aria-describedby="basic-addon1" required>
                                        </div>
                                        <p id="valueInvalid" style="color: red; display: none;"></p>

                                        <label class="form-label">Upload a campaign banner</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="campaignBannerUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                                        </div>

                                        <label for="date">Closing Date:</label>
                                        <input type="date" id="campaignClosingDate" name="campaignClosingDate" required><br/><br/>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-reg-signin" data-bs-dismiss="modal">Close</button>
                                    <input class="btn btn-secondary btn-reg-signin" id="createCampaign" type="submit" value="Create" form="campaignForm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="activeSection" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                            Active Campaign
                        </span>
                    </div>
                    <br/>';
                    echo'<div class="container-fluid">';

                        $currentDate = date('Y-m-d');
                        $query3 = "SELECT * FROM ngo_campaign WHERE `ouid`= ? AND closing_date > ?";
                        
                        $stmt3 = mysqli_prepare($dbc, $query3);
                                                        
                        mysqli_stmt_bind_param($stmt3,"ss",$targetProfile,$currentDate); 
                        mysqli_stmt_execute($stmt3);
                                        
                        $result3 = mysqli_stmt_get_result($stmt3);
                        mysqli_stmt_close($stmt3);
            
                        while ($row = mysqli_fetch_assoc($result3)) {
                        
                            $campaignName = $row['campaign_name'];
                            $campaignID = $row['campaign_id'];
                            $campaignBanner = $row['campaign_banner'];
                            $progress =  $row['progress'];
                            $raiseGoal =  $row['raise_goal'];
                            $closingDate = $row['closing_date'];

                            echo'<div class="row">
                                <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                    <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                        echo'<a href="../main/donationCampaign.php?campaignid='.$campaignID.'">';
                                            echo'<img src="../campaign_banner/';
                                            echo$campaignBanner;
                                            echo'"height="200px" width="100%">';
                                            echo'<div class="card-body">
                                                    <h5 class="card-text">
                                                        Campaign Name: '.$campaignName.' 
                                                    </h5>
                                                    <p class ="card-text">
                                                        Campaign ID: '.$campaignID.' <br/>
                                                        Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
                                                        Closing Date: '.$closingDate.'<br/>
                                                    </p>
                                                </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>';
                        }
                    echo'</div>

                    <div id="pastSection" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                            Past Campaign
                        </span>
                    </div>
                    <br/>';
                    echo'<div class="container-fluid">';

                        $currentDate = date('Y-m-d');
                        $query4 = "SELECT * FROM ngo_campaign WHERE `ouid`= ? AND closing_date <= ?";
                        
                        $stmt4 = mysqli_prepare($dbc, $query4);
                                                        
                        mysqli_stmt_bind_param($stmt4,"ss",$targetProfile,$currentDate); 
                        mysqli_stmt_execute($stmt4);
                                        
                        $result4 = mysqli_stmt_get_result($stmt4);
                        mysqli_stmt_close($stmt4);
            
                        while ($row = mysqli_fetch_assoc($result4)) {
                        
                            $campaignName = $row['campaign_name'];
                            $campaignID = $row['campaign_id'];
                            $campaignBanner = $row['campaign_banner'];
                            $progress =  $row['progress'];
                            $raiseGoal =  $row['raise_goal'];
                            $closingDate = $row['closing_date'];

                            echo'<div class="row">
                                <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                    <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                        echo'<a href="../main/donationCampaign.php?campaignid='.$campaignID.'">';
                                            echo'<img src="../campaign_banner/';
                                            echo$campaignBanner;
                                            echo'"height="200px" width="100%">';
                                            echo'<div class="card-body">
                                                    <h5 class="card-text">
                                                        Campaign Name: '.$campaignName.' 
                                                    </h5>
                                                    <p class ="card-text">
                                                        Campaign ID: '.$campaignID.' <br/>
                                                        Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
                                                        Closing Date: '.$closingDate.'<br/>
                                                    </p>
                                                </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>';
                        }
                    echo'</div>
                </div>

                <div class="tab-pane fade" id="volunteerCampaign">
                    <br/>';
                    if(empty($_GET['profileid']) || $_SESSION['identifier']==$_GET['profileid']){
                        if($ngoStatusCheck == 'listed'){
                            echo'<div class="text-end" style="margin-right: 10px;">
                                <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#addVolunteerActivity">
                                    Launch New Volunteer
                                </button>
                            </div>';
                        }
                    }
                    echo'<button id="jumpActive" class="btn btn-primary btn-reg-signin"><a href="#activeActivitySection" style="color: white;">Active</a></button>
                    <button id="jumpPast" class="btn btn-primary btn-reg-signin"><a href="#pastActivitySection" style="color: white;">Past</a></button>

                    <div class="modal fade" id="addVolunteerActivity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create a volunteer activity</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="activityForm" action="../cherish_api/ngo/apiC_ngo_activity.php" method="POST" enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Activity Name</span>
                                            <input type="text" name="activityName" oninput="checkNameLength(this, 100)" class="form-control" placeholder="Enter activity name" aria-label="Enter activity name" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group mb-3" style="width: 100%;">
                                            <span class="input-group-text">Activity Info</span>
                                            <textarea name="activityInfo" class="form-control" aria-label="With textarea" required></textarea>
                                        </div>

                                        <label for="date">Activity Date:</label>
                                        <input type="date" id="activityDate" name="activityDate" onchange="updateMaxDate()" required><br/><br/>

                                        <label for="date">Closing Date:</label>
                                        <input type="date" id="activityClosingDate" name="activityClosingDate" required><br/><br/>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="startTime" name="startTime" placeholder="Start Time (eg. 1:30)">
                                            <div class="input-group-append">
                                                <select class="form-control" id="startAMPM" name="startAMPM">
                                                    <option value="" disabled selected>Select AM/PM</option>
                                                    <option value="AM">AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="endTime" name="endTime" placeholder="End Time (eg. 2:30)">
                                            <div class="input-group-append">
                                                <select class="form-control" id="endAMPM" name="endAMPM" placeholder="123">
                                                    <option value="" disabled selected>Select AM/PM</option>
                                                    <option value="AM">AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Address Line</span>
                                            <input type="text" name="addressLine" class="form-control" placeholder="Enter your address" aria-label="Enter your address" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Postal Code</span>
                                            <input type="number" name="postalCode" id="postalCode" oninput="checkPostCodeLength(this, 5)" class="form-control" placeholder="Enter your Postal Code" aria-label="Enter your Postal Code" aria-describedby="basic-addon1" required>
                                        </div>
                
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">City</span>
                                            <input type="text" name="city" class="form-control" placeholder="Enter your city" aria-label="Enter your city" aria-describedby="basic-addon1" required>
                                        </div>
                        
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">State</label>
                                            <select name="state" class="form-select" id="inputGroupSelect01" required>
                                                <option selected>Select your resides state...</option>
                                                <option value="Perlis">Perlis</option>
                                                <option value="Kedah">Kedah</option>
                                                <option value="Pulau Pinang">Pulau Pinang</option>
                                                <option value="Perak">Perak</option>
                                                <option value="Kelantan">Kelantan</option>
                                                <option value="Terengganu">Terengganu</option>
                                                <option value="Pahang">Pahang</option>
                                                <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                <option value="Putra Jaya">Putra Jaya</option>
                                                <option value="Selangor">Selangor</option>
                                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                <option value="Melaka">Melaka</option>
                                                <option value="Johor">Johor</option>
                                                <option value="Sarawak">Sarawak</option>
                                                <option value="Sabah">Sabah</option>
                                                <option value="Labuan">Labuan</option>
                                            </select>
                                        </div>

                                         <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Participation Limit</span>
                                            <input type="number" name="participationLimit" id="participationLimit" class="form-control" placeholder="Enter participation limit" aria-label="Enter participation limit" aria-describedby="basic-addon1" required>
                                        </div>
                                        <p id="invalidParticipationValue" style="color: red; display: none;"></p>

                                        <label class="form-label">Upload a activity banner</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="activityBannerUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-reg-signin" data-bs-dismiss="modal">Close</button>
                                    <input class="btn btn-secondary btn-reg-signin" id="createActivity" type="submit" value="Create" form="activityForm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="activeActivitySection" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                            Active Activity
                        </span>
                    </div>
                    <br/>';
                    echo'<div class="container-fluid">';

                        $currentDate = date('Y-m-d');
                        $query5 = "SELECT * FROM ngo_activity WHERE `ouid`= ? AND closing_date > ?";
                        
                        $stmt5 = mysqli_prepare($dbc, $query5);
                                                        
                        mysqli_stmt_bind_param($stmt5,"ss",$targetProfile,$currentDate); 
                        mysqli_stmt_execute($stmt5);
                                        
                        $result5 = mysqli_stmt_get_result($stmt5);
                        mysqli_stmt_close($stmt5);
            
                        while ($row = mysqli_fetch_assoc($result5)) {
                        
                            $activityName = $row['activity_name'];
                            $activityID = $row['activity_id'];
                            $activityLocation = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                            $activityDate =  $row['activity_date'];
                            $activityTime =  $row['activity_time'];
                            $closingDate = $row['closing_date'];
                            $participationLimit = $row['participation_limit'];
                            $currentParticipant = $row['current_participant'];
                            $activityBanner = $row['activity_banner'];

                            echo'<div class="row">
                                <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                    <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                        echo'<a href="../main/volunteerActivity.php?activityid='.$activityID.'">';
                                            echo'<img src="../activity_banner/';
                                            echo$activityBanner;
                                            echo'"height="200px" width="100%">';
                                            echo'<div class="card-body">
                                                    <h5 class="card-text">
                                                        Activity Name: '.$activityName.' 
                                                    </h5>
                                                    <p class ="card-text">
                                                        Activity ID: '.$activityID.' <br/>
                                                        Activity Date: '.$activityDate.' <br/>
                                                        Venue: '.$activityLocation.' <br/>
                                                        Participant Progress: '.$currentParticipant.'/'.$participationLimit.'<br/>
                                                        Closing Date: '.$closingDate.'<br/>
                                                    </p>
                                                </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>';
                        }
                    echo'</div>

                    <div id="pastActivitySection" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                            Past Activity
                        </span>
                    </div>
                    <br/>';
                    echo'<div class="container-fluid">';

                        $currentDate = date('Y-m-d');
                        $query6 = "SELECT * FROM ngo_activity WHERE `ouid`= ? AND closing_date <= ?";
                        
                        $stmt6 = mysqli_prepare($dbc, $query6);
                                                        
                        mysqli_stmt_bind_param($stmt6,"ss",$targetProfile,$currentDate); 
                        mysqli_stmt_execute($stmt6);
                                        
                        $result6 = mysqli_stmt_get_result($stmt6);
                        mysqli_stmt_close($stmt6);
            
                        while ($row = mysqli_fetch_assoc($result6)) {
                        
                            $activityName = $row['activity_name'];
                            $activityID = $row['activity_id'];
                            $activityLocation = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                            $activityDate =  $row['activity_date'];
                            $activityTime =  $row['activity_time'];
                            $closingDate = $row['closing_date'];
                            $participationLimit = $row['participation_limit'];
                            $currentParticipant = $row['current_participant'];
                            $activityBanner = $row['activity_banner'];

                            echo'<div class="row">
                                <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                    <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                        echo'<a href="../main/volunteerActivity.php?activityid='.$activityID.'">';
                                            echo'<img src="../activity_banner/';
                                            echo$activityBanner;
                                            echo'"height="200px" width="100%">';
                                            echo'<div class="card-body">
                                                    <h5 class="card-text">
                                                        Activity Name: '.$activityName.' 
                                                    </h5>
                                                    <p class ="card-text">
                                                        Activity ID: '.$activityID.' <br/>
                                                        Activity Date: '.$activityDate.' <br/>
                                                        Venue: '.$activityLocation.' <br/>
                                                        Participant Progress: '.$currentParticipant.'/'.$participationLimit.'<br/>
                                                        Closing Date: '.$closingDate.'<br/>
                                                    </p>
                                                </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>';
                        }
                    echo'</div>
                </div>


                <div class="tab-pane fade" id="unlistedCampaign">';
                    echo'<div class="container-fluid">';
                        echo'<br/>';
                        $currentDate = date('Y-m-d');
                        $query7 = "SELECT * FROM ngo_campaign WHERE `ouid`= ? AND closing_date > ? AND campaign_status='unlisted'";
                       
                        $stmt7 = mysqli_prepare($dbc, $query7);
                                                        
                        mysqli_stmt_bind_param($stmt7,"ss",$targetProfile,$currentDate); 
                        mysqli_stmt_execute($stmt7);
                                        
                        $result7 = mysqli_stmt_get_result($stmt7);
                        mysqli_stmt_close($stmt7);

                        while ($row = mysqli_fetch_assoc($result7)) {

                            $campaignName = $row['campaign_name'];
                            $campaignID = $row['campaign_id'];
                            $campaignBanner = $row['campaign_banner'];
                            $progress =  $row['progress'];
                            $raiseGoal =  $row['raise_goal'];
                            $closingDate = $row['closing_date'];

                            echo'<div class="row">
                                <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                    <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                        echo'<a href="../main/donationCampaign.php?campaignid='.$campaignID.'">';
                                            echo'<img src="../campaign_banner/';
                                            echo$campaignBanner;
                                            echo'"height="200px" width="100%">';
                                            echo'<div class="card-body">
                                                    <h5 class="card-text">
                                                        Campaign Name: '.$campaignName.' 
                                                    </h5>
                                                    <p class ="card-text">
                                                        Campaign ID: '.$campaignID.' <br/>
                                                        Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
                                                        Closing Date: '.$closingDate.'<br/>
                                                    </p>
                                                </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <br>';
                        }
                    echo'</div>';
                echo'</div>

                <div class="tab-pane fade" id="unlistedActivity">';
                    echo'<div class="container-fluid">';
                        echo'<br/>';
                        $currentDate = date('Y-m-d');
                        $query8 = "SELECT * FROM ngo_activity WHERE `ouid`= ? AND closing_date > ? AND activity_status='unlisted'";
                        
                        $stmt8 = mysqli_prepare($dbc, $query8);
                                                        
                        mysqli_stmt_bind_param($stmt8,"ss",$targetProfile,$currentDate); 
                        mysqli_stmt_execute($stmt8);
                                        
                        $result8 = mysqli_stmt_get_result($stmt8);
                        mysqli_stmt_close($stmt8);
            
                        while ($row = mysqli_fetch_assoc($result8)) {
                        
                            $activityName = $row['activity_name'];
                            $activityID = $row['activity_id'];
                            $activityLocation = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                            $activityDate =  $row['activity_date'];
                            $activityTime =  $row['activity_time'];
                            $closingDate = $row['closing_date'];
                            $participationLimit = $row['participation_limit'];
                            $currentParticipant = $row['current_participant'];
                            $activityBanner = $row['activity_banner'];

                            echo'<div class="container-fluid">
                                <div class="row">
                                    <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                        <div class="card" style="width: 85%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                            echo'<a href="../main/volunteerActivity.php?activityid='.$activityID.'">';
                                                echo'<img src="../activity_banner/';
                                                echo$activityBanner;
                                                echo'"height="200px" width="100%">';
                                                echo'<div class="card-body">
                                                        <h5 class="card-text">
                                                            Activity Name: '.$activityName.' 
                                                        </h5>
                                                        <p class ="card-text">
                                                            Activity ID: '.$activityID.' <br/>
                                                            Activity Date: '.$activityDate.' <br/>
                                                            Venue: '.$activityLocation.' <br/>
                                                            Participant Progress: '.$currentParticipant.'/'.$participationLimit.'<br/>
                                                            Closing Date: '.$closingDate.'<br/>
                                                        </p>
                                                    </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>';
                        }
                    echo'</div>';
                echo'</div>
            </div>';
            include '../main/footer.php'

        ?>
    </body>

    <script>
        //prevent selecting past date
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('campaignClosingDate').setAttribute('min', today);
        document.getElementById('activityDate').setAttribute('min', today);
        document.getElementById('activityClosingDate').setAttribute('min', today);
        
        //this prevent closing date to be able to select past the activity date
        var activityDateInput = document.getElementById('activityDate');
        var closingDateInput = document.getElementById('activityClosingDate');
        function updateMaxDate() {
            var activityDate = new Date(activityDateInput.value);
            activityDate.setDate(activityDate.getDate() - 1);  //1 day before the actual activity date
            var maxDate = activityDate.toISOString().split('T')[0];
            closingDateInput.setAttribute('max', maxDate);  //update the date picker to limit selection to only 1 day before actual activity date
        }

        //check raise goal value to prevent too low or too high
        const raiseValue = document.getElementById('raiseGoal');
        const invalidValuePrompt = document.getElementById('valueInvalid');
        const createCampaignBtn = document.getElementById('createCampaign');

        raiseValue.addEventListener('input', validateRaiseValue);

        function validateRaiseValue() {
            const valueGiven = parseInt(raiseValue.value); 
            if (valueGiven < 1000) {
                invalidValuePrompt.textContent = "Value too low";
                invalidValuePrompt.style.display = 'block';
                createCampaignBtn.setAttribute('disabled','true');
            } else if (valueGiven >100000){
                invalidValuePrompt.textContent = "Value too high";
                invalidValuePrompt.style.display = 'block';
                createCampaignBtn.setAttribute('disabled','true');
            }else{
                invalidValuePrompt.style.display = 'none';
                createCampaignBtn.removeAttribute('disabled');
            }
        }

        function checkNameLength(input, maxLength) {
            if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 100.
            }
        }

        var startTimeField = document.getElementById("startTime");
            startTimeField.addEventListener("input", function() {
                var inputValue = startTimeField.value;
                var filteredValue = inputValue.replace(/[^0-9:]/g, ''); 
                startTimeField.value = filteredValue;
        });

        var endTimeField = document.getElementById("endTime");
            endTimeField.addEventListener("input", function() {
                var inputValue = endTimeField.value;
                var filteredValue = inputValue.replace(/[^0-9:]/g, ''); 
                endTimeField.value = filteredValue;
        });

        function checkPostCodeLength(input, maxLength) {
            if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 5.
            }
        }

        //this section below make sure that unnecessary symbols are not entered into the postal code field.
        var postCodeField = document.getElementById("postalCode");
        postCodeField.addEventListener("input", function() {
            var inputValue = postCodeField.value;
            var filteredValue = inputValue.replace(/[^\d]/g, ''); // Allow only numeric digits
            //regex is used on the above line. The regex filter out all the symobl.
            postCodeField.value = filteredValue;
        });

        const participationNumberValue = document.getElementById('participationLimit');
        const invalidParticipationPrompt = document.getElementById('invalidParticipationValue');
        const createActivityBtn = document.getElementById('createActivity');

        participationNumberValue.addEventListener('input', validateParticipantValue);

        function validateParticipantValue() {
            const valueGiven = parseInt(participationNumberValue.value); 
            if (valueGiven < 5) {
                invalidParticipationPrompt.textContent = "Value too low";
                invalidParticipationPrompt.style.display = 'block';
                createActivityBtn.setAttribute('disabled','true');
            } else if (valueGiven > 500){
                invalidParticipationPrompt.textContent = "Value too high";
                invalidParticipationPrompt.style.display = 'block';
                createActivityBtn.setAttribute('disabled','true');
            }else{
                invalidParticipationPrompt.style.display = 'none';
                createActivityBtn.removeAttribute('disabled');
            }
        }
    </script>

    <?php
        if(!empty($_GET['action'])){
            $alertCondition = $_GET['action'];
            if($alertCondition == "activityCreated"){
                echo"<script>
                        alertify.alert('Activity Action','Activity Created');
                    </script>";
            }
            else if($alertCondition == "campaignCreated"){
                echo"<script>
                    alertify.alert('Campaign Action','Campaign Created');
                </script>";
            }
            else if($alertCondition == "aanp"){
                echo"<script>
                    alertify.alert('Activity Action','Activity Not Created. Try Again.');
                </script>";
            }
            else if($alertCondition == "canp"){
                echo"<script>
                    alertify.alert('Campaign Action','Campaign Not Created. Try Again.');
                </script>";
            }
        }
    ?>
</html>


