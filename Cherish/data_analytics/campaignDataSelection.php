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
                        Active Campaign
                    </span>
                </div>';
            
            echo'<div class="container-fluid">';
                echo"<br/>";
                $dbc = mysqli_connect("localhost","root","");
                mysqli_select_db($dbc,"cherish_db");

                $currentDate = date('Y-m-d');
                $query3 = "SELECT * FROM ngo_campaign WHERE `ouid`= ? AND closing_date > ?";

                $stmt3 = mysqli_prepare($dbc, $query3);
                                                
                mysqli_stmt_bind_param($stmt3,"ss",$_SESSION['identifier'],$currentDate); 
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
                                echo'<a href="ngoBoard_specificCampaign.php?campaignid='.$campaignID.'">';
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

            echo'<div id="pastSection" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                    <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                        Past Campaign
                    </span>
                </div><br/>';

            echo'<div class="container-fluid">';

                        $currentDate = date('Y-m-d');
                        $query4 = "SELECT * FROM ngo_campaign WHERE `ouid`= ? AND closing_date <= ?";
                        
                        $stmt4 = mysqli_prepare($dbc, $query4);
                                                        
                        mysqli_stmt_bind_param($stmt4,"ss",$_SESSION['identifier'],$currentDate); 
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
                                        echo'<a href="ngoBoard_specificCampaign.php?campaignid='.$campaignID.'">';
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

        ?>

        

    </body>
</html>


