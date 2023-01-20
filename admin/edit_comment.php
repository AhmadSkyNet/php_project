<?php include "nav.php"; ?>
    <div class="col-8">
        <div class="container">
            <h1 class="mt-5"><i class="bi bi-pencil-square"></i> Comment</h1>
            <div class="table-responsive">
                <?php
                    if(isset($_GET['edit'])) {
                        $id=$_GET['edit'];
                    }

                    if(isset($_POST['EDIT'])) {
                        $username  = $_POST['username'];
                        $email     = $_POST['email'];
                        $content   = $_POST['content'];

                        $query = "UPDATE comments SET comment_user = '$username', comment_date = now(), comment_email = '$email', comment_content = '$content' WHERE comment_id = '$id'";
                        $result = $conn->prepare($query);  
                        $result->execute();
                        header("location: comments.php");
                    }
                    $query = "SELECT * FROM comments WHERE comment_id = '$id' ORDER BY comment_id DESC";
                    $result = $conn->prepare($query);  
                    $result->execute();
                    while($row = $result->fetch()){
                        $comment_id        = $row['comment_id'];
                        $comment_user      = $row['comment_user'];
                        $comment_email     = $row['comment_email'];
                        $comment_date      = $row['comment_date'];
                        $comment_content   = $row['comment_content'];
                        $comment_status	   = $row['comment_status'];
                        $comment_post_id   = $row['comment_post_id'];
                    }
                ?>
                <div class="mb-4 ms-2">     
                    <form method="post" enctype="multipart/form-data">    
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $comment_user ; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $comment_email ; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-pencil-square"></i> Content</label>
                            <textarea class="form-control" name="content" rows="6"><?php echo $comment_content ; ?></textarea>
                        </div>
                        <input class="btn btn-primary mb-3" type="submit" name="EDIT" value="EDIT">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../footer.php";?>
