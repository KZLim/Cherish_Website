<!DOCTYPE html>
<html>
<head>
    <title>Participant Gender | Overall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <?php
        $overallMale_basedActivity = 0;
        $overallFemale_basedActivity = 0;

        $dbc = mysqli_connect("localhost", "root", "");
        mysqli_select_db($dbc, "cherish_db");

        $query = "SELECT DISTINCT user_account.uid, user_account.gender FROM user_account 
                    INNER JOIN (
                        SELECT DISTINCT participant_uid
                        FROM participants_record
                        WHERE activity_id IN (
                            SELECT activity_id
                            FROM ngo_activity
                            WHERE ouid = ?
                        )
                    ) AS distinct_participant
                    ON user_account.uid = distinct_participant.participant_uid;";

        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt,"s",$_SESSION['identifier']); 

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        while ($row = mysqli_fetch_assoc($result)) {            
            if($row['gender']=="Male"){
                $overallMale_basedActivity = $overallMale_basedActivity + 1;
            }
            else if($row['gender'] == "Female"){
                $overallFemale_basedActivity = $overallFemale_basedActivity + 1;
            }
        }
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-6">
                <div style="width: 100%; max-width: 400px; height: 400px;">
                    <canvas id="overallGender_activity"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h4>Your NGO's Overall Activity Participant Based on Gender</h4>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Gender</th>
                            <th scope="col">Number of People</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Overall Male Audience</th>
                            <td><?php echo"$overallMale_basedActivity<br/>";?></td>
                        </tr>
                        <tr>
                            <th scope="row">Overall Female Audience</th>
                            <td><?php echo$overallFemale_basedActivity;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Get the canvas element and create a context for drawing
        var ngoOverallGender_activity = document.getElementById('overallGender_activity').getContext('2d');

        var gender_activity = {
            male: <?php echo $overallMale_basedActivity; ?>,
            female: <?php echo $overallFemale_basedActivity; ?>
        };

        // Data for the pie chart
        var genderData_activity = {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [gender_activity.male,gender_activity.female], // Values for each slice
                backgroundColor: ['blue', 'pink'], // Colors for each slice
            }]
        };

        // Create a pie chart
        var overallGender_activity = new Chart(ngoOverallGender_activity, {
            type: 'pie',
            data: genderData_activity
        });
    </script>
</body>
</html>
