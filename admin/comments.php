<?php include "nav.php"; ?>
  <div class="col-9">
    <div class="container">
      <h1 class="mt-5"><i class="bi bi-chat-square-fill"></i> Comments</h1>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">User</th>
              <th scope="col">Content</th>
              <th scope="col">Reply</th>
              <th scope="col">Status</th>
              <th scope="col">Date</th>
              <th scope="col">Email</th>
              <th scope="col">Approve</th>
              <th scope="col">Unapprove</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                    $query = "SELECT * FROM comments ORDER BY comment_id DESC";
                    $result = $conn->prepare($query);  
                    $result->execute();
                    while($row = $result->fetch()){
                        $comment_id       = $row['comment_id'];
                        $comment_user     = $row['comment_user'];
                        $comment_date     = $row['comment_date'];
                        $comment_content  = substr($row['comment_content'],0,20);
                        $ReplyComment     = substr($row['reply_comment'],0,20);
                        $comment_status	  = $row['comment_status'];
                        $comment_post_id  = $row['comment_post_id'];
                        $number_of_comment  = $row['number_of_comment'];
                        $comment_email    = $row['comment_email'];
                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_user</td>";
                    echo "<td><a class='text-dark' href='../post.php?p=$comment_post_id'>$comment_content</a></td>";
                    echo "<td>$ReplyComment</td>";
                    echo "<td>$comment_status</td>";
                    echo "<td>$comment_date</td>";
                    echo "<td>$comment_email</td>";
                    echo "<td><a class='text-dark' href='comments.php?app=$comment_id'>Approve</a></td>";
                    echo "<td><a class='text-dark' href='comments.php?unapp=$comment_id'>Unapprove</a></td>";
                    echo "<td><a class='text-dark' href='edit_comment.php?edit=$comment_id'>Edit</a></td>";
                    echo "<td><a class='text-dark' href='comments.php?del=$comment_id'>Delete</a></td>";
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
    $query="DELETE FROM comments WHERE comment_id = $del";
    $result = $conn->prepare($query);    
    $result->execute();    
    header("location: comments.php");
    }

    if(isset($_GET['app'])){
        $app= $_GET['app'];
        $query="UPDATE comments set comment_status = ? WHERE comment_id = ?";
        $result = $conn->prepare($query);    
        $result->execute(['approve',$app]);    
        header("location: comments.php");
    }
    
    if(isset($_GET['unapp'])){
            $unapp= $_GET['unapp'];
            $query="UPDATE comments set comment_status = ? WHERE comment_id = ?";
            $result = $conn->prepare($query);    
            $result->execute(['unapprove',$unapp]);    
            header("location: comments.php");
    }
?>
</br></br>
<?php include "../footer.php";?>