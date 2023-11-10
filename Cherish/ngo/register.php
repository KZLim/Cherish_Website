<html>

    <head>
        <title>Registration | Cherish</title>
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
            <div class="inner-container" style="background-color: white;">
                <h4>Register organization account:</h4>
                <br/>

                <form action="../cherish_api/ngo/apiC_ngo_account.php" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="emailPart" id="emailPart" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                        <span class="input-group-text">@</span>
                        <input type="text" name="domainPart" id="domainPart" class="form-control" placeholder="Domain.com" aria-label="Domain.com" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">IC Number</span>
                        <input type="number" name="icNumber" id="icNumber" oninput="checkICLength(this, 12)" class="form-control" placeholder="Enter your IC Number" aria-label="Enter your IC Number" aria-describedby="basic-addon1" required>
                    </div>
                    <span id="invalidICPrompt" style="color: red; display: none;">IC too short</span>
                    <span id="invalidAgePrompt" style="color: red; display: none;">Age requirement not fulfill</span>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Create a password" aria-label="Create a password" aria-describedby="basic-addon1" required>
                    </div>
                    <p id="passwordPatternPrompt" style="color: red; display: none;"></p>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Confirm Password</span>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password" aria-label="Confirm password" aria-describedby="basic-addon1" required>
                    </div>
                    <p id="matchingPrompt" style="color: red; display: none;">Fields do not match!</p>

                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary btn-reg-signin" id="registerBtn" type="submit" value="Register">
                    </div>
                </form>
            </div>

            <div class="inner-container" style="background-color: #ffa9a3">
                <h4 align="center">Sign Up and Get Spotted by Public</h4>
                <p align="center">Sign up an account so we can help you promote your organization. <br/> No matter how small or big, we care!</p>
                <p align="center">If you already have an account, sign in instead.</p>

                <img src="../images/hands-reaching-out-hope.png" width="80%" height="60%"><br/><br/>

                <div class="d-grid gap-2">
                    <a class="btn btn-primary btn-reg-signin" href="signin.php" role="button">Sign In</a>
                </div>
            </div>

            <!-- this script section belows contain all the necessary validation code in javascript. certain data are further validated in the back end as well-->
            <script>

                function checkICLength(input, maxLength) {
                    if (input.value.length > maxLength) {
                        input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 12.
                    }
                }

                //this section below make sure that unnecessary symbols are not entered into the postal code field.
                var icNumberField = document.getElementById("icNumber");
                icNumberField.addEventListener("input", function() {
                    var inputValue = icNumberField.value;
                    var filteredValue = inputValue.replace(/[^\d]/g, ''); // Allow only numeric digits
                    //regex is used on the above line. The regex filter out all the symobl.
                    icNumberField.value = filteredValue;
                });

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

                const passwordField = document.getElementById('password');
                const confirmField = document.getElementById('confirmPassword');
                const mismatchPrompt = document.getElementById('matchingPrompt');
                const registerButton = document.getElementById('registerBtn');

                passwordField.addEventListener('input', validateMatching);
                confirmField.addEventListener('input', validateMatching);

                function validateMatching() {
                    const password = passwordField.value;
                    const confirm = confirmField.value;

                    if (password === confirm) {
                        mismatchPrompt.style.display = 'none';
                        registerButton.removeAttribute('disabled');
                    } else {
                        mismatchPrompt.style.display = 'block';
                        registerButton.setAttribute('disabled', 'true');
                    }
                }

                const passwordInput = document.getElementById('password');
                const passwordPrompt = document.getElementById('passwordPatternPrompt');
                var passwordPatternRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{12,21}$/;

                passwordInput.addEventListener('input', validatePasswordPattern);

                function validatePasswordPattern() {
                    
                    if (passwordInput.value.length > 21) {
                        passwordInput.value = passwordInput.value.slice(0, 21);
                    }

                    if (!passwordPatternRegex.test(passwordInput.value)) {
                        passwordPrompt.textContent = "Password Must Contain Capital Letter and a Special Character, in 12-21 characters long.";
                        passwordPrompt.style.display = 'block';
                    } else {
                        passwordPrompt.textContent = "";
                        passwordPrompt.style.display = 'none';
                    }
                }

                const icData = document.getElementById('icNumber');
                const icLengthInvalid = document.getElementById('invalidICPrompt');
                const ageVerifyInvalid = document.getElementById('invalidAgePrompt');

                icData.addEventListener('input', validateValidity);

                function validateValidity() {
                    const length = icData.value.length;

                    const yearFromIC = icData.value.substring(0, 2);

                    const currentYear = new Date().getFullYear();
                    const maxAgeYear = currentYear.toString().slice(-2);

                    const year = parseInt(yearFromIC, 10);

                    let age = 0;

                    if (year <= maxAgeYear) {
                        age = currentYear - (2000 + year);
                    } else {
                        age = currentYear - (1900 + year);
                    }

                    if (length < 12) {
                        icLengthInvalid.style.display = 'block';
                        registerButton.setAttribute('disabled', 'true');
                    } else {
                        icLengthInvalid.style.display = 'none';
                        if(age < 15){
                            ageVerifyInvalid.style.display = 'block';
                            registerButton.setAttribute('disabled', 'true');
                        }
                        else{
                            ageVerifyInvalid.style.display = 'none';
                            registerButton.removeAttribute('disabled');
                        }
                    }
                }

            </script>

            <?php
                if(!empty($_GET['action'])){
                    $alertCondition = $_GET['action'];
                    if($alertCondition == "anp"){
                        echo"<script>
                                alertify.alert('Registration','Something went wrong. Please contact us.');
                            </script>";
                    }
                }
            ?>
        </div>
    </body>
</html>