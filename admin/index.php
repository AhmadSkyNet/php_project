<?php include "nav.php"; ?>

  <div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4 mt-4">
      <div class="col">
        <div class="card bg-outline-dark">
          <div class="card-body text-center bg-primary">
                <?php
                  $query = "SELECT COUNT(*) FROM posts ORDER BY post_id DESC";
                  $result = $conn->prepare($query);    
                  $result->execute();   
                  $post_count=$result->fetchcolumn();   
                ?>
                <div class="row"> 
                  <div class="col-2"> 
                    <p class="card-text"><h3><i class="fa-solid fa-file-signature"></i></h3></p>
                  </div>
                  <div class="col"> 
                    <h2><?php echo $post_count ;?> Posts</h2>
                  </div>
                </div>
          </div>
          <div class="card-footer">
              <a href="posts.php" class="text-dark">Details</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card bg-outline-dark">
          <div class="card-body text-center bg-danger">
                <?php
                  $query = "SELECT COUNT(*) FROM comments ORDER BY comment_id DESC";
                  $result = $conn->prepare($query);    
                  $result->execute();   
                  $comment_count=$result->fetchcolumn();   

                ?>
                <div class="row"> 
                  <div class="col-2"> 
                    <p class="card-text"><h3><i class="fa-regular fa-comments"></i></h3></p>
                  </div>
                  <div class="col"> 
                    <h4><?php echo $comment_count ;?> Comments</h4>
                  </div>
                </div>
          </div>
          <div class="card-footer">
            <a href="comments.php" class="text-dark">Details</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card bg-outline-dark">
          <div class="card-body text-center bg-info">
                <?php
                  $query = "SELECT COUNT(*) FROM cate ORDER BY cat_id DESC";
                  $result = $conn->prepare($query);    
                  $result->execute();   
                  $cat_count=$result->fetchcolumn();   
                ?>
            <div class="row"> 
                <div class="col-2"> 
                  <p class="card-text"><h3><i class="fa-solid fa-rectangle-list"></i></h3></p>
                </div>
                <div class="col"> 
                  <h4><?php echo $cat_count ;?> Category</h4>
                </div>
            </div>
          </div>
          <div class="card-footer">
            <a href="cate.php" class="text-dark">Details</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card bg-outline-dark">
          <div class="card-body text-center bg-success">
            <?php
              $query = "SELECT COUNT(*) FROM users ORDER BY user_id DESC";
              $result = $conn->prepare($query);    
              $result->execute();   
              $user_count=$result->fetchcolumn();   
            ?>
            <div class="row"> 
              <div class="col-2"> 
                <p class="card-text"><h3><i class="fa-solid fa-user-plus"></i></h3></p>
              </div>
              <div class="col"> 
                <h4><?php echo $user_count ;?> Users</h4>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <a href="users.php" class="text-dark">Details</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div> <!--end of d-flex on nav.php -->

<div class="table-responsive">
  <div class="col-3 offset-4"> 
    <div id="columnchart_material" style="width: 600px; height: 500px;"></div>
  </div>
</div>
</br>
<?php include "../footer.php";?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['data', 'count'],
          <?php

          $data=['Posts','Comments','Users','Category'];
          $count=[$post_count,$comment_count,$user_count,$cat_count];
          for($i=0;$i<4;$i++){

              echo "['$data[$i]'" . "," . "$count[$i]],";


          }

          ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>