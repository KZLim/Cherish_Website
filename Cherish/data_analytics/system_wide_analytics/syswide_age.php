<!DOCTYPE html>
<html>
<head>
    <title>Age Overall | Admin</title>
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

        $dbc = mysqli_connect("localhost", "root", "");
        mysqli_select_db($dbc, "cherish_db");

        $query = "SELECT ic_number FROM user_account";

        $stmt = mysqli_prepare($dbc, $query);

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
            else if($age>=31 && $age<=40){
                $ageGroup4 = $ageGroup4 + 1;
            }
            else if($age>=41 && $age<=50){
                $ageGroup5 = $ageGroup5 + 1;
            }
            else if($age>=51 && $age<=60){
                $ageGroup6 = $ageGroup6 + 1;
            }
            else if($age>=61 && $age<=70){
                $ageGroup7 = $ageGroup7 + 1;
            }
            else if($age>=71 && $age<=80){
                $ageGroup8 = $ageGroup8 + 1;
            }
        }
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-6">
                <div style="width: 100%; max-width: 400px; height: 400px;">
                    <canvas id="overallAgeGroup"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h4>System-wide Overall Age Group Analysis</h4>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Get the canvas element and create a context for drawing
        var siteOverallAgeGroup = document.getElementById('overallAgeGroup').getContext('2d');

        var ageGroup = {
            "0-10": <?php echo $ageGroup1; ?>,
            "11-20": <?php echo $ageGroup2; ?>,
            "21-30": <?php echo $ageGroup3; ?>,
            "31-40": <?php echo $ageGroup4; ?>,
            "41-50": <?php echo $ageGroup5; ?>,
            "51-60": <?php echo $ageGroup6; ?>,
            "61-70": <?php echo $ageGroup7; ?>,
            "71-80": <?php echo $ageGroup8; ?>,
        };

        // Data for the pie chart
        var ageGroupdata= {
            labels: ['1-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80', '81-90', '91-99'],
            datasets: [{
                data: [ageGroup["1-10"],ageGroup["11-20"],ageGroup["21-30"],ageGroup["31-40"],
                    ageGroup["41-50"],ageGroup["51-60"],ageGroup["61-70"], ageGroup["71-80"]], // Values for each slice
                backgroundColor: ['blue', 'pink', 'red', 'green', 'orange', 'purple', 'cyan', 'magenta'], // Colors for each slice
            }]
        };

        // Create a pie chart
        var overallAgeGroup = new Chart(siteOverallAgeGroup, {
            type: 'pie',
            data: ageGroupdata
        });
    </script>
</body>
</html>
