<?php
    class Ngo_profile{
    
        // database connection and table name
        private $conn;
        private $table_name = "ngo_profile";
    
        // object properties
        public $ngoEmail;
        public $ouid;
        public $ngoName;
        public $registrationNumber;  
        public $addressLine;        
        public $postalCode;
        public $city; 
        public $state; 
        public $profilePath; 
        public $bannerPath; 
        public $bio; 
        public $websiteURL; 
        public $category; 
        public $status; 
        public $tmpPath;        //when a file is upload, a temporary path is holding the image.
        public $errorCount; 
        public $bannerTmpPath;        //when a file is upload, a temporary path is holding the image.
        public $bannerErrorCount; 
 
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // create product
        function createProfile(){
        
            // query to insert record
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        ngo_email=:emailAddress, ouid=:ouid, ngo_name=:name, register_number=:registerNumber,
                        address_line=:addressLine, city=:city, state=:state, postal_code=:postCode, profile_path=:profilePath,
                        banner_path=:bannerPath, ngo_bio=:bio, ngo_url=:url, ngo_category=:category, ngo_status=:ngoStatus";
        

            // prepare query
            $stmt = $this->conn->prepare($query);

            //we rename the image name that the ngo give (for simpler file management)
            $fileType=substr($this->profilePath, strpos($this->profilePath, ".")); //this step take the extension of the image file (png,jpg...)
            $newImageName = $this->ouid.uniqid().$fileType;  //this generate the new name for the image, the formula: (ouid+image unique id+extension)
            
            //we rename the banner name that the ngo give (for simpler file management)
            $bannerfileType=substr($this->bannerPath, strpos($this->bannerPath, ".")); 
            $newBannerName = $this->ouid.uniqid().$bannerfileType;  


            //after having new name, and error is check, the file is then move to the destination path for image storing
            if($this->errorCount == 0){     
                $img_upload_path = '../../ngo_images/'.$newImageName;
                move_uploaded_file($this->tmpPath,$img_upload_path);
            }

            if($this->bannerErrorCount == 0){     
                $banner_upload_path = '../../ngo_banner_images/'.$newBannerName;
                move_uploaded_file($this->bannerTmpPath,$banner_upload_path);
            }

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $emailData = $this->ngoEmail;
            $ouidData = $this->ouid;
            $nameData = $this->ngoName;
            $registrationNumberData = $this->registrationNumber;
            $addresslineData = $this->addressLine;
            $cityData = $this->city;
            $stateData = $this->state;
            $postCodeData = $this->postalCode;
            $profilePathData = $newImageName;
            $bannerPathData = $newBannerName;
            $bioData = $this->bio;
            $urlData = $this->websiteURL;
            $categoryData = $this->category;
            $ngoStatusData = "listed";

            // bind the values so that it can be use in the query
            $stmt->bindParam(":ouid", $ouidData);
            $stmt->bindParam(":emailAddress", $emailData);
            $stmt->bindParam(":name", $nameData);
            $stmt->bindParam(":registerNumber", $registrationNumberData);
            $stmt->bindParam(":addressLine", $addresslineData);
            $stmt->bindParam(":city", $cityData);
            $stmt->bindParam(":state", $stateData);
            $stmt->bindParam(":postCode", $postCodeData);
            $stmt->bindParam(":profilePath", $profilePathData);
            $stmt->bindParam(":bannerPath", $bannerPathData);
            $stmt->bindParam(":bio", $bioData);
            $stmt->bindParam(":url", $urlData);
            $stmt->bindParam(":category", $categoryData);
            $stmt->bindParam(":ngoStatus", $ngoStatusData);

            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }
    }
?>