<?php include 'header.php';

if (isset($_COOKIE['email'])) {
  # code...
  ?>
  <script>
    alert("already Logged in. Redirecting you to Dashboard.");
    window.location.assign("dashboard.php");
  </script>
  <?php
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  # code...
  include 'connect.php';
  if (isset($_POST['email']) && isset($_POST['pass'])) {
    # code...
    $email = test_input($_POST['email']);
    $pass = test_input($_POST['pass']);
    $sql = "select * from user where email='$email' and password='$pass'";
    $sql1 = "select * from teacher where temail= '$email' and password ='$pass'";
    $result = $conn->query($sql);
    $res = $conn->query($sql1);
    if ($result->num_rows > 0) {
      ?>
      <script>
        window.location.assign("log.php?in=<?php echo $email; ?>");
      </script>
      <?php
    }elseif ($res->num_rows>0) {
      ?>
      <script>
        window.location.assign("log.php?te=<?php echo $email; ?>")
      </script>
    }
      <?php
    }else {
      ?>
      <script>
        alert("wrong Details. Please check type your Details carefully.");
      </script>
      <?php
    }
  }else {

    ?>
    <script>
      alert("Fields cannot be left blank please fill your Details");
    </script>
    <?php
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<div class="login-form">
<center>
  <h2> Login to your Account </h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="email" placeholder="E-Mail" name="email" autocomplete="off" required="yes" />
    <input type="password" placeholder="Password" name="pass" autocomplete="off" required="yes" />
    <button type="submit">LOGIN</button>
  </form>
  <h3>Forgot Password?</h3>
  <a href="register.php"><button>Not Registered? Register Here</button></a>
</center>
</div>

<?php include 'footer.php'; ?>
