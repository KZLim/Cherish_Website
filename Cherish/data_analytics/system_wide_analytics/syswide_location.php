<!DOCTYPE html>
<html>
<head>
    <title>User Location Overall | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <?php
        $malaysiaState = array(
            'Perlis' => 0,
            'Kedah' => 0,
            'Pulau Pinang' => 0,
            'Perak' => 0,
            'Kelantan' => 0,
            'Terengganu' => 0,
            'Pahang' => 0,
            'Kuala Lumpur' => 0,
            'PutraJaya' => 0,
            'Selangor' => 0,
            'Negeri Sembilan' => 0,
            'Melaka' => 0,
            'Johor' => 0,
            'Sarawak' => 0,
            'Sabah' => 0,
            'Labuan' => 0
        );

        $dbc = mysqli_connect("localhost", "root", "");
        mysqli_select_db($dbc, "cherish_db");

        $query = "SELECT `state` FROM user_account";

        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        while ($row = mysqli_fetch_assoc($result)) {   
            $malaysiaState[$row['state']] = $malaysiaState[$row['state']] + 1;
        }

    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-6">
                <div style="width: 100%; max-width: 400px; height: 400px;">
                    <canvas id="overallAudienceLocation"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h4>System-wide User Location Analysis</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">State</th>
                            <th scope="col">Number of People</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Perlis</th>
                            <td><?php echo $malaysiaState['Perlis']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kedah</th>
                            <td><?php echo $malaysiaState['Kedah']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Pulau Pinang</th>
                            <td colspan="2"><?php echo $malaysiaState['Pulau Pinang']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Perak</th>
                            <td colspan="2"><?php echo $malaysiaState['Perak']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kelantan</th>
                            <td colspan="2"><?php echo $malaysiaState['Kelantan']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Terengganu</th>
                            <td colspan="2"><?php echo $malaysiaState['Terengganu']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Pahang</th>
                            <td colspan="2"><?php echo $malaysiaState['Pahang']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kuala Lumpur</th>
                            <td colspan="2"><?php echo $malaysiaState['Kuala Lumpur']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">PutraJaya</th>
                            <td colspan="2"><?php echo $malaysiaState['PutraJaya']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Selangor</th>
                            <td colspan="2"><?php echo $malaysiaState['Selangor']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Negeri Sembilan</th>
                            <td colspan="2"><?php echo $malaysiaState['Negeri Sembilan']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Melaka</th>
                            <td colspan="2"><?php echo $malaysiaState['Melaka']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Johor</th>
                            <td colspan="2"><?php echo $malaysiaState['Johor']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Sarawak</th>
                            <td colspan="2"><?php echo $malaysiaState['Sarawak']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Sabah</th>
                            <td colspan="2"><?php echo $malaysiaState['Sabah']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Labuan</th>
                            <td colspan="2"><?php echo $malaysiaState['Labuan']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Get the canvas element and create a context for drawing
        var siteOverallAudienceLocation = document.getElementById('overallAudienceLocation').getContext('2d');

        var locationGroup = {
            'Perlis': <?php echo $malaysiaState['Perlis']; ?>,
            'Kedah': <?php echo $malaysiaState['Kedah']; ?>,
            'Pulau Pinang': <?php echo $malaysiaState['Pulau Pinang']; ?>,
            'Perak': <?php echo $malaysiaState['Perak']; ?>,
            'Kelantan': <?php echo $malaysiaState['Kelantan']; ?>,
            'Terengganu': <?php echo $malaysiaState['Terengganu']; ?>,
            'Pahang': <?php echo $malaysiaState['Pahang']; ?>,
            'Kuala Lumpur': <?php echo $malaysiaState['Kuala Lumpur']; ?>,
            'PutraJaya': <?php echo $malaysiaState['PutraJaya']; ?>, 
            'Selangor': <?php echo $malaysiaState['Selangor']; ?>, 
            'Negeri Sembilan': <?php echo $malaysiaState['Negeri Sembilan']; ?>, 
            'Melaka': <?php echo $malaysiaState['Melaka']; ?>, 
            'Johor': <?php echo $malaysiaState['Johor']; ?>, 
            'Sarawak': <?php echo $malaysiaState['Sarawak']; ?>, 
            'Sabah': <?php echo $malaysiaState['Sabah']; ?>, 
            'Labuan': <?php echo $malaysiaState['Labuan']; ?>, 
        };

        // Data for the pie chart
        var locationGroupData= {
            labels: ['Perlis', 'Kedah', 'Pulau Pinang', 'Perak', 'Kelantan', 'Terengganu', 'Pahang', 'Kuala Lumpur', 'PutraJaya', 'Selangor',
                    'Negeri Sembilan', 'Melaka', 'Johor', 'Sarawak', 'Sabah', 'Labuan'],
            datasets: [{
                data: [locationGroup["Perlis"],locationGroup["Kedah"],locationGroup["Pulau Pinang"],locationGroup["Perak"],
                        locationGroup["Kelantan"],locationGroup["Terengganu"],locationGroup["Pahang"], locationGroup["Kuala Lumpur"],
                        locationGroup["PutraJaya"],locationGroup["Selangor"],locationGroup["Negeri Sembilan"],locationGroup["Melaka"],
                        locationGroup["Johor"],locationGroup["Sarawak"],locationGroup["Sabah"],locationGroup["Labuan"]], // Values for each slice
                backgroundColor: ['blue', 'pink', 'red', 'green', 'orange', 'purple', 'cyan', 'magenta', 'yellow', 'lightblue'], // Colors for each slice
            }]
        };
        
        // Create a pie chart
        var overallAudienceLocation = new Chart(siteOverallAudienceLocation, {
            type: 'pie',
            data: locationGroupData
        });
    </script>
</body>
</html>
