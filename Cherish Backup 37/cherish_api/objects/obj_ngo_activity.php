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
        }

        function updateActivity(){
            
            if(!empty($this->activityInfo)){
                $query2 = "UPDATE ngo_activity SET activity_info=:activityInfo, activity_status=:activityStatus WHERE activity_id=:activityID;";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(":activityInfo",$this->activityInfo);
                $stmt2->bindParam(":activityStatus",$this->activityStatus);
                $stmt2->bindParam(":activityID",$this->activityID);

                $stmt2->execute();
            }
            
            if(!empty($this->activityBanner)){
                $query3 = "UPDATE ngo_activity SET activity_banner=:activityBanner WHERE activity_id=:activityID;";
                $stmt3 = $this->conn->prepare($query3);

                $fileType=substr($this->activityBanner, strpos($this->activityBanner, ".")); //this step take the extension of the image file (png,jpg...)
                $newImageName = $this->ouid.uniqid().$fileType;  //this generate the new name for the image, the formula: (userid+image unique
                
                if($this->activityBanner_error == 0){     
                    $img_upload_path = '../../activity_banner/'.$newImageName;
                    move_uploaded_file($this->activityBanner_tmp,$img_upload_path);
                }

                $stmt3->bindParam(":activityBanner",$newImageName);
                $stmt3->bindParam(":activityID",$this->activityID);

                $stmt3->execute();
            }

            if(!empty($this->activityDate)&&!empty($this->closingDate)){
                $query4 = "UPDATE ngo_activity SET activity_date=:activityDate,closing_date=:closing_date, activity_status=:activityStatus WHERE activity_id=:activityID;";
                $stmt4 = $this->conn->prepare($query4);
                $stmt4->bindParam(":closing_date",$this->closingDate);
                $stmt4->bindParam(":activityDate",$this->activityDate);
                $stmt4->bindParam(":activityStatus",$this->activityStatus);
                $stmt4->bindParam(":activityID",$this->activityID);
                $stmt4->execute();
            }

            if(!empty($this->activityTime)){
                $query5 = "UPDATE ngo_activity SET activity_time=:activityTime, activity_status=:activityStatus WHERE activity_id=:activityID;";
                $stmt5 = $this->conn->prepare($query5);
                $stmt5->bindParam(":activityTime",$this->activityTime);
                $stmt5->bindParam(":activityStatus",$this->activityStatus);
                $stmt5->bindParam(":activityID",$this->activityID);

                $stmt5->execute();
            }

            if(!empty($this->addressLine)&&!empty($this->postCode)&&!empty($this->city)&&!empty($this->state)){
                $query6 = "UPDATE ngo_activity SET address_line=:addressLine,postal_code=:postalCode,city=:city, state=:state,
                            activity_status=:activityStatus WHERE activity_id=:activityID;";
                $stmt6 = $this->conn->prepare($query6);
                $stmt6->bindParam(":addressLine",$this->addressLine);
                $stmt6->bindParam(":postalCode",$this->postCode);
                $stmt6->bindParam(":city",$this->city);
                $stmt6->bindParam(":state",$this->state);
                $stmt6->bindParam(":activityStatus",$this->activityStatus);
                $stmt6->bindParam(":activityID",$this->activityID);

                $stmt6->execute();
            }

            if(!empty($this->participationLimit)){
                $query7 = "UPDATE ngo_activity SET participation_limit=:particiaptionLimit, activity_status=:activityStatus WHERE activity_id=:activityID;";
                $stmt7 = $this->conn->prepare($query7);
                $stmt7->bindParam(":particiaptionLimit",$this->participationLimit);
                $stmt7->bindParam(":activityStatus",$this->activityStatus);
                $stmt7->bindParam(":activityID",$this->activityID);

                $stmt7->execute();
            }
            
            return true;
        }

        function updateActivityStatus(){

            $query8 = "UPDATE ngo_activity SET activity_status=:activityStatus WHERE activity_id=:activityID;";
            $stmt8 = $this->conn->prepare($query8);
            $stmt8->bindParam(":activityStatus",$this->activityStatus);
            $stmt8->bindParam(":activityID",$this->activityID);

            if($stmt8->execute()){
                return true;
            }
        
            return false;
        }

        function updateAllActivityStatus(){

            $query8 = "UPDATE ngo_activity SET activity_status=:activityStatus WHERE `ouid`=:ouid;";
            $stmt8 = $this->conn->prepare($query8);
            $stmt8->bindParam(":activityStatus",$this->activityStatus);
            $stmt8->bindParam(":ouid",$this->ouid);

            if($stmt8->execute()){
                return true;
            }
            else{
                return false;
            }            
        }
    }
?>