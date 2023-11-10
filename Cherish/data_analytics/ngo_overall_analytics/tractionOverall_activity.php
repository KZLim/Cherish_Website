<!DOCTYPE html>
<html>
<head>
    <title>Activity Traction | Overall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <?php
        $overallExpected = 0;
        $overallRaised = 0;
        $performanceScore = 0;

        $dbc = mysqli_connect("localhost", "root", "");
        mysqli_select_db($dbc, "cherish_db");

        $query = "SELECT SUM(current_participant) AS totalParticipant, SUM(participation_limit) AS totalTarget FROM ngo_activity WHERE ouid = ?";

        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt,"s",$_SESSION['identifier']); 

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        while ($row = mysqli_fetch_assoc($result)) {   
            $overallExpected = $row['totalTarget'];
            $overallJoined = $row['totalParticipant'];
            $score = ($row['totalParticipant']/$row['totalTarget'])*100;
            $performanceScore = ceil($score);
        }
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-6">
                <div style="width: 100%; max-width: 400px; height: 400px;">
                    <canvas id="overallPerformance_activity" ></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h4>Your NGO's Overall Activity Performance</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Performance</th>
                            <th scope="col">In Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Overall Activity Performance Score</th>
                            <td><?php echo $performanceScore; ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var ngoOverallPerformance_activity = document.getElementById('overallPerformance_activity').getContext('2d');

        var ngoPerformance_activity = {
            'expectedPerformance': <?php echo $overallExpected; ?>,
            'actualRaised': <?php echo $overallJoined; ?>,
        };

        var overallPerformanceData_activity = {
            labels: ['Overall Activity Performance'],
            datasets: [
                {
                label: 'Total Raised',
                data: [ngoPerformance_activity.actualRaised], 
                backgroundColor: 'green', // Bar color
                },
                {
                label: 'Total Expected',
                data: [ngoPerformance_activity.expectedPerformance - ngoPerformance_activity.actualRaised],
                backgroundColor: 'pink',
                },
            ],
        };

        var overallPerformance_activity = new Chart(ngoOverallPerformance_activity, {
        type: 'bar',
        data: overallPerformanceData_activity,
        options: {
            scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true,
            },
            },
        },
        });
    </script>
</body>
</html>
