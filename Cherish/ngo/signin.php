<html>

    <head>
        <title>Sign In | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="ngo_css/register.css">
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <div class="register-container">
            <div class="inner-container" style="background-color: white; padding-top: 70px;">
                <h4>Sign in to your account:</h4>
                <br/>

                <form action="../cherish_api/ngo/api_signin.php" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="emailPart" id="emailPart" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                        <span class="input-group-text">@</span>
                        <input type="text" name="domainPart" id="domainPart" class="form-control" placeholder="Domain.com" aria-label="Domain.com" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" aria-label="Create a password" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary btn-reg-signin" id="signinBtn" type="submit" value="Sign in">
                    </div>
                </form>
            </div>

            <div class="inner-container" style="background-color: #ffa9a3">
                <h4 align="center">Together Make A Difference</h4>
                <p align="center">Sign up an account to give out an helping hand. <br/> No matter how small or big of a help, it makes a difference.</p>
                <p align="center">Don't Have An Account? Register one with us today.</p>

                <img src="../images/hands-reaching-out-hope.png" width="80%" height="60%"><br/><br/>

                <div class="d-grid gap-2">
                    <a class="btn btn-primary btn-reg-signin" href="register.php" role="button">Register</a>
                    <a class="btn btn-primary btn-reg-signin" href="passwordReset.php" role="button">Forgot Password</a>
                </div>
            </div>

            <!-- this script section belows contain all the necessary validation code in javascript. certain data are further validated in the back end as well-->
            <script>
                //this section below make sure that the emailPart field does not allow the '@' symbol, as the system later on has already provided.
                const emailRestrict = document.getElementById('emailPart');

                emailRestrict.addEventListener('input', function(event) {
                const inputValue = event.target.value;
                const emailCharRestrict = /[@]/g; // Only restrict the "@" symbol

                if (emailCharRestrict.test(inputValue)) {
                    event.target.value = inputValue.replace(emailCharRestrict, '');
                }
                });

                //this section below make sure that the domainPart field does not allow the '@' symbol, as the system later on has already provided.
                //this is checked twice because the field form the email's username field and the domain field are treated as two separate field.
                const domainRestrict = document.getElementById('domainPart');

                domainRestrict.addEventListener('input', function(event) {
                const inputValue = event.target.value;
                const domainCharRestrict = /[@]/g; // Only restrict the "@" symbol

                if (domainCharRestrict.test(inputValue)) {
                    event.target.value = inputValue.replace(domainCharRestrict, '');
                }
                });

            </script>

            <?php
                if(!empty($_GET['action'])){
                    $alertCondition = $_GET['action'];
                    if($alertCondition == "invcred"){
                        echo"<script>
                                alertify.alert('Sign In','Invalid Credential');
                            </script>";
                    }
                    else if($alertCondition == "anp"){
                        echo"<script>
                                alertify.alert('Sign In','Action Not Performed. Try Again.');
                            </script>";
                    }
                }
            ?>
        </div>
    </body>
</html>