<html>

    <head>
        <title>Password Setup | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="admin_css/register.css">
    </head>

    <body>
        <div class="register-container" style="justify-content: center; width: 500px; height: 700px;">

            <h4 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Welcome aboard Cherish</h4>
            <form action="../cherish_api/admin/apiU_admin_password.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%;">
                <h6 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Please update your password</h6>
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
                    <input class="btn btn-primary btn-reg-signin" id="setup" type="submit" value="Done">
                </div>
            </form>           
        </div>
    </body>

    <script>
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

        const icLength = document.getElementById('icNumber');
        const icLengthInvalid = document.getElementById('invalidICPrompt');

        icLength.addEventListener('input', validateicLength);

        function validateicLength() {
            const length = icLength.value.length;

            if (length < 12) {
                icLengthInvalid.style.display = 'block';
                registerButton.setAttribute('disabled', 'true');
            } else {
                icLengthInvalid.style.display = 'none';
                registerButton.removeAttribute('disabled');
            }
        }
    </script>
</html>