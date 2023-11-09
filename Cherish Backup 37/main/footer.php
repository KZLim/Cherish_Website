<html>
    <head>
        <title>Footer</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../main/main_css/footer.css">
        <link rel="stylesheet" href="../main/main_css/main.css">
        <link rel="stylesheet" href="main_css/profile.css">
    </head>
    <body>
        <?php
            echo'<div class="footer">
                <div class="container text-center">
                    <div class="row">
                        <div class="col">';
                            if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="crt"){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                        <li><u><h5>Navigation Links</h5></u></li>
                                        <li><a href="../main/homepage.php">Home</a></li>
                                        <li><a href="../main/donationListing.php">Donation</a></li>
                                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                                        <li><a href="../data_analytics/databoardMain_ngo.php">Data Analytics</a></li>
                                    </ul>';
                            }
                            else if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="CAG"){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                    <li><u><h5>Navigation Links</h5></u></li>
                                    <li><a href="../admin/adminDashboard.php">Home</a></li>
                                        <li><a href="../main/donationListing.php">Donation</a></li>
                                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                                    </ul>';            
                            }
                            else if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))!="CAG" && (substr($_SESSION['identifier'],0,3))!="crt"){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                        <li><u><h5>Navigation Links</h5></u></li>
                                        <li><a href="../main/homepage.php">Home</a></li>
                                        <li><a href="../main/donationListing.php">Donation</a></li>
                                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                                    </ul>';
                            }
                            else if(empty($_SESSION['identifier'])){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                        <li><u><h5>Navigation Links</h5></u></li>
                                        <li><a href="../main/homepage.php">Home</a></li>
                                        <li><a href="../main/donationListing.php">Donation</a></li>
                                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                                    </ul>';
                            }
                        echo'</div>
                        <div class="col">
                            <ul style="list-style-type: none; text-align: left;">
                                <li><u><h5>More About Us</h5></u></li>
                                <li><a href="../main/aboutUs.php">About us</a></li>
                                <li><a href="../main/contactUs.php">Contact Us</a></li>
                                <li><a href="../main/faq.php">FAQ</a></li>
                            </ul>';
                        echo'</div>
                        <div class="col">';
                            if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="crt"){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                    <li><u><h5>Account Action</h5></u></li>
                                    <li><a href="../ngo/profile.php">Profile</a></li>
                                        <li><a href="../ngo/accountSetting.php">Setting</a></li>
                                        <li><a href="../main/logout.php">Logout</a></li>
                                    </ul>';
                            }
                            else if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))!="CAG" && (substr($_SESSION['identifier'],0,3))!="crt"){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                        <li><u><h5>Account Action</h5></u></li>
                                        <li><a href="../users/profile.php">Profile</a></li>
                                        <li><a href="../users/accountSetting.php">Setting</a></li>
                                        <li><a href="../main/logout.php">Logout</a></li>
                                    </ul>';

                            }
                            else if (!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="CAG"){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                        <li><u><h5>Account Action</h5></u></li>
                                        <li><a href="../admin/adminDashboard.php">Dashboard</a></li>
                                        <li><a href="../main/logout.php">Logout</a></li>
                                    </ul>';
                            }
                            else if (empty($_SESSION['identifier'])){
                                echo'<ul style="list-style-type: none; text-align: left;">
                                        <li><u><h5>Account Action</h5></u></li>
                                        <li><a href="../users/signin.php">Sign In as User</a></li>
                                        <li><a href="../ngo/signin.php">Sign In as NGO</a></li>
                                    </ul>';
                            }
                        echo'</div>
                    </div>
                </div>
                <p class="text-center">&copy2023 Cherish - All rights reserved</p>
            </div>';
        ?>
    </body>
</html>