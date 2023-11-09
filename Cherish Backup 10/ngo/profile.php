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
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col" style="background-color: blue; padding: 0;">
                    <img src="../users_images/64ef59a0466d564ef59b44c436.jpg"  height="200px" width="100%">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6" style="z-index: 5; position: absolute; top: 140px; left: 50%; transform: translateX(-50%); display: flex; align-items: center;">
                    <img src="../users_images/64ef59a0466d564ef59b44c436.jpg" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                    <h1 style="margin-top: 30px;">No More Hunger Foundation</h1>
                </div>
            </div>
        </div>

        <div style="background-color: white; height: 110px;">
        </div> 

        <div>
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
                <h2>NGO Details</h2>
                <p>This section will display all the ngo details.</p>
                <?php
                            $dbc = mysqli_connect("localhost","root","");
                            mysqli_select_db($dbc,"cherish_db");

                            $query = mysqli_query($dbc,"SELECT * FROM ngo_profile WHERE `ouid`= 'crt64f075fc86ee3'");
                                        
                            while ($row = $query->fetch_assoc()){

                                $ouid = $row['ouid'];
                                $ngoEmail = $row['ngo_email'];
                                $registerNumber = $row['register_number'];
                                $addressLine = $row['address_line'];
                                $city = $row['city'];
                                $state = $row['state'];
                                $postalCode = $row['postal_code'];
                                $ngoBio = $row['ngo_bio'];
                                $ngoURL = $row['ngo_url'];
                                $ngoCategory = $row['ngo_category'];
                                $profilePicture = $row['profile_path'];       

                                echo"<br/>";
                                echo'<img src="../ngo_images/';
                                echo$profilePicture;
                                echo'"width="250" height="250">';
                                echo"<br/>";
                                echo"<br/>";
                                echo"OUID: $ouid";
                                echo"<br/>";
                                echo"Email: $ngoEmail";
                                echo"<br/>";
                                echo"Register Number: $registerNumber";
                                echo"<br/>";
                                echo"Address: $addressLine";
                                echo"<br/>";
                                echo"City: $city";
                                echo"<br/>";
                                echo"State: $state";
                                echo"<br/>";
                                echo"Postal Code: $postalCode";
                                echo"<br/>";
                                echo"Bio: $ngoBio";
                                echo"<br/>";
                                echo"Website's URL: $ngoURL";
                                echo"<br/>";
                                echo"Category: $ngoCategory";

                            }
                ?>  
            </div>

            <div class="tab-pane fade" id="donationCampaign">
                <h2>Donation Campaign</h2>
                <p>Active</p>
                <p>Past</p>
            </div>

            <div class="tab-pane fade" id="volunteerCampaign">
                <h2>Volunteer Campaign</h2>
                <p>Active</p>
                <p>Past</p>
            </div>
        </div>
    </body>
</html>


