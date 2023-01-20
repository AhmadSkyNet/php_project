<?php include "header.php"; ?>

<?php
$username="";
if(isset($_POST['submit'])){
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);
    $password2=trim($_POST['password2']);
    $gender= $_POST['gender'];
    $error=['user'=>'','pass'=>'','email'=>''];

    if (strlen($username)<3) {
        $error['user']="Please enter a name that is at least 3 characters long.";
    }
    if ($password !== $password2) {
        $error['pass']="Password does not match!";
    } 

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
            $error['user']='Username has already been taken';
        } 

        if(!empty($user_id2) && $user_id2 != $id){
            $error['email']='Email has already been taken';
        } 

        if (array_filter($error)) {} // If the error array has an error, stop the process else start the process!
        else {
            $query="INSERT INTO users (user_name, user_password, user_email, user_gender, user_role) VALUES (?,?,?,?,?)";
            $result=$conn->prepare($query);
            $result->execute([$username,$password,$email,$gender,'user']);
            $user_id=$conn->lastinsertid();

            $_SESSION['user_id']=$user_id;
            $_SESSION['username']=$username;
            $_SESSION['email']=$email;
            $_SESSION['user_role']='user';
            header('location: index.php');
        }
}

?>

<div class="container">
    <div class="text-center pt-3">
        <img src="/php_project/images/register.png" class="img-fluid" alt="register" style= "width:200px ; height:200px;" >
    </div>
    </br>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <form method="post">
               <div class="input-group flex-nowrap p-1">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill-add"></i></span>
                    <input type="text" value="<?php echo isset($username) ? $username : '';?>" name="username" class="form-control " placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required autocomplete="on">
               </div>
               <p class="text-danger ms-4"> <?php echo isset($error['user']) ? $error['user'] : ''; // here is  if Statement ?> </p>
               <div class="input-group flex-nowrap p-1">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" value="<?php echo isset($email) ? $email : '';?>" name="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" required>
                </div>
                <p class="text-danger ms-4"><?php echo isset($error['email']) ? $error['email'] : ''; // here is  if Statement ?> </p>
               <div class="input-group flex-nowrap p-1">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-lock"></i></span>
                    <input type="Password" value="<?php echo isset($password) ? $password : '';?>" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                </div>
                <p class="text-danger ms-4"> <?php echo isset($error['pass']) ? $error['pass'] : ''; // here is  if Statement ?> </p>
                <div class="input-group flex-nowrap p-1">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-lock-fill"></i></span>
                    <input type="Password" value="<?php echo isset($password2) ? $password2 : '';?>" name="password2" class="form-control" placeholder="Confirm Password" aria-label="password2" aria-describedby="basic-addon1" required>
                </div>
                </br>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-people-fill"></i></i></span>
                    <select class="form-select" aria-label="Select your gender" name="gender" required>
                        <option selected> </option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                </br>
                <div class="input-group flex-nowrap">
                    <button type="submit" value="Register" name="submit" class="form-control btn btn-dark"><span><i class="bi bi-box-arrow-in-up"></i> Register</span></button>
                </div>
                <div class="input-group flex-nowrap p-4">
                 <span>Already have an account? <a href="login.php"><button type="button" class="btn btn-dark">Log in</button></a></span>
                </div>
            </form>
      </div>
   </div>
</div>
</br></br>

<?php include "footer.php"; ?>
