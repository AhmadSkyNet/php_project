<?php include "nav.php"; ?>
    <div class="col-8">
        <div class="container">
            <h1 class="mt-5"><i class="bi bi-pencil-square"></i> Posts</h1>
            <div class="table-responsive">
                <?php
                    if(isset($_GET['edit'])) {
                        $id=$_GET['edit'];
                    }
    
                    if(isset($_POST['EDIT'])) {
                        $post_title        = $_POST['title'];
                        $post_status       = $_POST['post_status'];
                        $post_image        = $_FILES['file']['name'];
                        $post_image_temp   = $_FILES['file']['tmp_name'];
                        $post_tags         = $_POST['post_tags'];
                        $post_content      = $_POST['post_content'];

                        if(empty($post_image)){
                            $query = "SELECT * FROM posts WHERE post_id = '$id'";
                            $result = $conn->prepare($query);  
                            $result->execute();
                            while($row = $result->fetch()){
                                $post_image = $row['post_image'];
                        
                            }
                        }
                        move_uploaded_file($post_image_temp, "../images/$post_image" );
                        $query = "UPDATE posts SET post_title = '$post_title', post_date = now(), post_image = '$post_image',
                        post_content = '$post_content', post_tags = '$post_tags', post_status = '$post_status' WHERE post_id = '$id'";
                        $result = $conn->prepare($query);  
                        $result->execute();
                        header("location: posts.php");
                    }
                    
                    $query = "SELECT * FROM posts WHERE post_id = '$id' ORDER BY post_id DESC";
                    $result = $conn->prepare($query);  
                    $result->execute();
                    while($row = $result->fetch()){
                        $post_id       = $row['post_id'];
                        $post_title    = $row['post_title'];
                        $post_status   = $row['post_status'];
                        $post_image    = $row['post_image'];
                        $post_content  = $row['post_content'];
                        $post_tags     = $row['post_tags'];
                        $post_date     = $row['post_date'];
                    }
                ?>
                <div class="mb-4 ms-2">     
                    <form method="post" enctype="multipart/form-data">    
                        <div class="mb-3">
                            <label class="form-label">Add Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $post_title ; ?>" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="post_status" aria-label="Status" required>
                            <option value=<?php echo $post_status ;?>><?php echo ucfirst($post_status) ;?></option>
                            <?php if($post_status=='published'){?>
                            <option value="draft">Draft</option>
                            <?php } else { ?>
                            <option value="published">Published</option>
                            <?php }  ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Add Tags</label>
                            <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Add Image</label>
                            <img width='100' src='../images/<?php echo $post_image ;?>'>
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-pencil-square"></i> Content</label>
                            <textarea class="form-control" name="post_content" rows="6"><?php echo $post_content ; ?></textarea>
                        </div>
                        <input class="btn btn-primary mb-3" type="submit" name="EDIT" value="EDIT">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../footer.php";?>





