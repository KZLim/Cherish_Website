<?php
    class Ngo_activity{
    
        // database connection and table name
        private $conn;
        private $table_name = "ngo_activity";
    
        // object properties
        public $activityName;
        public $activityID;
        public $activityInfo;
        public $activityDate; 
        public $closingDate;
        public $activityTime;
        public $addressLine;
        public $postCode;
        public $city;
        public $state;
        public $participationLimit;
        public $currentParticipation;
        public $activityStatus;
        public $activityBanner;
        public $activityBanner_tmp;
        public $activityBanner_error;
        public $ouid;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create product
        function createActivity(){
            
			// query to insert record
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        activity_name=:activityName, activity_id=:activityID, activity_info=:activityInfo, address_line=:addressLine,
                        postal_code=:postCode, city=:city, state=:state, activity_date=:activityDate, closing_date=:closingDate,
						activity_time=:activityTime, participation_limit=:participationLimit, current_participant=:currentParticipant,
						activity_status=:activityStatus, activity_banner=:activityBanner, ouid=:ouid";
        

            // prepare query
            $stmt = $this->conn->prepare($query);
            
            //we rename the banner name that the ngo give (for simpler file management)
            $bannerfileType=substr($this->activityBanner, strpos($this->activityBanner, ".")); 
            $newBannerName = $this->ouid.uniqid().$bannerfileType;  

            //after having new name, and error is check, the file is then move to the destination path for image storing
            if($this->activityBanner_error == 0){     
                $banner_upload_path = '../../activity_banner/'.$newBannerName;
                move_uploaded_file($this->activityBanner_tmp,$banner_upload_path);
            }

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $activityNameData = $this->activityName;
			$activityIdData = $this->activityID;
			$activityInfoData = $this->activityInfo;
			$addressLineData = $this->addressLine;
			$postCodeData = $this->postCode;
			$cityData = $this->city;
			$stateData = $this->state;
			$activityDateData = $this->activityDate;
			$closingDateData = $this->closingDate;
			$activityTimeData = $this->activityTime;
			$participationLimitData = $this->participationLimit;
			$currentParticipationData =  $this->currentParticipation;
			$activityStatusData = $this->activityStatus;
			$ouidData = $this->ouid;
           

            // bind the values so that it can be use in the query
            $stmt->bindParam(":activityName", $activityNameData);
            $stmt->bindParam(":activityID", $activityIdData);
            $stmt->bindParam(":activityInfo", $activityInfoData);
            $stmt->bindParam(":addressLine", $addressLineData);
            $stmt->bindParam(":postCode", $postCodeData);
            $stmt->bindParam(":city", $cityData);
            $stmt->bindParam(":state", $stateData);
            $stmt->bindParam(":activityDate", $activityDateData);
            $stmt->bindParam(":closingDate", $closingDateData);
            $stmt->bindParam(":activityTime", $activityTimeData);
            $stmt->bindParam(":participationLimit", $participationLimitData);
            $stmt->bindParam(":currentParticipant", $currentParticipationData);
            $stmt->bindParam(":activityStatus", $activityStatusData);
            $stmt->bindParam(":activityBanner", $newBannerName);
            $stmt->bindParam(":ouid", $ouidData);

            if($stmt->execute()){
                return true;
            }
        
            return false;
			
			
			
			
			
			/*
        	echo $this->activityName;
           	echo "<br/>";
           	echo $this->activityID;
           	echo "<br/>";
           	echo $this->activityInfo;
           	echo "<br/>";
          	echo $this->addressLine;
           	echo "<br/>";
           	echo $this->postCode;
           	echo "<br/>";
           	echo $this->city;
           	echo "<br/>";
           	echo $this->state;
           	echo "<br/>";
           	echo $this->activityDate;
           	echo "<br/>";
           	echo $this->closingDate;
           	echo "<br/>";
           	echo $this->activityTime;
           	echo "<br/>";
           	echo $this->participationLimit;
           	echo "<br/>";
           	echo $this->currentParticipation;
           	echo "<br/>";
           	echo $this->activityStatus;
           	echo "<br/>";
           	echo $this->activityBanner;
           	echo "<br/>";
           	echo $this->activityBanner_tmp;
           	echo "<br/>";
           	echo $this->activityBanner_error;
           	echo "<br/>";
           	echo $this->ouid;
			*/

        }
    }
?>