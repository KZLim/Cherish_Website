<html>

    <head>
        <title>Account Setting | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="user_css/accountSetting.css">
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
            <?php 
                include '../main/header.php';
            ?>
            
            <div class="container container-custom">
                <div class="row">
                    <div class="col-4 text-center" style="border-right: 1px solid #ffa9a3; width:390px; word-wrap: break-word;">
                        <?php                            
                            $dbc = mysqli_connect("localhost","root","");
                            mysqli_select_db($dbc,"cherish_db");

                            $query = "SELECT * FROM user_profile WHERE `uid`= ?";

                            $stmt = mysqli_prepare($dbc, $query);
                                                        
                            mysqli_stmt_bind_param($stmt,"s",$_SESSION['identifier']); 
                            mysqli_stmt_execute($stmt);
                                            
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                
                            while ($row = mysqli_fetch_assoc($result)) {
                                        
                                $uid = $row['uid'];
                                $name = $row['name'];
                                $bio = $row['bio'];
                                $profilePicture = $row['profile_path'];       
                                
                                echo"<h4>Account Settings</h4>";
                                echo'<img src="../users_images/';
                                echo$profilePicture;
                                echo'"width="250" height="250">';
                                echo"<br/>";
                                echo"<br/>";
                                echo"UID: $uid";
                                echo"<br/>";
                                echo"Username: $name";
                                echo"<br/>";
                                echo"Bio: $bio";

                                echo"<div style='height: 15px;'></div>"; 
                            }
                        ?>
                        <p style="text-align: left;">Settings Option:<hr></p>
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="profile-preferences-tab" data-bs-toggle="pill" data-bs-target="#profile-preferences-pill" type="button" role="tab">Profile Preferences</button>
                            <button class="nav-link" id="change-password-tab" data-bs-toggle="pill" data-bs-target="#change-password-pill" type="button" role="tab">Change Password</button>
                            <button class="nav-link" id="change-email-tab" data-bs-toggle="pill" data-bs-target="#change-email-pill" type="button" role="tab">Change Email</button>
                            <button class="nav-link" id="change-phone-tab" data-bs-toggle="pill" data-bs-target="#change-phone-pill" type="button" role="tab">Change Phone</button>
                            <button class="nav-link" id="change-reside-address-tab" data-bs-toggle="pill" data-bs-target="#change-address-pill" type="button" role="tab">Change Reside Address</button>
                        </div>
                               
                        <div style='height: 60px;'></div>    
                    </div>

                    <div class="col" style="width:810px;">
                        <div class="d-flex align-items-start tab-nav-profile justify-content-center">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="profile-preferences-pill" role="tabpanel">
                                    <h1>Change Profile Picture</h1><br/>
                                    <form action="../cherish_api/users/apiU_profile_pic.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%;">
                                        <label class="form-label">Recommended Photo 250px*250px.[.jpeg/.jpg/.png/.tiff] accepted</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="profilePicUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-primary btn-reg-signin" id="uploadProPic" type="submit" value="Upload">
                                        </div>
                                    </form>

                                    <br/>
                                    <br/>
                                    <br/>

                                    <h1>Change Profile Bio</h1><br/>
                                    <form action="../cherish_api/users/apiU_user_bio.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%;">
                                        <label class="form-label">Write a bio for your profile</label>
                                        <div class="input-group mb-3" style="width: 100%;">
                                            <span class="input-group-text">Write your bio</span>
                                            <textarea name="bio" class="form-control" aria-label="With textarea"></textarea>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                             <input class="btn btn-primary btn-reg-signin" id="updateBio" type="submit" value="Update">
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="change-password-pill" role="tabpanel" aria-labelledby="change-password-tab" tabindex="0">
                                    <h1>Change Password Setting</h1><br/>
                                    <form action="../cherish_api/users/api_change_password.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%;">
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
                                            <input class="btn btn-primary btn-reg-signin" id="resetPasswordBtn" type="submit" value="Update">
                                        </div>
                                    </form>

                                    <script>                            
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
                                </div>

                                <div class="tab-pane fade" id="change-email-pill" role="tabpanel">
                                    <h1>Change Email Address</h1><br/>
                                    <form action="../cherish_api/users/apiU_email_address.php" method="POST">

                                        <div class="input-group mb-3">
                                            <input type="text" name="emailPart" id="emailPart" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                                            <span class="input-group-text">@</span>
                                            <input type="text" name="domainPart" id="domainPart" class="form-control" placeholder="Domain.com" aria-label="Domain.com" required>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Password</span>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" aria-label="Enter password" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-primary btn-reg-signin" id="updateEmail" type="submit" value="Update">
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
                                    </script>
                                </div>

                                <div class="tab-pane fade" id="change-phone-pill" role="tabpanel">
                                    <h1>Change Phone Number</h1><br/>
                                    <form action="../cherish_api/users/apiU_phn_number.php" method="POST">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Phone Number</span>
                                            <input type="number" name="phoneNumber" id="phoneNumber" oninput="checkPhoneNumLength(this, 11)" class="form-control" placeholder="Enter your phone number" aria-label="Enter your phone number" aria-describedby="basic-addon1" required>
                                        </div>
                                        <p id="invalidPhonePrompt" style="color: red; display: none;">Phone Number Invalid</p>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Password</span>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" aria-label="Enter password" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-primary btn-reg-signin" id="updatePhone" type="submit" value="Update">
                                        </div>
                                    </form>

                                    <script>
                                       //this function ensure that the phone number field does not accept more than 11 character (in numeric)
                                       const updatePhoneBtn = document.getElementById('updatePhone'); 
                                        function checkPhoneNumLength(input, maxLength) {
                                            if (input.value.length >= 10) {
                                                input.value = input.value.slice(0, maxLength);
                                                updatePhoneBtn.removeAttribute('disabled');
                                            }
                                            else if(input.value.length < maxLength){
                                                updatePhoneBtn.setAttribute('disabled','true');
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

                                <div class="tab-pane fade" id="change-address-pill" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                                    <h1>Change Reside Address</h1><br/>
                                    <form action="../cherish_api/users/apiU_reside_address.php" method="POST">
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
                                        
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Password</span>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" aria-label="Enter password" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-primary btn-reg-signin" id="updateAddress" type="submit" value="Update">
                                        </div>
                                    </form>

                                    <script>
                                        //this function ensure that the psotal code field does not accept more than 5 character (in numeric)
                                        function checkPostCodeLength(input, maxLength) {
                                            if (input.value.length > maxLength) {
                                                    input.value = input.value.slice(0, maxLength); //remove the excess character enter by the user, thus limiting to 5.
                                                }
                                            }

                                            //this section below make sure that unnecessary symbols are not entered into the postal code field.
                                            var postCodeField = document.getElementById("postalCode");
                                            postCodeField.addEventListener("input", function() {
                                                var inputValue = postCodeField.value;
                                                var filteredValue = inputValue.replace(/[^\d]/g, ''); // Allow only numeric digits
                                                //regex is used on the above line. The regex filter out all the symobl.
                                                postCodeField.value = filteredValue;
                                            });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            if(!empty($_GET['actionCondition'])){
                $alertCondition = $_GET['actionCondition'];
                if($alertCondition == "emailModifiedTrue"){
                    echo"<script>
                            alertify.alert('Account Action','Email Changed Successfully!');
                        </script>";
                }
                else if($alertCondition == "passwordModifiedTrue"){
                    echo"<script>
                            alertify.alert('Account Action','Password Changed Successfully!');
                        </script>";
                }
                else if($alertCondition == "phoneModifiedTrue"){
                    echo"<script>
                            alertify.alert('Account Action','Phone Number Changed Successfully!');
                        </script>";
                }
                else if($alertCondition == "addressModifiedTrue"){
                    echo"<script>
                            alertify.alert('Account Action','Reside Address Changed Successfully!');
                        </script>";
                }
                else if($alertCondition == "pictureModifiedTrue"){
                    echo"<script>
                            alertify.alert('Account Action','Profile Picture Changed Successfully!');
                        </script>";
                }
                else if($alertCondition == "bioModifiedTrue"){
                    echo"<script>
                            alertify.alert('Account Action','Profile Bio Changed Successfully!');
                        </script>";
                }
                else if($alertCondition == "invcred"){
                    echo"<script>
                            alertify.alert('Account Action','Invalid Verification Provided');
                        </script>";
                }
                else if($alertCondition == "anp"){
                    echo"<script>
                            alertify.alert('Account Action','Action Not Performed. Try Again.');
                        </script>";
                }
            }

            include '../main/footer.php'
        ?>
    </body>
</html>