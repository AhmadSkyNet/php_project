<?php include "nav.php"; ?>
  <div class="col-9">
    <div class="container">
      <h1 class="mt-5"><i class="bi bi-book"></i> Posts</h1>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Status</th>
              <th scope="col">Image</th>
              <th scope="col">Tages</th>
              <th scope="col">Date</th>
              <th scope="col">Published</th>
              <th scope="col">Draft</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                $query = "SELECT * FROM posts ORDER BY post_id DESC";
                $result = $conn->prepare($query);  
                $result->execute();
                while($row = $result->fetch()){
                $post_id       = $row['post_id'];
                $post_title    = $row['post_title'];
                $post_status   = $row['post_status'];
                $post_image    = $row['post_image'];
                $post_content  = substr($row['post_content'],0,70);
                $post_tags     = $row['post_tags'];
                $post_date     = $row['post_date'];
                echo "<tr>";
                echo "<td>$post_id</td>";
                echo "<td>$post_title</td>";
                echo "<td>$post_content</td>";
                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../images/$post_image'></td>";
                echo "<td>$post_tags</td>";
                echo "<td>$post_date </td>";
                echo "<td><a class='text-dark' href='posts.php?app=$post_id'>Published</a></td>";
                echo "<td><a class='text-dark' href='posts.php?unapp=$post_id'>Draft</a></td>";
                echo "<td><a class='text-dark' href='edit_post.php?edit=$post_id'>Edit</a></td>";
                echo "<td><a class='text-dark' href='posts.php?del=$post_id'>Delete</a></td>";
                echo "</tr>";
                }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
if(isset($_GET['del'])){
  $del = $_GET['del'];
  $query = "DELETE FROM posts WHERE post_id= $del";
  $result = $conn->prepare($query);  
  $result->execute();
  header("location: posts.php");
}

if(isset($_GET['app'])){
  $app= $_GET['app'];
  $query="UPDATE posts set post_status = ? WHERE post_id = ?";
  $result = $conn->prepare($query);    
  $result->execute(['published',$app]);    
  header("location: posts.php");
}

if(isset($_GET['unapp'])){
      $unapp= $_GET['unapp'];
      $query="UPDATE posts set post_status = ? WHERE post_id = ?";
      $result = $conn->prepare($query);    
      $result->execute(['draft',$unapp]);    
      header("location: posts.php");
}
?>
</br></br>
<?php include "../footer.php";?>