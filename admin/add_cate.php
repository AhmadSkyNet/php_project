<?php include "nav.php"; ?>
<?php include "fun.php"; ?>
<div class="container">
<div class="col-5 offset-1">
<?php
if(isset($_POST['create'])) {
$cat_title        = $_POST['title'];
$cat_status       = $_POST['cat_status'];
$cat_image        = $_FILES['file']['name'];
$cat_image_temp   = $_FILES['file']['tmp_name'];
$cat_content      = $_POST['cat_content'];
move_uploaded_file($cat_image_temp, "../images/$cat_image" );
$query = "INSERT INTO cate(cat_title, cat_date, cat_image, cat_content, cat_status)
VALUES(?,now(),?,?,?)";      
$create_cat_query = $conn->prepare($query);    
$create_cat_query->execute([$cat_title, $cat_image, $cat_content, $cat_status]);    
$the_cat_id = $conn->lastInsertId();
}?>     

<form method="post" enctype="multipart/form-data">    
<label>Title</label></br>
<input type="text" class="form-control" name="title" required> </br>
<label>Status</label></br>
<select class=custom-select name="cat_status">
<option value="published">Published</option>
<option value="draft">Draft</option>
</select></br></br>
<label>Image</label></br>
<input type="file" name="file"></br></br>
<label>Content</label></br>
<textarea class="form-control" name="cat_content" cols="10" rows="10"></textarea></br>
<input class="btn btn-primary" type="submit" name="create" value="Publish"></br>
</form></br>
</div></div></br></div>
<?php include "../footer.php";?>

