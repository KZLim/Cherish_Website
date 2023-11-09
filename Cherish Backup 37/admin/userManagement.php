<html>

    <head>
        <title>User Management | Admin</title>
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
                            echo'<img src="../ngo_banner_images/crt64f7103ad583764fc2b2646a68.jpg" height="200px" width="100%" style="filter: brightness(0.4);">';
                            echo'<h5 class="banner-title-custom" style="color: #ff5757; font-weight: bold">User Management | Admin</h5>';
                        echo'</div>
                    </div>
                </div>';

                echo'<br/>';

                echo'<div>
                        <ul class="nav nav-tabs justify-content-center" id="profileTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#lockAccount">Lock Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#unlockAccount">Unlock Account</a>
                            </li>             
                        </ul>
                    </div>';

                    echo'<div class="tab-content" style="overflow: auto;">';
                        echo'<div class="tab-pane fade show active" id="lockAccount">';
                                echo"<br/>";
                                echo'<form action="../cherish_api/admin/api_lock_account.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%; margin-left: auto; margin-right: auto;">
                                        <h6 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Please provide target account\'s UID:</h6>
                    
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">UID</span>
                                            <input type="text" name="providedUid" id="providedUid" class="form-control" placeholder="Enter target account UID" aria-label="Enter target account UID" aria-describedby="basic-addon1" required>
                                        </div>
                                            
                                        <div class="d-flex justify-content-end">
                                            <input class="btn btn-primary btn-reg-signin" id="lock" type="submit" value="Lock">
                                        </div>
                                    </form>';     
            
                                echo'<h5 class="text-center">NOTE: By clicking lock, the user account will be lock and unable to login. ';
                                echo'Ensure before locking.</h5>';
                        echo'</div>';

                        echo'<div class="tab-pane fade" id="unlockAccount">';
                                    echo"<br/>";

                                    $query = "SELECT * FROM user_account WHERE account_status = 'lock'";

                                    $stmt = mysqli_prepare($dbc, $query);
                                                        
                                    mysqli_stmt_execute($stmt);
                                                    
                                    $result = mysqli_stmt_get_result($stmt);
                                    mysqli_stmt_close($stmt);
                        
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $userName = $row['name'];
                                        $uid = $row['uid'];
                                        $email = $row['email_address'];
                                        $phoneNumber =  $row['phone_number'];
                                        echo'<div class="container-fluid">
                                            <div class="row">
                                                <div class="col md-6 d-flex justify-content-center" style="border: 0px solid black; padding: 0px;">
                                                    <div class="card" style="width: 85%; height: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
                                                        echo'<a href="../cherish_api/admin/api_unlock_account.php?targetUID='.$uid.'"  onclick="return confirm(\'Are you sure you want to proceed?\');">';
                                                            echo'<div class="card-body">
                                                                    <h5 class="card-text">
                                                                        Username: '.$userName.' 
                                                                    </h5>
                                                                    <p class ="card-text">
                                                                        UID: '.$uid.' <br/>
                                                                        Email: '.$email.'<br/>
                                                                        Phone: '.$phoneNumber.'<br/>
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
                    echo'</div>';

                    if(!empty($_GET['actionDone'])){
                        $alertCondition = $_GET['actionDone'];
                        if($alertCondition == "locked"){
                            echo"<script>
                                    alertify.alert('Action Performed','The Target User Account Has Been Locked!');
                                </script>";
                        }
                        else if($alertCondition == "unlocked"){
                            echo"<script>
                                    alertify.alert('Action Performed','The Selected User Account Has Been Unlocked!');
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


