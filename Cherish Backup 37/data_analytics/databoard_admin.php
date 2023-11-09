<html>

    <head>
        <title>Databoard | Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>
        <?php
            include '../main/header.php';
            include 'system_wide_analytics/syswide_gender.php';
            echo"<br/>";
            echo"<br/>";
            echo"<br/>";
            echo"<br/>";
            include 'system_wide_analytics/syswide_age.php';
            echo"<br/>"; 
            echo"<br/>";
            echo"<br/>";
            echo"<br/>";
            include 'system_wide_analytics/syswide_location.php';
        ?>
    </body>
</html>


