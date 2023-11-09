<html>

    <head>
        <title>Reset Password | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="user_css/register.css">
    </head>

    <body>
        <div class="register-container" style="justify-content: center; width: 500px; height: 700px;">
                <h4 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Reset Password:</h4>

                <form action="../cherish_api/users/api_reset_password.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%;">
                    <div class="input-group mb-3">
                        <input type="text" name="emailPart" id="emailPart" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                        <span class="input-group-text">@</span>
                        <input type="text" name="domainPart" id="domainPart" class="form-control" placeholder="Domain.com" aria-label="Domain.com" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">IC Number</span>
                        <input type="number" name="icNumber" id="icNumber" oninput="checkICLength(this, 12)" class="form-control" placeholder="Enter your IC Number" aria-label="Enter your IC Number" aria-describedby="basic-addon1" required>
                    </div>
                    <p id="invalidICPrompt" style="color: red; display: none;">IC too short</p>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">New Password</span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Create a new password" aria-label="Create a password" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Confirm Password</span>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password" aria-label="Confirm password" aria-describedby="basic-addon1" required>
                    </div>
                    <p id="matchingPrompt" style="color: red; display: none;">Fields do not match!</p>

                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary" id="resetPasswordBtn" type="submit" value="Reset">
                    </div>
                </form>


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
                //this function ensure that the ic number field does not accept more than 12 character (in numeric)
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
            </script>
           
        </div>
    </body>
</html>