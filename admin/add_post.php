<?php include "nav.php"; ?>
    <div class="col-8">
        <div class="container">
            <h1 class="mt-5"><i class="bi bi-plus-square-fill"></i> Posts</h1>
            <div class="table-responsive">
                <?php
                    if(isset($_POST['create'])) {
                    $post_title        = $_POST['title'];
                    $post_status       = $_POST['post_status'];
                    $post_image        = $_FILES['file']['name'];
                    $post_image_temp   = $_FILES['file']['tmp_name'];
                    $post_tags         = $_POST['post_tags'];
                    $post_content      = $_POST['post_content'];
                    move_uploaded_file($post_image_temp, "../images/$post_image" );
                    $query = "INSERT INTO posts(post_title, post_date, post_image, post_content, post_tags, post_status)
                    VALUES(?, now(), ?, ?, ?,?)";      
                    $create_post_query = $conn->prepare($query);    
                    $create_post_query->execute([$post_title, $post_image, $post_content, $post_tags, $post_status]);    
                    $the_post_id = $conn->lastInsertId();
                    }
                ?>
                <div class="mb-4 ms-2">     
                    <form method="post" enctype="multipart/form-data">    
                        <div class="mb-3">
                            <label class="form-label">Add Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="post_status" aria-label="Status" required>
                                <option selected>Select Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Add Tags</label>
                            <input type="text" class="form-control" name="post_tags">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Add Image</label>
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-pencil-square"></i> Content</label>
                            <textarea class="form-control" name="post_content" rows="6"></textarea>
                        </div>
                        <input class="btn btn-primary mb-3" type="submit" name="create" value="Publish Post">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../footer.php";?>

