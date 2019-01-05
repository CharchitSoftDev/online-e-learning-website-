<?php include 'header.php';
include 'connect.php';

if (!isset($_COOKIE['email'])) {
  # code...
  ?>
  <script>
    alert("Not Logged in. Please log in first.");
    window.location.assign("login.php");
  </script>
  <?php
}else {
  $email = $_COOKIE['email'];
  $user_sql = "select email,name from user where email = '$email'";
  
  $user_res = $conn->query($user_sql);
  
  if ($user_res->num_rows > 0) {
    # code...
    $user_row = $user_res->fetch_assoc();
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
<!-- <div id="dash-pop" class="dash-pop" data-toggle="modal" data-target="#myModal">Please buy subcription to access these videos<h6 onclick="dashPopHide()">X</h6></div>   -->
<div class="dashboard">
<center>
  <h2>Welcome <?php echo $user_row['name']; ?>! Select your Course. </h2>
  <script>
    dashPopHide();
  </script>
  <a href="chapter.php?b=1"><div style="background: url(images/micro.jpg);color: #333;" class="dash-opt">C++</div></a>
  <a href="chapter.php?b=2"><div style="background: url(images/macro.jpg);color: #f0f8ff;" class="dash-opt">PHP</div></a>
  <a href="chapter.php?b=1"><div style="background: url(images/micro.jpg);color: #333;" class="dash-opt">C Language</div></a>
  <a href="chapter.php?b=2"><div style="background: url(images/macro.jpg);color: #f0f8ff;" class="dash-opt">Java </div></a>
  </center>
</div>
<?php include 'footer.php' ?>