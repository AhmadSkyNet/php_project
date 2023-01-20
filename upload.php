<?php 
// multi upload file كود رفع ملفات متعدده

    if(isset($_POST['submit'])){
        
        $uploadsDir = "./images/";
        
            // Loop through file items نستخدم فور ايج لان تعدد الصور يحتاج مصفوفة
        foreach($_FILES['file']['name'] as $id => $val){
            
            // Get files upload path
            $array[$id]= $_FILES['file']['name'][$id];

            $fileName        = $_FILES['file']['name'][$id];
            $tempLocation    = $_FILES['file']['tmp_name'][$id];

            $temp = explode(".", $_FILES["file"]["name"][$id]); // نفصل اسم الصورة عن صيغتها وننقل الصيغة للمتغير $temp
            $fileName = uniqid() . '.' . end($temp); // نسوي تغيير للاسم من دالة يونيكيد وراها نرجع ال . وبعدها نرجع الصيغة للملف

            $targetFilePath  = $uploadsDir . $fileName;
            move_uploaded_file($tempLocation, $targetFilePath);
                        
        }
    }
?>
    <form method="post" enctype="multipart/form-data">  
        <div class="mb-3">
            <label for="formFile" class="form-label">Add Image</label>
            <input class="form-control" type="file" name="file[]" multiple id="formFile">
        </div>
       <input type="submit" value="Upload Image" name="submit">
    </form>