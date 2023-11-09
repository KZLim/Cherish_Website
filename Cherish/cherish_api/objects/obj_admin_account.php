<?php
    class Admin_account{
    
        // database connection and table name
        private $conn;
    
        // object properties
        public $adminID;
        public $adminIC;
        public $adminName;
        public $email;
        public $password;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create product
        function adminSignIn(){
        
            $query = "SELECT `admin_id`, `password` FROM admin_account WHERE admin_id=:adminId";

            // prepare query for execution
            $stmt = $this->conn->prepare($query);

            $adminIdData = $this->adminID;
            $stmt->bindParam(":adminId",$adminIdData); 

            //execute the query
            $stmt->execute();

            //fetch after executing query
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                //verify the given password and the hashed password in the db
                if(password_verify($this->password, $row['password'])){
                    session_start();
			        $_SESSION["identifier"] = $row["admin_id"] ;
                    return true;
                }
                else if($this->password == $row['password']){
                    header("Location:../../admin/passwordSetup.php");
                    exit;
                }
                else{
                    return false;
                }
            }    
            else{
                echo"Record Not Found";
            }
        }
        function adminUpdatePassword(){
            $newPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $cipherMethod = "AES-128-CTR";
            $initVector = "Cherish Moments.";
            $encryptionKey = "Theonlylimittoourrealizationoftomorrowwillbeourdoubtsoftoday";
            $encryptedIC = openssl_encrypt($this->adminIC, $cipherMethod,$encryptionKey,0, $initVector);

            $query2 = "SELECT admin_ic FROM admin_account WHERE admin_ic=:adminIC";
            $query3 = "UPDATE admin_account SET `password`=:newPasswordData, admin_ic=:encryptedIC WHERE admin_ic=:adminIC;";

            // prepare query for execution
            $stmt2 = $this->conn->prepare($query2);
            $stmt3 = $this->conn->prepare($query3);

            //bind the value to be used in the query
            $stmt2->bindParam(":adminIC",$this->adminIC); 
            $stmt3->bindParam(":adminIC",$this->adminIC); 
            $stmt3->bindParam(":newPasswordData",$newPassword); 
            $stmt3->bindParam(":encryptedIC",$encryptedIC); 

            //execute the query
            $stmt2->execute();

            //fetch after executing query
            $row = $stmt2->fetch(PDO::FETCH_ASSOC);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                if($this->adminIC == $row['admin_ic']){
                    $stmt3->execute();
                    return true;
                }
                else{
                    echo"not updated";
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