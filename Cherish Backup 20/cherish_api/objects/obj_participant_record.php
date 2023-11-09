<?php
    class Participant_record{
    
        // database connection and table name
        private $conn;
        private $table_name = "participants_record";
    
        // object properties
        public $participantName;
        public $uid;
        public $registerDate;
        public $registerTime;
        public $activityID;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create product
        function volunteerInActivity(){
        
            // query to insert record
            $query = "SELECT `name` FROM user_account WHERE `uid`=:uidData";

            $query2 = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        participant_name=:participantName, participant_uid=:participantUid, register_date=:registerDate, register_time=:registerTime,
                        activity_id=:activityID";
            
            $query3 = "UPDATE ngo_activity SET current_participant=current_participant + 1 WHERE activity_id=:activityID;";

            date_default_timezone_set('Asia/Kuala_Lumpur');  //set the time zone to kuala lumpur 

            // prepare query
            $stmt = $this->conn->prepare($query);
            $stmt2 = $this->conn->prepare($query2);
            $stmt3 = $this->conn->prepare($query3);


            $participantUidData = $this->uid;
            $stmt->bindParam(":uidData", $this->uid);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //assign value for second query
            $participantNameData = $row['name'];
            $registerDateData = date('Y-m-d');
            $registerTimeData = date("h:i:sa");
            $activityIdData = $this->activityID;
        
            // bind the values for the second query
            $stmt2->bindParam(":participantName", $participantNameData);
            $stmt2->bindParam(":participantUid", $participantUidData);
            $stmt2->bindParam(":registerDate", $registerDateData);
            $stmt2->bindParam(":registerTime", $registerTimeData);
            $stmt2->bindParam(":activityID", $activityIdData);

            $stmt3->bindParam(":activityID", $activityIdData);


            // execute query and finishing this query will store the reamining data needed for the profile into the database (incl the image new name)
            if($stmt2->execute()){
                if($stmt3->execute()){
                    return true;
                }
            }
            return false;
        }
    }
?>