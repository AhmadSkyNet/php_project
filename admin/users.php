<?php include "nav.php"; ?>
  <div class="col-9">
    <div class="container">
      <h1 class="mt-5"><i class="bi bi-person-fill-gear"></i> Members</h1>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Admin</th>
              <th scope="col">User</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                    $query = "SELECT * FROM users ORDER BY user_id DESC";
                    $result = $conn->prepare($query);  
                    $result->execute();
                    while($row = $result->fetch()){
                        $user_id       = $row['user_id'];
                        $user_name	   = $row['user_name'];
                        $user_email    = $row['user_email'];
                        $user_role     = $row['user_role'];
                        echo "<tr>";
                        echo "<td>$user_id</td>";
                        echo "<td>$user_name</td>";
                        echo "<td>$user_email</td>";
                        echo "<td>$user_role </td>";
                        echo "<td><a class='text-dark' href='users.php?ap=$user_id'>Admin</a></td>";
                        echo "<td><a class='text-dark' href='users.php?unap=$user_id'>User</a></td>";
                        echo "<td><a class='text-dark' href='edit_user.php?edit=$user_id'>Edit</a></td>";
                        echo "<td><a class='text-dark' href='users.php?del=$user_id'>Delete</a></td>";
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
    $query="DELETE FROM users WHERE user_id = $del";
    $result = $conn->prepare($query);    
    $result->execute();    
    header("location: users.php");
    }

    if(isset($_GET['ap'])){
        $ap=$_GET['ap'];
        $query="UPDATE users SET user_role = 'admin' WHERE user_id = $ap";
        $result = $conn->prepare($query);  
        $result->execute();
            header("location: users.php");
    }
    
    if(isset($_GET['unap'])){
        $unap=$_GET['unap'];
        $query="UPDATE users SET user_role = 'user' WHERE user_id = $unap";
        $result = $conn->prepare($query);  
        $result->execute();
        header("location: users.php");
    }

    if($_SESSION['user_role'] != 'admin'){ 
        header("location: index.php");

      }
?>
</br></br>
<?php include "../footer.php";?>

