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
        <div class="register-container" style="justify-content: center; width: 500px; height: 1000px;">
                <h4 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Setup your profile:</h4>

                <form action="../cherish_api/ngo/apiC_ngo_profile.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Organization Name</span>
                        <input type="text" name="ngoName" id="username" oninput="checkNameLength(this, 150)" class="form-control" placeholder="Enter organization name" aria-label="Enter organization name" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Registration Number</span>
                        <input type="text" name="regNumber" class="form-control" placeholder="Enter organization registration number" aria-label="Enter organization registration number" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Contact Number</span>
                        <input type="number" name="contactNumber" id="contactNumber" oninput="checkPhoneNumLength(this, 11)" class="form-control" placeholder="A direct phone number we can contact" aria-label="A direct phone number we can contact" aria-describedby="basic-addon1" required>
                    </div>
                    <p id="invalidPhonePrompt" style="color: red; display: none;">Phone Number Invalid</p>

                    <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Address Line</span>
                            <input type="text" name="addressLine" class="form-control" placeholder="Enter your address" aria-label="Enter your address" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">City</span>
                        <input type="text" name="city" class="form-control" placeholder="Enter your city" aria-label="Enter your city" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">State</label>
                        <select name="state" class="form-select" id="inputGroupSelect01" required>
                            <option selected>Select your resides state...</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Perak">Perak</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Putra Jaya">Putra Jaya</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Johor">Johor</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Labuan">Labuan</option>
                        </select>
                    </div>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Postal Code</span>
                        <input type="number" name="postalCode" id="postalCode" oninput="checkPostCodeLength(this, 5)" class="form-control" placeholder="Enter your Postal Code" aria-label="Enter your Postal Code" aria-describedby="basic-addon1" required>
                    </div>

                    <label class="form-label">Select a profile picture</label>
                    <div class="input-group mb-3">
                        <input type="file" name="ngoPicUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>

                    <label class="form-label">Select a banner picture</label>
                    <div class="input-group mb-3">
                        <input type="file" name="bannerUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>

                    <label class="form-label">Write a bio for your profile</label>
                    <div class="input-group mb-3" style="width: 100%;">
                        <span class="input-group-text">Write your bio</span>
                        <textarea name="bio" class="form-control" aria-label="With textarea"></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Website URL</span>
                        <input type="text" name="url" class="form-control" placeholder="Enter your website URL" aria-label="Enter your website URL" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Category</label>
                        <select name="category" class="form-select" id="inputGroupSelect01" required>
                            <option selected>Select your charity category...</option>
                            <option value="Animal Welfare">Animal Welfare</option>
                            <option value="Children Welfare">Children Welfare</option>
                            <option value="Education Support">Education Support</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Mental Health">Mental Health</option>
                            <option value="Food Bank">Food Bank</option>
                            <option value="Seniors Welfare">Seniors Welfare</option>
                            <option value="Enviroment Care">Enviroment Care</option>
                            <option value="Differently Abled">Differently Abled</option>
                        </select>
                    </div>
                    
                    <!--these data are pass from the first step of the registration process. Both thes data are need to setup the profile, this using
                    the post method of this form, pass on to the profile creation api, so that it can work on its process.-->
                    <input type="hidden" name="ouidparam" value="<?php echo urldecode($_GET['ouid']); ?>">
                    <input type="hidden" name="emailparam" value="<?php echo urldecode($_GET['email']); ?>">

                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary btn-reg-signin" id="setup" type="submit" value="Done">
                    </div>
                </form>

            <script>
                function checkPhoneNumLength(input, maxLength) {
                    if (input.value.length > maxLength) {
                        input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 11.
                    }
                }

                //this section below make sure that unnecessary symbols are not entered into the phone number field.
                //this is check as some users tends to provide a dash along with their phone number.
                var contactField = document.getElementById("contactNumber");
                contactField.addEventListener("input", function() {
                    var inputValue = contactField.value;
                    var filteredValue = inputValue.replace(/[^\d]/g, ''); // Allow only numeric digits
                    //regex is used on the above line. The regex filter out all the symobl.
                    contactField.value = filteredValue;
                });

                const phnNumLength = document.getElementById('contactNumber');
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

                //this function ensure that the name field does not accept more than 50 characters.
                function checkNameLength(input, maxLength) {
                    if (input.value.length > maxLength) {
                        input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 12.
                    }
                }

                function checkPostCodeLength(input, maxLength) {
                    if (input.value.length > maxLength) {
                        input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 5.
                    }
                }
            </script>
        </div>
    </body>
</html>