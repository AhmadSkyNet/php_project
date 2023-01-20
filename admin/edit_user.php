<?php include "nav.php"; ?>
    <div class="col-8">
        <div class="container">
            <h1 class="mt-5"><i class="bi bi-person-circle"></i> Members</h1>
            <div class="table-responsive">
                <?php
                    if(isset($_GET['edit'])) {
                        $id = $_GET['edit'];
                    }

                    if(isset($_POST['EDIT'])) {
                        $username    = $_POST['username'];
                        $email       = $_POST['email'];
                        $password    = $_POST['password'];
                        $password2   = $_POST['password2'];
                        $gender      = $_POST['gender'];

                        $error=['user'=>'','pass'=>'','email'=>''];
                        
                        if(strlen($username)<3){
                            $error['user']='username must be longer';
                        }
                        
                        if($password != $password2){
                            $error['pass']='password are not the same';
                        }

                        // --This is the smart way-- One SQL command 

                        $query="SELECT * FROM users WHERE user_name='$username' OR user_email='$email'";
                        $result = $conn->prepare($query);  
                        $result->execute();
                        if(!empty($result)){
                            while($row = $result->fetch()){
                                if($row['user_name']===$username){
                                $user_id= $row['user_id'];
                                }

                                if($row['user_email']===$email){
                                    $user_id2= $row['user_id'];
                                }

                            }
                        }

                        if(!empty($user_id) && $user_id != $id){
                            $error['user']='username exist';
                        } 

                        if(!empty($user_id2) && $user_id2 != $id){
                            $error['email']='email exist';
                        } 

                        /* --This easy and simple way-- Four SQL command

                        $query="SELECT * FROM users WHERE user_name ='$username'";
                        $result = $conn->prepare($query);  
                        $result->execute();
                        if(!empty($result)){
                            while($row = $result->fetch()){
                                $user_id= $row['user_id'];
                                }
                        }

                        $query= "SELECT COUNT(*) FROM users WHERE user_name ='$username'";
                        $result= $conn->prepare($query);
                        $result->execute();
                        $count = $result->fetchColumn();
                        
                        if(!empty($count) && $user_id != $id){
                            $error['user']='username exist';
                        } 
                        
                        $query="SELECT * FROM users WHERE user_email='$email'";
                        $result = $conn->prepare($query);  
                        $result->execute();
                        if(!empty($result)){
                            while($row = $result->fetch()){
                                $user_id= $row['user_id'];
                            }
                        }
                        
                        $query="SELECT COUNT(*) FROM users WHERE user_email='$email'";
                        $result=$conn->prepare($query);
                        $result->execute();
                        $count =$result->fetchColumn();
                        
                        if(!empty($count) && $user_id != $id){
                            $error['email']='email exist';
                        } 
                       */ 

                        if(array_filter($error)){}
                        else {
                        $query = "UPDATE users SET user_name = '$username', user_password = '$password', user_email = '$email' , user_gender= '$gender' WHERE user_id = '$id'";
                        $result = $conn->prepare($query);  
                        $result->execute();
                        header("location: users.php");
                        }
                    }
                    $query = "SELECT * FROM users WHERE user_id = '$id' ORDER BY user_id DESC";
                    $result = $conn->prepare($query);  
                    $result->execute();
                    while($row = $result->fetch()){
                        $user_id          = $row['user_id'];
                        $user_name        = $row['user_name'];
                        $user_password    = $row['user_password'];
                        $user_email       = $row['user_email'];
                        $user_gender      = $row['user_gender'];
                    }
                ?>
                <div class="mb-4 ms-2">     
                    <form method="post" enctype="multipart/form-data">    
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $user_name ; ?>" required>
                            <p class="text-danger"> <?php echo isset($error['user']) ? $error['user'] : '';?> </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $user_email ; ?>">
                            <p class="text-danger"> <?php echo isset($error['email']) ? $error['email'] : '';?> </p>
                        </div>
                        <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo $user_password;?>">
                        <p class="text-danger"> <?php echo isset($error['pass']) ? $error['pass'] : '';?> </p>
                        </div>
                        <div class="mb-3">
                        <label class="form-label">Confirm  Password</label>
                        <input type="password" class="form-control" name="password2" value="<?php echo $user_password;?>">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="gender" aria-label="gender" required>
                                <option value=<?php echo $user_gender ;?>><?php echo ucfirst($user_gender) ; // ucfirst Convert the first letter to uppercase ?></option> 
                                <?php if($user_gender == 'male'){?>
                                    <option value="female">Female</option>
                                <?php } else { ?>
                                    <option value="male">Male</option>
                                <?php }  ?>
                            </select>
                        </div>
                        <input class="btn btn-primary mb-3" type="submit" name="EDIT" value="EDIT">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../footer.php";?>