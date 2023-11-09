<html>

    <head>
        <title>Admin Sign In | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="admin_css/signin.css">
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <div class="register-container">
            <div class="inner-container" style="width:40%; background-color: white; padding-top: 70px;">
                <h4>Sign in to admin portal:</h4>
                <br/>

                <form action="../cherish_api/admin/api_signin_admin.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Admin ID</span>
                        <input type="text" name="adminID" id="adminID" class="form-control" placeholder="Enter ID" aria-label="Enter ID" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" aria-label="Enter Password" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary btn-reg-signin" id="signinBtn" type="submit" value="Sign in">
                    </div>
                </form>
            </div>

            <div class="inner-container" style="background-color: #ffa9a3">
                <h4 class="text-center">Cherish | Serving a greater cause </h4>
                <p class="text-center">The support behind the helping hand <br/> Serving for a greater good and changing one step at a time</p>
                <p style="height: 10px;"></p>

                <img src="../images/community-support.png" width="100%" height="70%"><br/><br/>

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
                if(!empty($_GET['actionDone'])){
                    $alertCondition = $_GET['actionDone'];
                    if($alertCondition == "anp"){
                        echo"<script>
                                alertify.alert('Error Signing In','Something Went Wrong While Signing In');
                            </script>";
                    }
                    else if($alertCondition == "invcred"){
                        echo"<script>
                                alertify.alert('Error Signing In','Invalid Credential');
                            </script>";
                    }
                    else if($alertCondition == "upe"){
                        echo"<script>
                                alertify.alert('Error Signing In','Update Password Gone Wrong. Contact Internal Support.');
                            </script>";
                    }
                }
            ?>
        </div>
    </body>
</html>