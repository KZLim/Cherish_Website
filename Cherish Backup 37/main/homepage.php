<html>

    <head>
        <title> Homepage | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>

        <?php
            include '../main/header.php';
        ?>

        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="../images/charity support-carousel-1.jpg" class="d-block w-100" alt="..." height="500px" width="100%" style="filter: brightness(0.4);">
                <div class="carousel-caption d-block">
                    <h5 style="color: #ff5757; font-weight: bold">Cherish | Charity Facilitator</h5>
                    <p style="color: #ff5757; font-weight: bold">Facilitating all charity needs.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="../images/charity support-carousel-2.jpg" class="d-block w-100" alt="..." height="500px" width="100%" style="filter: brightness(0.4);">
                    <div class="carousel-caption d-block">
                        <h5 style="color: #ff5757; font-weight: bold">Cherish | United for A Cause</h5>
                        <p style="color: #ff5757; font-weight: bold">United for a greater cause and serving a greater purpose.</p>
                    </div>
                </div>
                <div class="carousel-item">
                <img src="../images/charity support-carousel-3.jpg" class="d-block w-100" alt="..." height="500px" width="100%" style="filter: brightness(0.4);">
                    <div class="carousel-caption d-block">
                        <h5 style="color: #ff5757; font-weight: bold">Cherish | Safe and Reliable</h5>
                        <p style="color: #ff5757; font-weight: bold">Providing ease of mind for all users.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!--Charity by Category Section-->
        <div class="container-fluid text-center" >
            <br/>
            <h3 class="text-center"><u><b>Charity by Category</b></u></h3>
            <div class="row">
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=Animal Welfare">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/animal welfare.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Animal Welfare</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=Children Welfare">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/children welfare.jpg" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Children Welfare</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=Education Support">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/education support.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Education Support</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center card-col-view" >
                    <a href="ngoListing.php?category=Healthcare">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/healthcare.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Healthcare</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=Food Bank">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/food bank.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Food Bank</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=Seniors Welfare">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/seniors care.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Seniors Care</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center card-col-view" >
                    <a href="ngoListing.php?category=Mental Health">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/mental health.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Mental Health</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=Environment Care">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/environment care.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Enviroment Care</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=Differently Abled">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="../images/differently abled.png" class="card-img-top" alt="..." height="250px;">
                            <div class="card-body">
                                <h6>Differently Abled</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <br/>
        <br/>

        <!--Donation Campaign Highlight-->
        <?php
            $dbc = mysqli_connect("localhost", "root", "");
            mysqli_select_db($dbc, "cherish_db");

            $currentDate = date('Y-m-d');
            $query = "SELECT campaign_name, campaign_id, raise_goal, progress, closing_date, campaign_banner
                      FROM ngo_campaign WHERE closing_date > ? AND campaign_status <> 'unlisted' ORDER BY RAND() LIMIT 3";

            $stmt = mysqli_prepare($dbc, $query);
                                                        
            mysqli_stmt_bind_param($stmt,"s",$currentDate); 
            mysqli_stmt_execute($stmt);
                                            
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            echo'<h3 class="text-center"><u><b>Donation Campaign Highlight</b></u></h3>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo'<div class="container-fluid">
                        <br/>
                        <div class="row">
                            <div class="col md-6 d-flex justify-content-center card-col-view" style="border: 0px solid black; padding: 0px;">
                                <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <a href="donationCampaign.php?campaignid='.$row['campaign_id'].'">
                                        <img src="../campaign_banner/'.$row['campaign_banner'].'" height="200px" width="100%">
                                        <div class="card-body">
                                            <h5 class="card-text">
                                                Campaign Name: '.$row['campaign_name'].' 
                                            </h5>
                                            <p class ="card-text">
                                                Campaign ID: '.$row['campaign_id'].'<br/>
                                                Fund Progress: '.$row['progress'].'/'.$row['raise_goal'].'<br/>
                                                Closing Date: '.$row['closing_date'].' <br/>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        ?>

        <br/>
        <br/>

        <?php
            $currentDate = date('Y-m-d');
            $query2 = "SELECT activity_name, activity_id, activity_date, address_line, city, postal_code, `state`, 
                       participation_limit, current_participant, closing_date, activity_banner FROM ngo_activity WHERE closing_date > ?
                        AND activity_status<>'unlisted' ORDER BY RAND() LIMIT 3";

            $stmt2 = mysqli_prepare($dbc, $query2);
                                            
            mysqli_stmt_bind_param($stmt2,"s",$currentDate); 
            mysqli_stmt_execute($stmt2);
                                
            $result2= mysqli_stmt_get_result($stmt2);
            mysqli_stmt_close($stmt2);

            echo'<h3 class="text-center"><u><b>Volunteer Activity Highlight</b></u></h3>';
            while ($row = mysqli_fetch_assoc($result2)) {
                echo'<div class="container-fluid">
                        <br/>
                        <div class="row">
                            <div class="col md-6 d-flex justify-content-center card-col-view" style="border: 0px solid black; padding: 0px;">
                                <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <a href="volunteerActivity.php?activityid='.$row['activity_id'].'">
                                        <img src="../activity_banner/'.$row['activity_banner'].'" height="200px" width="100%">
                                        <div class="card-body">
                                            <h5 class="card-text">
                                                Activity Name: '.$row['activity_name'].' 
                                            </h5>
                                            <p class ="card-text">
                                                Activity ID: '.$row['activity_id'].' <br/>
                                                Activity Date: '.$row['activity_date'].' <br/>
                                                Venue: '.$row['address_line'].','.$row['postal_code'].','.$row['city'].','.$row['state'].'<br/>
                                                Participant Progress: '.$row['current_participant'].'/'.$row['participation_limit'].'<br/>
                                                Closing Date: '.$row['closing_date'].'<br/>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            include "footer.php";
        ?>
    </body>
</html>


