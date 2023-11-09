<html>

    <head>
        <title>Registration | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="user_css/profile.css">
    </head>

    <body>

        <?php 
            include '../main/header.php';
        ?>

        <div class="container container-custom">
            <div class="row">
                <div class="col-4 text-center" style="border-right: 1px solid #ffa9a3; width:390px; word-wrap: break-word;">
                    <?php
                        $dbc = mysqli_connect("localhost","root","");
                        mysqli_select_db($dbc,"cherish_db");

                        $query = mysqli_query($dbc,"SELECT * FROM user_profile WHERE `uid`= '".$_SESSION["identifier"]."'");
                                        
                        while ($row = $query->fetch_assoc()){

                            $uid = $row['uid'];
                            $name = $row['name'];
                            $bio = $row['bio'];
                            $profilePicture = $row['profile_path'];       

                            echo"<br/>";
                            echo'<img src="../users_images/';
                            echo$profilePicture;
                            echo'"width="250" height="250">';
                            echo"<br/>";
                            echo"<br/>";
                            echo"UID: $uid";
                            echo"<br/>";
                            echo"Username: $name";
                            echo"<br/>";
                            echo"Bio: $bio";

                            echo"<div style='height: 80px;'></div>";      

                            echo"<h4>Quick Links</h4>";
                            echo"<a href='https://google.com'>Google</a>";
                            echo"<br/>";
                            echo"<a href='https://google.com'>Google</a>";
                            echo"<br/>";
                            echo"<a href='https://google.com'>Google</a>";
                            echo"<br/>";
                            echo"<a href='https://google.com'>Google</a>";

                            echo"<div style='height: 60px;'></div>";      
                        }
                    ?>
                </div>
                    
                <div class="col">
                    <ul class="nav nav-tabs tab-nav-profile" id="profileTabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#myDonationRecord">My Donation</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#currentParticipation">Current Volunteer</a>
                        </li>
                            
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#pastParticipation">Past Volunteer</a>
                        </li>
                    </ul>

                    <div class="tab-content"  style="overflow: auto; height: 600px;" >
                        <div class="tab-pane fade show active" id="myDonationRecord">
                            <br/>
                            <?php
                                $query2 = mysqli_query($dbc,"SELECT ngo_campaign.campaign_name, ngo_campaign.campaign_banner, ngo_campaign.progress, ngo_campaign.raise_goal,
                                donors_record.campaign_id, donors_record.amount, donors_record.donation_date,
                                donors_record.donation_time FROM ngo_campaign INNER JOIN donors_record ON ngo_campaign.campaign_id = donors_record.campaign_id WHERE donors_record.donor_uid = '".$_SESSION["identifier"]."'");

                                while ($row = $query2->fetch_assoc()) {

                                    $campaignName = $row['campaign_name'];
                                    $campaignID = $row['campaign_id'];
                                    $campaignBanner = $row['campaign_banner'];
                                    $progress =  $row['progress'];
                                    $raiseGoal =  $row['raise_goal'];
                                    $amount = $row['amount'];
                                    $donateDate = $row['donation_date'];
                                    $donateTime = $row['donation_time'];
                                    echo'<div class="container-fluid">
                                        <div class="row">
                                            <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                                <div class="card" style="width: 85%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
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
                                                                    Amount Donated: '.$amount.'<br/>
                                                                    Date of Donation: '.$donateDate.'<br/>
                                                                    Time of Donation: '.$donateTime.'<br/>
                                                                    Campaign Raised: '.$progress.'/'.$raiseGoal.'<br/>
                                                                </p>
                                                            </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>';
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="currentParticipation">
                            <br/>
                            <?php
                                $currentDate = date('Y-m-d');
                                $query3 = mysqli_query($dbc,"SELECT ngo_activity.activity_name, ngo_activity.activity_banner, ngo_activity.current_participant, ngo_activity.participation_limit,
                                participants_record.activity_id, participants_record.register_date, participants_record.register_time
                                FROM ngo_activity INNER JOIN participants_record ON ngo_activity.activity_id = participants_record.activity_id WHERE participants_record.participant_uid = '".$_SESSION["identifier"]."'
                                AND ngo_activity.closing_date > '".$currentDate."'");

                                while ($row = $query3->fetch_assoc()) {

                                    $activityName = $row['activity_name'];
                                    $activityID = $row['activity_id'];
                                    $activityBanner = $row['activity_banner'];
                                    $currentParticipant = $row['current_participant'];
                                    $volunteerNeeded = $row['participation_limit'];
                                    $registerDate = $row['register_date'];
                                    $registerTime = $row['register_time'];
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
                                                                    Date of Registration: '.$registerDate.'<br/>
                                                                    Time of Registration: '.$registerTime.'<br/>
                                                                    Volunteer Participated: '.$currentParticipant.'/'.$volunteerNeeded.'<br/>
                                                                </p>
                                                            </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>';
                                }
                            ?>
                        </div>

                        <div class="tab-pane fade" id="pastParticipation">
                            <br/>
                            <?php
                                $currentDate = date('Y-m-d');
                                $query4 = mysqli_query($dbc,"SELECT ngo_activity.activity_name, ngo_activity.activity_banner, ngo_activity.current_participant, ngo_activity.participation_limit,
                                participants_record.activity_id, participants_record.register_date, participants_record.register_time
                                FROM ngo_activity INNER JOIN participants_record ON ngo_activity.activity_id = participants_record.activity_id WHERE participants_record.participant_uid = '".$_SESSION["identifier"]."'
                                AND ngo_activity.closing_date <= '".$currentDate."'");

                                while ($row = $query4->fetch_assoc()) {

                                    $activityName = $row['activity_name'];
                                    $activityID = $row['activity_id'];
                                    $activityBanner = $row['activity_banner'];
                                    $currentParticipant = $row['current_participant'];
                                    $volunteerNeeded = $row['participation_limit'];
                                    $registerDate = $row['register_date'];
                                    $registerTime = $row['register_time'];
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
                                                                    Date of Registration: '.$registerDate.'<br/>
                                                                    Time of Registration: '.$registerTime.'<br/>
                                                                    Volunteer Participated: '.$currentParticipant.'/'.$volunteerNeeded.'<br/>
                                                                </p>
                                                            </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>