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
        function create(){
        
            // query to insert record
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        ic_number=:icNumber, uid=:uid, name=:name, email_address=:emailAddress, phone_number=:phoneNumber, gender=:gender,
                        address_line=:addressLine, city=:city, state=:state, postal_code=:postalCode, password=:password";
        
            // prepare query
            $stmt = $this->conn->prepare($query);
        
            // sanitize

            //retrieve data and assign to another variable to prepare for binding
            $icNumberData = $this->icNumber;
            $uidData = $this->uid;
            $nameData = $this->name;
            $passwordData = $this->password;
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

            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }
    }
?>