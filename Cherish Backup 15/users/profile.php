<html>

    <head>
        <title>Registration | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="user_css/profile.css">
    </head>

    <body>
        <div class="profile-content-container">
            <div class="container inner-container">
                <div class="row">
                    <div class="col-4 text-center col-height" style="border-right: 1px solid #ffa9a3; width:390px; word-wrap: break-word;">
                        <?php
                            session_start();
                            $dbc = mysqli_connect("localhost","root","");
                            mysqli_select_db($dbc,"cherish_db");

                            $query = mysqli_query($dbc,"SELECT * FROM user_profile WHERE `uid`= '".$_SESSION["identifier"]."'");
                                        
                            while ($row = $query->fetch_assoc()){

                                $uid = $row['uid'];
                                $name = $row['name'];
                                $bio = $row['bio'];
                                $profilePicture = $row['profile_path'];       

                                echo"<br/>";
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

                                echo"<div style='height: 80px;'></div>";      

                                echo"<h4>Quick Links</h4>";
                                echo"<a href='https://google.com'>Google</a>";
                                echo"<br/>";
                                echo"<a href='https://google.com'>Google</a>";
                                echo"<br/>";
                                echo"<a href='https://google.com'>Google</a>";
                                echo"<br/>";
                                echo"<a href='https://google.com'>Google</a>";

                                echo"<div style='height: 60px;'></div>";      
                            }
                        ?>
                    </div>
                    
                    <div class="col-8" style="width:810px;">
                        <ul class="nav nav-tabs tab-nav-profile" id="profileTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#myDonationRecord">My Donation</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#currentParticipation">Current Volunteer</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#pastParticipation">Past Volunteer</a>
                            </li>
                        </ul>

                        <div class="tab-content"  style="overflow: auto; height: 600px;" >
                            <div class="tab-pane fade show active" id="myDonationRecord">
                                <h2>My Donation Record</h2>
                                <p>This section will display all the user's donation record.</p>
                            </div>

                            <div class="tab-pane fade" id="currentParticipation">
                                <h2>Current Participation</h2>
                                <p>This section will display the user's current participation.</p>
                            </div>

                            <div class="tab-pane fade" id="pastParticipation">
                                <h2>Past Participation</h2>
                                <p>This section will display the user's past participation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>