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
                <img src="../ngo_banner_images/crt64f7103ad583764f71066c0c49.jpg" class="d-block w-100" alt="..." height="500px" width="100%" style="filter: brightness(0.4);">
                <div class="carousel-caption d-block">
                    <h5 style="color: #ff5757; font-weight: bold">Cherish | Charity Facilitator</h5>
                    <p style="color: #ff5757; font-weight: bold">Some representative placeholder content for the first slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="../ngo_banner_images/crt64f7103ad583764fc2b2646a68.jpg" class="d-block w-100" alt="..." height="500px" width="100%" style="filter: brightness(0.4);">
                    <div class="carousel-caption d-block">
                        <h5 style="color: #ff5757; font-weight: bold">Cherish | United for A Cause</h5>
                        <p style="color: #ff5757; font-weight: bold">Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                <img src="../ngo_banner_images/crt64faf1c1eb74864faf1d17eadc.jpg" class="d-block w-100" alt="..." height="500px" width="100%" style="filter: brightness(0.4);">
                    <div class="carousel-caption d-block">
                        <h5 style="color: #ff5757; font-weight: bold">Cherish | Safe and Reliable</h5>
                        <p style="color: #ff5757; font-weight: bold">Some representative placeholder content for the third slide.</p>
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

        <br/>
        <br/>

        <!--Charity by Category Section-->
        <div class="container-fluid text-center" style="background-color: white; border: 1px solid #ff5757">
            <br/>
            <h3 class="text-center"><u><b>Charity by Category</b></u></h3>
            <div class="row">
                <div class="col d-flex justify-content-center card-col-view">
                    <a href="ngoListing.php?category=health">
                        <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center card-col-view" >
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center card-col-view" >
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center card-col-view">
                    <div class="card" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <br/>

        <!--Donation Campaign Highlight-->
        <div class="container-fluid" style="background-color: white; border: 1px solid #ff5757">
            <br/>
            <h3 class="text-center"><u><b>Donation Campaign Highlight</b></u></h3>
            <div class="row">
                <div class="col md-6 d-flex justify-content-center card-col-view" style="border: 0px solid black; padding: 0px;">
                    <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <a href="">
                            <img src="" height="200px" width="100%">
                            <div class="card-body">
                                <h5 class="card-text">
                                    Campaign Name: 
                                </h5>
                                <p class ="card-text">
                                    Campaign ID: <br/>
                                    Fund Progress: <br/>
                                    Closing Date: <br/>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <br/>

        <!--Volunteer Activity Highlight-->
        <div class="container-fluid" style="background-color: white; border: 1px solid #ff5757">
            <br/>
            <h3 class="text-center"><u><b>Volunteer Activity Highlight</b></u></h3>
            <div class="row">
                <div class="col md-6 d-flex justify-content-center card-col-view" style="border: 0px solid black; padding: 0px;">
                    <div class="card" style="width: 95%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <a href="">
                            <img src="#" height="200px" width="100%">
                            <div class="card-body">
                                <h5 class="card-text">
                                    Activity Name: 
                                </h5>
                                <p class ="card-text">
                                    Activity ID:  <br/>
                                    Activity Date:  <br/>
                                    Venue: <br/>
                                    Participant Progress: <br/>
                                    Closing Date: <br/>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br/>

    </body>
</html>


