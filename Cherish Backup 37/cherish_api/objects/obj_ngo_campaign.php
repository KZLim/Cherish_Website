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

        function updateCampaign(){
            
            if(!empty($this->campaignInfo)){
                $query2 = "UPDATE ngo_campaign SET campaign_info=:campaignInfo, campaign_status=:campaignStatus WHERE campaign_id=:campaignID;";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(":campaignInfo",$this->campaignInfo);
                $stmt2->bindParam(":campaignStatus",$this->campaignStatus);
                $stmt2->bindParam(":campaignID",$this->campaignID);

                $stmt2->execute();
            }
            
            if(!empty($this->campaignBanner)){
                $query3 = "UPDATE ngo_campaign SET campaign_banner=:campaignBanner WHERE campaign_id=:campaignID;";
                $stmt3 = $this->conn->prepare($query3);

                $fileType=substr($this->campaignBanner, strpos($this->campaignBanner, ".")); //this step take the extension of the image file (png,jpg...)
                $newImageName = $this->ouid.uniqid().$fileType;  //this generate the new name for the image, the formula: (userid+image unique
                
                if($this->campaignBanner_error == 0){     
                    $img_upload_path = '../../campaign_banner/'.$newImageName;
                    move_uploaded_file($this->campaignBanner_tmp,$img_upload_path);
                }

                $stmt3->bindParam(":campaignBanner",$newImageName);
                $stmt3->bindParam(":campaignID",$this->campaignID);

                $stmt3->execute();
            }

            if(!empty($this->closingDate)){
                $query4 = "UPDATE ngo_campaign SET closing_date=:closingDate WHERE campaign_id=:campaignID;";
                $stmt4 = $this->conn->prepare($query4);
                $stmt4->bindParam(":closingDate",$this->closingDate);
                $stmt4->bindParam(":campaignID",$this->campaignID);

                $stmt4->execute();
            }
            
            return true;
        }

        function updateCampaignStatus(){

            $query5 = "UPDATE ngo_campaign SET campaign_status=:campaignStatus WHERE campaign_id=:campaignID;";
            $stmt5 = $this->conn->prepare($query5);
            $stmt5->bindParam(":campaignStatus",$this->campaignStatus);
            $stmt5->bindParam(":campaignID",$this->campaignID);

            if($stmt5->execute()){
                return true;
            }
        
            return false;
        }

        function updateAllCampaignStatus(){

            $query5 = "UPDATE ngo_campaign SET campaign_status=:campaignStatus WHERE `ouid`=:ouid;";
            $stmt5 = $this->conn->prepare($query5);
            $stmt5->bindParam(":campaignStatus",$this->campaignStatus);
            $stmt5->bindParam(":ouid",$this->ouid);

            if($stmt5->execute()){
                return true;
            }
            else{
                return false;
            }        
        }
    }
?>