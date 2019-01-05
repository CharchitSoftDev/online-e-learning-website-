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
    $user_sql = "select * from user where email = '$email'";
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

  if (isset($_GET['ch'])) {
    # code...
    $chapter = $_GET['ch'];

    $book_sql = "select * from chapter where cid = $chapter";
    $book_res = $conn->query($book_sql);
    if ($book_res->num_rows > 0) {
      # code...
      $book_row = $book_res->fetch_assoc();
      if ($book_row['cat'] == $user_row['status'] || $user_row['status'] == 0) {
        # code...
        $bo = $book_row['cat'];
        $chapter_sql = "select * from chapter where cat = $bo";
        $chapter_res = $conn->query($chapter_sql);
        if ($chapter_res->num_rows > 0) {
          # code...
          ?>
          <div class="video-menu">
            <ul>
              <?php
              while ($chapter_row = $chapter_res->fetch_assoc()) {
                # code...
                if ($chapter_row['cid'] == $chapter) {
                  # code...
                  ?>
                  <a href="videos.php?ch=<?php echo $chapter_row['cid'];?>"><li style="background:#555;"><?php echo $chapter_row['name']; ?></li></a>
                  <?php
                }else {
                  ?>
                  <a href="videos.php?ch=<?php echo $chapter_row['cid'];?>"><li><?php echo $chapter_row['name']; ?></li></a>
                  <?php
                }
              }
              ?>
            </ul>
          </div>
          <?php
        }else {
          ?>
          <script>
            alert("Sorry! Wrong Request");
            window.location.assign("dashboard.php");
          </script>
          <?php
        }

        $video_sql = "select * from videos where cid = $chapter";
        $video_res = $conn->query($video_sql);
        if ($video_res->num_rows > 0) {
          # code...
          $curr = 0;
          ?>
          <div class="videos">
            <center>
              <?php
              while ($video_row = $video_res->fetch_assoc()) {
                # code...
                if ($curr == 0) {
                  # code...
                  ?>
                  <h2><?php echo $video_row['name']; ?></h2>
                  <?php if ($book_row['doc'] != 0): ?>

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Download Attachment</h4>
                </div>
                <div class="modal-body">
                  <?php
                    if ($book_row['doc'] == 1) {
                      # code...
                      ?>
                      <!-- <p>We have Attached an Important Questions PDF file for you to explain more.</p> -->
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                      <?php
                    }elseif ($book_row['doc'] == 2) {
                      # code...
                      ?>
                      <!-- <p>We have Attached an Explaination PDF file for you to explain more.</p> -->
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                      <?php
                    }
                  ?>
                </div>
              
                  
                   <!--  <button style="width:60%;min-width:300px;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalChap">Document Available</button> -->
                  <?php endif; ?>
                    <div class="current-playing">
                      <iframe src="<?php echo $video_row['link']; ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                  <?php
                  $curr = $video_row['vid'];
                }
              }
              ?>
              <div class="playlist">
                <ul>
              <?php
              $playlist_sql = "select * from videos where cid = $chapter";
              $playlist_res = $conn->query($playlist_sql);
              while ($playlist_row = $playlist_res->fetch_assoc()) {
                if ($playlist_row['vid'] == $curr) {
                  # code...
                  ?>
                    <a href="videos.php?v=<?php echo $playlist_row['vid']?>"><li style="background:#f5f5f5;color:#555;"><?php echo $playlist_row['name']; ?></li></a>
                  <?php
                }else {
                  ?>
                    <a href="videos.php?v=<?php echo $playlist_row['vid']?>"><li><?php echo $playlist_row['name']; ?></li></a>
                  <?php
                }
              }
              ?>
                </ul>
              </div>
            </center>
          </div>

          <div class="modal fade" id="myModalChap" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Download Attachment</h4>
                </div>
                <div class="modal-body">
                  <?php
                    if ($book_row['doc'] == 1) {
                      # code...
                      ?>
                      <p>We have Attached an Important Questions PDF file for you to explain more.</p>
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                      <?php
                    }elseif ($book_row['doc'] == 2) {
                      # code...
                      ?>
                      <p>We have Attached an Explaination PDF file for you to explain more.</p>
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                      <?php
                    }
                  ?>
                </div>
              </div>
              <!-- Modal content-->

            </div>
          </div>

          <?php
        }else {
          ?>
          <script>
            alert("No videos in this chapter. Please check after some time");
            window.location.assign("dashboard.php");
          </script>
          <?php
        }

      }else {
        ?>
        <script>
          alert("Not subscribed to this service. Please subscribe to access this section.");
          window.location.assign("dashboard.php");
        </script>
        <?php
      }
    }else {
      ?>
      <script>
        alert("Sorry! Wrong Request");
        window.location.assign("dashboard.php");
      </script>
      <?php
    }

  }elseif (isset($_GET['v'])) {
    # code...
    $vid = $_GET['v'];
    $ch_sql = "select * from videos where vid = $vid";
    $ch_res = $conn->query($ch_sql);
    if ($ch_res->num_rows > 0) {
      # code...
      $ch_row = $ch_res->fetch_assoc();
      $book = $ch_row['book'];
      $chapter = $ch_row['cid'];

      $book_sql = "select * from chapter where cat = $book";
      $book_res = $conn->query($book_sql);
      if ($book_res->num_rows > 0) {
        # code...
        ?>
        <div class="video-menu">
          <ul>
            <?php
            while ($book_row = $book_res->fetch_assoc()) {
              # code...
              if ($book_row['cid'] == $chapter) {
                # code...
                ?>
                <a href="videos.php?ch=<?php echo $book_row['cid'];?>"><li style="background:#555;"><?php echo $book_row['name']; ?></li></a>
                <?php
              }else {
                ?>
                <a href="videos.php?ch=<?php echo $book_row['cid'];?>"><li><?php echo $book_row['name']; ?></li></a>
                <?php
              }
            }
            ?>
          </ul>
        </div>
        <?php
      }else {
        echo "no chapter in $book";
        ?>
        <script>
          alert("Sorry! Wrong Request");
          window.location.assign("dashboard.php");
        </script>
        <?php
      }

      $video_sql = "select * from videos where cid = $chapter";
      $video_res = $conn->query($video_sql);
      $doc_sql = "select * from chapter where cid = $chapter";
      $doc_res = $conn->query($doc_sql);
      $doc_row = $doc_res->fetch_assoc();
      ?>
      <div class="videos">
        <center>
          <h2><?php echo $ch_row['name']; ?></h2>
         <!--  <?php if ($doc_row['doc'] != 0){ ?>
          <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Download Attachment</h4>
                </div>
                <div class="modal-body">
                  <?php
                    if ($book_row['doc'] == 1) {
                      # code...
                      ?>
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                      <?php
                    }elseif ($book_row['doc'] == 2) {
                      # code...
                      ?>
                      
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                      <?php
                    }
                  ?>
                </div> -->
            <!-- <button style="width:60%;min-width:300px;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Document Available</button> -->
          <?php } ?>
            <div class="current-playing">
              <iframe src="<?php echo $ch_row['link']; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
      <div class="playlist">
        <ul>
      <?php
      while ($video_row = $video_res->fetch_assoc()) {
        if ($video_row['vid'] == $vid) {
          # code...
          ?>
            <a href="videos.php?v=<?php echo $video_row['vid']?>"><li style="background:#f5f5f5;color:#555;"><?php echo $video_row['name']; ?></li></a>
          <?php
        }else {
          ?>
            <a href="videos.php?v=<?php echo $video_row['vid']?>"><li><?php echo $video_row['name']; ?></li></a>
          <?php
        }
      }
      ?>
        </ul>
      </div>
        </center>
      </div>
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Download Attachment</h4>
            </div>
            <div class="modal-body">
              <?php
                if ($doc_row['doc'] == 1) {
                  # code...
                  ?>
                  <p>We have Attached an Important Questions PDF file for you to explain more.</p>
                  <a href="<?php echo $doc_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                  <?php
                }elseif ($doc_row['doc'] == 2) {
                  # code...
                  ?>
                  <p>We have Attached an Explaination PDF file for you to explain more.</p>
                  <a href="<?php echo $doc_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Download Attachment</button></a>
                  <?php
                }
              ?>
            </div>
          </div>
          <!-- Modal content-->

        </div>
      </div>
      <?php

    }else {
      echo "wrong video id";
      ?>
      <script>
        alert("Sorry! Wrong Request");
        window.location.assign("dashboard.php");
      </script>
      <?php
    }
  } else {
    echo "not recieved vid";
    ?>
    <script>
      alert("Sorry! Wrong Request");
      window.location.assign("dashboard.php");
    </script>
    <?php
  }
include 'footer.php'; ?>
