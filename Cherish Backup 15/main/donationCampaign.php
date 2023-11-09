<html>

    <head>
        <title>Registration | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../ngo/ngo_css/profile.css">
    </head>

    <body>
        <?php
            include '../ngo/test.php';
            session_start();
            $dbc = mysqli_connect("localhost","root","");
            mysqli_select_db($dbc,"cherish_db");
            $targetCampaign = $_GET['campaignid'];

            $query = mysqli_query($dbc,"SELECT ngo_campaign.campaign_name, ngo_campaign.campaign_banner, ngo_profile.ngo_name FROM ngo_campaign INNER JOIN ngo_profile ON ngo_profile.ouid = ngo_campaign.ouid WHERE ngo_campaign.campaign_id = '$targetCampaign'");

            while ($row = $query->fetch_assoc()){

                $campaignName = $row['campaign_name'];
                $bannerPicture = $row['campaign_banner'];  
                $ngoName = $row['ngo_name'];

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="padding: 0;">';
                            echo'<img src="../campaign_banner/';
                            echo$bannerPicture;
                            echo'"height="200px" width="100%">';
                        echo'</div>
                    </div>
                    <div class="row" style="background-color: white;">';
                            echo'<h1 style="margin-top: 20px; margin-bottom: 20px;">'.$campaignName.'</h1>';
                            echo'<h6 style="margin-top: 20px; margin-bottom: 20px;">Organize by: '.$ngoName.'</h6>';
                    echo'</div>
                </div>';
            }

            echo"<br/>";

            echo'<div class="container-fluid">';

                $query2 = mysqli_query($dbc,"SELECT * FROM ngo_campaign WHERE campaign_id = '$targetCampaign'"); 
                while ($row = $query2->fetch_assoc()){

                    $campaignName = $row['campaign_name'];
                    $campaignBanner = $row['campaign_banner'];
                    $progress = $row['progress'];
                    $raiseGoal =  $row['raise_goal'];
                    $closingDate = $row['closing_date'];
                    $inPercentage = ($progress*100)/$raiseGoal;

                    echo'<div class="row">
                        <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                            <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                echo'<div class="card-body">
                                        <div class="progress" role="progressbar" aria-label="Dynamic Progress" aria-valuenow="' . $inPercentage . '" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: ' . $inPercentage . '%;"></div>
                                        </div>
                                        <p class ="card-text">
                                            Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
                                            In Percentage: '.$inPercentage.'%<br/>
                                            Closing Date: '.$closingDate.'<br/>
                                        </p>
                                    </div>
                            </div>
                        </div>
                    </div>';
                }
            echo'</div>';
            
            echo"<br/>";
            
            //perform substring operation here 
            if($_SESSION['identifier'] == "crt64f7103ad5837"){
                echo'<div class="text-end" style="margin-right: 10px;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDonationCampaign">
                                Edit Campaign
                            </button>
                        </div>';
            }

            echo'<div class="modal fade" id="editDonationCampaign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Change campaign info</h1><br/>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Leave empty if certain field wants to remain the same</p>
                            <form id="updateCampaignForm" action="../cherish_api/ngo/apiU_ngo_campaign.php" method="POST" enctype="multipart/form-data">
                                <div class="input-group mb-3" style="width: 100%;">
                                    <span class="input-group-text">Campaign Info</span>
                                    <textarea name="campaignInfo" class="form-control" aria-label="With textarea"></textarea>
                                </div>

                                <label class="form-label">Upload a campaign banner</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="campaignBannerUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                </div>

                                <label for="date">Closing Date:</label>
                                <input type="date" id="campaignClosingDate" name="campaignClosingDate"><br/><br/>

                                <input type="hidden" name="campaignIdParam" value='.$targetCampaign.'>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-reg-signin" data-bs-dismiss="modal">Close</button>
                            <input class="btn btn-secondary btn-reg-signin" id="createCampaign" type="submit" value="Create" form="updateCampaignForm">
                        </div>
                    </div>
                </div>
            </div>';

            echo'<div class="tab-content" style="height: 600px;" >
                    <div class="tab-pane fade show active" id="ngoDetails">
                        <br/>
                        <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                Campaign Details
                            </span>
                        </div>
                    <br/>';

                    $query3 = mysqli_query($dbc,"SELECT * FROM ngo_campaign WHERE campaign_id = '$targetCampaign'");
                    while ($row = $query3->fetch_assoc()){

                        $campaignID = $row['campaign_id'];
                        $campaignInfo = $row['campaign_info'];
                        $raiseGoal = $row['raise_goal'];
                        $campaignStatus = $row['campaign_status'];

                        echo'<table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Campaign ID</th>
                                    <td>'.$campaignID.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Campaign Info/Description</th>
                                    <td>'.$campaignInfo.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fundraising Target (In RM)</th>
                                    <td colspan="2">'.$raiseGoal.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Campaign Status</th>
                                    <td>'.$campaignStatus.'</td>
                                </tr>
                            </tbody>
                        </table>';
                    }

                    echo'<div class="tab-content" style="overflow: auto; height: 600px;" >
                    <div class="tab-pane fade show active" id="ngoDetails">
                        <br/>
                        <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                Organizing\'s NGO Details
                            </span>
                        </div>
                    <br/>';
                    

                    $query3 = mysqli_query($dbc,"SELECT ngo_profile.ngo_email, ngo_profile.ouid, ngo_profile.ngo_name, ngo_profile.address_line, ngo_profile.city, ngo_profile.state, ngo_profile.postal_code,
                    ngo_profile.ngo_category FROM ngo_profile INNER JOIN ngo_campaign ON ngo_profile.ouid = ngo_campaign.ouid WHERE ngo_campaign.campaign_id = '$targetCampaign'"); 
                    while ($row = $query3->fetch_assoc()){

                        $organizerEmail = $row['ngo_email'];
                        $organizerName = $row['ngo_name'];
                        $organizerAddress = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                        $organizerCategory = $row['ngo_category'];
                        $ouid = $row['ouid'];

                        echo'<table class="table table-bordered">
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
                                    <td colspan="2">'.$organizerAddress.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">NGO Category</th>
                                    <td>'.$organizerCategory.'</td>
                                </tr>
                            </tbody>
                        </table>';
                    }
        ?>
    </body>
</html>


