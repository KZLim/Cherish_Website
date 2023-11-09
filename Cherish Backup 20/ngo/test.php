<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header Menu</title>
    <style>
        /* Base Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: #fff;
            position: relative;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .header ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .header li {
            margin-right: 20px;
        }

        .header a {
            text-decoration: none;
            color: #fff;
        }

        /* Hamburger Menu Styles (Initially Hidden) */
        .hamburger-menu {
            display: none;
            flex-direction: column;
            cursor: pointer;
            z-index: 10;
        }

        .hamburger-menu div {
            width: 25px;
            height: 3px;
            background-color: #fff;
            margin: 3px 0;
        }

        /* Media Query for Mobile and Tablet Views */
        @media screen and (max-width: 768px) {
            .header ul {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: #333;
                z-index: 10;
            }

            .header ul.active {
                display: flex;
            }

            .hamburger-menu {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="#" class="logo">Logo</a>
        <div class="hamburger-menu" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.querySelector('.header ul');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>
