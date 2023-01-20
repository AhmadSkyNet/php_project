<?php include "nav.php"; ?>
    <div class="col-8">
        <div class="container">
            <h1 class="mt-5"><i class="bi bi-pencil-square"></i> Category</h1>
            <div class="table-responsive">
                <?php
                    if(isset($_GET['edit'])) {
                        $id=$_GET['edit'];
                    }
    
                    if(isset($_POST['EDIT'])) {
                        $cat_title        = $_POST['title'];
                        $cat_status       = $_POST['cat_status'];
                        $cat_image        = $_FILES['file']['name'];
                        $cat_image_temp   = $_FILES['file']['tmp_name'];
                        $cat_content      = $_POST['cat_content'];

                    if(empty($cat_image)){
                        $query = "SELECT * FROM cate WHERE cat_id = '$id'";
                        $result = $conn->prepare($query);  
                        $result->execute();
                        $row = $result->fetch();
                        $cat_image = $row['cat_image'];
                    }
                        move_uploaded_file($cat_image_temp, "../images/$cat_image");
                        $query = "UPDATE cate SET cat_title = ?, cat_date = now(), cat_image = ?,
                        cat_content = ?,  cat_status = ? WHERE cat_id = ?";
                        $result = $conn->prepare($query);  
                        $result->execute([$cat_title,$cat_image,$cat_content,$cat_status,$id]);
                        header("location: cate.php");
                    }
                    $query = "SELECT * FROM cate WHERE cat_id = '$id' ORDER BY cat_id DESC";
                    $result = $conn->prepare($query);  
                    $result->execute();
                    while($row = $result->fetch()){
                        $cat_id            = $row['cat_id'];
                        $cat_title         = $row['cat_title'];
                        $cat_status        = $row['cat_status'];
                        $cat_image         = $row['cat_image'];
                        $cat_content       = $row['cat_content'];
                        $cat_date          = $row['cat_date'];
                    }
                ?>     
                <div class="mb-4 ms-2">     
                    <form method="post" enctype="multipart/form-data">    
                        <div class="mb-3">
                            <label class="form-label">Add Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $cat_title ; ?>" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="cat_status" aria-label="Status" required>
                                <option value=<?php echo $cat_status ;?>><?php echo ucfirst($cat_status) ;?></option>
                                <?php if($cat_status == 'published'){?>
                                <option value="draft">Draft</option>
                                <?php } else { ?>
                                <option value="published">Published</option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Add Image</label>
                            <img width='100' src='../images/<?php echo $cat_image ;?>'>
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-pencil-square"></i> Content</label>
                            <textarea class="form-control" name="cat_content" rows="6"><?php echo $cat_content ; ?></textarea>
                        </div>
                        <input class="btn btn-primary mb-3" type="submit" name="EDIT" value="EDIT">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../footer.php";?>




