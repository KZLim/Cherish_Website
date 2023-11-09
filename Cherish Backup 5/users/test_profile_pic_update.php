<html>

    <head>
        <title>Registration | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="user_css/register.css">
    </head>


    <body>
        <div class="register-container" style="justify-content: center; width: 500px; height: 700px;">
                <h4 style="margin-left: auto; margin-right: auto; margin-top: 10px;">Setup your profile:</h4>

                <form action="../cherish_api/users/apiU_profile_pic.php" method="POST" enctype="multipart/form-data" style="padding: 0; width: 95%;">
                    
                    <label class="form-label">Select a profile picture</label>
                    <div class="input-group mb-3">
                        <input type="file" name="profilePicUpload" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary" id="test" type="submit" value="Test">
                    </div>
                </form>

            </script>
           
        </div>
    </body>
</html>