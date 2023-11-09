<html>

    <head>
        <title>Volunteer Activity | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="main_css/profile.css">
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <?php
            include '../main/header.php';
            $dbc = mysqli_connect("localhost","root","");
            mysqli_select_db($dbc,"cherish_db");
            $targetActivity = $_GET['activityid'];
            $canParticipate = false;

            $query = "SELECT ngo_activity.activity_name, ngo_activity.activity_banner, ngo_profile.ngo_name FROM ngo_activity INNER JOIN ngo_profile ON ngo_profile.ouid = ngo_activity.ouid WHERE ngo_activity.activity_id = ?";

            $stmt = mysqli_prepare($dbc, $query);
                                                        
            mysqli_stmt_bind_param($stmt,"s",$targetActivity); 
            mysqli_stmt_execute($stmt);
                            
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            while ($row = mysqli_fetch_assoc($result)) {

                $activityName = $row['activity_name'];
                $bannerPicture = $row['activity_banner'];  
                $ngoName = $row['ngo_name'];

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="padding: 0;">';
                            echo'<img src="../activity_banner/';
                            echo$bannerPicture;
                            echo'"height="200px" width="100%">';
                        echo'</div>
                    </div>
                    <div class="row" style="background-color: white;">';
                            echo'<h1 style="margin-top: 20px; margin-bottom: 20px;">'.$activityName.'</h1>';
                            echo'<h6 style="margin-top: 20px; margin-bottom: 20px;">Organize by: '.$ngoName.'</h6>';
                    echo'</div>
                </div>';
            }

            echo"<br/>";

            echo'<div class="container-fluid">';

                $query2 = "SELECT * FROM ngo_activity WHERE activity_id = ?"; 

                $stmt2 = mysqli_prepare($dbc, $query2);
                                                        
                mysqli_stmt_bind_param($stmt2,"s",$targetActivity); 
                mysqli_stmt_execute($stmt2);
                                
                $result2 = mysqli_stmt_get_result($stmt2);
                mysqli_stmt_close($stmt2);
    
                while ($row = mysqli_fetch_assoc($result2)) {

                    $progress = $row['current_participant'];
                    $participationLimit =  $row['participation_limit'];
                    $closingDate = $row['closing_date'];
                    $venue = $row['address_line'].','.$row['postal_code'].','.$row['city'].','.$row['state'];
                    $activityDate = $row['activity_date'];
                    $activityTime = $row['activity_time'];
                    $inPercentage = ($progress*100)/$participationLimit;
                    $ouid = $row['ouid'];

                    if(!empty($_SESSION['identifier'])){
                        $query5 = mysqli_query($dbc,"SELECT participant_uid FROM participants_record WHERE participant_uid = '$_SESSION[identifier]' AND activity_id='$targetActivity'"); 
                        while ($row = $query5->fetch_assoc()){
                            $canParticipate = true;
                        }
                    }


                    echo'<div class="row">
                        <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                            <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                echo'<div class="card-body">
                                        <div class="progress" role="progressbar" aria-label="Dynamic Progress" aria-valuenow="' . $inPercentage . '" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: ' . $inPercentage . '%;"></div>
                                        </div>
                                        <p class ="card-text">
                                            Volunteers Registered: '.$progress.'/'.$participationLimit.'<br/>
                                            Date: '.$activityDate.' <br/>
                                            Time: '.$activityTime.'<br/>
                                            Venue: '.$venue.'<br/>
                                            Closing Date: '.$closingDate.'<br/>
                                        </p>';
                                        
                                        if(!empty($_SESSION['identifier']) && $closingDate>date('Y-m-d')){
                                            if($progress<$participationLimit && substr($_SESSION['identifier'],0,3)!="crt" && substr($_SESSION['identifier'],0,3)!="CAG"  && $canParticipate==false){
                                                echo'<div class="text-end" style="margin-right: 10px;">
                                                    <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#participateForm">
                                                        Volunteer
                                                    </button>
                                                </div>';
                                            }
                                            else if(!empty($_SESSION['identifier']) && substr($_SESSION['identifier'],0,3)=="CAG"){
                                                echo'<div class="text-end" style="margin-right: 10px;">
                                                        <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#acceptPrompt">
                                                            Accept
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#rejectPrompt">
                                                            Reject
                                                        </button>
                                                    </div>';
                                            }
                                        }
                                    echo'</div>
                            </div>
                        </div>
                    </div>';
                }
            echo'</div>';

            echo'<div class="modal fade" id="acceptPrompt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Approve campaign?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="acceptForm" action="../cherish_api/admin/apiU_activity_status.php" method="POST" enctype="multipart/form-data">
                            
                            <input type="hidden" name="activityIdParam" value='.$targetActivity.'>
                            <input type="hidden" name="statusParam" value="listed">

                        </form>
                        By approving the activity, you have ensure that all the details has been checked.                            
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-secondary btn-reg-signin" id="approveBtn" type="submit" value="OK" form="acceptForm">
                    </div>
                </div>
            </div>
        </div>';

        echo'<div class="modal fade" id="rejectPrompt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Reject campaign?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="rejectForm" action="../cherish_api/admin/apiU_activity_status.php" method="POST" enctype="multipart/form-data">
                                
                                <input type="hidden" name="activityIdParam" value='.$targetActivity.'>
                                <input type="hidden" name="statusParam" value="unlisted">

                            </form>
                            Donation campaign can be unlisted if it violate any the Cherish donation terms and condition. Please double check before unlisting campaign.                           
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-secondary btn-reg-signin" id="rejectBtn" type="submit" value="OK" form="rejectForm">
                        </div>
                    </div>
                </div>
            </div>';

            echo'<div class="modal fade" id="participateForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Volunteer in Activity</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="volunteerForm" action="../cherish_api/ngo/api_participate_activity.php" method="POST" enctype="multipart/form-data">
                                    By clicking volunteer, you agree to the Cherish volunteering terms and condition

                                    <input type="hidden" name="activityIdParam" value='.$targetActivity.'>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-secondary btn-reg-signin" id="participateVolunteerBtn" type="submit" value="Join" form="volunteerForm">
                            </div>
                        </div>
                    </div>
                </div>';
            
            echo"<br/>";

            $currentDate = date('Y-m-d');
            if(!empty($_SESSION['identifier'])){
                if((substr($_SESSION['identifier'],0,3))=="crt" && $_SESSION['identifier']==$ouid && $closingDate>$currentDate){
                    echo'<div class="text-end" style="margin-right: 10px;">
                                <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#editVolunteerActivity">
                                    Edit Activity
                                </button>
                            </div>';
                }
            }

            echo'<div class="modal fade" id="editVolunteerActivity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Change activity info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="activityForm" action="../cherish_api/ngo/apiU_ngo_activity.php" method="POST" enctype="multipart/form-data">
                                <div class="input-group mb-3" style="width: 100%;">
                                    <span class="input-group-text">Activity Info</span>
                                    <textarea name="activityInfo" class="form-control" aria-label="With textarea"></textarea>
                                </div>

                                <label for="date">Activity Date:</label>
                                <input type="date" id="activityDate" name="activityDate" onchange="updateMaxDate()"><br/><br/>
                                <p id="activityDatePrompt" style="color: red; display: none;">Activity date required as well</p>

                                <label for="date">Closing Date:</label>
                                <input type="date" id="activityClosingDate" name="activityClosingDate"><br/><br/>
                                <p id="closingDatePrompt" style="color: red; display: none;">Closing date required as well</p>

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
                                <p id="startTimePrompt" style="color: red; display: none;">Start time required as well</p>

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
                                <p id="endTimePrompt" style="color: red; display: none;">End time required as well</p>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Address Line</span>
                                    <input type="text" name="addressLine" class="form-control" placeholder="Enter your address" aria-label="Enter your address" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Postal Code</span>
                                    <input type="number" name="postalCode" id="postalCode" oninput="checkPostCodeLength(this, 5)" class="form-control" placeholder="Enter your Postal Code" aria-label="Enter your Postal Code" aria-describedby="basic-addon1">
                                </div>
        
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">City</span>
                                    <input type="text" name="city" class="form-control" placeholder="Enter your city" aria-label="Enter your city" aria-describedby="basic-addon1">
                                </div>
                
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">State</label>
                                    <select name="state" class="form-select" id="inputGroupSelect01">
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
                                    <input type="number" name="participationLimit" id="participationLimit" class="form-control" placeholder="Enter participation limit" aria-label="Enter participation limit" aria-describedby="basic-addon1">
                                </div>
                                <p id="valueInvalid" style="color: red; display: none;"></p>

                                <label class="form-label">Upload a activity banner</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="activityBannerUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                </div>

                                <input type="hidden" name="activityIdParam" value='.$targetActivity.'>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-secondary btn-reg-signin" id="updateActivity" type="submit" value="Update" form="activityForm">
                        </div>
                    </div>
                </div>
            </div>';
            
            if(!empty($_SESSION['identifier'])){
                if((substr($_SESSION['identifier'],0,3))=="crt" && $_SESSION['identifier']==$ouid){
                    echo'<div>
                        <ul class="nav nav-tabs justify-content-center" id="profileTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#activityDetails">Activity Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#volunteerList">Volunteer List</a>
                            </li>              
                        </ul>
                    </div>';
                }
            }

            echo'<div class="tab-content" id="myTabContent">';
                echo'<div class="tab-pane fade show active" id="activityDetails" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';
                    echo'<br/>';
                    
                    echo'<div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                Activity Details
                            </span>
                        </div>
                    <br/>';

                    $query3 = "SELECT * FROM ngo_activity WHERE activity_id = ?";

                    $stmt3 = mysqli_prepare($dbc, $query3);
                                                        
                    mysqli_stmt_bind_param($stmt3,"s",$targetActivity); 
                    mysqli_stmt_execute($stmt3);
                                    
                    $result3 = mysqli_stmt_get_result($stmt3);
                    mysqli_stmt_close($stmt3);
        
                    while ($row = mysqli_fetch_assoc($result3)) {

                        $activityID = $row['activity_id'];
                        $activityInfo = $row['activity_info'];
                        $participationLimit = $row['participation_limit'];
                        $activityStatus = $row['activity_status'];
                        $address = $row['address_line'];
                        $postalCode = $row['postal_code'];
                        $city = $row['city'];
                        $state = $row['state'];

                        echo'<table class="table table-bordered" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
                                <tbody>
                                    <tr>
                                        <th scope="row">Activity ID</th>
                                        <td>'.$activityID.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Activity Info/Description</th>
                                        <td>'.$activityInfo.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Activity Date</th>
                                        <td>'.$activityDate.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Activity Time</th>
                                        <td>'.$activityTime.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Venue</th>
                                        <td>'.$address.','.$postalCode.','.$city.','.$state.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Volunteer Needed</th>
                                        <td>'.$participationLimit.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Campaign Status</th>
                                        <td>'.$activityStatus.'</td>
                                    </tr>
                                </tbody>
                            </table>';
                    }  

                    echo'<div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                Organizing\'s NGO Details
                            </span>
                        </div>
                    <br/>';
                            

                    $query4 = "SELECT ngo_profile.ngo_email, ngo_profile.ouid, ngo_profile.ngo_name, ngo_profile.address_line, ngo_profile.city, ngo_profile.state, ngo_profile.postal_code,
                    ngo_profile.ngo_category FROM ngo_profile INNER JOIN ngo_activity ON ngo_profile.ouid = ngo_activity.ouid WHERE ngo_activity.activity_id = ?"; 
                    
                    $stmt4 = mysqli_prepare($dbc, $query4);
                                                        
                    mysqli_stmt_bind_param($stmt4,"s",$targetActivity); 
                    mysqli_stmt_execute($stmt4);
                                    
                    $result4 = mysqli_stmt_get_result($stmt4);
                    mysqli_stmt_close($stmt4);
        
                    while ($row = mysqli_fetch_assoc($result4)) {
                    
                        $organizerEmail = $row['ngo_email'];
                        $organizerName = $row['ngo_name'];
                        $organizerAddress = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                        $organizerCategory = $row['ngo_category'];
                        $ouid = $row['ouid'];

                        echo'<table class="table table-bordered" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
                                <tbody>
                                    <tr>
                                        <th scope="row">NGO Email</th>
                                        <td>'.$organizerEmail.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">NGO Name</th>
                                        <td>'.$organizerName.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">OUID</th>
                                        <td>'.$ouid.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address:</th>
                                        <td>'.$organizerAddress.'</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">NGO Category</th>
                                        <td>'.$organizerCategory.'</td>
                                    </tr>
                                </tbody>
                            </table>';
                    }
                echo'</div>';

                echo'<div class="tab-pane fade" id="volunteerList" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">';
                    echo'<br/>';
                    $query5 = "SELECT user_account.name, user_account.email_address, user_account.ic_number, user_account.address_line,
                    user_account.postal_code, user_account.city, user_account.state, participants_record.register_date, participants_record.register_time
                    FROM user_account INNER JOIN participants_record ON user_account.uid = participants_record.participant_uid WHERE participants_record.activity_id = ?";

                    $stmt5 = mysqli_prepare($dbc, $query5);
                                                                            
                    mysqli_stmt_bind_param($stmt5,"s",$targetActivity); 
                    mysqli_stmt_execute($stmt5);
                                    
                    $result5 = mysqli_stmt_get_result($stmt5);
                    mysqli_stmt_close($stmt5);

                    while ($row = mysqli_fetch_assoc($result5)) {

                        $participantName = $row['name'];
                        $participantEmail = $row['email_address'];
                        $participantAddress = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                        $registerDate = $row['register_date'];
                        $registerTime = $row['register_time'];

                        $cipherMethod = "AES-128-CTR";
                        $decryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
                        $initVector = "Cherish Moments.";

                        $decryptICValue = openssl_decrypt ($row['ic_number'], $cipherMethod ,$decryptionKey, 0, $initVector);

                        echo'<div class="container-fluid">
                            <div class="row">
                                <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                    <div class="card" style="width: 85%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                        echo'<div class="card-body">
                                                <table class="table table-bordered" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Paticipant Name</th>
                                                            <td>'.$participantName.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">IC Number</th>
                                                            <td>'.$decryptICValue.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email Address</th>
                                                            <td>'.$participantEmail.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mailing Address</th>
                                                            <td>'.$participantAddress.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Register Date</th>
                                                            <td>'.$registerDate.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Register Time</th>
                                                            <td>'.$registerTime.'</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>';
                    }
                echo'</div>';
            echo'</div>';

            include "footer.php";
        ?>
    </body>

    <script>
        //this section below make sure that unnecessary symbols are not entered into the postal code field.
        var postCodeField = document.getElementById("postalCode");
        postCodeField.addEventListener("input", function() {
            var inputValue = postCodeField.value;
            var filteredValue = inputValue.replace(/[^\d]/g, ''); // Allow only numeric digits
            //regex is used on the above line. The regex filter out all the symobl.
            postCodeField.value = filteredValue;
        });

        window.addEventListener('DOMContentLoaded', function () {
            var activityDateField = document.getElementById("activityDate");
            var closingDateField = document.getElementById("activityClosingDate");
            const activityDatePrompt = document.getElementById('activityDatePrompt');
            const closingDatePrompt = document.getElementById('closingDatePrompt');
            const updateActivityBtn = document.getElementById('updateActivity');

            activityDateField.addEventListener('input', function () {
                if (activityDateField.value && !closingDateField.value) {
                    closingDatePrompt.style.display = 'block';
                    updateActivityBtn.setAttribute('disabled', 'true');
                }
                else{
                    activityDatePrompt.style.display = 'none';
                    updateActivityBtn.removeAttribute('disabled');
                }
            });

            closingDateField.addEventListener('input', function () {
                if (closingDateField.value && !activityDateField.value) {
                    activityDatePrompt.style.display = 'block';
                    updateActivityBtn.setAttribute('disabled', 'true');
                }
                else{
                    closingDatePrompt.style.display = 'none';
                    updateActivityBtn.removeAttribute('disabled');
                }
            });
        });

        window.addEventListener('DOMContentLoaded', function () {
            var startTimeField = document.getElementById("startTime");
            var endTimeField = document.getElementById("endTime");
            const startTimePrompt = document.getElementById('startTimePrompt');
            const endTimePrompt = document.getElementById('endTimePrompt');
            const updateActivityBtn = document.getElementById('updateActivity');

            startTimeField.addEventListener('input', function () {
                if (startTimeField.value && !endTimeField.value) {
                    endTimePrompt.style.display = 'block';
                    updateActivityBtn.setAttribute('disabled', 'true');
                }
                else{
                    startTimePrompt.style.display = 'none';
                    updateActivityBtn.removeAttribute('disabled');
                }
            });

            endTimeField.addEventListener('input', function () {
                if (endTimeField.value && !startTimeField.value) {
                    startTimePrompt.style.display = 'block';
                    updateActivityBtn.setAttribute('disabled', 'true');
                }
                else{
                    endTimePrompt.style.display = 'none';
                    updateActivityBtn.removeAttribute('disabled');
                }
            });
        });

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
    </script>

    <?php
        if(!empty($_GET['updateStatus'])){
            $alertCondition = $_GET['updateStatus'];
            if($alertCondition == "success"){
                echo"<script>
                        alertify.alert('Update Action','Activity Status Updated');
                    </script>";
            }
            else if($alertCondition == "anp"){
                echo"<script>
                        alertify.alert('Update Action','Action Not Performed. Try Again.');
                    </script>";
            }
        }

        if(!empty($_GET['action'])){
            $alertCondition = $_GET['action'];
            if($alertCondition == "joined"){
                echo"<script>
                        alertify.alert('Participate Action','You have joined this activity');
                    </script>";
            }
            else if($alertCondition == "xjoined"){
                echo"<script>
                        alertify.alert('Participate Action','Your participation did not went through');
                    </script>";
            }
            else if($alertCondition == "anp"){
                echo"<script>
                    alertify.alert('Participate Action','Action Not Performed. Try Again.');
                </script>";
            }
            else if($alertCondition == "updateSuccess"){
                echo"<script>
                        alertify.alert('Update Action','Activity Update Successfully');
                    </script>";
            }
            else if($alertCondition == "uaanp"){
                echo"<script>
                        alertify.alert('Update Action','Activity Not Updated. Try Again.');
                    </script>";
            }
        }
    ?>
</html>


