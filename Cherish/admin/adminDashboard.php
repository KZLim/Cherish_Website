<html>

    <head>
        <title> Admin Dashboard | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>

        <?php
            include '../main/header.php';
        ?>

        <?php
            $dbc = mysqli_connect("localhost", "root", "");
            mysqli_select_db($dbc, "cherish_db");

            //to store the returned counted data
            $ngoProfileData = array(
                'listed' => 0,
                'unlisted' => 0,
            );

            $userAccountData = array(
                'lock' => 0,
                'unlock' => 0,
            );

            $campaignData = array(
                'listed' => 0,
                'new' => 0,
                'updated' => 0,
                'unlisted' => 0
            );

            $activityData = array(
                'listed' => 0,
                'new' => 0,
                'updated' => 0,
                'unlisted' => 0
            );

            $currentDate = date('Y-m-d');
            //Query 1
            $query = "SELECT ngo_status, COUNT(*) AS ngo_profile_data FROM ngo_profile GROUP BY ngo_status";
            $stmt = mysqli_prepare($dbc, $query);

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            $ngoProfileCategory = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $ngoProfileStatus = $row['ngo_status'];                
                $ngoProfileData[$ngoProfileStatus] = $row['ngo_profile_data'];
            }
            
            //Query 2 for the second data
            $query2 = "SELECT account_status, COUNT(*) AS user_account_data FROM user_account GROUP BY account_status
                        ORDER BY CASE WHEN account_status='`unlock`' THEN 1 WHEN account_status='locked' THEN 2 END";
            $stmt2 = mysqli_prepare($dbc, $query2);

            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            mysqli_stmt_close($stmt2);

            $userAccountCategory = 0;
            while ($row = mysqli_fetch_assoc($result2)) {
                $userAccountStatus = $row['account_status'];                
                $userAccountData[$userAccountStatus] = $row['user_account_data'];
            }

            //Query 3 for the third data
            $query3 = "SELECT campaign_status, COUNT(*) as campaign_data FROM ngo_campaign WHERE closing_date > '".$currentDate."' GROUP BY campaign_status";
            $stmt3 = mysqli_prepare($dbc, $query3);
           
            mysqli_stmt_execute($stmt3);
            $result3 = mysqli_stmt_get_result($stmt3);
            mysqli_stmt_close($stmt3);

            while ($row = mysqli_fetch_assoc($result3)) {
                $campaignStatus = $row['campaign_status'];                
                $campaignData[$campaignStatus] = $row['campaign_data'];
            }

            //Query 4 for the fourth data
            $query4 = "SELECT activity_status, COUNT(*) as activity_data FROM ngo_activity WHERE closing_date > '".$currentDate."' GROUP BY activity_status";
            $stmt4 = mysqli_prepare($dbc, $query4);
           
            mysqli_stmt_execute($stmt4);
            $result4 = mysqli_stmt_get_result($stmt4);
            mysqli_stmt_close($stmt4);

            $activityDataNum = 0;
            while ($row = mysqli_fetch_assoc($result4)) {
                $activityStatus = $row['activity_status'];     
                $activityData[$activityStatus] = $row['activity_data'];
            }

            $totalUser = $userAccountData['lock']+$userAccountData['unlock'];
            $totalNGO = $ngoProfileData['listed']+$ngoProfileData['unlisted'];
            $totalCampaign = $campaignData['listed']+$campaignData['new']+$campaignData['updated']+$campaignData['unlisted'];
            $totalActivity = $activityData['listed']+$activityData['new']+$activityData['updated']+$activityData['unlisted'];
            echo'<div class="container text-center" style="margin-top: 30px;">
                <h3>Overall System Statistic</h3>
                <div class="row" style="padding: 10px;">
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of New Campaign:</h5>
                        <h5>'.$campaignData['new'].'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of Updated Campaign:</h5>
                        <h5>'.$campaignData['updated'].'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of Unlisted Campaign:</h5>
                        <h5>'.$campaignData['unlisted'].'</h5>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of New Activity:</h5>
                        <h5>'.$activityData['new'].'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of Updated Activity:</h5>
                        <h5>'.$activityData['updated'].'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of Unlisted Activity:</h5>
                        <h5>'.$activityData['unlisted'].'</h5>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of Unlisted Profile:</h5>
                        <h5>'.$ngoProfileData['unlisted'].'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Number of Locked Users:</h5>
                        <h5>'.$userAccountData['lock'].'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Total User:</h5>
                        <h5>'.$totalUser.'</h5>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Total NGO:</h5>
                        <h5>'.$totalNGO.'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Total Campaign listed:</h5>
                        <h5>'.$totalCampaign.'</h5>
                    </div>
                    <div class="col" style="background-color: rgba(255, 87, 87, 0.6); border: 1px solid black; padding: 15px;">
                        <h5>Total Activity listed:</h5>
                        <h5>'.$totalActivity.'</h5>
                    </div>
                </div>
            </div><br/><br/><br/>';

        ?>
    </body>
</html>


