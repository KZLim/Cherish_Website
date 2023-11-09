<html>

    <head>
        <title>Campaign Management | Admin</title>
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
                            echo'<h5 class="banner-title-custom" style="color: #ff5757; font-weight: bold">Camapaign Management | Admin</h5>';
                        echo'</div>
                    </div>
                </div>';

                echo'<br/>';

                $dbc = mysqli_connect("localhost", "root", "");
                mysqli_select_db($dbc, "cherish_db");

                echo'<div>
                        <ul class="nav nav-tabs justify-content-center" id="profileTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#newCampaignList">New Campaign List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#updatedCampaignList">Updated Campaign List</a>
                            </li>   
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#unlistedCampaignList">Unlisted Campaign List</a>
                            </li>             
                        </ul>
                    </div>';

                echo'<div class="tab-content" style="overflow: auto;">';
                    echo'<div class="tab-pane fade show active" id="newCampaignList">';
                            echo"<br/>";
                            $currentDate = date('Y-m-d');
                            $query2 = mysqli_query($dbc, "SELECT * FROM ngo_campaign WHERE closing_date > '".$currentDate."' AND campaign_status<>'unlisted' AND campaign_status='new'");

                            while ($row = $query2->fetch_assoc()) {

                                $campaignName = $row['campaign_name'];
                                $campaignID = $row['campaign_id'];
                                $campaignBanner = $row['campaign_banner'];
                                $progress =  $row['progress'];
                                $raiseGoal =  $row['raise_goal'];
                                $closingDate = $row['closing_date'];
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
                                                                Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
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

                    echo'<div class="tab-pane fade" id="updatedCampaignList">';
                                echo"<br/>";

                                $currentDate = date('Y-m-d');
                                $query2 = mysqli_query($dbc, "SELECT * FROM ngo_campaign WHERE closing_date > '".$currentDate."' AND campaign_status<>'unlisted' AND campaign_status='updated'");

                                while ($row = $query2->fetch_assoc()) {

                                    $campaignName = $row['campaign_name'];
                                    $campaignID = $row['campaign_id'];
                                    $campaignBanner = $row['campaign_banner'];
                                    $progress =  $row['progress'];
                                    $raiseGoal =  $row['raise_goal'];
                                    $closingDate = $row['closing_date'];
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
                                                                    Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
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

                    echo'<div class="tab-pane fade" id="unlistedCampaignList">';
                                echo"<br/>";

                                $currentDate = date('Y-m-d');
                                $query2 = mysqli_query($dbc, "SELECT * FROM ngo_campaign WHERE closing_date > '".$currentDate."' AND campaign_status='unlisted'");

                                while ($row = $query2->fetch_assoc()) {

                                    $campaignName = $row['campaign_name'];
                                    $campaignID = $row['campaign_id'];
                                    $campaignBanner = $row['campaign_banner'];
                                    $progress =  $row['progress'];
                                    $raiseGoal =  $row['raise_goal'];
                                    $closingDate = $row['closing_date'];
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
                                                                    Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
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


