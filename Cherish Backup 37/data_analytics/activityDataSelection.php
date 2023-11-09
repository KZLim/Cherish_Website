<html>

    <head>
        <title>NGO Overall Analytics | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>

        <?php
            include '../main/header.php';

            echo'<br/><button id="jumpActive" class="btn btn-primary btn-reg-signin"><a href="#activeSection" style="color: white;">Active</a></button>
                 <button id="jumpPast" class="btn btn-primary btn-reg-signin"><a href="#pastSection" style="color: white;">Past</a></button>';

            echo'<div id="activeSection" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                    <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                        Active Activity
                    </span>
                </div><br/>';
            
                echo'<div class="container-fluid">';

                    $dbc = mysqli_connect("localhost","root","");
                    mysqli_select_db($dbc,"cherish_db");

                    $currentDate = date('Y-m-d');
                    $query5 = "SELECT * FROM ngo_activity WHERE `ouid`= ? AND closing_date > ?";
                    
                    $stmt5 = mysqli_prepare($dbc, $query5);
                                                    
                    mysqli_stmt_bind_param($stmt5,"ss",$_SESSION['identifier'],$currentDate); 
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
                                    echo'<a href="ngoBoard_specificActivity.php?activityid='.$activityID.'">';
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
                echo'</div>';

                echo'<div id="pastSection" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                            Past Activity
                        </span>
                    </div><br/>';

                echo'<div class="container-fluid">';

                    $currentDate = date('Y-m-d');
                    $query6 = "SELECT * FROM ngo_activity WHERE `ouid`= ? AND closing_date <= ?";
                    
                    $stmt6 = mysqli_prepare($dbc, $query6);
                                                    
                    mysqli_stmt_bind_param($stmt6,"ss",$_SESSION['identifier'],$currentDate); 
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
                                    echo'<a href="ngoBoard_specificActivity.php?activityid='.$activityID.'">';
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
                echo'</div>';
        ?>
    </body>
</html>


