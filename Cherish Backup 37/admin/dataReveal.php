<html>

    <head>
        <title>Data Reveal | Admin</title>
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

                echo'<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col" style="padding: 0;">';
                            echo'<img src="../ngo_banner_images/crt64f7103ad583764fc2b2646a68.jpg" height="200px" width="100%" style="filter: brightness(0.4);">';
                            echo'<h5 class="banner-title-custom" style="color: #ff5757; font-weight: bold">Data Reveal | Admin</h5>';
                        echo'</div>
                    </div>
                </div>';

                echo'<br/>';

                echo'<form action="../cherish_api/admin/api_get_uic.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%; margin-left: auto; margin-right: auto;">
                    <h6 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Please provide the UID:</h6>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">UID</span>
                        <input type="text" name="providedUid" id="providedUid" class="form-control" placeholder="Enter UID" aria-label="Enter UID" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3" style="width: 100%;">
                        <span class="input-group-text">Reason</span>
                        <textarea name="reason" class="form-control" aria-label="With textarea"></textarea>
                    </div>
                        
                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary btn-reg-signin" id="setup" type="submit" value="Retrieve">
                    </div>
                </form>';     

                echo'<h5 class="text-center">NOTE: By clicking retrieve, access log will be created by the system to record that you are requesting sensitive data. ';
                echo'Accessed log are audited regularly</h5>';

                if(!empty($_GET['icv']) && ($_GET['icv']!="null")){
                    $cipherMethod = "AES-128-CTR";
                    $decryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
                    $initVector = "Cherish Moments.";

                    $decryptICValue = openssl_decrypt ($_GET['icv'], $cipherMethod ,$decryptionKey, 0, $initVector);

                    echo"<script>
                            alertify.alert('Reveal Process','The IC Number is: $decryptICValue', function () {
                                clearParam();
                            });
                    
                            function clearParam() {
                                // Redirect the user to the desired URL on the client side
                                window.location.href = 'dataReveal.php';
                            }
                        </script>";
                }
                else if (!empty($_GET['icv']) && ($_GET['icv']=="null")){
                    echo"<script>
                            alertify.alert('Error','The Process cannot be done. Try Again.')
                    
                            function clearParam() {
                                // Redirect the user to the desired URL on the client side
                                window.location.href = 'dataReveal.php';
                            }
                        </script>";
                }
        ?>
    </body>
</html>


