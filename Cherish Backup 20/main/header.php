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
        echo'<div class="header">
            <a href="#" class="logo">Logo</a>
            <div class="hamburger-menu" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <ul>
                <li><a href="../main/homepage.php">Home</a></li>
                <li><a href="../main/donationListing.php">Donation</a></li>
                <li><a href="../main/volunteerListing.php">Volunteer</a></li>
                <li><a href="../main/aboutUs.php">About us</a></li>
                <li><a href="../main/contactUs.php">Contact Us</a></li>';
                if (!empty($_SESSION['identifier']) && (substr($_SESSION['identifier'],0,3))=="crt"){
                    //this is for the NGO My Account section
                    echo'<li class="dropdown">
                            <a href="#" onclick="toggleSubMenu(this)">My Account</a>
                            <ul class="sub-menu">
                                <li><a href="../ngo/profile.php">Profile</a></li>
                                <li><a href="../ngo/accountSetting.php">Setting</a></li>
                                <li><a href="../main/logout.php">Logout</a></li>
                            </ul>
                        </li>';
                }
                else if(!empty($_SESSION['identifier'])){
                    //this is for the normal user My Account section
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
