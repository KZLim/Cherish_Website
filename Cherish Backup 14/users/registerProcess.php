<html>

    <head>
        <title>RegistrationProcess</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </head>

    <body>
        <h1>OK Process Done</h1>

                                                    <input type="number" name="raiseGoal" id="raiseGoal"  min="1" max="100" oninput="checkPostCodeLength(this, 5)" class="form-control" placeholder="Enter raising goal (RM)" aria-label="Enter raising goal (RM)" aria-describedby="basic-addon1" required>

        <?Php
        $cipherMethod = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($cipherMethod);
            $encryption_iv = uniqid().substr(uniqid(),0,3);  
            $encryption_key = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";

            $encryptionValue = openssl_encrypt("010506070144", $cipherMethod,$encryption_key,0, $encryption_iv);

            $decryption=openssl_decrypt ("BndHkDBSgSYKlyQJ", $cipherMethod,$encryption_key, 0, "64e9c3bc6dfa1157");

            echo"$encryption_iv";
            echo"<br/>";
            echo"$encryptionValue";
            echo"<br/>";
            echo"$decryption";

            if(password_verify("2","$2y$10\$HjnK6QxCkaS8SDTKDWiUBe2s5uoRZp3BCulpO8G9yjD2KQ5hXvQgW")){
                echo"it work";
            }
            else{
                echo"password wrong";
            }



        ?>

    </body>
</html>