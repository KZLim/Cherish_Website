<?php
    class Donor_record{
    
        // database connection and table name
        private $conn;
        private $table_name = "donors_record";
    
        // object properties
        public $donorName;
        public $uid;
        public $amount;
        public $donationDate;
        public $donationTime;
        public $campaignID;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create donor record
        function donateToCampaign(){
        
            // query to insert record
            $query = "SELECT `name` FROM user_account WHERE `uid`=:uidData";

            $query2 = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        donor_name=:donorName, donor_uid=:donorUid, amount=:amount, donation_date=:donationDate, donation_time=:donationTime, campaign_id=:campaignID";
            
            $query3 = "UPDATE ngo_campaign SET progress=progress + :amount WHERE campaign_id=:campaignID;";

            date_default_timezone_set('Asia/Kuala_Lumpur');  //set the time zone to kuala lumpur 

            // prepare query
            $stmt = $this->conn->prepare($query);
            $stmt2 = $this->conn->prepare($query2);
            $stmt3 = $this->conn->prepare($query3);


            $donorUidData = $this->uid;
            $stmt->bindParam(":uidData", $this->uid);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //assign value for second query
            $donorNameData = $row['name'];
            $amountData = $this->amount;
            $donationDateData = date('Y-m-d');
            $donationTimeData = date("h:i:sa");
            $campaignIdData = $this->campaignID;
        
            // bind the values for the second query
            $stmt2->bindParam(":donorName", $donorNameData);
            $stmt2->bindParam(":donorUid", $donorUidData);
            $stmt2->bindParam(":amount", $amountData);
            $stmt2->bindParam(":donationDate", $donationDateData);
            $stmt2->bindParam(":donationTime", $donationTimeData);
            $stmt2->bindParam(":campaignID", $campaignIdData);

            $stmt3->bindParam(":amount", $amountData);
            $stmt3->bindParam(":campaignID", $campaignIdData);


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