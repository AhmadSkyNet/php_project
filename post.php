<?php include "header.php"; ?>

<?php
  if(isset($_GET['p'])){
  $id=$_GET['p'];
  }
?>

<div class="container">
  <div class="row justify-content-center"> 
    <div class="col-lg-10 pt-5"> 
        <?php
          $query = "SELECT * FROM posts WHERE post_id = '$id' ORDER BY post_id DESC";
                $select_posts = $conn->prepare($query);  
                $select_posts->execute();
                while($row = $select_posts->fetch()){
                $post_id            = $row['post_id'];
                $post_title         = $row['post_title'];
                $post_status        = $row['post_status'];
                $post_image         = $row['post_image'];
                $post_content       = $row['post_content'];
                $post_tags          = $row['post_tags'];
                $post_date          = $row['post_date']; 
        ?>

                <div class="card">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $post_title ; ?></h5>
                    <p class="card-text"><?php echo $post_content ; ?></p>
                    <p class="card-text"><?php echo "Tags: $post_tags"; ?></p>
                  </div> 
                  <p class="card-text ms-3 pb-1"><small class="text-muted"><i class="bi bi-clock-history"></i> <?php echo $post_date ; ?></small></p>
                </div>
          <?php } ?>
    </div>
    
    <div class="col-lg-10 pt-5">
      <?php
              $query = "SELECT * FROM cate WHERE cat_id = '$id'  ORDER BY cat_id DESC ";
              $select_cats = $conn->prepare($query);  
              $select_cats->execute();

              while($row = $select_cats->fetch()){
              $cat_id            = $row['cat_id'];
              $cat_title         = $row['cat_title'];
              $cat_status        = $row['cat_status'];
              $cat_image         = $row['cat_image'];
              $cat_content       = $row['cat_content']; 
              $cat_date          = $row['cat_date'];
      ?>
      <div class="col">
        <div class="card h-100">
              <div class="card-body text-center">
                  <h5 class="card-title"><?php echo $cat_title ; ?></h5>
                  <p class="card-text"><?php echo $cat_content ; ?></p>
                </div>
                <div class="card-footer">
                  <small class="text-muted"><i class="bi bi-clock-history"></i> <?php echo $cat_date ; ?></small>
                </div>
          </div>
      </div>
     <?php } ?>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <?php if (!empty ($_SESSION['username'])) { // here is if Statement to Hide the reply box from visitors ?>
      <form method="post">
        <h2 class="text-success m-2">Right A Comment</h2>
        <input type="text" value="<?php echo $_SESSION['username'] ?>" name="username" placeholder="Name" class="form-control m-2" required>
        <input type="email" value="<?php echo $_SESSION['email'] ?>" name="email" placeholder="Email" class="form-control m-2" required>
        <textarea name="comment" class="form-control m-2" id="" cols="15" rows="5"></textarea>
        <button type="submit" value="" name="submit" class="btn btn-dark ms-2">Send</button>
      </form>
      <?php }?>

      <?php
      if(isset($_POST['submit'])){
        $username=trim($_POST['username']);
        $email=trim($_POST['email']);
        $comment=trim($_POST['comment']);

        $query="INSERT INTO comments(comment_user,comment_date,comment_content,comment_status,comment_post_id,comment_email)VALUES(?,now(),?,?,?,?)";
                $select_posts = $conn->prepare($query);  
                $select_posts->execute([$username, $comment, 'unapprove', $id, $email]);
       }
      ?>
    </div>
  </div>

  <div class="row justify-content-center"> 
    <div class="col-lg-8 p-3">
      <div class="comm">
          <?php  
            $query = "SELECT * FROM comments WHERE comment_post_id = $id AND number_of_comment=0 AND comment_status = 'approve' ORDER BY comment_id DESC";
            $select_posts = $conn->prepare($query);  
            $select_posts->execute();
            while($row = $select_posts->fetch()){
                    $comment_id      = $row['comment_id'];
                    $comment_user    = $row['comment_user'];
                    $comment_date    = $row['comment_date'];
                    $comment_email   = $row['comment_email'];
                    $comment_content = $row['comment_content'];
          ?>
                  <div class="border border-success p-3 mb-2 border-opacity-50">
                    <div class="body">
                      <h6><i class="bi bi-person-circle"></i> <?php echo $comment_user; ?></h6>
                      <p><i class="bi bi-chat-right-text-fill"></i> <?php echo $comment_content; ?></p>
                      <small><i class="bi bi-clock-history"></i> <?php echo $comment_date; ?></small>
                    </div>
                    <form method="post">
                      <h2 class="text-success m-2">Reply Comment</h2>
                      <input type="text" value="<?php echo $_SESSION['username'] ?>" name="username" placeholder="Name" class="form-control m-2" required>
                      <input type="email" value="<?php echo $_SESSION['email'] ?>" name="email" placeholder="Email" class="form-control m-2" required>
                      <textarea name="ReplyComment" class="form-control m-2" id="" cols="15" rows="3"></textarea>
                      <input type="hidden" name="number" value="<?php echo $comment_id ?>">
                      <button type="submit" value="" name="Reply" class="btn btn-dark ms-2">Reply</button>
                    </form>
                    <?php  
                    $query = "SELECT * FROM comments WHERE number_of_comment=$comment_id ORDER BY comment_id DESC";
                    $select_Comment = $conn->prepare($query);  
                    $select_Comment->execute();
                    while($row = $select_Comment->fetch()){
                      $comment_id      = $row['comment_id'];
                      $comment_user    = $row['comment_user'];
                      $comment_date    = $row['comment_date'];
                      $comment_email   = $row['comment_email'];
                      $comment_content = $row['comment_content'];
                      $ReplyComment = $row['reply_comment'];
                      $number_of_comment = $row['number_of_comment'];
                      ?>
                    <div class="body p-2 mb-2">
                      <h6><i class="bi bi-person-circle"></i> <?php echo $comment_user; ?></h6>
                      <p><i class="bi bi-chat-right-text-fill"></i> <?php echo $ReplyComment; ?></p>
                      <small><i class="bi bi-clock-history"></i> <?php echo $comment_date; ?></small>
                    </div>
                  <?php } ?> 
          </div>
          <?php } ?> 
                   <?php
                      if(isset($_POST['Reply'])){
                        $username=trim($_POST['username']);
                        $email=trim($_POST['email']);
                        $ReplyComment=trim($_POST['ReplyComment']);
                        $number_of_comment= $_POST['number'];
                        $query="INSERT INTO comments(comment_user,comment_date,reply_comment,comment_status,comment_email,number_of_comment)VALUES(?,now(),?,?,?,?)";
                              $input_commet = $conn->prepare($query);  
                              $input_commet->execute([$username, $ReplyComment, 'unapprove', $email,$number_of_comment]);
                      }
                   ?>
        </div>
    </div>
  </div>
</div>
<br></br>
<!-- <script type="text/javascript">
          var start = 0;
          var limit = 3;
          var reachedMax = false;
          $(window).scroll(function () {
              if ($(window).scrollTop() == $(document).height() - $(window).height())
                  getData();
               });
          $(document).ready(function () {
               getData();
            });
          function getData() {
            if (reachedMax)
                return;
          $.ajax({
                  url: 'loadcomment.php',
                  method: 'POST',
                  data: {
                       getData: "getcomment",
                       start: start,
                       limit: limit,
                       id:<?php// echo $id?>
                       },
            success: function(response) {
                  if (response == "reachedMax")
                      reachedMax = true;
                  else {
                      start += limit ;
                      $(".comm").append(response);
                    }
                    }
                });
            }
        </script>  -->
<?php include "footer.php"; ?>
