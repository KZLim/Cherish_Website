<?php
    class Users_account{
    
        // database connection and table name
        private $conn;
        private $table_name = "user_account";
    
        // object properties
        public $icNumber;
        public $uid;
        public $name;
        public $password;
        public $emailAddress;
        public $phoneNumber;
        public $gender;
        public $addressLine;
        public $city;
        public $state;
        public $postalCode;
        public $accountStatus;

    
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create product
        function createAccount(){
        
            // query to insert record
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        ic_number=:icNumber, uid=:uid, name=:name, email_address=:emailAddress, phone_number=:phoneNumber, gender=:gender,
                        address_line=:addressLine, city=:city, state=:state, postal_code=:postalCode, password=:password, account_status=:accountStatus";
        
            // prepare query
            $stmt = $this->conn->prepare($query);
        
            //perform encryption to the IC Number of the user for storage
            $cipherMethod = "AES-128-CTR";
            $initVector = "Cherish Moments.";
            $encryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $encryptedIC = openssl_encrypt($this->icNumber, $cipherMethod,$encryptionKey,0, $initVector);

            //perform hashing to the password for storage
            //PASSWORD_DEFAULT method of php is use. This method uses bcrypt method but will change constantly based on php update
            $encryptedPword = password_hash($this->password, PASSWORD_DEFAULT); //255 size is used to preven overflow when php release update with strong algorithm

            //retrieve data and assign to another variable to prepare for binding
            $icNumberData = $encryptedIC;
            $uidData = $this->uid;
            $nameData = $this->name;
            $passwordData = $encryptedPword;
            $emailData = $this->emailAddress;
            $phoneNumberData = $this->phoneNumber;
            $genderData = $this->gender;
            $addressLineData = $this->addressLine;
            $cityData = $this->city;
            $stateData = $this->state;
            $postCodeData = $this->postalCode;
            $accountStatus = "unlock";

            // bind values
            $stmt->bindParam(":icNumber", $icNumberData);
            $stmt->bindParam(":uid", $uidData);
            $stmt->bindParam(":name", $nameData);
            $stmt->bindParam(":password", $passwordData);
            $stmt->bindParam(":emailAddress", $emailData);
            $stmt->bindParam(":phoneNumber", $phoneNumberData);
            $stmt->bindParam(":gender", $genderData);
            $stmt->bindParam(":addressLine", $addressLineData);
            $stmt->bindParam(":city", $cityData);
            $stmt->bindParam(":state", $stateData);
            $stmt->bindParam(":postalCode", $postCodeData);
            $stmt->bindParam(":accountStatus", $accountStatus);

            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }

        //this is the sign in function, called from api signin endpoint
        function validateSignIn(){

            $query2 = "SELECT `uid`, `password`, account_status FROM user_account WHERE email_address=:emailAddressData";

            // prepare query for execution
            $stmt2 = $this->conn->prepare($query2);

            //bind the value to be used in the query
            $stmt2->bindParam(":emailAddressData",$this->emailAddress); 

            //execute the query
            $stmt2->execute();

            //fetch after executing query
            $row = $stmt2->fetch(PDO::FETCH_ASSOC);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                //verify the given password and the hashed password in the db
                if(password_verify($this->password, $row['password']) && $row['account_status']=='unlock'){
                    session_start();
			        $_SESSION["identifier"] = $row["uid"] ;
                    return true;
                }
                else if(password_verify($this->password, $row['password']) && $row['account_status']=='lock'){
                    header("Location:../../users/signin.php?response=acclocked");
                }
                else{
                    return false;
                }
            }    
            else{
                echo"Record Not Found";
            }
        }

        function resetPassword(){

            $newPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $cipherMethod = "AES-128-CTR";
            $decryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $initVector = "Cherish Moments.";


            $query3 = "SELECT ic_number FROM user_account WHERE email_address=:emailAddressData";
            $query4 = "UPDATE  user_account SET `password`=:newPasswordData WHERE email_address=:emailAddressData;";

            // prepare query for execution
            $stmt3 = $this->conn->prepare($query3);
            $stmt4 = $this->conn->prepare($query4);


            //bind the value to be used in the query
            $stmt3->bindParam(":emailAddressData",$this->emailAddress); 
            $stmt4->bindParam(":emailAddressData",$this->emailAddress); 
            $stmt4->bindParam(":newPasswordData",$newPassword); 

            //execute the query
            $stmt3->execute();

            //fetch after executing query
            $row = $stmt3->fetch(PDO::FETCH_ASSOC);

            $decryptICValue = openssl_decrypt ($row['ic_number'], $cipherMethod ,$decryptionKey, 0, $initVector);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                if($decryptICValue == $this->icNumber){
                    $stmt4->execute();
                    return true;
                }
                else{
                    echo"not reset";
                    return false;
                }
            }    
            else{
                echo"Record Not Found";
                return false;
            }
        }

        function updateEmail(){

            $newEmail = $this->emailAddress;


            $query5 = "SELECT `password` FROM user_account WHERE `uid`=:uidData";
            $query6 = "UPDATE  user_account SET email_address=:emailAddressData WHERE `uid`=:uidData;";

            $stmt5 = $this->conn->prepare($query5);
            $stmt6 = $this->conn->prepare($query6);

            $stmt5->bindParam(":uidData",$this->uid);
            $stmt6->bindParam(":emailAddressData",$newEmail);
            $stmt6->bindParam(":uidData",$this->uid);

        
            $stmt5->execute();

            $row = $stmt5->fetch(PDO::FETCH_ASSOC);

            if($row){
                if(password_verify($this->password, $row['password'])){
                    $stmt6->execute();
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }

        function updatePhone(){

            $newPhoneNum = $this->phoneNumber;


            $query7 = "SELECT password FROM user_account WHERE `uid`=:uidData";
            $query8 = "UPDATE  user_account SET phone_number=:phoneNumberData WHERE `uid`=:uidData;";

            $stmt7 = $this->conn->prepare($query7);
            $stmt8 = $this->conn->prepare($query8);

            $stmt7->bindParam(":uidData",$this->uid);
            $stmt8->bindParam(":phoneNumberData",$newPhoneNum);
            $stmt8->bindParam(":uidData",$this->uid);

        
            $stmt7->execute();

            $row = $stmt7->fetch(PDO::FETCH_ASSOC);

            if($row){
                if(password_verify($this->password, $row['password'])){
                    $stmt8->execute();
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }

        function updateReside(){

            $newAddressLine = $this->addressLine;
            $newCity = $this->city;
            $newState = $this->state;
            $newPostCode = $this->postalCode;

            $query9 = "SELECT `password` FROM user_account WHERE `uid`=:uidData";
            $query10 = "UPDATE  user_account SET address_line=:addressLineData, city=:cityData, `state`=:stateData, postal_code=:postCodeData WHERE `uid`=:uidData;";

            $stmt9 = $this->conn->prepare($query9);
            $stmt10 = $this->conn->prepare($query10);

            $stmt9->bindParam(":uidData",$this->uid);
            $stmt10->bindParam(":addressLineData",$newAddressLine);
            $stmt10->bindParam(":cityData",$newCity);
            $stmt10->bindParam(":stateData",$newState);
            $stmt10->bindParam(":postCodeData",$newPostCode);
            $stmt10->bindParam(":uidData",$this->uid);

        
            $stmt9->execute();

            $row = $stmt9->fetch(PDO::FETCH_ASSOC);

            if($row){
                if(password_verify($this->password, $row['password'])){
                    $stmt10->execute();
                    echo"Address Changed";
                    return true;
                }
                else{
                    echo"Address Not Changed";
                    return false;
                }
            }
            else{
                return false;
            }
        }

        function changePassword(){

            $newPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $cipherMethod = "AES-128-CTR";
            $decryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $initVector = "Cherish Moments.";


            $query11 = "SELECT ic_number FROM user_account WHERE `uid`=:uidData";
            $query12 = "UPDATE user_account SET `password`=:newPasswordData WHERE `uid`=:uidData;";

            // prepare query for execution
            $stmt11 = $this->conn->prepare($query11);
            $stmt12 = $this->conn->prepare($query12);

            //bind the value to be used in the query
            $stmt11->bindParam(":uidData",$this->uid); 
            $stmt12->bindParam(":uidData",$this->uid); 
            $stmt12->bindParam(":newPasswordData",$newPassword); 

            //execute the query
            $stmt11->execute();

            //fetch after executing query
            $row = $stmt11->fetch(PDO::FETCH_ASSOC);

            $decryptICValue = openssl_decrypt ($row['ic_number'], $cipherMethod ,$decryptionKey, 0, $initVector);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                if($decryptICValue == $this->icNumber){
                    $stmt12->execute();
                    return true;
                }
                else{
                    echo"not reset";
                    return false;
                }
            }    
            else{
                echo"Record Not Found";
                return false;
            }
        }

        function updateAccountStatus(){

            $query13 = "UPDATE user_account SET account_status=:accountStatus WHERE `uid`=:uidData;";

            // prepare query for execution
            $stmt13 = $this->conn->prepare($query13);

            //bind the value to be used in the query
            $stmt13->bindParam(":uidData",$this->uid); 
            $stmt13->bindParam(":accountStatus",$this->accountStatus); 

            //the if row check for whether something is fetch, if nothing means that no record found
            if($stmt13->execute()){
                return true;
            }    
            else{
                return false;
            }
        }
    }
?>