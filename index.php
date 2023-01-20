<?php include "header.php"; ?> <!--import the header file -->
<br></br>

<div class="container">
  <div class= "row">
    <div class= "col-lg-8"> <!-- start of posts! -->
      <?php

      if (isset($_GET['page'])) { // this is for number of pages
        $page_post = $_GET['page'];
      } else {
        $page_post = 1;
      }
      $no_of_records_per_page = 6; // You can always manage the number of records to be displayed in a page by changing the value
      $offset = ($page_post-1) * $no_of_records_per_page;

      $total_pages_sql = "SELECT COUNT(*) FROM posts";
      $result = $conn->prepare($total_pages_sql);  
      $result->execute();
      $total_rows = $result->fetchColumn();
      $total_pages = ceil($total_rows / $no_of_records_per_page);


            $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $offset, $no_of_records_per_page"; //The DESC command is used to sort the data returned in descending order.
                    $stmt = $conn->prepare($sql);  
                    $stmt->execute();
                    foreach($stmt->fetchall() as $key => $value){
                    $post_id            = $value['post_id'];
                    $post_title         = $value['post_title'];
                    $post_status        = $value['post_status'];
                    $post_image         = $value['post_image'];
                    $post_content       = substr($value['post_content'],0,90); //The substr() function returns a part of a string. substr(string,start,length)
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
                    <img src="images/<?php echo $post_image ; ?>" class="img-fluid rounded-start" alt="..." style="width:210px; height:300px;">
                 </div>
                <div class="col-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $post_title ; ?></h5>
                      <p class="card-text"><?php echo $post_content ; ?></p>
                      <p class="card-text"><?php echo $post_tags ; ?></p>
                      <p class="card-text"><small class="text-muted"><i class="bi bi-clock-history"></i> <?php echo $post_date ; ?></small></p>
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
                    <img src="images/<?php echo $post_image ; ?>" class="img-fluid rounded-start" alt="..." style="width:210px; height:300px;">
                 </div>
                 <div class="col-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $post_title ; ?></h5>
                      <p class="card-text"><?php echo $post_content ; ?></p>
                      <p class="card-text"><?php echo $post_tags ; ?></p>
                      <p class="card-text"><small class="text-muted"><i class="bi bi-clock-history"></i> <?php echo $post_date ; ?></small></p>
                      <a href="post.php?p=<?php echo $post_id ; ?>" class="btn btn-primary">Read more</a>
                    </div>
                  </div>
              </div>
            </div>  
        </div>
     </div>
      <?php } ?>
      <?php } ?>
                <!-- Pagination start -->
                <nav aria-label="Page navigation posts">
          <ul class="pagination justify-content-center mt-2">
            <li class="page-item">
              <a class="page-link" href="?page=1" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item <?php if($page_post <= 1){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($page_post <= 1){ echo '#'; } else { echo "?page=".($page_post - 1); } ?>">Prev</a>
            </li>
            <li class="page-item <?php if($page_post >= $total_pages){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($page_post >= $total_pages){ echo '#'; } else { echo "?page=".($page_post + 1); } ?>">Next</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $total_pages; ?>" aria-label="Last">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- Pagination end -->
    </div> <!-- end of posts! -->
   

   <div class="col-lg-4 mt-5">  <!-- start of category! -->
      <?php
            $query = "SELECT * FROM cate WHERE cat_status = 'published' ORDER BY cat_id DESC LIMIT 5";
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
          <img src="images/<?php echo $cat_image ; ?>" class="card-img-top" alt="..." style="object-fit: fill;">
          <div class="card-body">
              <h5 class="card-title"><?php echo $cat_title ; ?></h5>
              <p class="card-text"><?php echo $cat_content ; ?></p>
              <a href="post.php?p=<?php echo $cat_id  ; ?>" class="btn btn-primary">Read More</a>
            </div>
            <div class="card-footer">
              <small class="text-muted"><i class="bi bi-clock-history"></i> <?php echo $cat_date ; ?></small>
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
