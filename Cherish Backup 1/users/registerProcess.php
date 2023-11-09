<html>

    <head>
        <title>RegistrationProcess</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </head>

    <body>
        <h1>Hello World</h1>

        <?php

            $ICget = $_POST['icNumber'];
            $nameRetrieve = $_POST['username'];
            $emailPartRetrieve = $_POST['emailPart'];
            $domainPartRetrieve = $_POST['domainPart'];
            $phoneRetrieve = $_POST['phoneNumber'];
            $addressLineRetrieve = $_POST['addressLine'];
            $cityRetrieve = $_POST['city'];
            $stateRetrieve = $_POST['state'];
            $postCodeRetrieve = $_POST['postalCode'];
            $passwordRetrieve = $_POST['password'];
            $confirmPasswordRetrieve = $_POST['confirmPassword'];

            echo"$ICget";
            echo"<br/>";
            echo"$nameRetrieve";
            echo"<br/>";
            echo"$emailPartRetrieve";
            echo"<br/>";
            echo"$domainPartRetrieve";
            echo"<br/>";
            echo"$phoneRetrieve";
            echo"<br/>";
            echo"$addressLineRetrieve";
            echo"<br/>";
            echo"$cityRetrieve";
            echo"<br/>";
            echo"$stateRetrieve";
            echo"<br/>";
            echo"$postCodeRetrieve";
            echo"<br/>";
            echo"$passwordRetrieve";
            echo"<br/>";
            echo"$confirmPasswordRetrieve";














        ?>
    </body>
</html>