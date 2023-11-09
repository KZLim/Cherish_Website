<html>
    <head>
        <title>NGO Header</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../main/main_css/header.css">
    </head>
    <body>
        <?php
        SESSION_START();
        echo'<div class="header">';
                if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="CAG"){
                
                    echo'<a data-bs-toggle="offcanvas" href="#adminCanvas" role="button" aria-controls="adminCanvas">
                        <img src="../images/hamburgerIcon2.png" style="height: 40px; width:40px;">
                    </a>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminCanvas" aria-labelledby="adminCanvas">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title">Admin panel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                Admin Function Access
                            </div>
                            <div class="mt-3">
                                <a class="admin-hamburger-menu" href="ngoManagement.php">NGO Management</a><br/>
                                <a class="admin-hamburger-menu" href="userManagement.php">User Management</a><br/>
                                <a class="admin-hamburger-menu" href="campaignManagement.php">Campaign Management</a><br/>
                                <a class="admin-hamburger-menu" href="activityManagement.php">Activity Management</a><br/>
                                <a class="admin-hamburger-menu" href="dataReveal.php">Data Reveal Management</a><br/>
                                <a class="admin-hamburger-menu" href="../data_analytics/databoard_admin.php">System Data Analytics</a><br/>
                            </div>
                        </div>
                    </div>

                    <div class="hamburger-menu" onclick="toggleMenu()">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>';
                }
                else{
                    echo'<a href="#" class="logo">Cherish</a>
                    <div class="hamburger-menu" onclick="toggleMenu()">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>';
                }

                echo'<ul>';
                    if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="crt"){
                        echo'<li><a href="../main/homepage.php">Home</a></li>
                        <li><a href="../main/donationListing.php">Donation</a></li>
                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                        <li><a href="../data_analytics/databoardMain_ngo.php">Data Analytics</a></li>
                        <li><a href="../main/aboutUs.php">About us</a></li>
                        <li><a href="../main/contactUs.php">Contact Us</a></li>';

                        echo'<li class="dropdown">
                                <a href="#" onclick="toggleSubMenu(this)">My Account</a>
                                <ul class="sub-menu">
                                    <li><a href="../ngo/profile.php">Profile</a></li>
                                    <li><a href="../ngo/accountSetting.php">Setting</a></li>
                                    <li><a href="../main/logout.php">Logout</a></li>
                                </ul>
                            </li>';

                    }
                    else if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="CAG"){
                        echo'<li><a href="../admin/adminDashboard.php">Dashboard</a></li>
                        <li><a href="../main/homepage.php">Home</a></li>
                        <li><a href="../main/donationListing.php">Donation</a></li>
                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>';

                        echo'<li class="dropdown">
                                <a href="#" onclick="toggleSubMenu(this)">My Account</a>
                                <ul class="sub-menu">
                                    <li><a href="../main/logout.php">Logout</a></li>
                                </ul>
                            </li>';
                    }
                    else if(!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))!="CAG" && (substr($_SESSION['identifier'],0,3))!="crt"){
                        echo'<li><a href="../main/homepage.php">Home</a></li>
                        <li><a href="../main/donationListing.php">Donation</a></li>
                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                        <li><a href="../main/aboutUs.php">About us</a></li>
                        <li><a href="../main/contactUs.php">Contact Us</a></li>';

                        echo'<li class="dropdown">
                                <a href="#" onclick="toggleSubMenu(this)">My Account</a>
                                <ul class="sub-menu">
                                    <li><a href="../users/profile.php">Profile</a></li>
                                    <li><a href="../users/accountSetting.php">Setting</a></li>
                                    <li><a href="../main/logout.php">Logout</a></li>
                                </ul>
                            </li>';
                    }
                    else if(empty($_SESSION['identifier'])){
                        //this is non login user to be able to click login
                        echo'<li><a href="../main/homepage.php">Home</a></li>
                        <li><a href="../main/donationListing.php">Donation</a></li>
                        <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                        <li><a href="../main/aboutUs.php">About us</a></li>
                        <li><a href="../main/contactUs.php">Contact Us</a></li>';

                        echo'<li class="dropdown">
                                <a href="#" onclick="toggleSubMenu(this)">Login</a>
                                <ul class="sub-menu">
                                    <li><a href="../users/signin.php">Users</a></li>
                                    <li><a href="../ngo/signin.php">NGOs</a></li>
                                </ul>
                            </li>';
                    }
                echo'</ul>
        </div>';
        ?>
    </body>
    <script>
            // Function to toggle the sub-menu for all screen sizes
            function toggleSubMenu(link) {
                var subMenu = link.nextElementSibling;
                subMenu.classList.toggle('active');
            }

            // Function to toggle the mobile menu
            function toggleMenu() {
                var menu = document.querySelector('.header ul');
                menu.classList.toggle('active');
            }
        </script>
</html>
