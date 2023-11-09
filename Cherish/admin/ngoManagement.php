<html>

    <head>
        <title>NGO Management | Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
            <?php
                include '../main/header.php';

                $dbc = mysqli_connect("localhost", "root", "");
                mysqli_select_db($dbc, "cherish_db");

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="padding: 0;">';
                            echo'<img src="../images/setting.jpg" height="200px" width="100%" style="filter: brightness(0.4);">';
                            echo'<h5 class="banner-title-custom" style="color: #ff5757; font-weight: bold">NGO Management | Admin</h5>';
                        echo'</div>
                    </div>
                </div>';

                echo'<br/>';

                echo'<div>
                        <ul class="nav nav-tabs justify-content-center" id="profileTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#lockProfile">Lock Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#unlockProfile">Unlock Profile</a>
                            </li>             
                        </ul>
                    </div>';

                    echo'<div class="tab-content" style="overflow: auto;">';
                        echo'<div class="tab-pane fade show active" id="lockProfile">';
                                echo"<br/>";
                                echo'<form action="../cherish_api/admin/api_unlist_profile.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%; margin-left: auto; margin-right: auto;">
                                        <h6 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Please provide target account\'s OUID:</h6>
                    
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">OUID</span>
                                            <input type="text" name="providedOuid" id="providedUid" class="form-control" placeholder="Enter target account OUID" aria-label="Enter target account OUID" aria-describedby="basic-addon1" required>
                                        </div>
                                            
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-primary btn-reg-signin" id="lock" type="submit" value="Unlist">
                                        </div>
                                    </form>';     
            
                                echo'<h5 class="text-center">NOTE: By clicking lock, the user account will be lock and unable to login. ';
                                echo'Ensure before locking.</h5>';
                        echo'</div>';

                        echo'<div class="tab-pane fade" id="unlockProfile">';
                            echo"<br/>";

                            $query = "SELECT * FROM ngo_profile WHERE ngo_status = 'unlisted'";

                            $stmt = mysqli_prepare($dbc, $query);
                                                        
                            mysqli_stmt_execute($stmt);
                                            
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                
                            while ($row = mysqli_fetch_assoc($result)) {

                                $ngoName = $row['ngo_name'];
                                $ouid = $row['ouid'];
                                $email = $row['ngo_email'];
                                $registerNumber =  $row['register_number'];
                                echo'<div class="container-fluid">
                                    <div class="row">
                                        <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                            <div class="card" style="width: 85%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                                echo'<a href="../cherish_api/admin/api_list_profile.php?targetOUID='.$ouid.'" onclick="return confirm(\'Are you sure you want to proceed?\');">';
                                                    echo'<div class="card-body">
                                                            <h5 class="card-text">
                                                                NGO Name: '.$ngoName.' 
                                                            </h5>
                                                            <p class ="card-text">
                                                                OUID: '.$ouid.' <br/>
                                                                Email: '.$email.'<br/>
                                                                Register Number: '.$registerNumber.'<br/>
                                                            </p>
                                                        </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>';
                            }
                        echo'</div>';
                    echo'</div>';

                    if(!empty($_GET['actionDone'])){
                        $alertCondition = $_GET['actionDone'];
                        if($alertCondition == "unlisted"){
                            echo"<script>
                                    alertify.alert('Action Performed','The Target NGO Profiel Has Been Unlisted!');
                                </script>";
                        }
                        else if($alertCondition == "listed"){
                            echo"<script>
                                    alertify.alert('Action Performed','The Selected NGO Profile Has Been Listed!');
                                </script>";
                        }
                        else if($alertCondition == "anp"){
                            echo"<script>
                                    alertify.alert('Error','Action Not Performed. Try Again.');
                                </script>";
                        }
                    }
            ?>
    </body>
    
</html>


