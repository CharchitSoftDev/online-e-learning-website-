<?php include 'header.php';
include 'connect.php';

if (!isset($_COOKIE['temail'])) {
  # code...
  ?>
  <script>
    alert("Not Logged in. Please log in first.");
    window.location.assign("login.php");
  </script>
  <?php
}else {
  $email = $_COOKIE['temail'];
    $user1_sql="select temail,name from teacher where temail = '$email'";
  
  $user1_res= $conn->query($user1_sql);
  if ($user1_res->num_rows>0) {
    # code...
    $user_row = $user1_res->fetch_assoc();
  }else {
    ?>
    <script>
      alert("Not Logged in. Please log in first.");
      window.location.assign("log.php?out");
    </script>
    <?php
  }
}

?>
<div class="video-menu" style="height: 70px;">
 <ul>
 <a href="teacher_dashboard.php"><li style="background: #555;"> Classes</li></a>
  <a href="my_upload.php"><li>
    My Uploads
  </li></a>
 <a href="my-notes.php"><li>
   Add Notes
  </li></a>
  <a href="add_topic.php"><li>
    Add Topic
  </li></a>
  </ul>
</div>
<div class="dashboard">

<center>
  <h2>Welcome <?php echo $user_row['name']; ?>! Add your Class. </h2>
  <a href="teacher_upload.php?t=1"><div style="background: url(images/micro.jpg);color: #333;" class="dash-opt">C++</div></a>
  <a href="teacher_upload.php?t=14"><div style="background: url(images/macro.jpg);color: #f0f8ff;" class="dash-opt">PHP</div></a>
   <a href="teacher_upload.php?t=2"><div style="background: url(images/micro.jpg);color: #333;" class="dash-opt">JAVA</div></a>
  <a href="teacher_upload.php?t=14"><div style="background: url(images/macro.jpg);color: #f0f8ff;" class="dash-opt">C</div></a>
</center>
</div>
<?php include 'footer.php' ?> 