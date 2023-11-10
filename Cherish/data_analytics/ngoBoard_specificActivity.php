<html>

    <head>
        <title>Specific Activity Analytics | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>

        <?php
            $activityID = $_GET['activityid'];
            include '../main/header.php';
            include '../data_analytics/ngo_specific_analytics/genderSpecific_activity.php';
            echo"<br/>";
            echo"<br/>";
            echo"<br/>";
            include '../data_analytics/ngo_specific_analytics/ageSpecific_activity.php';
            echo"<br/>";
            echo"<br/>";
            echo"<br/>";
            include '../data_analytics/ngo_specific_analytics/specificLocation_activity.php';
        ?>
    </body>
</html>


