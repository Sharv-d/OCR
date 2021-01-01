
<?php
if(isset($_POST["submit"])){
    //$check = getimagesize($_FILES["image"]["tmp_name"]);
    //if($check !== false){
        $image = $_FILES['image']['tmp_name'];
		
		$name1 = $_POST['Name'];
		$namef = $_FILES['image']['name'];
		$ext = explode('.', $namef);
		$actExt = strtolower(end($ext));
		$all = array('jpg', 'jpeg', 'png', 'pdf');
		if(in_array($actExt, $all)){
            $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */
        
        //DB details
            $dbHost     = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName     = 'uploadfile';
        
        //Create connection and select DB
            $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
        // Check connection
            if($db->connect_error){
                die("Connection failed: " . $db->connect_error);
            }
            $text = $_POST['Name'];
            $dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
            $insert = $db->query("INSERT into uploads (NAME, IMAGE, CREATED) VALUES ('$text', '$imgContent', '$dataTime')");
            if($insert){
             //   echo "File uploaded successfully.";
				echo shell_exec("python main.py");
            }else{
                echo "File upload failed, please try again.";
            } 
		}else{
			echo "File type not allowed";
		}
    //}else{
    //    echo "Please select an image file to upload.";
    //}
}
?>


<!DOCTYPE html>
<html lang="en">
<body>
    <form action="f3.php" method="post" enctype="multipart/form-data">
        Select image to upload:
		<input type="text" name="Name"/>
        <input type="file" name="image"/>
        <input type="submit" name="submit" value="UPLOAD" />
    </form>
</body>
</html>