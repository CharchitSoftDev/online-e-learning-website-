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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # code...
  include 'connect.php';
  if (isset($_POST['name']) && isset($_POST['num']) && isset($_POST['select']) && isset($_POST['email']) && isset($_POST['pass'])) {
    # code...
    $all_ok = 1;
    $msg = "";
    $name = $_POST['name'];
    $num = $_POST['num'];
    $sel=$_POST['select'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $all_ok = 0;
        $msg = "INVALID EMAIL.";
    }

    if (!(strlen($num) == 10)) {
      # code...
      $all_ok = 0;
      $msg = "INVALID MOBILE NUMBER.";
    }

    if ($all_ok == 1) {
      # code...
      $insert = "insert into user(name,phone,email,password,status) values('$name',$num,'$email','$pass',0)";
      if ($conn->query($insert) === true) {
        # code...
        ?>
          <script>
            alert("Successully registered. Please select your area of Intrest.");
            window.location.assign("dashboard.php");
          </script>
        <?php
      }else {
        echo $conn->error;
        ?>
          <script>
            alert("You Seems like already registered. Please login or use forgot password link if you have forgot it.");
          </script>
        <?php
      }
    }else {
      ?>
        <script>
          alert("<?php echo $msg; ?>");
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

?>

<div class="login-form">
<center>
  <h2> Register Here to get Full access of our content </h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="text" placeholder="Name:[A-Z]" name="name" autocomplete="off" required="yes" pattern="[A-Za-z\\s]*" />
    <input type="number" placeholder="10 digit mobile number" name="num" autocomplete="off" required="yes" />
      <div id="ck1">
      <select id="soflow" name="select"> 
     <option>GENDER</option>
     <option>MALE</option>
     <option>FEMALE</option>
     </select>
      </div>
    <input type="email" placeholder="E-Mail" name="email" autocomplete="off" required="yes" />
    <input type="password" placeholder="Password" name="pass" autocomplete="off" required="yes" />
    <button type="submit">REGISTER as Student</button>
  </form>
  <a href="login.php"><button>Already registered? Login</button></a>
    </center>
</div>

<?php include 'footer.php'; ?>
