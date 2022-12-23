<?php include "header.php"; ?> <!--import the header file -->
<br></br>

<div class="container">
  <div class= "row">
   <div class= "col-lg-8"> <!-- start of posts! -->
   <?php
        $sql = "SELECT * FROM posts ORDER BY post_id DESC"; //The DESC command is used to sort the data returned in descending order.
                $stmt = $conn->prepare($sql);  
                $stmt->execute();
                foreach($stmt->fetchall() as $key => $value){
                $post_id            = $value['post_id'];
                $post_title         = $value['post_title'];
                $post_status        = $value['post_status'];
                $post_image         = $value['post_image'];
                $post_content       = substr($value['post_content'],0,100); //The substr() function returns a part of a string. substr(string,start,length)
                $post_tags          = $value['post_tags'];
                $post_date          = $value['post_date']; 
   ?>
    <br></br>
   <?php  if ($key%2==0) { ?>
    <div class= "row">
      <div class= "col-lg-6">
        <div class="card mb-3">
          <div class="row g-0">
             <div class="col-4">
                <img src="images/<?php echo $post_image ; ?>" class="img-fluid rounded-start" alt="..." width="180" height="300">
             </div>
             <div class="col-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $post_title ; ?></h5>
                  <p class="card-text"><?php echo $post_content ; ?></p>
                  <p class="card-text"><?php echo $post_tags ; ?></p>
                  <p class="card-text"><small class="text-muted"><?php echo $post_date ; ?></small></p>
                  <a href="post.php?p=<?php echo $post_id ; ?>" class="btn btn-primary">Read more</a>
                </div>
              </div>
           </div>
        </div>  
     </div>
     <?php }  else {?>
      <div class= "col-lg-6">
        <div class="card mb-3">
          <div class="row g-0">
             <div class="col-4">
                <img src="images/<?php echo $post_image ; ?>" class="img-fluid rounded-start" alt="..." width="180" height="300">
             </div>
             <div class="col-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $post_title ; ?></h5>
                  <p class="card-text"><?php echo $post_content ; ?></p>
                  <p class="card-text"><?php echo $post_tags ; ?></p>
                  <p class="card-text"><small class="text-muted"><?php echo $post_date ; ?></small></p>
                  <a href="post.php?p=<?php echo $post_id ; ?>" class="btn btn-primary">Read more</a>
                </div>
              </div>
           </div>
        </div>  
     </div>
   </div>
   <?php } ?>
   <?php } ?>
   </div> <!-- end of posts! -->
   
   
   <div class="col-lg-4 mt-5">  <!-- start of category! -->
          <?php
          $query = "SELECT * FROM cate WHERE cat_status = 'published' ORDER BY cat_id DESC LIMIT 4";
          $select_cats = $conn->prepare($query);  
          $select_cats->execute();

          while($row = $select_cats->fetch()){
          $cat_id            = $row['cat_id'];
          $cat_title         = $row['cat_title'];
          $cat_status        = $row['cat_status'];
          $cat_image         = $row['cat_image'];
          $cat_content       = substr($row['cat_content'],0,50); 
          $cat_date          = $row['cat_date'];
          ?>

     <div class="col">
     <div class="card h-100">
         <img src="images/<?php echo $cat_image ; ?>" class="card-img-top" alt="..." width="300" height="300">
         <div class="card-body">
            <h5 class="card-title"><?php echo $cat_title ; ?></h5>
            <p class="card-text"><?php echo $cat_content ; ?></p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
          <div class="card-footer">
            <small class="text-muted"><?php echo $cat_date ; ?></small>
          </div>
     </div>
    </div>
    <br></br>
        <?php } ?>
    </div> <!-- end of category! -->
   
  </div>
</div>
<br></br>

<?php include "footer.php"; ?> <!--import the footer file -->
