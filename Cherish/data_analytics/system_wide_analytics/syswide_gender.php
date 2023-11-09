<!DOCTYPE html>
<html>
<head>
    <title>Gender Overall | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <?php
        $overallMale = 0;
        $overallFemale = 0;

        $dbc = mysqli_connect("localhost", "root", "");
        mysqli_select_db($dbc, "cherish_db");

        $query = "SELECT gender FROM user_account";

        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        while ($row = mysqli_fetch_assoc($result)) {            
            if($row['gender']=="Male"){
                $overallMale = $overallMale + 1;
            }
            else if($row['gender'] == "Female"){
                $overallFemale = $overallFemale + 1;
            }
        }
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-6">
                <div style="width: 100%; max-width: 400px; height: 400px;">
                    <canvas id="overallGender"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h4>System-wide Gender Analysis</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Gender</th>
                            <th scope="col">Number of People</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Male</th>
                            <td><?php echo"$overallMale<br/>";?></td>
                        </tr>
                        <tr>
                            <th scope="row">Female</th>
                            <td><?php echo$overallFemale;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Get the canvas element and create a context for drawing
        var siteGenderOverall = document.getElementById('overallGender').getContext('2d');

        var siteOverallGender = {
            male: <?php echo $overallMale; ?>,
            female: <?php echo $overallFemale; ?>
        };

        // Data for the pie chart
        var siteOverallGenderData = {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [siteOverallGender.male,siteOverallGender.female], // Values for each slice
                backgroundColor: ['blue', 'pink'], // Colors for each slice
            }]
        };

        // Create a pie chart
        var overallGender = new Chart(siteGenderOverall, {
            type: 'pie',
            data: siteOverallGenderData
        });
    </script>
</body>
</html>
