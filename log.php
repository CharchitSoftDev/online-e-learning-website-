<?php
  if (isset($_GET['in'])) {
    # code...
    $email = $_GET['in'];
    setcookie('email',$email,time()+86400,'/');
    ?>
    <script>
      window.location.assign("dashboard.php");
    </script>
    <?php
  }elseif (isset($_GET['te'])) {
    $email = $_GET['te'];
    setcookie('temail',$email,time()+86400,'/');
    ?>
    <script type="text/javascript">
      window.location.assign("teacher_dashboard.php");
    </script>
  }
    <?php
  }elseif (isset($_GET['out'])) {
    # code...
    setcookie('temail','',time()-86400,'/');
    setcookie('email','',time()-86400,'/');
    ?>
    <script>
      window.location.assign("index.php");
    </script>
    <?php
  }else {
    ?>
    <script>
      window.location.assign("index.php");
    </script>
    <?php
  }
?>
