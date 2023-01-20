<?php include "nav.php"; ?>
  <div class="col-9">
    <div class="container">
      <h1 class="mt-5"><i class="bi bi-book"></i> Category</h1>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Status</th>
              <th scope="col">Image</th>
              <th scope="col">Date</th>
              <th scope="col">Published</th>
              <th scope="col">Draft</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                    $query = "SELECT * FROM cate ORDER BY cat_id DESC";
                    $result = $conn->prepare($query);  
                    $result->execute();
                    while($row = $result->fetch()){
                        $cat_id            = $row['cat_id'];
                        $cat_title         = $row['cat_title'];
                        $cat_status        = $row['cat_status'];
                        $cat_image         = $row['cat_image'];
                        $cat_content       = substr($row['cat_content'],0,70);
                        $cat_date          = $row['cat_date'];
                    echo "<tr>";
                    echo "<td>$cat_id</td>";
                    echo "<td>$cat_title</td>";
                    echo "<td>$cat_content</td>";
                    echo "<td>$cat_status</td>";
                    echo "<td><img width='100' src='../images/$cat_image'></td>";
                    echo "<td>$cat_date</td>";

                    /* --This easy and simple way--
                    echo "<td><a class='text-dark' href='cate.php?app=$cat_id'>Published</a></td>";
                    echo "<td><a class='text-dark' href='cate.php?unapp=$cat_id'>Draft</a></td>";
                    echo "<td><a class='text-dark' href='edit_cate.php?edit=$cat_id'>Edit</a></td>";
                    echo "<td><a class='text-dark' href='cate.php?del=$cat_id'>Delete</a></td>";
                    */
               ?>
                    <!-- This is the smart way -->
                    <form method="post">
                    <input type="hidden" name="app" value="<?php echo $cat_id ?>">
                    <td> <button class='text-dark'>Published</button></td>
                    </form>
                    <form method="post">
                    <input type="hidden" name="unapp" value="<?php echo $cat_id ?>">
                    <td> <button class='text-dark'>Draft</button></td>
                    </form>
                <?php  echo "<td><a class='text-dark' href='edit_cate.php?edit=$cat_id'><button class='text-dark'>Edit</button></a></td>"; ?>
                    <form method="post">
                    <input type="hidden" name="del" value="<?php echo $cat_id ?>">
                    <td> <button class='text-dark'>Delete</button></td>
                    </form>
                <?php    
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

/* --This easy and simple way-- we use $_GET

    if(isset($_GET['del'])){
    $del = $_GET['del'];
    $query="DELETE FROM cate WHERE cat_id = $del";
    $result = $conn->prepare($query);    
    $result->execute();    
    header("location: cate.php");
    }

    if(isset($_GET['app'])){
        $app= $_GET['app'];
        $query="UPDATE cate set cat_status = ? WHERE cat_id = ?";
        $result = $conn->prepare($query);    
        $result->execute(['published',$app]);    
        header("location: cate.php");
    }
    
    if(isset($_GET['unapp'])){
            $unapp= $_GET['unapp'];
            $query="UPDATE cate set cat_status = ? WHERE cat_id = ?";
            $result = $conn->prepare($query);    
            $result->execute(['draft',$unapp]);    
            header("location: cate.php");
    }
     */
  // This is the smart way we use $_POST
  if(isset($_POST['del'])){
    $del = $_POST['del'];
    $query="DELETE FROM cate WHERE cat_id = $del";
    $result = $conn->prepare($query);    
    $result->execute();    
    header("location: cate.php");
    }

    if(isset($_POST['app'])){
        $app= $_POST['app'];
        $query="UPDATE cate set cat_status = ? WHERE cat_id = ?";
        $result = $conn->prepare($query);    
        $result->execute(['published',$app]);    
        header("location: cate.php");
    }
    
    if(isset($_POST['unapp'])){
            $unapp= $_POST['unapp'];
            $query="UPDATE cate set cat_status = ? WHERE cat_id = ?";
            $result = $conn->prepare($query);    
            $result->execute(['draft',$unapp]);    
            header("location: cate.php");
    }
?>
</br></br>
<?php include "../footer.php";?>
