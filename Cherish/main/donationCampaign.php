<html>

    <head>
        <title>Donation Campaign | Cherish</title>
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
            $targetCampaign = $_GET['campaignid'];

            $query = "SELECT ngo_campaign.campaign_name, ngo_campaign.campaign_banner, ngo_profile.ngo_name FROM ngo_campaign INNER JOIN ngo_profile ON ngo_profile.ouid = ngo_campaign.ouid WHERE ngo_campaign.campaign_id = ?";

            $stmt = mysqli_prepare($dbc, $query);
                                                        
            mysqli_stmt_bind_param($stmt,"s",$targetCampaign); 
            mysqli_stmt_execute($stmt);
                            
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            while ($row = mysqli_fetch_assoc($result)) {

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

                $query2 = "SELECT * FROM ngo_campaign WHERE campaign_id = ?"; 

                $stmt2 = mysqli_prepare($dbc, $query2);
                                                        
                mysqli_stmt_bind_param($stmt2,"s",$targetCampaign); 
                mysqli_stmt_execute($stmt2);
                                
                $result2 = mysqli_stmt_get_result($stmt2);
                mysqli_stmt_close($stmt2);
    
                while ($row = mysqli_fetch_assoc($result2)) {

                    $campaignName = $row['campaign_name'];
                    $campaignBanner = $row['campaign_banner'];
                    $progress = $row['progress'];
                    $raiseGoal =  $row['raise_goal'];
                    $closingDate = $row['closing_date'];
                    $inPercentage = ($progress*100)/$raiseGoal;
                    $ouid = $row['ouid'];
                    $test="test";
                    $percentageRaised = ceil($inPercentage);

                    echo'<div class="row">
                        <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                            <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                echo'<div class="card-body">
                                        <div class="progress" role="progressbar" aria-label="Dynamic Progress" aria-valuenow="' . $inPercentage . '" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: ' . $inPercentage . '%;"></div>
                                        </div>

                                        <p class ="card-text">
                                            Fund Progress: '.$progress.'/'.$raiseGoal.'<br/>
                                            In Percentage: '.$percentageRaised.'%<br/>
                                            Closing Date: '.$closingDate.'<br/>
                                        </p>';
                                        
                                        if(!empty($_SESSION['identifier']) && $closingDate>date('Y-m-d')){
                                            if($progress<$raiseGoal && substr($_SESSION['identifier'],0,3)!="crt" && substr($_SESSION['identifier'],0,3)!="CAG"){
                                                echo'<div class="text-end" style="margin-right: 10px;">
                                                    <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#donateForm">
                                                        Donate
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
                                <form id="acceptForm" action="../cherish_api/admin/apiU_campaign_status.php" method="POST" enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="campaignIdParam" value='.$targetCampaign.'>
                                    <input type="hidden" name="statusParam" value="listed">

                                </form>
                                By approving the campaign, you have ensure that all the details has been checked and reason provided for a fundraising is reasonable.                            
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-secondary btn-reg-signin" id="donateToCampaignBtn" type="submit" value="OK" form="acceptForm">
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
                                <form id="rejectForm" action="../cherish_api/admin/apiU_campaign_status.php" method="POST" enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="campaignIdParam" value='.$targetCampaign.'>
                                    <input type="hidden" name="statusParam" value="unlisted">

                                </form>
                                Donation campaign can be unlisted if it violate any the Cherish donation terms and condition. Please double check before unlisting campaign.                           
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-secondary btn-reg-signin" id="donateToCampaignBtn" type="submit" value="OK" form="rejectForm">
                            </div>
                        </div>
                    </div>
                </div>';

            echo'<div class="modal fade" id="donateForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Donate to the campaign</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="campaignForm" action="../cherish_api/ngo/api_donateTo_campaign.php" method="POST" enctype="multipart/form-data">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Donate Amount</span>
                                        <input type="number" name="donateAmount" id="donateAmount" oninput="checkPostCodeLength(this, 6)" class="form-control" placeholder="Enter donation amount (In RM)" aria-label="Enter donation amount (In RM)" aria-describedby="basic-addon1" required>
                                    </div>
                                    <p id="valueInvalid" style="color: red; display: none;"></p>


                                    <input type="hidden" name="campaignIdParam" value='.$targetCampaign.'>

                                </form>
                                By donating you agree to the Cherish campaign donation terms and condition.
                            </div>
                            <div class="modal-footer">
                                <input class="btn btn-secondary btn-reg-signin" id="donateToCampaignBtn" type="submit" value="Donate" form="campaignForm">
                            </div>
                        </div>
                    </div>
                </div>';
            
            echo"<br/>";
            
            $currentDate = date('Y-m-d');
            if(!empty($_SESSION['identifier'])){
                if((substr($_SESSION['identifier'],0,3))=="crt" && $_SESSION['identifier']==$ouid && $closingDate>$currentDate){
                    echo'<div class="text-end" style="margin-right: 10px;">
                                <button type="button" class="btn btn-primary btn-reg-signin" data-bs-toggle="modal" data-bs-target="#editDonationCampaign">
                                    Edit Campaign
                                </button>
                            </div>';
                }
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
                            <input class="btn btn-secondary btn-reg-signin" id="updateCampaign" type="submit" value="Update" form="updateCampaignForm">
                        </div>
                    </div>
                </div>
            </div>';

            if(!empty($_SESSION['identifier'])){
                if((substr($_SESSION['identifier'],0,3))=="crt" && $_SESSION['identifier']==$ouid){
                    echo'<div>
                            <ul class="nav nav-tabs justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#campaignDetails">Campaign Details</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#donorList">Donors List</a>
                                </li>              
                            </ul>
                        </div>';
                }
            }

            echo'<div class="tab-content">';
                echo'<div class="tab-pane fade show active" id="campaignDetails" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';
                    echo'<br/>';
                    echo'<div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                    Campaign Details
                            </span>
                        </div>
                    <br/>';

                    $query3 = "SELECT * FROM ngo_campaign WHERE campaign_id = ?";

                    $stmt3 = mysqli_prepare($dbc, $query3);
                                                        
                    mysqli_stmt_bind_param($stmt3,"s",$targetCampaign); 
                    mysqli_stmt_execute($stmt3);
                                    
                    $result3 = mysqli_stmt_get_result($stmt3);
                    mysqli_stmt_close($stmt3);
        
                    while ($row = mysqli_fetch_assoc($result3)) {

                        $campaignID = $row['campaign_id'];
                        $campaignInfo = $row['campaign_info'];
                        $raiseGoal = $row['raise_goal'];
                        $campaignStatus = $row['campaign_status'];

                        echo'<table class="table table-bordered" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
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
                                            <td>'.$raiseGoal.'</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Campaign Status</th>
                                            <td>'.$campaignStatus.'</td>
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
                    ngo_profile.ngo_category FROM ngo_profile INNER JOIN ngo_campaign ON ngo_profile.ouid = ngo_campaign.ouid WHERE ngo_campaign.campaign_id = ?"; 
                    
                    $stmt4 = mysqli_prepare($dbc, $query4);
                                                        
                    mysqli_stmt_bind_param($stmt4,"s",$targetCampaign); 
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

                echo'<div class="tab-pane fade" id="donorList" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">';
                    echo'<br/>';
                    $query5 = "SELECT user_account.name, user_account.email_address, user_account.ic_number, user_account.address_line,
                    user_account.postal_code, user_account.city, user_account.state, donors_record.amount, donors_record.donation_date, donors_record.donation_time
                    FROM user_account INNER JOIN donors_record ON user_account.uid = donors_record.donor_uid WHERE donors_record.campaign_id = ?";

                    $stmt5 = mysqli_prepare($dbc, $query5);
                                                                            
                    mysqli_stmt_bind_param($stmt5,"s",$targetCampaign); 
                    mysqli_stmt_execute($stmt5);
                                    
                    $result5 = mysqli_stmt_get_result($stmt5);
                    mysqli_stmt_close($stmt5);

                    while ($row = mysqli_fetch_assoc($result5)) {

                        $donorName = $row['name'];
                        $donorEmail = $row['email_address'];
                        $donorAddress = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                        $amount = $row['amount'];
                        $donateDate = $row['donation_date'];
                        $donateTime = $row['donation_time'];

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
                                                            <th scope="row">Donor Name</th>
                                                            <td>'.$donorName.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">IC Number</th>
                                                            <td>'.$decryptICValue.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email Address</th>
                                                            <td>'.$donorEmail.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mailing Address</th>
                                                            <td>'.$donorAddress.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Amount Donated</th>
                                                            <td>'.$amount.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Donation Date</th>
                                                            <td>'.$donateDate.'</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Donation Time</th>
                                                            <td>'.$donateTime.'</td>
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
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('campaignClosingDate').setAttribute('min', today);
    </script>
    <?php
        if(!empty($_GET['status'])){
            $alertCondition = $_GET['status'];
            if($alertCondition == "donationok"){
                echo"<script>
                    alertify.alert('Donation Action','Your Donation Has Been Received!');
                </script>";
            }
            else if($alertCondition == "donationxok"){
                echo"<script>
                    alertify.alert('Donation Action','Your Donation Did Not Went Through');
                </script>";
            }
            else if($alertCondition == "anp"){
                echo"<script>
                    alertify.alert('Donation Action','Action Not Performed. Try Again.');
                </script>";
            }
        }

        if(!empty($_GET['updateStatus'])){
            $alertCondition = $_GET['updateStatus'];
            if($alertCondition == "success"){
                echo"<script>
                    alertify.alert('Update Action','Campaign Status Updated');
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
            if($alertCondition == "updateSuccess"){
                echo"<script>
                    alertify.alert('Update Action','Campaign Updated Successfully');
                </script>";
            }
        }
    ?>
</html>


