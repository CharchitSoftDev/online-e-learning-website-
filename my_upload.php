<?php include 'header.php';
    include 'connect.php' ?>
<div class="video-menu" style="height: 70px;">
 <ul>
 <a href="teacher_dashboard.php"><li> Classes
  </li></a>
  <a href="my_upload.php"><li style="background: #555;">
    My Uploads
  </li></a>
 <a href="my-notes.php"><li>
   Add Notes
  </li></a>
   <a href="add_topic.php"><li>
    Add Topic
  </li></a></ul>
</div>
<div class="dashboard">
<?php
$test1="select * from videos";
$user_test1=$conn->query($test1);
while($row = mysqli_fetch_assoc($user_test1)) // While there are still rows, create an array of each
{
    echo "<iframe src='".$row['link']."'></iframe>";
    															 // Write an anchor with the url as href, and text as value/content
}?>