<html>

    <head>
        <title>Registration | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="ngo_css/profile.css">
    </head>

    <body>
        <?php
            include 'test.php';
            session_start();
            $dbc = mysqli_connect("localhost","root","");
            mysqli_select_db($dbc,"cherish_db");

            $query = mysqli_query($dbc,"SELECT * FROM ngo_profile WHERE `ouid`= '".$_SESSION["identifier"]."'");

            while ($row = $query->fetch_assoc()){

                $ouid = $row['ouid'];
                $ngoEmail = $row['ngo_email'];
                $ngoName = $row['ngo_name'];
                $registerNumber = $row['register_number'];
                $addressLine = $row['address_line'];
                $city = $row['city'];
                $state = $row['state'];
                $postalCode = $row['postal_code'];
                $ngoBio = $row['ngo_bio'];
                $ngoURL = $row['ngo_url'];
                $ngoCategory = $row['ngo_category'];
                $profilePicture = $row['profile_path'];     
                $bannerPicture = $row['banner_path'];  

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="background-color: blue; padding: 0;">';
                            echo'<img src="../ngo_banner_images/';
                            echo$bannerPicture;
                            echo'"height="200px" width="100%">';
                        echo'</div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6" style="z-index: 5; position: absolute; top: 190px; left: 50%; transform: translateX(-50%); display: flex; align-items: center;">';
                            echo'<img src="../ngo_images/';
                            echo$profilePicture;
                            echo'"style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">';
                            echo'<h1 style="margin-top: 60px; margin-left: 10px;">'.$ngoName.'';
                        echo'</div>
                    </div>
                </div>

                <div style="background-color: white; height: 110px;">
                </div>';

                echo'<div>
                    <ul class="nav nav-tabs justify-content-center" id="profileTabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#ngoDetails">NGO Details</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#donationCampaign">Donation Campaign</a>
                        </li>
                                        
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#volunteerCampaign">Volunteer Campaign</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" style="overflow: auto; height: 600px;" >
                    <div class="tab-pane fade show active" id="ngoDetails">
                        <h2 class="text-center">NGO Details Tab</h2>
                        <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                Basic Details
                            </span>
                        </div>
                        <br/>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Registered Name</th>
                                    <td>'.$ngoName.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>'.$ngoBio.'</td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Organization Registration Number</th>
                                    <td colspan="2">'.$registerNumber.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">Office Adrress</th>
                                    <td colspan="2">'.$addressLine.','.$postalCode.','.$city.','.$state.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">NGO Category</th>
                                    <td colspan="2">'.$ngoCategory.'</td>
                                </tr>
                                <tr>
                                    <th scope="row">OUID</th>
                                    <td>'.$ouid.'</td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                            <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                Contact Detail
                            </span>
                        </div>
                        <br/>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Email Address</th>
                                    <td>'.$ngoEmail.'</td>
                                </tr>
                                    <tr>
                                    <th scope="row">NGO\'s Website</th>
                                    <td>'.$ngoURL.'</td>
                                 </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="donationCampaign">
                        <h2 class="text-center">Donation Campaign</h2>
                        <div class="text-end" style="margin-right: 10px;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDonationCampaign">
                                Launch New Campaign
                            </button>
                        </div>
                        <div class="modal fade" id="addDonationCampaign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create a donation campaign</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="campaignForm" action="../cherish_api/ngo/apiC_ngo_campaign.php" method="POST" enctype="multipart/form-data">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Campaign Name</span>
                                                <input type="text" name="campaignName" class="form-control" placeholder="Enter campaign name" aria-label="Enter campaign name" aria-describedby="basic-addon1" required>
                                            </div>

                                            <div class="input-group mb-3" style="width: 100%;">
                                                <span class="input-group-text">Campaign Info</span>
                                                <textarea name="campaignInfo" class="form-control" aria-label="With textarea" required></textarea>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Raise Goal</span>
                                                <input type="number" name="raiseGoal" id="raiseGoal" oninput="checkPostCodeLength(this, 5)" class="form-control" placeholder="Enter raising goal (RM)" aria-label="Enter raising goal (RM)" aria-describedby="basic-addon1" required>
                                            </div>
                                            <p id="valueInvalid" style="color: red; display: none;"></p>

                                            <label class="form-label">Upload a campaign banner</label>
                                            <div class="input-group mb-3">
                                                <input type="file" name="campaignBannerUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                                            </div>

                                            <label for="date">Closing Date:</label>
                                            <input type="date" id="closingDate" name="closingDate" required><br/><br/>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-reg-signin" data-bs-dismiss="modal">Close</button>
                                        <input class="btn btn-secondary btn-reg-signin" id="createCampaign" type="submit" value="Create" form="campaignForm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>Active</p>


                        <p>Past</p>
                    </div>

                    <div class="tab-pane fade" id="volunteerCampaign">
                        <h2>Volunteer Campaign</h2>
                        <p>Active</p>
                        <p>Past</p>
                    </div>
                </div>';
            }
        ?>
    </body>

    <script>
        //prevent selecting past date
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('closingDate').setAttribute('min', today);
        
        //check raise goal value to prevent too low or too high
        const raiseValue = document.getElementById('raiseGoal');
        const invalidValuePrompt = document.getElementById('valueInvalid');
        const registerButton = document.getElementById('registerBtn');

                raiseValue.addEventListener('input', validateRaiseValue);

                function validateRaiseValue() {
                    const valueGiven = parseInt(raiseValue.value); 
                    if (valueGiven < 1000) {
                        invalidValuePrompt.textContent = "Value too low";
                        invalidValuePrompt.style.display = 'block';
                        registerButton.setAttribute('disabled','true');
                    } else if (valueGiven >100000){
                        invalidValuePrompt.textContent = "Value too high";
                        invalidValuePrompt.style.display = 'block';
                        registerButton.setAttribute('disabled','true');
                    }else{
                        invalidValuePrompt.style.display = 'none';
                        registerButton.removeAttribute('disabled');
                    }
                }
    </script>
</html>


