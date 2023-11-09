<!DOCTYPE html>
<html>
<head>
    <title>Participant Age | Specific</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <?php
        $age = 0;
        $ageGroup1 = 0;
        $ageGroup2 = 0;
        $ageGroup3 = 0;
        $ageGroup4 = 0;
        $ageGroup5 = 0;
        $ageGroup6 = 0;
        $ageGroup7 = 0;
        $ageGroup8 = 0;
        $ageGroup9 = 0;
        $ageGroup10 = 0;

        $dbc = mysqli_connect("localhost", "root", "");
        mysqli_select_db($dbc, "cherish_db");

        $query = "SELECT DISTINCT user_account.uid, user_account.ic_number FROM user_account 
                    INNER JOIN (
                        SELECT DISTINCT participant_uid
                        FROM participants_record
                        WHERE activity_id IN (
                            SELECT activity_id
                            FROM ngo_activity
                            WHERE activity_id = ?
                        )
                    ) AS distinct_participant
                    ON user_account.uid = distinct_participant.participant_uid";

        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt,"s",$activityID); 

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        while ($row = mysqli_fetch_assoc($result)) {   
            $cipherMethod = "AES-128-CTR";
            $decryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $initVector = "Cherish Moments.";

            $decryptICValue = openssl_decrypt ($row['ic_number'], $cipherMethod ,$decryptionKey, 0, $initVector);

            $yearFromIC = substr($decryptICValue,0,2);

            $maxAgeYear = substr(date('Y'),2,2); 

            $year = intval($yearFromIC);

            if ($year <= $maxAgeYear) {
                $age = intval(date('Y')) - (2000 + $year);
            }
            else{
                $age = intval(date('Y')) - (1900 + $year);
            }

            if($age>=15 && $age<=20){
                $ageGroup2 = $ageGroup2 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup3 = $ageGroup3 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup4 = $ageGroup4 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup5 = $ageGroup5 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup6 = $ageGroup6 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup7 = $ageGroup7 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup8 = $ageGroup8 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup9 = $ageGroup9 + 1;
            }
            else if($age>=21 && $age<=30){
                $ageGroup10 = $ageGroup10 + 1;
            }
            
        }
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-6">
                <div style="width: 100%; max-width: 400px; height: 400px;">
                    <canvas id="specificAgeGroup_activity"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h4>This Activity Participant's Age Group</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Age Group</th>
                            <th scope="col">Number of People</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Age "15-20</th>
                            <td><?php echo $ageGroup2; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "21-30"</th>
                            <td colspan="2"><?php echo $ageGroup3; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "31-40"</th>
                            <td colspan="2"><?php echo $ageGroup4; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "41-50"</th>
                            <td colspan="2"><?php echo $ageGroup5; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "51-60"</th>
                            <td colspan="2"><?php echo $ageGroup6; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "61-70"</th>
                            <td colspan="2"><?php echo $ageGroup7; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "71-80"</th>
                            <td colspan="2"><?php echo $ageGroup8; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "81-90"</th>
                            <td colspan="2"><?php echo $ageGroup9; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Age "91-99"</th>
                            <td colspan="2"><?php echo $ageGroup10; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Get the canvas element and create a context for drawing
        var ngoSpecificAgeGroup_activity = document.getElementById('specificAgeGroup_activity').getContext('2d');

        var ageGroupSpecific_activity = {
            "0-10": <?php echo $ageGroup1; ?>,
            "11-20": <?php echo $ageGroup2; ?>,
            "21-30": <?php echo $ageGroup3; ?>,
            "31-40": <?php echo $ageGroup4; ?>,
            "41-50": <?php echo $ageGroup5; ?>,
            "51-60": <?php echo $ageGroup6; ?>,
            "61-70": <?php echo $ageGroup7; ?>,
            "71-80": <?php echo $ageGroup8; ?>,
            "81-90": <?php echo $ageGroup9; ?>,
            "91-99": <?php echo $ageGroup10; ?>
        };

        // Data for the pie chart
        var ageGroupdataSpecific_activity= {
            labels: ['1-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80', '81-90', '91-99'],
            datasets: [{
                data: [ageGroupSpecific_activity["1-10"],ageGroupSpecific_activity["11-20"],ageGroupSpecific_activity["21-30"],ageGroupSpecific_activity["31-40"],
                        ageGroupSpecific_activity["41-50"],ageGroupSpecific_activity["51-60"],ageGroupSpecific_activity["61-70"], ageGroupSpecific_activity["71-80"],
                        ageGroupSpecific_activity["81-90"],ageGroupSpecific_activity["91-99"]], // Values for each slice
                backgroundColor: ['blue', 'pink', 'red', 'green', 'orange', 'purple', 'cyan', 'magenta', 'yellow', 'lightblue'], // Colors for each slice
            }]
        };

        // Create a pie chart
        var specificAgeGroup_activity = new Chart(ngoSpecificAgeGroup_activity, {
            type: 'pie',
            data: ageGroupdataSpecific_activity
        });
    </script>
</body>
</html>
