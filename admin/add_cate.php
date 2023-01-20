<?php include "nav.php"; ?>
    <div class="col-8">
        <div class="container">
            <h1 class="mt-5"><i class="bi bi-plus-square-fill"></i> Category</h1>
            <div class="table-responsive">
                <?php
                    if(isset($_POST['create'])) {
                    $cat_title        = $_POST['title'];
                    $cat_status       = $_POST['cat_status'];
                    $cat_image        = $_FILES['file']['name'];
                    $cat_image_temp   = $_FILES['file']['tmp_name'];
                    $cat_content      = $_POST['cat_content'];
                    $uniqid_image = uniqid("sky") . $cat_image ; // uniqid() is for rename the imges!
                    move_uploaded_file($cat_image_temp, "../images/$uniqid_image" );
                    $query = "INSERT INTO cate(cat_title, cat_date, cat_image, cat_content, cat_status)
                    VALUES(?,now(),?,?,?)";      
                    $create_cat_query = $conn->prepare($query);    
                    $create_cat_query->execute([$cat_title, $uniqid_image, $cat_content, $cat_status]);    
                    $the_cat_id = $conn->lastInsertId();
                    }
                ?>     
                <div class="mb-4 ms-2">     
                    <form method="post" enctype="multipart/form-data">    
                        <div class="mb-3">
                            <label class="form-label">Add Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="cat_status" aria-label="Status" required>
                                <option selected>Select Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Add Image</label>
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-pencil-square"></i> Content</label>
                            <textarea class="form-control" name="cat_content" rows="6"></textarea>
                        </div>
                        <input class="btn btn-primary mb-3" type="submit" name="create" value="Publish">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../footer.php";?>

