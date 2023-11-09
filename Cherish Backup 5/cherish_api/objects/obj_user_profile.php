<?php
    class Users_profile{
    
        // database connection and table name
        private $conn;
        private $table_name = "user_profile";
    
        // object properties
        public $uid;
        public $name;
        public $bio;
        public $profilePicName;  //this is the name that comes with the uploaded images. (User computer defined)
        public $tmpPath;        //when a file is upload, a temporary path is holding the image.
        public $errorCount; 

    
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
                        uid=:uid, name=:name, bio=:bio, profile_path=:profilePath";
        

            // prepare query
            $stmt = $this->conn->prepare($query);

            //we rename the image name that the user give (for simpler file management)
            $fileType=substr($this->profilePicName, strpos($this->profilePicName, ".")); //this step take the extension of the image file (png,jpg...)
            $newImageName = $this->uid.uniqid().$fileType;  //this generate the new name for the image, the formula: (userid+image unique id+extension)
            
            //after having new name, and error is check, the file is then move to the destination path for image storing
            if($this->errorCount == 0){     
                $img_upload_path = '../../users_images/'.$newImageName;
                move_uploaded_file($this->tmpPath,$img_upload_path);
            }

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $uidData = $this->uid;
            $nameData = $this->name;
            $bioData = $this->bio;
            $profilePathData = $newImageName;
        
            // bind the values so that it can be use in the query
            $stmt->bindParam(":uid", $uidData);
            $stmt->bindParam(":name", $nameData);
            $stmt->bindParam(":bio", $bioData);
            $stmt->bindParam(":profilePath", $profilePathData);
           

            // execute query and finishing this query will store the reamining data needed for the profile into the database (incl the image new name)
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }

        function updateBio(){

            $newBio = $this->bio;

            $query2 = "UPDATE  user_profile SET bio=:bioData WHERE `uid`=:uidData;";

            $stmt2 = $this->conn->prepare($query2);

            $stmt2->bindParam(":uidData",$this->uid);
            $stmt2->bindParam(":bioData",$newBio);
           
        
            if($stmt2->execute()){
                echo"bio changed";
            }
            else{
                echo"bio not change";
            }

        }

        function updatePhoto(){
            $query3 = "UPDATE user_profile SET profile_path=:profilePathData WHERE `uid`=:uidData";

            // prepare query
            $stmt3 = $this->conn->prepare($query3);

            //we rename the image name that the user give (for simpler file management)
            $fileType=substr($this->profilePicName, strpos($this->profilePicName, ".")); //this step take the extension of the image file (png,jpg...)
            $newImageName = $this->uid.uniqid().$fileType;  //this generate the new name for the image, the formula: (userid+image unique id+extension)

            //retrieve data from the obj properties and assign to another variable to prepare for binding
            $uidData = $this->uid;
            $profilePathData = $newImageName;

            // bind the values so that it can be use in the query
            $stmt3->bindParam(":uidData", $uidData);
            $stmt3->bindParam(":profilePathData", $profilePathData);

            // execute query and finishing this query will store the reamining data needed for the profile into the database (incl the image new name)
            if($stmt3->execute()){
                //after having new name, and error is check, the file is then move to the destination path for image storin
                if($this->errorCount == 0){     
                    $img_upload_path = '../../users_images/'.$newImageName;
                    move_uploaded_file($this->tmpPath,$img_upload_path);
                }
                return true;
            }
            else{
                return false;
            }
        }
    }
?>