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
                        address_line=:addressLine, city=:city, state=:state, postal_code=:postalCode, password=:password, vector=:vector";
        
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
            $stmt->bindParam(":vector", $initVector);

            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }

        //this is the sign in function, called from api signin endpoint
        function validateSignIn(){

            $query2 = "SELECT `uid`, `password` FROM user_account WHERE email_address=:emailAddressData";

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
                if(password_verify($this->password, $row['password'])){
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

        function resetPassword(){

            $newPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $cipherMethod = "AES-128-CTR";
            $decryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $initVector = "Cherish Moments.";


            $query3 = "SELECT ic_number FROM user_account WHERE email_address=:emailAddressData";
            $query4 = "UPDATE  user_account SET `password`=:newPassword WHERE email_address=:emailAddressData;";

            // prepare query for execution
            $stmt3 = $this->conn->prepare($query3);
            $stmt4 = $this->conn->prepare($query4);


            //bind the value to be used in the query
            $stmt3->bindParam(":emailAddressData",$this->emailAddress); 
            $stmt4->bindParam(":emailAddressData",$this->emailAddress); 
            $stmt4->bindParam(":newPassword",$newPassword); 

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
                }
            }    
            else{
                echo"Record Not Found";
            }
        }

    }
?>