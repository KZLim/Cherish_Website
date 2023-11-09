<html>

    <head>
        <title>Registration | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="ngo_css/register.css">
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
                        <span class="input-group-text" id="basic-addon1">Phone Number</span>
                        <input type="number" name="phoneNumber" id="phoneNumber" oninput="checkPhoneNumLength(this, 11)" class="form-control" placeholder="A direct phone number we can contact" aria-label="A direct phone number we can contact" aria-describedby="basic-addon1" required>
                    </div>
                    <p id="invalidPhonePrompt" style="color: red; display: none;">Phone Number Invalid</p>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Create a password" aria-label="Create a password" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Confirm Password</span>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password" aria-label="Confirm password" aria-describedby="basic-addon1" required>
                    </div>
                    <p id="matchingPrompt" style="color: red; display: none;">Password fields do not match!</p>

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
                //this function ensure that the phone number field does not accept more than 11 character (in numeric)
                function checkPhoneNumLength(input, maxLength) {
                    if (input.value.length > maxLength) {
                        input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 11.
                    }
                }

                //this section below make sure that unnecessary symbols are not entered into the phone number field.
                //this is check as some users tends to provide a dash along with their phone number.
                var phnField = document.getElementById("phoneNumber");
                phnField.addEventListener("input", function() {
                    var inputValue = phnField.value;
                    var filteredValue = inputValue.replace(/[^\d]/g, ''); // Allow only numeric digits
                    //regex is used on the above line. The regex filter out all the symobl.
                    phnField.value = filteredValue;
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

                const phnNumLength = document.getElementById('phoneNumber');
                const phnLengthInvalid = document.getElementById('invalidPhonePrompt');

                phnNumLength.addEventListener('input', validatePhnLength);

                function validatePhnLength() {
                    const length = phnNumLength.value.length;

                    if (length <= 9) {
                        invalidPhonePrompt.style.display = 'block';
                        registerButton.setAttribute('disabled', 'true');
                    } else {
                        invalidPhonePrompt.style.display = 'none';
                        registerButton.removeAttribute('disabled');
                    }
                }

            </script>
        </div>
    </body>
</html>