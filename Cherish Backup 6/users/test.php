<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  /* Basic styles for the navigation menu */
  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    background-color: #333;
    padding: 10px;
    z-index: 1000; /* Ensure it's above other content */
  }

  .navbar-brand {
    color: white;
    font-size: 24px;
    text-decoration: none;
  }

  .navbar-list {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
  }

  .navbar-item {
    margin: 0 10px;
  }

  .navbar-link {
    color: white;
    text-decoration: none;
  }

  /* Additional styling for mobile view */
  @media (max-width: 768px) {
    .navbar {
      flex-direction: column;
      align-items: center;
    }

    .navbar-list {
      display: none; /* Hide the links initially */
      flex-direction: column;
      text-align: center;
      margin-top: 10px; /* Add some spacing below the header */
    }

    .navbar-item {
      margin: 5px 0;
    }

    .menu-icon {
      display: block;
      cursor: pointer;
    }

    .content {
      margin-top: 60px; /* Add space below the header for mobile view */
    }
  }
</style>
</head>
<body>
  <nav class="navbar">
    <a href="#" class="navbar-brand">Your Logo</a>
    <ul class="navbar-list" id="mobile-menu">
      <li class="navbar-item"><a href="#" class="navbar-link">Home</a></li>
      <li class="navbar-item"><a href="#" class="navbar-link">About</a></li>
      <li class="navbar-item"><a href="#" class="navbar-link">Services</a></li>
      <li class="navbar-item"><a href="#" class="navbar-link">Portfolio</a></li>
      <li class="navbar-item"><a href="#" class="navbar-link">Contact</a></li>
    </ul>
    <div class="menu-icon" id="menu-icon">&#9776;</div>
  </nav>

  <script>
    // Toggle mobile menu
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    let menuOpen = false;

    menuIcon.addEventListener('click', () => {
      if (!menuOpen) {
        mobileMenu.style.display = 'flex';
      } else {
        mobileMenu.style.display = 'none';
      }
      menuOpen = !menuOpen;
    });

    // Hide mobile menu on larger screens
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768) {
        mobileMenu.style.display = 'none';
        menuOpen = false;
      }
      else{
        
      }
    });
  </script>
</body>
</html>
