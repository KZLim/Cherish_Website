<!DOCTYPE html>
<html>
<head>
    <title>Donors Gender | Specific</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <?php
        $overallMale_basedCampaign = 0;
        $overallFemale_basedCampaign = 0;

        $dbc = mysqli_connect("localhost", "root", "");
        mysqli_select_db($dbc, "cherish_db");

        $query = "SELECT DISTINCT user_account.uid, user_account.gender FROM user_account 
                    INNER JOIN (
                        SELECT DISTINCT donor_uid
                        FROM donors_record
                        WHERE campaign_id IN (
                            SELECT campaign_id
                            FROM ngo_campaign
                            WHERE campaign_id = ?
                        )
                    ) AS distinct_donor
                    ON user_account.uid = distinct_donor.donor_uid;";

        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt,"s",$campaignID); 

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        while ($row = mysqli_fetch_assoc($result)) {            
            if($row['gender']=="Male"){
                $overallMale_basedCampaign = $overallMale_basedCampaign + 1;
            }
            else if($row['gender'] == "Female"){
                $overallFemale_basedCampaign = $overallFemale_basedCampaign + 1;
            }
        }
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div style="width: 400px; height: 400px;">
                    <canvas id="specificGender_campaign"></canvas>
                </div>
            </div>
            <div class="col d-flex flex-column justify-content-center align-items-center">
                <h4>This Campaign Interaction Based on Gender</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Gender</th>
                            <th scope="col">Number of People</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Overall Male Interaction</th>
                            <td><?php echo"$overallMale_basedCampaign<br/>";?></td>
                        </tr>
                        <tr>
                            <th scope="row">Overall Female Interaction</th>
                            <td><?php echo$overallFemale_basedCampaign;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Get the canvas element and create a context for drawing
        var ngoSpecificGender_campaign = document.getElementById('specificGender_campaign').getContext('2d');

        var genderSpecific_campaign = {
            male: <?php echo $overallMale_basedCampaign; ?>,
            female: <?php echo $overallFemale_basedCampaign; ?>
        };

        // Data for the pie chart
        var genderDataSpecific_campaign = {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [genderSpecific_campaign.male,genderSpecific_campaign.female], // Values for each slice
                backgroundColor: ['blue', 'pink'], // Colors for each slice
            }]
        };

        // Create a pie chart
        var specificGender_campaign = new Chart(ngoSpecificGender_campaign, {
            type: 'pie',
            data: genderDataSpecific_campaign
        });
    </script>
</body>
</html>
