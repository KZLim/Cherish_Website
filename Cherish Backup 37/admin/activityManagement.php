<html>

    <head>
        <title>Activity Management | Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>
        <?php
                include '../main/header.php';

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="padding: 0;">';
                            echo'<img src="../ngo_banner_images/crt64f7103ad583764fc2b2646a68.jpg" height="200px" width="100%" style="filter: brightness(0.4);">';
                            echo'<h5 class="banner-title-custom" style="color: #ff5757; font-weight: bold">Activity Management | Admin</h5>';
                        echo'</div>
                    </div>
                </div>';

                echo'<br/>';

                $dbc = mysqli_connect("localhost", "root", "");
                mysqli_select_db($dbc, "cherish_db");

                echo'<div>
                        <ul class="nav nav-tabs justify-content-center" id="profileTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#newActivityList">New Activity List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#updatedActivityList">Updated Activity List</a>
                            </li>   
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#unlistedActivityList">Unlisted Activity List</a>
                            </li>             
                        </ul>
                    </div>';

                echo'<div class="tab-content" style="overflow: auto;">';
                    echo'<div class="tab-pane fade show active" id="newActivityList">';
                            echo"<br/>";
                            $currentDate = date('Y-m-d');
                            $query = "SELECT * FROM ngo_activity WHERE closing_date > ? AND activity_status='new'";
                            
                            $stmt = mysqli_prepare($dbc, $query);
                                                        
                            mysqli_stmt_bind_param($stmt,"s",$currentDate); 
                            mysqli_stmt_execute($stmt);
                                            
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                
                            while ($row = mysqli_fetch_assoc($result)) {

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

                    echo'<div class="tab-pane fade" id="updatedActivityList">';
                            echo"<br/>";

                            $currentDate = date('Y-m-d');
                            $query2 = "SELECT * FROM ngo_activity WHERE closing_date > ? AND activity_status='updated'";

  
                            $stmt2 = mysqli_prepare($dbc, $query2);
                                                        
                            mysqli_stmt_bind_param($stmt2,"s",$currentDate); 
                            mysqli_stmt_execute($stmt2);
                                            
                            $result2 = mysqli_stmt_get_result($stmt2);
                            mysqli_stmt_close($stmt2);
                
                            while ($row = mysqli_fetch_assoc($result2)) {

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
                    echo'</div>';

                    echo'<div class="tab-pane fade" id="unlistedActivityList">';
                        echo"<br/>";

                        $currentDate = date('Y-m-d');
                        $query3 = "SELECT * FROM ngo_activity WHERE closing_date > ? AND activity_status='unlisted'";

                        $stmt3 = mysqli_prepare($dbc, $query3);
                                                        
                        mysqli_stmt_bind_param($stmt3,"s",$currentDate); 
                        mysqli_stmt_execute($stmt3);
                                        
                        $result3 = mysqli_stmt_get_result($stmt3);
                        mysqli_stmt_close($stmt3);
            
                        while ($row = mysqli_fetch_assoc($result3)) {

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
                    echo'</div>';
                echo'</div>';
        ?>
    </body>
</html>


