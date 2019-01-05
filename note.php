<?php
include 'connect.php';
include 'header.php';
if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
         $query="insert into chapter (`FILE_NAME`,`FILE_SIZE`,`FILE_TYPE`) VALUES($file_name','$file_size','$file_type'); ";
        $desired_dir="upload";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
		 mysqli_query($conn,$query);			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		echo "Success";
    
    	}
}
?>

<div class="video-menu" style="height: 70px;">
 <ul>
 <a href="teacher_dashboard.php"><li> Classes
  </li></a>
  <a href="my_upload.php"><li>
    My Uploads
  </li></a>
  <a href="my-notes.php"><li style="background: #555";>
   Add Notes
  </li></a>
  <a href="add_topic.php"><li>
    Add Topic
  </li></a></ul>

</div>
<div class="login-form">
<form action="" method="POST" enctype="multipart/form-data">
Click Here to Upload PDF--> 
	<input type="file" name="files[]" multiple/>
	<input type="submit"/><br>
Click Here to Upload DOCUMENT--> 
    <input type="file" name="files[]" multiple/>
    <input type="submit"/><br>  
    Click Here to Upload TextFile--> 
    <input type="file" name="files[]" multiple/>
    <input type="submit"/>
    </form>
    </div>
</form>
