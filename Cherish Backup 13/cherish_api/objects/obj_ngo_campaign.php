<?php
    class Ngo_campaign{
    
        // database connection and table name
        private $conn;
        private $table_name = "ngo_campaign";
    
        // object properties
        public $campaignName;
        public $campaignID;
        public $campaignInfo;
        public $raiseGoal;
        public $progress; 
        public $closingDate;
        public $ouid;
        public $campaignStatus;
        public $campaignBanner;
        public $campaignBanner_tmp;
        public $campaignBanner_error;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create product
        function createCampaign(){
        
            // query to insert record
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        campaign_name=:campaignName, campaign_id=:campaignID, campaign_info=:campaignInfo, raise_goal=:raiseGoal,
                        progress=:progress, closing_date=:closingDate, ouid=:ouid, campaign_status=:campaignStatus, campaign_banner=:campaignBanner";
        

            // prepare query
            $stmt = $this->conn->prepare($query);
            
            //we rename the banner name that the ngo give (for simpler file management)
            $bannerfileType=substr($this->campaignBanner, strpos($this->campaignBanner, ".")); 
            $newBannerName = $this->ouid.uniqid().$bannerfileType;  

            //after having new name, and error is check, the file is then move to the destination path for image storing
            if($this->campaignBanner_error == 0){     
                $banner_upload_path = '../../campaign_banner/'.$newBannerName;
                move_uploaded_file($this->campaignBanner_tmp,$banner_upload_path);
            }

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $campaignNameData = $this->campaignName;
            $campaignIdData = $this->campaignID;
            $campaignInfoData = $this->campaignInfo;
            $raiseGoalData = $this->raiseGoal;
            $progressData = $this->progress;
            $closingDateData = $this->closingDate;
            $ouidData = $this->ouid;
            $campaignStatusData = $this->campaignStatus;
            $campaignBannerData = $newBannerName;
           

            // bind the values so that it can be use in the query
            $stmt->bindParam(":campaignName", $campaignNameData);
            $stmt->bindParam(":campaignID", $campaignIdData);
            $stmt->bindParam(":campaignInfo", $campaignInfoData);
            $stmt->bindParam(":raiseGoal", $raiseGoalData);
            $stmt->bindParam(":progress", $progressData);
            $stmt->bindParam(":closingDate", $closingDateData);
            $stmt->bindParam(":ouid", $ouidData);
            $stmt->bindParam(":campaignStatus", $campaignStatusData);
            $stmt->bindParam(":campaignBanner", $campaignBannerData);

            if($stmt->execute()){
                return true;
            }
        
            return false;
            

        }
    }
?>