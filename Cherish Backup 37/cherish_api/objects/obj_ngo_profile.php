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
        public $contactNumber;
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
        public $password;
 
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
                        ngo_email=:emailAddress, ouid=:ouid, ngo_name=:name, register_number=:registerNumber, ngo_contact=:ngoContact,
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
            $ngoContactData = $this->contactNumber;
            $addresslineData = $this->addressLine;
            $cityData = $this->city;
            $stateData = $this->state;
            $postCodeData = $this->postalCode;
            $profilePathData = $newImageName;
            $bannerPathData = $newBannerName;
            $bioData = $this->bio;
            $urlData = $this->websiteURL;
            $categoryData = $this->category;
            $ngoStatusData = $this->status;

            // bind the values so that it can be use in the query
            $stmt->bindParam(":ouid", $ouidData);
            $stmt->bindParam(":emailAddress", $emailData);
            $stmt->bindParam(":name", $nameData);
            $stmt->bindParam(":registerNumber", $registrationNumberData);
            $stmt->bindParam(":ngoContact", $ngoContactData);
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

        function updatePhoto(){
            $query2 = "UPDATE ngo_profile SET profile_path=:profilePathData WHERE ouid=:ouidData";

            // prepare query
            $stmt2 = $this->conn->prepare($query2);

            //we rename the image name that the user give (for simpler file management)
            $fileType=substr($this->profilePath, strpos($this->profilePath, ".")); //this step take the extension of the image file (png,jpg...)
            $newImageName = $this->ouid.uniqid().$fileType;  //this generate the new name for the image, the formula: (userid+image unique id+extension)

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $ouidData = $this->ouid;
            $profilePathData = $newImageName;

            // bind the values so that it can be use in the query
            $stmt2->bindParam(":ouidData", $ouidData);
            $stmt2->bindParam(":profilePathData", $profilePathData);

            // execute query and finishing this query will store the reamining data needed for the profile into the database (incl the image new name)
            if($stmt2->execute()){
                //after having new name, and error is check, the file is then move to the destination path for image storin
                if($this->errorCount == 0){     
                    $img_upload_path = '../../ngo_images/'.$newImageName;
                    move_uploaded_file($this->tmpPath,$img_upload_path);
                }
                return true;
            }
            else{
                return false;
            }
        }

        function updateBanner(){
            $query3 = "UPDATE ngo_profile SET banner_path=:bannerPathData WHERE ouid=:ouidData";

            // prepare query
            $stmt3 = $this->conn->prepare($query3);

            //we rename the image name that the user give (for simpler file management)
            $fileType=substr($this->bannerPath, strpos($this->bannerPath, ".")); //this step take the extension of the image file (png,jpg...)
            $newImageName = $this->ouid.uniqid().$fileType;  //this generate the new name for the image, the formula: (userid+image unique id+extension)

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $ouidData = $this->ouid;
            $bannerPathData = $newImageName;

            // bind the values so that it can be use in the query
            $stmt3->bindParam(":ouidData", $ouidData);
            $stmt3->bindParam(":bannerPathData", $bannerPathData);

            // execute query and finishing this query will store the reamining data needed for the profile into the database (incl the image new name)
            if($stmt3->execute()){
                //after having new name, and error is check, the file is then move to the destination path for image storin
                if($this->errorCount == 0){     
                    $img_upload_path = '../../ngo_banner_images/'.$newImageName;
                    move_uploaded_file($this->bannerTmpPath,$img_upload_path);
                }
                return true;
            }
            else{
                return false;
            }
        
        
        }

        function updateAddress(){

            $newAddressLine = $this->addressLine;
            $newCity = $this->city;
            $newState = $this->state;
            $newPostCode = $this->postalCode;

            $query4 = "SELECT ngo_password FROM ngo_account WHERE ouid=:ouidData";
            $query5 = "UPDATE  ngo_profile SET address_line=:addressLineData, city=:cityData, `state`=:stateData, postal_code=:postCodeData WHERE ouid=:ouidData;";

            $stmt4 = $this->conn->prepare($query4);
            $stmt5 = $this->conn->prepare($query5);

            $stmt4->bindParam(":ouidData",$this->ouid);
            $stmt5->bindParam(":addressLineData",$newAddressLine);
            $stmt5->bindParam(":cityData",$newCity);
            $stmt5->bindParam(":stateData",$newState);
            $stmt5->bindParam(":postCodeData",$newPostCode);
            $stmt5->bindParam(":ouidData",$this->ouid);

        
            $stmt4->execute();

            $row = $stmt4->fetch(PDO::FETCH_ASSOC);

            if($row){
                if(password_verify($this->password, $row['ngo_password'])){
                    $stmt5->execute();
                    echo"Address Changed";
                    return true;
                }
                else{
                    echo"Address Not Changed";
                    return false;
                }
            }
            else{
                return false;
            }
        }

        function updateBio(){

            $newBio = $this->bio;

            $query6 = "UPDATE ngo_profile SET ngo_bio=:bioData WHERE ouid=:ouidData;";

            $stmt6 = $this->conn->prepare($query6);

            $stmt6->bindParam(":ouidData",$this->ouid);
            $stmt6->bindParam(":bioData",$newBio);
           
        
            if($stmt6->execute()){
                echo"bio changed";
                return true;
            }
            else{
                echo"bio not change";
                return false;
            }
        }

        function updateWebsite(){

            $newURL = $this->websiteURL;

            $query7 = "UPDATE ngo_profile SET ngo_url=:urlData WHERE ouid=:ouidData;";

            $stmt7 = $this->conn->prepare($query7);

            $stmt7->bindParam(":ouidData",$this->ouid);
            $stmt7->bindParam(":urlData",$newURL);
           
        
            if($stmt7->execute()){
                echo"url changed";
                return true;
            }
            else{
                echo"url not change";
                return false;
            }
        }

        function updateNgoStatus(){


            $query8 = "UPDATE ngo_profile SET ngo_status=:ngoStatus WHERE ouid=:ouidData;";

            $stmt8 = $this->conn->prepare($query8);

            $stmt8->bindParam(":ouidData",$this->ouid);
            $stmt8->bindParam(":ngoStatus",$this->status);
           
        
            if($stmt8->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        function updateDirectContact(){

            $query9 = "UPDATE  ngo_profile SET ngo_contact=:contactNumberData WHERE ouid=:ouidData;";

            $stmt9 = $this->conn->prepare($query9);

            $stmt9->bindParam(":contactNumberData",$this->contactNumber);
            $stmt9->bindParam(":ouidData",$this->ouid);

            if($stmt9->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>

