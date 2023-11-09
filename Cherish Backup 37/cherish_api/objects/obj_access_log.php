<html>
<?php
    class Access_log{
    
        // database connection and table name
        private $conn;
        private $table_name = "access_log";
    
        // object properties
        public $uid;
        public $adminID;
        public $actionPerformed;
        public $dateAccessed;
        public $timeAccessed;
        public $reason;
        public $icValue;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        function adminGetUIC(){

            $query = "SELECT `ic_number` FROM user_account WHERE `uid`=:uidData";

            $query2 = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        admin_id=:adminID, action_performed=:actionPerformed, date_accessed=:dateAccessed, time_accessed=:timeAccessed, reason=:reason";

            // prepare query for execution
            $stmt = $this->conn->prepare($query);
            $stmt2 = $this->conn->prepare($query2);

            //bind the value to be used in the query
            $stmt->bindParam(":uidData",$this->uid); 

            $stmt2->bindParam(":adminID",$this->adminID); 
            $stmt2->bindParam(":actionPerformed",$this->actionPerformed); 
            $stmt2->bindParam(":dateAccessed",$this->dateAccessed); 
            $stmt2->bindParam(":timeAccessed",$this->timeAccessed); 
            $stmt2->bindParam(":reason",$this->reason); 

            //execute the query
            $stmt->execute();

            //fetch after executing query
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //the if row check for whether something is fetch, if nothing means that no record found
            if($row){
                $this->icValue = $row['ic_number'];
                $stmt2->execute();
                return true;
            }    
            else{
                echo"Record Not Found";
                return false;
            }
        }
    }
?>