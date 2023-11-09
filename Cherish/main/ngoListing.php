<html>

    <head>
        <title>NGO Directory | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>
        <?php
            include '../main/header.php';

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="padding: 0;">';
                            echo'<img src="../images/support.jpg" height="200px" width="100%" style="filter: brightness(0.4);">';
                            echo'<h5 class="banner-title-custom" style="color: #ff5757; font-weight: bold">Cherish | NGO Directory by Category</h5>';
                        echo'</div>
                    </div>
                </div>';

                echo'<form action="ngoListing.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%; margin-left: auto; margin-right: auto;">
                    <h6 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Search NGO:</h6>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                        <input type="text" name="providedName" id="providedName" class="form-control" placeholder="Enter NGO Name" aria-label="Enter UID" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary btn-reg-signin" id="searchNGO" type="submit" value="Search">
                    </div>
                </form>';   

                $dbc = mysqli_connect("localhost", "root", "");
                mysqli_select_db($dbc, "cherish_db");

                if(empty($_POST['providedName'])){
                    $targetCategory = $_GET['category'];
                    $query = mysqli_query($dbc, "SELECT COUNT(ouid) as totalCount FROM ngo_profile WHERE ngo_category='$targetCategory'");
                }
                else if(!empty($_POST['providedName'])){
                    $query = mysqli_query($dbc, "SELECT COUNT(ouid) as totalCount FROM ngo_profile WHERE ngo_name='$_POST[providedName]'");
                }
                                
                while ($row = $query->fetch_assoc()) {
                    $totalRecords = $row['totalCount'];
                }

                $recordsPerPage = 5;
                $totalPageNeeded = ceil($totalRecords / $recordsPerPage);

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $offsetValue = ($currentPage - 1) * $recordsPerPage;

                //top pagination menu
                //the column on the right and left are use as placeholder to make the pagination menu center
                echo'<div class="container text-center">
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col d-flex justify-content-center">';
                            echo'<ul class="pagination">';

                                //Previous page button
                                if ($currentPage > 1) {
                                    $previousPageNumber = $currentPage - 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page='.$previousPageNumber.'&category='.$targetCategory.'">Previous</a></li>';
                                }

                                //Page range for see (2 page before 2 page after)
                                for ($pageForSee = max(1, $currentPage - 2); $pageForSee <= min($totalPageNeeded, $currentPage + 2); $pageForSee++) {
                                    echo '<li class="page-item ';
                                    if ($i == $currentPage) {
                                        echo 'active';
                                    }
                                    echo '"><a class="page-link" href="?page='.$pageForSee.'&category='.$targetCategory.'">' . $pageForSee . '</a></li>';
                                }

                                //Next page button
                                if ($currentPage < $totalPageNeeded) {
                                    $nextPageNumber = $currentPage + 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page='.$nextPageNumber.'&category='.$targetCategory.'">Next</a></li>';
                                }

                            echo'</ul></nav>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>';
                
                if(empty($_POST['providedName'])){
                    $query2 = mysqli_query($dbc, "SELECT * FROM ngo_profile WHERE ngo_status = 'listed' AND ngo_category = '$targetCategory' LIMIT $offsetValue, $recordsPerPage");
                }
                else if(!empty($_POST['providedName'])){
                    $query2 = mysqli_query($dbc, "SELECT * FROM ngo_profile  WHERE ngo_name='$_POST[providedName]'");
                }

                while ($row = $query2->fetch_assoc()) {
                    $ouid = $row['ouid'];
                    $ngoName = $row['ngo_name'];
                    $ngoEmail = $row['ngo_email'];
                    $ngoAddress = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                    $ngoCategory =  $row['ngo_category'];
                    $ngoBanner =  $row['banner_path'];
            
                    echo'<div class="container-fluid">
                        <div class="row">
                            <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                <div class="card" style="width: 85%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                    echo'<a href="../ngo/profile.php?profileid='.$ouid.'">';
                                        echo'<img src="../ngo_banner_images/';
                                        echo$ngoBanner;
                                        echo'"height="200px" width="100%">';
                                        echo'<div class="card-body">
                                                <h4 class="card-text">
                                                    '.$ngoName.' 
                                                </h4>
                                                <p class ="card-text">
                                                    Email: '.$ngoEmail.' <br/>
                                                    Address: '.$ngoAddress.' <br/>
                                                    OUID: '.$ouid.'<br/>
                                                    Category: '.$ngoCategory.' <br/>
                                                </p>
                                            </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>';
                }

                //bottom pagination menu
                //the column on the right and left are use as placeholder to make the pagination menu center
                echo'<div class="container text-center">
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col d-flex justify-content-center">';
                            echo'<ul class="pagination">';

                                //Previous page button
                                if ($currentPage > 1) {
                                    $previousPageNumber = $currentPage - 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page='.$previousPageNumber.'&category='.$targetCategory.'">Previous</a></li>';
                                }
            
                                //Page range for see (2 page before 2 page after)
                                for ($pageForSee = max(1, $currentPage - 2); $pageForSee <= min($totalPageNeeded, $currentPage + 2); $pageForSee++) {
                                    echo '<li class="page-item ';
                                    if ($i == $currentPage) {
                                        echo 'active';
                                    }
                                    echo '"><a class="page-link" href="?page='.$pageForSee.'&category='.$targetCategory.'">' . $pageForSee . '</a></li>';
                                }
            
                                //Next page button
                                if ($currentPage < $totalPageNeeded) {
                                    $nextPageNumber = $currentPage + 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page='.$nextPageNumber.'&category='.$targetCategory.'">Next</a></li>';
                                }
    
                            echo'</ul></nav>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>';

                include "footer.php";

        ?>
    </body>
</html>


