<html>

    <head>
        <title>Volunteer List | Cherish</title>
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
                            echo'<img src="../images/volunteer_banner.jpg" height="200px" width="100%" style="filter: brightness(0.4);">';
                            echo'<h5 class="banner-title-custom" style="color: #ff5757; font-weight: bold">NGOs | Volunteer Activity</h5>';
                        echo'</div>
                    </div>
                </div>';

                echo'<form action="volunteerListing.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%; margin-left: auto; margin-right: auto;">
                        <h6 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Search Activity:</h6>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                            <input type="text" name="providedName" id="providedName" class="form-control" placeholder="Enter Activity Name" aria-label="Enter UID" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <input class="btn btn-primary btn-reg-signin" id="searchNGO" type="submit" value="Search">
                        </div>
                </form>';   

                $dbc = mysqli_connect("localhost", "root", "");
                mysqli_select_db($dbc, "cherish_db");
                
                if(empty($_POST['providedName'])){
                    $currentDate = date('Y-m-d');
                    $query = mysqli_query($dbc, "SELECT COUNT(activity_id) as totalCount FROM ngo_activity WHERE closing_date > '".$currentDate."'");
                }
                else if(!empty($_POST['providedName'])){
                    $query = mysqli_query($dbc, "SELECT COUNT(activity_id) as totalCount FROM ngo_activity WHERE activity_name='$_POST[providedName]'");
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
                            echo'<nav aria-label="Page navigation example"><ul class="pagination">';

                                //Previous page button
                                if ($currentPage > 1) {
                                    $previousPageNumber = $currentPage - 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $previousPageNumber . '">Previous</a></li>';
                                }

                                //Page range for see (2 page before 2 page after)
                                for ($pageForSee = max(1, $currentPage - 2); $pageForSee <= min($totalPageNeeded, $currentPage + 2); $pageForSee++) {
                                    echo '<li class="page-item ';
                                    if ($i == $currentPage) {
                                        echo 'active';
                                    }
                                    echo '"><a class="page-link" href="?page=' . $pageForSee . '">' . $pageForSee . '</a></li>';
                                }

                                //Next page button
                                if ($currentPage < $totalPageNeeded) {
                                    $nextPageNumber = $currentPage + 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $nextPageNumber . '">Next</a></li>';
                                }

                            echo'</ul></nav>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>';

                if(empty($_POST['providedName'])){
                    $currentDate = date('Y-m-d');
                    $query2 = mysqli_query($dbc, "SELECT * FROM ngo_activity WHERE closing_date > '".$currentDate."' AND activity_status <> 'unlisted' LIMIT $offsetValue, $recordsPerPage");                
                }
                else if(!empty($_POST['providedName'])){
                    $currentDate = date('Y-m-d');
                    $query2 = mysqli_query($dbc, "SELECT * FROM ngo_activity WHERE closing_date > '".$currentDate."' AND activity_status <> 'unlisted' AND activity_name='$_POST[providedName]' LIMIT $offsetValue, $recordsPerPage");                
                }

                while ($row = $query2->fetch_assoc()) {

                    $activityName = $row['activity_name'];
                    $activityID = $row['activity_id'];
                    $activityLocation = $row['address_line'].",".$row['postal_code'].",".$row['city'].",".$row['state'];
                    $activityDate =  $row['activity_date'];
                    $activityTime =  $row['activity_time'];
                    $closingDate = $row['closing_date'];
                    $participationLimit = $row['participation_limit'];
                    $currentParticipant = $row['current_participant'];
                    $activityBanner = $row['activity_banner'];

                    echo'<div class="container-fluid">
                        <div class="row">
                            <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                <div class="card" style="width: 85%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                    echo'<a href="../main/volunteerActivity.php?activityid='.$activityID.'">';
                                        echo'<img src="../activity_banner/';
                                        echo$activityBanner;
                                        echo'"height="200px" width="100%">';
                                        echo'<div class="card-body">
                                                <h5 class="card-text">
                                                    Activity Name: '.$activityName.' 
                                                </h5>
                                                <p class ="card-text">
                                                    Activity ID: '.$activityID.' <br/>
                                                    Activity Date: '.$activityDate.' <br/>
                                                    Venue: '.$activityLocation.' <br/>
                                                    Participant Progress: '.$currentParticipant.'/'.$participationLimit.'<br/>
                                                    Closing Date: '.$closingDate.'<br/>
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
                            echo'<nav aria-label="Page navigation example"><ul class="pagination">';

                                //Previous page button
                                if ($currentPage > 1) {
                                    $previousPageNumber = $currentPage - 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $previousPageNumber . '">Previous</a></li>';
                                }
            
                                //Page range for see (2 page before 2 page after)
                                for ($pageForSee = max(1, $currentPage - 2); $pageForSee <= min($totalPageNeeded, $currentPage + 2); $pageForSee++) {
                                    echo '<li class="page-item ';
                                    if ($i == $currentPage) {
                                        echo 'active';
                                    }
                                    echo '"><a class="page-link" href="?page=' . $pageForSee . '">' . $pageForSee . '</a></li>';
                                }
            
                                //Next page button
                                if ($currentPage < $totalPageNeeded) {
                                    $nextPageNumber = $currentPage + 1;
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $nextPageNumber . '">Next</a></li>';
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


