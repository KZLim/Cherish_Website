<?php 
echo'<div class="tab-content" style="overflow: auto; height: 600px;" >
                <div class="tab-pane fade show active" id="ngoDetails">
                    <br/>
                    <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                            Basic Details
                        </span>
                    </div>
                    <br/>';

                    $query2 = mysqli_query($dbc,"SELECT * FROM ngo_profile WHERE `ouid`= '$targetProfile'");
                    while ($row = $query2->fetch_assoc()){

                        $ouid = $row['ouid'];
                        $ngoEmail = $row['ngo_email'];
                        $registerNumber = $row['register_number'];
                        $addressLine = $row['address_line'];
                        $city = $row['city'];
                        $state = $row['state'];
                        $postalCode = $row['postal_code'];
                        $ngoBio = $row['ngo_bio'];
                        $ngoURL = $row['ngo_url'];
                        $ngoCategory = $row['ngo_category'];

                        echo'<table class="table table-bordered">
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
                                    <td colspan="2">'.$registerNumber.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Office Adrress</th>
                                    <td colspan="2">'.$addressLine.','.$postalCode.','.$city.','.$state.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">NGO Category</th>
                                    <td colspan="2">'.$ngoCategory.'</td>
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
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Email Address</th>
                                    <td>'.$ngoEmail.'</td>
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
                    if(substr($_SESSION['identifier'],0,3)=="crt"){
                        echo'<div class="text-end" style="margin-right: 10px;">
                            <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#addDonationCampaign">
                                Launch New Donation
                            </button>
                        </div>';
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
                        $query3 = mysqli_query($dbc,"SELECT * FROM ngo_campaign WHERE `ouid`= '$targetProfile' AND closing_date > '".$currentDate."'");
                        while ($row = $query3->fetch_assoc()){

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
                        $query4 = mysqli_query($dbc,"SELECT * FROM ngo_campaign WHERE `ouid`= '$targetProfile' AND closing_date <= '".$currentDate."'");
                        while ($row = $query4->fetch_assoc()){

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
                    if(substr($_SESSION['identifier'],0,3)=="crt"){
                        echo'<div class="text-end" style="margin-right: 10px;">
                            <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#addVolunteerActivity">
                                Launch New Volunteer
                            </button>
                        </div>';
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
                                                <option value="Selangor">Selangor</option>
                                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                <option value="Melaka">Melaka</option>
                                                <option value="Johor">Johor</option>
                                                <option value="Sarawak">Sarawak</option>
                                                <option value="Sabah">Sabah</option>
                                            </select>
                                        </div>

                                         <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Participation Limit</span>
                                            <input type="number" name="participationLimit" id="participationLimit" class="form-control" placeholder="Enter participation limit" aria-label="Enter participation limit" aria-describedby="basic-addon1" required>
                                        </div>
                                        <p id="valueInvalid" style="color: red; display: none;"></p>

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
                        $query5 = mysqli_query($dbc,"SELECT * FROM ngo_activity WHERE `ouid`= '$targetProfile' AND closing_date > '".$currentDate."'");
                        while ($row = $query5->fetch_assoc()){

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
                        $query6 = mysqli_query($dbc,"SELECT * FROM ngo_activity WHERE `ouid`= '$targetProfile' AND closing_date <= '".$currentDate."'");
                        while ($row = $query6->fetch_assoc()){

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
            </div>';

            ?>