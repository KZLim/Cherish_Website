<?php
    class Ngo_account{
    
        // database connection and table name
        private $conn;
        private $table_name = "ngo_account";
    
        // object properties
        public $email;
        public $icNumber;
        public $password;
        public $oldPassword;
        public $ouid;  //this is used for the uid given by the system (organization unique id)

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
                        ouid=:ouid, ngo_email=:email, ic_number_representative=:icRepresentative, ngo_password=:password";
        

            // prepare query
            $stmt = $this->conn->prepare($query);

            //perform encryption to the ic number of the legal representative
            $cipherMethod = "AES-128-CTR";
            $initVector = "Cherish Moments.";
            $encryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $encryptedIC = openssl_encrypt($this->icNumber, $cipherMethod,$encryptionKey,0, $initVector);

            $encryptedPword = password_hash($this->password, PASSWORD_DEFAULT); //255 size is used to preven overflow when php release update with strong algorithm

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $ouidData = $this->ouid;
            $emailData = $this->email;
            $icData = $encryptedIC;
            $passwordData = $encryptedPword;
        
            // bind the values so that it can be use in the query
            $stmt->bindParam(":ouid", $ouidData);
            $stmt->bindParam(":icRepresentative", $icData);
            $stmt->bindParam(":email", $emailData);
            $stmt->bindParam(":password", $passwordData);
           
            // execute query and finishing this query will store the reamining data needed for the profile into the database (incl the image new name)
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function validateSignIn(){

            $query2 = "SELECT ouid, ngo_password FROM ngo_account WHERE ngo_email=:emailAddressData";

            // prepare query for execution
            $stmt2 = $this->conn->prepare($query2);

            //bind the value to be used in the query
            $stmt2->bindParam(":emailAddressData",$this->email); 

            //execute the query
            $stmt2->execute();

            //fetch after executing query
            $row = $stmt2->fetch(PDO::FETCH_ASSOC);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                //verify the given password and the hashed password in the db
                if(password_verify($this->password, $row['ngo_password'])){
                    session_start();
			        $_SESSION["identifier"] = $row["ouid"] ;
                    return true;
                }
                else{
                    return false;
                }
            }    
            else{
                echo"Record Not Found";
            }
        }

        function changePassword(){

            $newPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $query3 = "SELECT ngo_password FROM ngo_account WHERE ouid=:ouidData";
            $query4 = "UPDATE ngo_account SET ngo_password=:newPasswordData WHERE ouid=:ouidData;";

            // prepare query for execution
            $stmt3 = $this->conn->prepare($query3);
            $stmt4 = $this->conn->prepare($query4);

            //bind the value to be used in the query
            $stmt3->bindParam(":ouidData",$this->ouid); 
            $stmt4->bindParam(":ouidData",$this->ouid); 
            $stmt4->bindParam(":newPasswordData",$newPassword); 

            //execute the query
            $stmt3->execute();

            //fetch after executing query
            $row = $stmt3->fetch(PDO::FETCH_ASSOC);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                if(password_verify($this->oldPassword, $row['ngo_password'])){
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

            $newEmail = $this->email;

            $query5 = "SELECT ngo_password FROM ngo_account WHERE ouid=:ouidData";
            $query6 = "UPDATE  ngo_account SET ngo_email=:emailAddressData WHERE ouid=:ouidData;";

            $stmt5 = $this->conn->prepare($query5);
            $stmt6 = $this->conn->prepare($query6);

            $stmt5->bindParam(":ouidData",$this->ouid);
            $stmt6->bindParam(":emailAddressData",$newEmail);
            $stmt6->bindParam(":ouidData",$this->ouid);

            $stmt5->execute();

            $row = $stmt5->fetch(PDO::FETCH_ASSOC);

            if($row){
                if(password_verify($this->password, $row['ngo_password'])){
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

        function resetPassword(){

            $newPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $cipherMethod = "AES-128-CTR";
            $decryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $initVector = "Cherish Moments.";


            $query7 = "SELECT ic_number_representative FROM ngo_account WHERE ngo_email=:emailAddressData";
            $query8 = "UPDATE  ngo_account SET ngo_password=:newPasswordData WHERE ngo_email=:emailAddressData;";

            // prepare query for execution
            $stmt7 = $this->conn->prepare($query7);
            $stmt8 = $this->conn->prepare($query8);


            //bind the value to be used in the query
            $stmt7->bindParam(":emailAddressData",$this->email); 
            $stmt8->bindParam(":emailAddressData",$this->email); 
            $stmt8->bindParam(":newPasswordData",$newPassword); 

            //execute the query
            $stmt7->execute();

            //fetch after executing query
            $row = $stmt7->fetch(PDO::FETCH_ASSOC);

            $decryptICValue = openssl_decrypt ($row['ic_number_representative'], $cipherMethod ,$decryptionKey, 0, $initVector);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                if($decryptICValue == $this->icNumber){
                    $stmt8->execute();
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
    }
?>