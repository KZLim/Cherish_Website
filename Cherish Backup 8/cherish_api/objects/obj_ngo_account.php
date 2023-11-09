<?php
    class Ngo_account{
    
        // database connection and table name
        private $conn;
        private $table_name = "ngo_account";
    
        // object properties
        public $email;
        public $password;
        public $directContactNumber;
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
                        ouid=:ouid, ngo_email=:email, ngo_direct_contact_number=:directContact, ngo_password=:password";
        

            // prepare query
            $stmt = $this->conn->prepare($query);

            //perform encryption to the IC Number of the user for storage
            $cipherMethod = "AES-128-CTR";
            $initVector = "Cherish Moments.";
            $encryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $encryptedPhoneNumber = openssl_encrypt($this->directContactNumber, $cipherMethod,$encryptionKey,0, $initVector);

            $encryptedPword = password_hash($this->password, PASSWORD_DEFAULT); //255 size is used to preven overflow when php release update with strong algorithm

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $ouidData = $this->ouid;
            $emailData = $this->email;
            $passwordData = $encryptedPword;
            $directContactData = $encryptedPhoneNumber;
        
            // bind the values so that it can be use in the query
            $stmt->bindParam(":ouid", $ouidData);
            $stmt->bindParam(":email", $emailData);
            $stmt->bindParam(":password", $passwordData);
            $stmt->bindParam(":directContact", $directContactData);
           
            // execute query and finishing this query will store the reamining data needed for the profile into the database (incl the image new name)
            if($stmt->execute()){
                return true;
            }
            return false;
            
        }
    }
?>